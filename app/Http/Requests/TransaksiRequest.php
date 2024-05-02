<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'orderedList' => 'required|array|min:1',
            'orderedList.*.menu_id' => 'required|exists:menus,id',
            'orderedList.*.qty' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ];
    }
}
