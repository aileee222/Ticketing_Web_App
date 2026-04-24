<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname'        => ['sometimes','nullable','string','max:255'],
            'lastname'         => ['sometimes','nullable','string', 'max:255'],
            'tel'              => ['sometimes','nullable','numeric','digits:10'],
            'birthday'         => ['sometimes','nullable','date'],
            'location'         => ['sometimes','nullable','string','max:255'],
            'education'        => ['sometimes','nullable','string','max:255'],
        ];
    }
}
