<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupFormRequest;
use App\Models\Amenity;
use App\Models\BedType;
use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(SignupFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $user =  User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'phone_number' => $request->get('phone_number'),
                'account_type' => $request->get('account_type'),
            ]);
            // if manager signing up,
            if($user->account_type == User::ACCOUNT_TYPE_MANAGER){
                // we will create the business name
                $business = $user->business()->create([
                    'name' => $request->get('business_name')
                ]);
                // Seed the common bed types
                $bedTypes = [];
                foreach (BedType::COMMON_BED_TYPES as $bedType){
                    $bedType['user_id'] = $user->id;
                    $bedTypes[] = new BedType($bedType);
                }
                $business->bedTypes()->saveMany($bedTypes);
                // Seed the common room categories
                $categories = [];
                foreach (Category::COMMON_CATEGORIES as $categoryName){
                    $categories[] = new Category([
                        'name' => $categoryName,
                        'user_id' => $user->id,
                    ]);
                }
                $business->categories()->saveMany($categories);
                // Seed the common amenities
                $amenities = [];
                foreach (Amenity::COMMON_AMENITIES as $amenityName){
                    $amenities[] = new Amenity([
                        'name' => $amenityName,
                        'user_id' => $user->id,
                    ]);
                }
                $business->amenities()->saveMany($amenities);
                // we send email verification link
                $user->sendEmailVerificationNotification();
            }
            DB::commit();
            // sign user in
            Auth::attempt([
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ]);
            return response()->json("Your account has created successfully!");
        }catch (Exception $ex){
            DB::rollBack();
            Log::error("USER_REGISTRATION: {$ex->getMessage()}");
            return response()->json($ex->getMessage(), Response::HTTP_FORBIDDEN);
        }

    }
}
