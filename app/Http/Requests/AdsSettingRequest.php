<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "admob_pub_id"=>"required",
            "admob_app_id"=>"required",
            "admob_bads_id"=>"required",
            "admob_iads_id"=>"required",
            "admob_rads_id"=>"required",
            "facebook_app_id"=>"required",
            "facebook_bads_p_id"=>"required",
            "facebook_rads_p_id"=>"required"
        ];
    }
}
