<?php

namespace App\Http\Requests;

use App\Models\GoldPrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGoldPriceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gold_price_edit');
    }

    public function rules()
    {
        return [
            'gold_type' => [
                'required',
            ],
            'unit' => [
                'required',
            ],
            'price' => [
                'string',
                'required',
            ],
            'up_or_down' => [
                'required',
            ],
        ];
    }
}
