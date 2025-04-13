<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGoldPriceRequest;
use App\Http\Requests\UpdateGoldPriceRequest;
use App\Http\Resources\Admin\GoldPriceResource;
use App\Models\GoldPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GoldPricesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gold_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GoldPriceResource(GoldPrice::all());
    }

    public function store(StoreGoldPriceRequest $request)
    {
        $goldPrice = GoldPrice::create($request->all());

        return (new GoldPriceResource($goldPrice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GoldPrice $goldPrice)
    {
        abort_if(Gate::denies('gold_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GoldPriceResource($goldPrice);
    }

    public function update(UpdateGoldPriceRequest $request, GoldPrice $goldPrice)
    {
        $goldPrice->update($request->all());

        return (new GoldPriceResource($goldPrice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GoldPrice $goldPrice)
    {
        abort_if(Gate::denies('gold_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goldPrice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
