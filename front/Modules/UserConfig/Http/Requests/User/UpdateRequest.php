<?php

namespace Modules\UserConfig\Http\Requests\User;

use App\Models\User;
use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => 'required',
            'email' => ['required', Rule::unique(User::getTableName())->ignore($userId)],
            'password' => [
                'nullable', 'min:8',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
            'role' => 'required',
        ];
    }

    public function messages(): array
    {
        return  ['min' => ':attribute Minimal terdiri dari :min karakter'];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama',
            'role' => 'peran',
            'user_type' => 'Tipe User'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
