<?php

namespace App\Http\Livewire\Auth;

use App\Models\Amenity;
use App\Models\BedType;
use App\Models\Business;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Exception;

class SignupForm extends Component
{
    public $account_type = User::ACCOUNT_TYPE_GUEST;
    public $name = '';
    public $business_name = '';
    public $email = '';
    public $phone_number = '';
    public $password = '';
    public $account_types = [
        User::ACCOUNT_TYPE_GUEST => "Guest",
        User::ACCOUNT_TYPE_MANAGER => 'Property Manager',
    ];

    protected $rules = [
        'account_type' => 'required|in:'. User::ACCOUNT_TYPE_MANAGER .','. User::ACCOUNT_TYPE_GUEST,
        'name' => 'required|min:7',
        'phone_number' => 'required|string|min:9|max:21|regex:'.User::PHONE_NUMBER_REGEX, // e.g +256xxxxxxxxx
        'email' => 'required|email|unique:users',
        'password' => 'required|regex:'.User::PASSWORD_FORMAT_REGEX,
        'business_name' => 'required_if:account_type,'.User::ACCOUNT_TYPE_MANAGER,
    ];

    protected $messages = [
        'password.regex' => "The password must be at least 8 characters long.<br />
        The password must contain at least one uppercase letter alphabets.<br />
        The password must contain at least one lowercase letter alphabets.<br />
        The password must contain at least one digit.<br />
        The password must contain at least one special character.",
    ];

    private function resetFormFields()
    {
        $this->account_type = User::ACCOUNT_TYPE_GUEST;
        $this->name = '';
        $this->business_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->password = '';
    }

    public function resetForm()
    {
        $this->resetFormFields();
    }

    public function register()
    {
        try {
            $this->validate();
            DB::beginTransaction();
            /**
             * @var User $user
             */
            $user =  User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'phone_number' => $this->phone_number,
                'account_type' => $this->account_type,
            ]);
            // if manager signing up,
            if($user->account_type == User::ACCOUNT_TYPE_MANAGER){
                // we will create the business name
                $business = $user->business()->create([
                    'name' => $this->business_name
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
                'email' => $this->email,
                'password' => $this->password,
            ]);
            session()->flash('success', "Your account has created successfully!");
            return redirect()->route('home');
        }catch (Exception $ex){
            DB::rollBack();
            Log::error("USER_REGISTRATION: {$ex->getMessage()}");
            session()->flush('error', $ex->getMessage());
        }

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.auth.signup-form')
            ->extends('auth.layout')
            ->section('content');
    }
}
