<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'summary' => ['required', 'string'],
            'changed_files' => ['nullable', 'string'],
            'changed_lines' => ['nullable', 'string'],
            'sql_queries' => ['nullable', 'string'],
            'testing_notes' => ['nullable', 'string'],
        ];
    }
}