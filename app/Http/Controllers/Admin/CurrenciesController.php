<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCurrencyRequest;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CurrenciesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('currency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Currency::query()->select(sprintf('%s.*', (new Currency)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'currency_show';
                $editGate      = 'currency_edit';
                $deleteGate    = 'currency_delete';
                $crudRoutePart = 'currencies';

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
            $table->editColumn('currency_code', function ($row) {
                return $row->currency_code ? Currency::CURRENCY_CODE_SELECT[$row->currency_code] : '';
            });
            $table->editColumn('rate', function ($row) {
                return $row->rate ? $row->rate : '';
            });
            $table->editColumn('buy_rate', function ($row) {
                return $row->buy_rate ? $row->buy_rate : '';
            });
            $table->editColumn('sell_rate', function ($row) {
                return $row->sell_rate ? $row->sell_rate : '';
            });
            $table->editColumn('up_or_down', function ($row) {
                return $row->up_or_down ? Currency::UP_OR_DOWN_SELECT[$row->up_or_down] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.currencies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('currency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.currencies.create');
    }

    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::create($request->all());

        return redirect()->route('admin.currencies.index');
    }

    public function edit(Currency $currency)
    {
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.currencies.edit', compact('currency'));
    }

    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->all());

        return redirect()->route('admin.currencies.index');
    }

    public function show(Currency $currency)
    {
        abort_if(Gate::denies('currency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.currencies.show', compact('currency'));
    }

    public function destroy(Currency $currency)
    {
        abort_if(Gate::denies('currency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurrencyRequest $request)
    {
        $currencies = Currency::find(request('ids'));

        foreach ($currencies as $currency) {
            $currency->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
