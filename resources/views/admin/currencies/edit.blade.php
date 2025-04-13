@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.currency.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.currencies.update", [$currency->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.currency.fields.currency_code') }}</label>
                <select class="form-control {{ $errors->has('currency_code') ? 'is-invalid' : '' }}" name="currency_code" id="currency_code" required>
                    <option value disabled {{ old('currency_code', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Currency::CURRENCY_CODE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('currency_code', $currency->currency_code) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency_code'))
                    <span class="text-danger">{{ $errors->first('currency_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.currency.fields.currency_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rate">{{ trans('cruds.currency.fields.rate') }}</label>
                <input class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" type="number" name="rate" id="rate" value="{{ old('rate', $currency->rate) }}" step="1" required>
                @if($errors->has('rate'))
                    <span class="text-danger">{{ $errors->first('rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.currency.fields.rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="buy_rate">{{ trans('cruds.currency.fields.buy_rate') }}</label>
                <input class="form-control {{ $errors->has('buy_rate') ? 'is-invalid' : '' }}" type="number" name="buy_rate" id="buy_rate" value="{{ old('buy_rate', $currency->buy_rate) }}" step="0.01" required>
                @if($errors->has('buy_rate'))
                    <span class="text-danger">{{ $errors->first('buy_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.currency.fields.buy_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sell_rate">{{ trans('cruds.currency.fields.sell_rate') }}</label>
                <input class="form-control {{ $errors->has('sell_rate') ? 'is-invalid' : '' }}" type="number" name="sell_rate" id="sell_rate" value="{{ old('sell_rate', $currency->sell_rate) }}" step="0.01" required>
                @if($errors->has('sell_rate'))
                    <span class="text-danger">{{ $errors->first('sell_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.currency.fields.sell_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.currency.fields.up_or_down') }}</label>
                <select class="form-control {{ $errors->has('up_or_down') ? 'is-invalid' : '' }}" name="up_or_down" id="up_or_down">
                    <option value disabled {{ old('up_or_down', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Currency::UP_OR_DOWN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('up_or_down', $currency->up_or_down) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('up_or_down'))
                    <span class="text-danger">{{ $errors->first('up_or_down') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.currency.fields.up_or_down_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection