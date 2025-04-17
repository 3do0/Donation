<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\OrganizationUser; 

class OrganizationProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $user = Auth::guard('organization')->user();

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(OrganizationUser::class)->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'currency' => ['required', 'in:YER,SAR,USD'],
            'photo' => ['nullable', 'image', 'max:10000'],
        ];
    }
}
