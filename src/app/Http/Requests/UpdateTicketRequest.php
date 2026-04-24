<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'name'          => ['sometimes','nullable','string','max:255'],
            'description'   => ['sometimes','nullable','string', 'max:255'],
            'fromproject'   => ['sometimes','nullable','string','max:255'],
            'tlimit'        => ['sometimes','nullable','date'],
            'comment'       => ['sometimes','nullable','string','max:255'],
            'status'        => ['sometimes','nullable','string','max:255'],
        ];
    }
}
