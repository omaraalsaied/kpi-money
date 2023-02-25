<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPointRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'user_id'=>'required|exists:users,id',
            'link_id' => 'required|exists:web_site_links,id',
        ];
    }
}
