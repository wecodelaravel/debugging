<?php

namespace App\Http\Requests;

use App\Models\PageSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePageSectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('page_section_create');
    }

    public function rules()
    {
        return [
            'custom_class' => [
                'string',
                'nullable',
            ],
            'section_title' => [
                'string',
                'nullable',
            ],
            'section' => [
                'required',
            ],
            'section_nickname' => [
                'string',
                'nullable',
            ],
            'order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
