<?php

namespace App\Http\Requests;

use App\Services\BulanService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImportExcelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_kegiatan'=>'required|numeric|min:1',
            'bulan'=>['required',Rule::in(BulanService::bulan())],
            'excel'=>'required|mimes:xls,xlsx|max:2048',
        ];
    }
}
