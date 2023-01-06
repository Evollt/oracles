<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class SecurityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phishing_code' => [
                'nullable',
                'between:6,9',
                'string',
            ],
            'inactive_timer' => [
                'between:1,30',
                'numeric',
            ]
        ];
    }
}
