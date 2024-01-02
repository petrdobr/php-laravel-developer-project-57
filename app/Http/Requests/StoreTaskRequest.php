<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function messages(): array
    {
        return [
            'unique' => __('validation.task.unique')
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:tasks',
            'description' => 'nullable|max:255',
            'status_id' => 'required|integer|exists:task_statuses,id',
            'assigned_to_id' => 'required',
            'labels' => 'required'
        ];
    }
}
