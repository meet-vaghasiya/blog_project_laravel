<?php

namespace App\Http\Requests\Post;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'title' => 'required|unique:posts,title,' . $this->post->id, // here we are using post in route params. and we are accessig by route modal binding. so use like this . other wise just use $this->id
            'content' => 'required|min:3'
        ];
    }
}
