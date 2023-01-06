<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'email:rfc,dns',
                'nullable',
            ],
            'discord' => [
                'regex:/.+#\d{4}/',
                'nullable'
            ],
            'profile_pic' => [
                'required_without:use_nft'
            ],
            'first_name' => [
                'required_with:last_name'
            ],
            'last_name' => [
                'required_with:first_name'
            ],
            'nft_profile_pic' => [
                'required_if:use_nft,on'
            ],
        ];
    }

    public function messages(){
        return [
           'nft_profile_pic.required_if' => 'When use nft is enabled please select a nft as a profile picture',
           'profile_pic.required_without' => 'When use nft is disabled please select a default profile picture',
        ];
    }
}
