<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\FreelancerService;
class FreelancerServiceRequest extends FormRequest
{
  public function authorize(): bool { return true; } // route middleware handles roles

    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:90'],
            'category'        => ['required', Rule::in(FreelancerService::CATEGORIES)],
            'description'     => ['required', 'string', 'min:30', 'max:3000'],
            'skills'          => ['required', 'string', 'max:255'],
            'price'           => ['required', 'string', 'max:60'],
            'delivery_days'   => ['required', 'integer', 'min:1', 'max:365'],
            'portfolio_url'   => ['nullable', 'url', 'max:255'],
            'portfolio_image' => ['nullable', 'image', 'max:2048'],
            'revision_policy' => ['required', 'string', 'max:255'],
        ];
    }
}
