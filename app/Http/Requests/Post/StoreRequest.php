<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|min:1|max:50|unique:posts,title',
            'content' => 'required|min:3|max:50',
            'thumbnail' => 'image|mimes:png,jpg,jpeg|max:2048|dimensions:min_height:500,max_height:1000,ratio=3/2'

        ];
    }
}
