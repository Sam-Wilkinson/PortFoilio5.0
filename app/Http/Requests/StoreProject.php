<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProject extends FormRequest
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
            'name'=>"required|max:255",
            'description'=>"required",
            'image' => "image|max:200000",
            'URL' => "required|URL",
            'date' =>"required|date|before_or_equal:today",
            'client'=>"required|digits_between:1,100",
            'technologies' => "required|array",
        ];
    }
}
