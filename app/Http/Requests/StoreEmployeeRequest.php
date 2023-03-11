<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Employee::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:150',
            'email' => ['required', 'email', 'max:255', Rule::unique('employees')],
            'phone' => ['required', 'max:15', 'regex:/^\+[1-9]\d{1,14}$/'],
        ];
    }
}
