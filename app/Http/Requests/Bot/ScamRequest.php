<?php

namespace App\Http\Requests\Bot;

use Illuminate\Foundation\Http\FormRequest;

class ScamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_title' => [
                'required',
                'string',
            ],
            'old_text' => [
                'required',
                'string',
            ],
            'scam_status_id' => [
                'required',
            ],
            'post_title' => [
                'nullable',
                'string',
            ],
            'post_text' => [
                'nullable',
                'string',
            ],
        ];
    }
}
