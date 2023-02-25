<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferwallRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "name"=>"required",
            "subtitle"=> "required",
            "url"=> "required|url",
            "points"=> "required",
            'image' => 'nullable|image|mimes:image/jpeg,jpeg,image/jpg,jpg,image/png,png,image/gif,gif|
            mimetypes:image/jpeg,jpeg,image/jpg,jpg,image/png,png,image/gif,gif|max:10240',
            "type"=> "required",
            "featured"=> "required",
            "position"=> "required"
        ];
    }
}
