<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', 'in:pending,active,completed'],
            'priority' => ['sometimes', 'integer'],
            'due_date' => ['nullable', 'date'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'estimated_hours' => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'actual_hours' => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'agreed_cost' => ['sometimes', 'nullable', 'numeric', 'min:0'],
        ];
    }
}