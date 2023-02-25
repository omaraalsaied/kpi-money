<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSiteLinkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
             "title"=> "required",
             "site_url"=> "required|url", 
             "code_number"=> "required|min:1", 
             "reward"=>"required|min:1"
        ];
    }
}
