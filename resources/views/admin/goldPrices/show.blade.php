@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.goldPrice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gold-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.goldPrice.fields.id') }}
                        </th>
                        <td>
                            {{ $goldPrice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goldPrice.fields.gold_type') }}
                        </th>
                        <td>
                            {{ App\Models\GoldPrice::GOLD_TYPE_SELECT[$goldPrice->gold_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goldPrice.fields.unit') }}
                        </th>
                        <td>
                            {{ App\Models\GoldPrice::UNIT_SELECT[$goldPrice->unit] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goldPrice.fields.price') }}
                        </th>
                        <td>
                            {{ $goldPrice->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goldPrice.fields.currency_code') }}
                        </th>
                        <td>
                            {{ App\Models\GoldPrice::CURRENCY_CODE_SELECT[$goldPrice->currency_code] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goldPrice.fields.up_or_down') }}
                        </th>
                        <td>
                            {{ App\Models\GoldPrice::UP_OR_DOWN_SELECT[$goldPrice->up_or_down] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gold-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection