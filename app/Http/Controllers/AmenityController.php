<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AmenityController extends Controller
{
    public function index()
    {
        $user = $this->getLoggedInUser();
        $amenitiesData = Amenity::forBusiness($user->business->id)->paginate(15);
        $amenities = Helpers::generatePagination($amenitiesData);
        $amenities->data = $amenitiesData->getCollection()->map(function(Amenity $amenity){
            unset($amenity->business_id);
            unset($amenity->user_id);
            return $amenity;
        });
        return response()->json($amenities);
    }

    public function options()
    {
        $user = $this->getLoggedInUser();
        $amenities = Amenity::forBusiness($user->business->id)->get(['id','name']);
        return response()->json($amenities);
    }

    public function store(StoreAmenityRequest $request)
    {
        $user = $this->getLoggedInUser();
        $amenity = new Amenity();
        $amenity->name = $request->get('name');
        $amenity->description = $request->get('description');
        $amenity->business_id = $user->business->id;
        $amenity->user_id = $user->id;
        $amenity->save();
        return response()->json("Your amenity was added successfully!");
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        $amenity->name = $request->get('name');
        $amenity->description = $request->get('description');
        $amenity->save();
        return response()->json("Your amenity was updated successfully!");
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        $user = $this->getLoggedInUser();
        $amenity = Amenity::forBusiness($user->business->id)->find($id);
        if (!$amenity)
        {
            return response()->json("Amenity with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        return response()->json($amenity);
    }
}
