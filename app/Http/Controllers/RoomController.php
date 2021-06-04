<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoveRoomAmenityRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UploadAdditionalPhotosRequest;
use App\Models\Image;
use App\Models\Property;
use App\Models\Room;
use App\Traits\InteractsWithMedia;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    use InteractsWithMedia;

    public function store(StoreRoomRequest $request)
    {
        try
        {
            $user = $this->getLoggedInUser();
            DB::beginTransaction();
            $tax = floatval($request->get('tax'));
            if (!$tax)
            {
                $tax = 0.00;
            }
            // the property
            $room = new Room();
            $room->name = $request->get('name');
            $room->description = $request->get('description');
            $room->rate = $request->get('rate');
            $room->ratePeriod = $request->get('ratePeriod');
            $room->tax = $tax / 100;
            $room->category_id = $request->get('categoryId');
            $room->property_id = $request->get('propertyId');
            $room->frequency = $request->get('frequency') ?? 1;
            $room->bathrooms = $request->get('bathrooms') ?? 1;
            $room->user_id = $user->id;
            $room->save();
            // attach the amenities
            if ($amenities = $request->get('amenities'))
            {
                $amenities = array_map(function ($amenity) {
                    return intval($amenity);
                }, explode(',', $amenities));
                $room->amenities()->syncWithPivotValues($amenities, [
                    'user_id' => $user->id,
                ]);
            }
            // try to upload featured image if available
            if ($request->hasFile('photo'))
            {
                $directory = "images/properties/{$room->property_id}/rooms/{$room->id}";
                $photo = $request->file('photo');
                $path = $photo->store($directory, 'public'); // in public disk storage
                $thumbnailPath = $photo->store("{$directory}/thumbnails", 'public'); // in public disk storage
                $fileName = $photo->hashName();
                // resize the image
                $this->resizeImage("storage/{$path}", null, 400, [
                    'aspectRatio' => true,
                    'upsize' => true,
                ]);
                // create the thumbnail
                $this->resizeImage("storage/{$thumbnailPath}", null, 100, [
                    'aspectRatio' => true,
                ]);
                $room->images()->save(new Image([
                    'user_id' => $user->id,
                    'name' => $fileName,
                    'path' => "/storage/{$path}",
                    'thumbnail_name' => $fileName,
                    'thumbnail_path' => "/storage/{$thumbnailPath}",
                    'featured' => true,
                ]));
            }
            DB::commit();
            return response()->json("Your room/service was added successfully!");
        } catch (Exception $ex)
        {
            DB::rollback();
            Log::error("CREATE_ROOM: {$ex->getMessage()}", $request->all());
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $user = $this->getLoggedInUser();
            $propertyId = $request->get('propertyId');
            $room = Room::where(['property_id' => $propertyId])->find($id);
            if (!$room)
            {
                return response()->json("Room with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
            }
            DB::beginTransaction();
            $tax = floatval($request->get('tax'));
            if (!$tax)
            {
                $tax = 0;
            }
            $room->name = $request->get('name');
            $room->description = $request->get('description');
            $room->rate = $request->get('rate');
            $room->ratePeriod = $request->get('ratePeriod');
            $room->tax = $tax / 100;
            $room->category_id = $request->get('categoryId');
            $room->frequency = $request->get('frequency') ?? 1;
            $room->bathrooms = $request->get('bathrooms') ?? 1;
            $room->save();
            // attach the amenities
            if ($amenities = $request->get('amenities'))
            {
                $amenities = array_map(function ($amenity) {
                    return intval($amenity);
                }, explode(',', $amenities));
                $room->amenities()->syncWithPivotValues($amenities, [
                    'user_id' => $user->id,
                ]);
            }
            // try to upload featured image if available
            if ($request->hasFile('photo'))
            {
                $directory = "images/properties/{$room->property_id}/rooms/{$room->id}";
                $photo = $request->file('photo');
                $path = $photo->store($directory, 'public'); // in public disk storage
                $thumbnailPath = $photo->store("{$directory}/thumbnails", 'public'); // in public disk storage
                $fileName = $photo->hashName();
                // resize the image
                $this->resizeImage("storage/{$path}", null, 400, [
                    'aspectRatio' => true,
                    'upsize' => true,
                ]);
                // create the thumbnail
                $this->resizeImage("storage/{$thumbnailPath}", null, 100, [
                    'aspectRatio' => true,
                ]);

                $room->images()->featured()->update([
                    'featured' => false
                ]);
                $room->images()->save(new Image([
                    'user_id' => $user->id,
                    'name' => $fileName,
                    'path' => "/storage/{$path}",
                    'thumbnailName' => $fileName,
                    'thumbnailPath' => "/storage/{$thumbnailPath}",
                    'featured' => true,
                ]));
            }
            DB::commit();
            return response()->json("Your room/service was updated successfully!");
        } catch (Exception $ex)
        {
            DB::rollback();
            Log::error("UPDATE_ROOM: {$ex->getMessage()}", $request->all());
        }
    }

    public function getForUpdate(Request $request, $id)
    {
        $propertyId = $request->get('propertyId');
        $room = Room::where(['property_id' => $propertyId])->find($id);
        if (!$room)
        {
            return response()->json("Room with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        $roomData = $room->getRoomInfo();
        return response()->json($roomData);
    }

    public function show(Request $request, $id)
    {
        $propertyId = $request->get('propertyId');
        $room = Room::where(['property_id' => $propertyId])->find($id);
        if (!$room)
        {
            return response()->json("Room with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        $roomData = $room->getRoomInfoForManager();
        return response()->json($roomData);
    }

    public function publish(Request $request, $id)
    {
        $user = $this->getLoggedInUser();
        $propertyId = $request->get('propertyId');
        $property = Property::forBusiness($user->business->id)->find($propertyId);
        if (!$property)
        {
            return response()->json("Property with id {$propertyId} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }

        if (!$property->published)
        {
            return response()->json("Sorry, the property that this room belongs to is not published for public view!", Response::HTTP_FORBIDDEN);
        }
        $room = $property->rooms()->find($id);
        if (!$room)
        {
            return response()->json("Room with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }

        $room->published = true;
        $room->save();
        return response()->json("Room/Service published successfully!");
    }

    public function unpublish(Request $request, $id)
    {
        $propertyId = $request->get('propertyId');
        $room = Room::where(['property_id' => $propertyId])->find($id);
        if (!$room)
        {
            return response()->json("Room with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        $room->published = false;
        $room->save();
        return response()->json("Room/Service unpublished successfully!");
    }

    public function uploadAdditionalPhotos(UploadAdditionalPhotosRequest $request, $id)
    {
        try
        {
            $user = $this->getLoggedInUser();
            $propertyId = $request->get('propertyId');
            $room = Room::where(['property_id' => $propertyId])->find($id);
            if (!$room)
            {
                return response()->json("Room with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
            }
            // try to upload additional photos if available
            $photos = $request->file('photos');
            $directory = "images/properties/{$room->property_id}/rooms/{$room->id}";
            foreach ($photos as $photo)
            {
                $path = $photo->store($directory, 'public'); // in public disk storage
                $thumbnailPath = $photo->store("{$directory}/thumbnails", 'public'); // in public disk storage
                $fileName = $photo->hashName();
                // resize the image so that the largest side fits within the limit; the smaller
                // side will be scaled to maintain the original aspect ratio
                $this->resizeImage("storage/{$path}", null, 400, [
                    'aspectRatio' => true,
                    'upsize' => true,
                ]);
                // Create the thumbnail
                $this->resizeImage("storage/{$thumbnailPath}", null, 100, [
                    'aspectRatio' => true,
                ]);
                // Store the image data in the DB
                $room->images()->save(new Image([
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
            Log::error("UPLOAD_ROOM_ADDITIONAL_PHOTOS: {$ex->getMessage()}", $request->all());
            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function removeAmenity(RemoveRoomAmenityRequest $request)
    {
        $roomId = $request->get('roomId');
        $amenityId = $request->get('amenityId');
        $room = Room::query()->find($roomId);
        if (!$room)
        {
            return response()->json("Room not found!", Response::HTTP_FORBIDDEN);
        }
        $room->amenities()->detach($amenityId);

        return response()->json("Amenity removed successfully!");
    }
}
