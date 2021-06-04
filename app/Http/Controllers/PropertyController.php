<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\RemovePropertyAmenityRequest;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UploadAdditionalPhotosRequest;
use App\Models\Image;
use App\Models\Property;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\InteractsWithMedia;

class PropertyController extends Controller
{
    use InteractsWithMedia;

    public function index()
    {
        $user = $this->getLoggedInUser();
        $propertiesData = Property::forBusiness($user->business->id)->paginate(5);
        $properties = Helpers::generatePagination($propertiesData);
        $properties->data = $propertiesData->getCollection()->map(function (Property $property) {
            return $property->getInfo();
        });
        return response()->json($properties);
    }

    public function store(StorePropertyRequest $request)
    {
        try
        {
            $user = $this->getLoggedInUser();
            DB::beginTransaction();
            // the property
            $property = new Property();
            $property->name = $request->get('name');
            $property->description = $request->get('description');
            $property->business_id = $user->business->id;
            $property->user_id = $user->id;
            $property->country = $request->get('country');
            $property->city = $request->get('city');
            $property->street = $request->get('street');
            $property->zip = $request->get('zip');
            $property->save();
            // attach the amenities
            if ($amenities = $request->get('amenities'))
            {
                $amenities = array_map(function ($amenity) {
                    return intval($amenity);
                }, explode(',', $amenities));
                $property->amenities()->syncWithPivotValues($amenities, [
                    'user_id' => $user->id,
                ]);
            }
            // try to upload featured image if available
            if ($request->hasFile('photo'))
            {
                $directory = "images/properties/{$property->id}";
                $photo = $request->file('photo');
                $path = $photo->store($directory, 'public'); // in public disk storage
                $thumbnailPath = $photo->store("{$directory}/thumbnails", 'public'); // in public disk storage
                $fileName = $photo->hashName();
                // resize the image so that the largest side fits within the limit; the smaller
                // side will be scaled to maintain the original aspect ratio
                $this->resizeImage("storage/{$path}",null, 400, [
                    'aspectRatio' => true,
                    'upsize' => true,
                ]);
                // Create the thumbnail
                $this->resizeImage("storage/{$thumbnailPath}",null, 100, [
                    'aspectRatio' => true,
                ]);
                $property->images()->save(new Image([
                    'user_id' => $user->id,
                    'name' => $fileName,
                    'path' => "/storage/{$path}",
                    'thumbnailName' => $fileName,
                    'thumbnailPath' => "/storage/{$thumbnailPath}",
                    'featured' => true,
                ]));
            }
            DB::commit();
            return response()->json("Your property was added successfully!");
        } catch (Exception $ex)
        {
            DB::rollback();
            Log::error("CREATE_PROPERTY: {$ex->getMessage()}", $request->all());
            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $user = $this->getLoggedInUser();
            $property = Property::forBusiness($user->business->id)->find($id);
            if (!$property)
            {
                return response()->json("Property with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
            }
            DB::beginTransaction();
            $property->name = $request->get('name');
            $property->description = $request->get('description');
            $property->country = $request->get('country');
            $property->city = $request->get('city');
            $property->street = $request->get('street');
            $property->zip = $request->get('zip');
            $property->save();
            // attach the amenities
            if ($amenities = $request->get('amenities'))
            {
                $amenities = array_map(function ($amenity) {
                    return intval($amenity);
                }, explode(',', $amenities));
                $property->amenities()->syncWithPivotValues($amenities, [
                    'user_id' => $user->id,
                ]);
            }
            // try to upload featured image if available
            if ($request->hasFile('photo'))
            {
                $directory = "images/properties/{$property->id}";
                $photo = $request->file('photo');
                $path = $photo->store($directory, 'public'); // in public disk storage
                $thumbnailPath = $photo->store("{$directory}/thumbnails", 'public'); // in public disk storage
                $fileName = $photo->hashName();
                // resize the image so that the largest side fits within the limit; the smaller
                // side will be scaled to maintain the original aspect ratio
                $this->resizeImage("storage/{$path}",null, 400, [
                    'aspectRatio' => true,
                    'upsize' => true,
                ]);
                // Create the thumbnail
                $this->resizeImage("storage/{$thumbnailPath}",null, 100, [
                    'aspectRatio' => true,
                ]);
                $property->images()->featured()->update([
                    'featured' => false
                ]);
                $property->images()->save(new Image([
                    'user_id' => $user->id,
                    'name' => $fileName,
                    'path' => "/storage/{$path}",
                    'thumbnailName' => $fileName,
                    'thumbnailPath' => "/storage/{$thumbnailPath}",
                    'featured' => true,
                ]));
            }
            DB::commit();
            return response()->json("Your property was updated successfully!");
        } catch (Exception $ex)
        {
            DB::rollback();
            Log::error("UPDATE_PROPERTY: {$ex->getMessage()}", $request->all());
            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $user = $this->getLoggedInUser();
        $property = Property::forBusiness($user->business->id)->find($id);
        if (!$property)
        {
            return response()->json("Property with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        $propertyData = $property->getInfoForManager();
        return response()->json($propertyData);
    }

    public function getPropertyRoomsOrServices($id)
    {
        $user = $this->getLoggedInUser();
        $property = Property::forBusiness($user->business->id)->find($id);
        if (!$property)
        {
            return response()->json("Property with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        $roomsOrServices = $property->getRoomsOrServicesForManager();
        return response()->json($roomsOrServices);
    }

    public function publish($id)
    {
        $user = $this->getLoggedInUser();
        $property = Property::forBusiness($user->business->id)->find($id);
        if (!$property)
        {
            return response()->json("Property with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        if ($property->rooms()->count() == 0)
        {
            return response()->json("Sorry, this property does not have any rooms/services!", Response::HTTP_FORBIDDEN);
        }
        $property->published = true;
        $property->save();
        return response()->json("Property published successfully!");
    }

    public function unpublish($id)
    {
        $user = $this->getLoggedInUser();
        $property = Property::forBusiness($user->business->id)->find($id);
        if (!$property)
        {
            return response()->json("Property with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        $property->published = false;
        $property->save();
        return response()->json("Property unpublished successfully!");
    }

    public function getForUpdate(Request $request, $id)
    {
        $user = $this->getLoggedInUser();
        $property = Property::forBusiness($user->business->id)->find($id);
        if (!$property)
        {
            return response()->json("Property with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        $propertyData = $property->getInfo();
        return response()->json($propertyData);
    }

    public function uploadAdditionalPhotos(UploadAdditionalPhotosRequest $request, $id)
    {
        try
        {
            $user = $this->getLoggedInUser();
            $property = Property::forBusiness($user->business->id)->find($id);
            if (!$property)
            {
                return response()->json("Property with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
            }
            // try to upload additional photos if available
            $photos = $request->file('photos');
            $directory = "images/properties/{$property->id}";
            foreach ($photos as $photo)
            {
                $path = $photo->store($directory, 'public'); // in public disk storage
                $thumbnailPath = $photo->store("{$directory}/thumbnails", 'public'); // in public disk storage
                $fileName = $photo->hashName();
                // resize the image so that the largest side fits within the limit; the smaller
                // side will be scaled to maintain the original aspect ratio
                $this->resizeImage("storage/{$path}",null, 400, [
                    'aspectRatio' => true,
                    'upsize' => true,
                ]);
                // Create the thumbnail
                $this->resizeImage("storage/{$thumbnailPath}",null, 100, [
                    'aspectRatio' => true,
                ]);
                // Store the image data in the DB
                $property->images()->save(new Image([
                    'user_id' => $user->id,
                    'name' => $fileName,
                    'path' => "/storage/{$path}",
                    'thumbnailName' => $fileName,
                    'thumbnailPath' => "/storage/{$thumbnailPath}",
                ]));
            }
            $count = count($photos);
            return response()->json("Successfully uploaded {$count} additional photos!");
        } catch (Exception $ex)
        {
            Log::error("UPLOAD_PROPERTY_ADDITIONAL_PHOTOS: {$ex->getMessage()}", $request->all());
            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function removeAmenity(RemovePropertyAmenityRequest $request)
    {
        $propertyId = $request->get('propertyId');
        $amenityId = $request->get('amenityId');
        $property = Property::query()->find($propertyId);
        if (!$property)
        {
            return response()->json("Property not found!", Response::HTTP_FORBIDDEN);
        }
        $property->amenities()->detach($amenityId);

        return response()->json("Amenity removed successfully!");
    }
}
