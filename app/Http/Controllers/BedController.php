<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoveBedRequest;
use App\Http\Requests\StoreBedRequest;
use App\Models\Room;
use App\Models\RoomBed;
use Illuminate\Http\Response;

class BedController extends Controller
{
    public function store(StoreBedRequest $request)
    {
        $roomId = $request->get('roomId');
        $bedTypeId = $request->get('bedTypeId');
        $numberOfBeds = $request->get('numberOfBeds');
        $user = $this->getLoggedInUser();

        $room = Room::query()->find($roomId);
        if (!$room)
        {
            return response()->json("Room not found!", Response::HTTP_FORBIDDEN);
        }

        $room->beds()->syncWithPivotValues([$bedTypeId],['number_of_beds' => $numberOfBeds, 'user_id' => $user->id], false);

        return response()->json("Bed saved successfully!");
    }

    public function remove(RemoveBedRequest $request)
    {
        $roomId = $request->get('roomId');
        $bedTypeId = $request->get('bedTypeId');
        RoomBed::query()->where([
            'room_id' => $roomId,
            'bed_type_id' => $bedTypeId,
        ])->delete();

        return response()->json("Bed removed successfully!");
    }
}
