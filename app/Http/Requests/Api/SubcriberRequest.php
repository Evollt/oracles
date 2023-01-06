<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SubcriberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'discord_id' => [
                'required',
                'integer'
            ],
            'name' => [
                'required',
                'string'
            ],
            'discriminator' => [
                'required',
                'integer'
            ],
            'subscribe' => [
                'required',
                'boolean'
            ],
        ];
    }
}
