<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->employee);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|max:150',
            'email' => [ 'nullable', 'email', 'max:255', Rule::unique('employees')->ignore($this->employee), ],
            'phone' => [ 'nullable', 'max:15', 'regex:/^\+[1-9]\d{1,14}$/' ],
        ];
    }
}
