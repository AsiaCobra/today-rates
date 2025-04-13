<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGoldPriceRequest;
use App\Http\Requests\StoreGoldPriceRequest;
use App\Http\Requests\UpdateGoldPriceRequest;
use App\Models\GoldPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GoldPricesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('gold_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GoldPrice::query()->select(sprintf('%s.*', (new GoldPrice)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'gold_price_show';
                $editGate      = 'gold_price_edit';
                $deleteGate    = 'gold_price_delete';
                $crudRoutePart = 'gold-prices';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('gold_type', function ($row) {
                return $row->gold_type ? GoldPrice::GOLD_TYPE_SELECT[$row->gold_type] : '';
            });
            $table->editColumn('unit', function ($row) {
                return $row->unit ? GoldPrice::UNIT_SELECT[$row->unit] : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('currency_code', function ($row) {
                return $row->currency_code ? GoldPrice::CURRENCY_CODE_SELECT[$row->currency_code] : '';
            });
            $table->editColumn('up_or_down', function ($row) {
                return $row->up_or_down ? GoldPrice::UP_OR_DOWN_SELECT[$row->up_or_down] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.goldPrices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('gold_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.goldPrices.create');
    }

    public function store(StoreGoldPriceRequest $request)
    {
        $goldPrice = GoldPrice::create($request->all());

        return redirect()->route('admin.gold-prices.index');
    }

    public function edit(GoldPrice $goldPrice)
    {
        abort_if(Gate::denies('gold_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.goldPrices.edit', compact('goldPrice'));
    }

    public function update(UpdateGoldPriceRequest $request, GoldPrice $goldPrice)
    {
        $goldPrice->update($request->all());

        return redirect()->route('admin.gold-prices.index');
    }

    public function show(GoldPrice $goldPrice)
    {
        abort_if(Gate::denies('gold_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.goldPrices.show', compact('goldPrice'));
    }

    public function destroy(GoldPrice $goldPrice)
    {
        abort_if(Gate::denies('gold_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goldPrice->delete();

        return back();
    }

    public function massDestroy(MassDestroyGoldPriceRequest $request)
    {
        $goldPrices = GoldPrice::find(request('ids'));

        foreach ($goldPrices as $goldPrice) {
            $goldPrice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
