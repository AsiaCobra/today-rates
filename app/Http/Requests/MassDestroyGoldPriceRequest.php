<?php

namespace App\Http\Requests;

use App\Models\GoldPrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGoldPriceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('gold_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:gold_prices,id',
        ];
    }
}
