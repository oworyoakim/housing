<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\BedType;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Room;
use App\Models\User;
use App\Traits\InteractsWithUser;
use App\Traits\VerifiesEmails;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    use VerifiesEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verifyEmailAddress');
        $this->middleware('throttle:6,1')->only('verifyEmailAddress');
    }

    public function getUserData()
    {
        $loggedInUser = $this->getLoggedInUser();
        return response()->json($loggedInUser);
    }

    public function getFormOptions(Request $request)
    {
        $user = $this->getLoggedInUser();
        $options = $request->get('options');
        $formOptions = [
            'amenities' => [],
            'countries' => [],
            'cities' => [],
            'bedTypes' => [],
            'roomCategories' => [],
            'ratePeriods' => [],
        ];
        if (strpos($options, 'countries') !== false || strpos($options, 'all') !== false)
        {
            $formOptions['countries'] = Country::all(['id', 'name', 'code']);
        }
        if (strpos($options, 'cities') !== false || strpos($options, 'all') !== false)
        {
            $formOptions['cities'] = City::all(['id', 'name']);
        }
        if (strpos($options, 'amenities') !== false || strpos($options, 'all') !== false)
        {
            $formOptions['amenities'] = Amenity::forBusiness($user->business->id)->get(['id', 'name']);
        }
        if (strpos($options, 'bedTypes') !== false || strpos($options, 'all') !== false)
        {
            $formOptions['bedTypes'] = BedType::forBusiness($user->business->id)->get(['id', 'name']);
        }
        if (strpos($options, 'roomCategories') !== false || strpos($options, 'all') !== false)
        {
            $formOptions['roomCategories'] = Category::forBusiness($user->business->id)->get(['id', 'name']);
        }
        if (strpos($options, 'ratePeriods') !== false || strpos($options, 'all') !== false)
        {
            $formOptions['ratePeriods'] = [
                ['value' => Room::RATE_PERIOD_NIGHT, 'label' => 'Per Night'],
                ['value' => Room::RATE_PERIOD_DAY, 'label' => 'Per Day (24 hours)'],
                ['value' => Room::RATE_PERIOD_MONTH, 'label' => 'Per Month'],
            ];
        }
        return response()->json($formOptions);
    }

    public function manager()
    {
        return view('manager_layout');
    }

    public function profile()
    {
        return view('account.profile');
    }

    public function bookings()
    {
        return view('account.bookings');
    }
}
