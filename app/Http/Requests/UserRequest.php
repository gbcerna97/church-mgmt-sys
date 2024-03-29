<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if(request()->routeIs('user.login')) {
            return [
                'email' => 'required|string|email|max:255',
                'password' => 'required|min:8',
            ];
        } else if(request()->routeIs('user.update')) {
                return [
                    'name' =>  'required|string|max:255',
                    'email' => 'required|string|email|unique:App\Models\User,email|max:255',
                ];
        } else if(request()->routeIs('user.email')) {
            return [
                
            ];
        } else if(request()->routeIs('password.update')) {
            return [
                'password' => 'required|confirmed|min:8',
            ];
        } else if(request()->routeIs('user.register')) {
            return [
                'name' =>  'required|string|max:255',
                'email' => 'required|string|email|unique:App\Models\User,email|max:255',
                'password' => 'required|confirmed|min:8',
            ];
        } else if(request()->routeIs('user.image')) {
            return [
                'image' => 'required|image|mimes:jpg,bmp,png|max:2048',
            ];
        }
    }
}
