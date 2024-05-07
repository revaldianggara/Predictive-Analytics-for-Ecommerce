<?php

namespace Modules\UserConfig\Http\Requests\User;

use App\Models\User;
use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:' . User::getTableName(),
            'email' => 'required|email|unique:' . User::getTableName(),
            'password' => [
                'required', 'min:8',
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
