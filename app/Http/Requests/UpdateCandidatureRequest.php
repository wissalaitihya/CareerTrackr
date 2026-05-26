<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name'     => 'sometimes|required|string|max:255',
            'job_title'        => 'sometimes|required|string|max:255',
            'offer_url'        => 'nullable|string|max:500',
            'status'           => 'sometimes|required|in:postulé,entretien_rh,test_technique,entretien_final,offre_reçue,accepté,refusé,envoyée,en_attente,entretien,offre',
            'priority'         => 'nullable|in:basse,moyenne,haute',
            'notes'            => 'nullable|string|max:1000',
            'application_date' => 'sometimes|required|date',
            'attachment'       => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ];
    }
}
