<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class SignupFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_type' => 'required|in:' . User::ACCOUNT_TYPE_MANAGER . ',' . User::ACCOUNT_TYPE_GUEST,
            'name' => 'required|min:7',
            'phone_number' => 'required|string|min:9|max:21|regex:' . User::PHONE_NUMBER_REGEX, // e.g +256xxxxxxxxx
            'email' => 'required|email|unique:users',
            'password' => 'required|regex:' . User::PASSWORD_FORMAT_REGEX,
            'business_name' => 'required_if:account_type,' . User::ACCOUNT_TYPE_MANAGER,
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => "The password must be at least 8 characters long.<br />
        The password must contain at least one uppercase letter alphabets.<br />
        The password must contain at least one lowercase letter alphabets.<br />
        The password must contain at least one digit.<br />
        The password must contain at least one special character.",
        ];
    }
}
