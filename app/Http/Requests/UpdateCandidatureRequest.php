<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name'     => 'required|string|max:255',
            'job_title'        => 'required|string|max:255',
            'offer_url'        => 'nullable|url|max:500',
            'status'           => 'required|in:envoyée,en_attente,entretien,offre,refusée',
            'priority'         => 'required|in:basse,moyenne,haute',
            'notes'            => 'nullable|string',
            'application_date' => 'required|date',
        ];
    }
}
