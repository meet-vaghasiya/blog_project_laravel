<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'thumbnail' => 'image|mimes:png,jpg,jpeg|max:2048|dimensions:width=128,height=128',
            'locale'=>[
                'required',
                Rule::in(array_keys(User::LOCALES))
            ]

        ];
    }
}
