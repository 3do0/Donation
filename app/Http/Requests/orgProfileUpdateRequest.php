<?php

namespace App\Http\Requests;

use App\Models\OrganizationUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class orgProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
 

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(OrganizationUser::class)->ignore($this->user()->id),
            ], 
            'phone' => ['nullable', 'string', 'max:20'],
            'currency' => ['required', 'in:YER,SAR,USD'],
            'photo' => ['nullable', 'image', 'max:10000'],
        ];
    }
}
