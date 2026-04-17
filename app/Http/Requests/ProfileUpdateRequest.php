<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // ✔ Editable fields
            'name' => ['required', 'string', 'max:255'],

            'phone' => ['nullable', 'string', 'max:20'],

            'address' => ['nullable', 'string', 'max:255'],

            'profile_photo' => ['nullable', 'image', 'max:2048'],

            /**
             * ⚠️ Email kept for safety (but you are not using edit in UI)
             * If you want FULL lock, you can remove email completely
             */
            'email' => [
                'sometimes',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}