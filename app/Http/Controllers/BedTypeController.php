<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBedTypeRequest;
use App\Http\Requests\UpdateBedTypeRequest;
use App\Models\BedType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BedTypeController extends Controller
{
    public function index()
    {
        $user = $this->getLoggedInUser();
        $bedTypes = BedType::forBusiness($user->business->id)
                           ->get()
                           ->map(function(BedType $bedType){
            unset($bedType->business_id);
            unset($bedType->user_id);
            return $bedType;
        });
        return response()->json($bedTypes);
    }

    public function options()
    {
        $user = $this->getLoggedInUser();
        $bedTypes = BedType::forBusiness($user->business->id)->get(['id','name']);
        return response()->json($bedTypes);
    }

    public function store(StoreBedTypeRequest $request)
    {
        $user = $this->getLoggedInUser();
        $bedType = new BedType();
        $bedType->name = $request->get('name');
        $bedType->capacity = $request->get('capacity');
        $bedType->business_id = $user->business->id;
        $bedType->user_id = $user->id;
        $bedType->save();
        return response()->json("Your bed type was added successfully!");
    }

    public function update(UpdateBedTypeRequest $request, BedType $bedType)
    {
        $bedType->name = $request->get('name');
        $bedType->capacity = $request->get('capacity');
        $bedType->save();
        return response()->json("Your bed type was updated successfully!");
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        $user = $this->getLoggedInUser();
        $bedType = BedType::forBusiness($user->business->id)->find($id);
        if (!$bedType)
        {
            return response()->json("Bed type with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        return response()->json($bedType);
    }
}
