@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.goldPrice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.gold-prices.update", [$goldPrice->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.goldPrice.fields.gold_type') }}</label>
                <select class="form-control {{ $errors->has('gold_type') ? 'is-invalid' : '' }}" name="gold_type" id="gold_type" required>
                    <option value disabled {{ old('gold_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\GoldPrice::GOLD_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gold_type', $goldPrice->gold_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gold_type'))
                    <span class="text-danger">{{ $errors->first('gold_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goldPrice.fields.gold_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.goldPrice.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\GoldPrice::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $goldPrice->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goldPrice.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.goldPrice.fields.unit') }}</label>
                <select class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit" id="unit" required>
                    <option value disabled {{ old('unit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\GoldPrice::UNIT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('unit', $goldPrice->unit) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <span class="text-danger">{{ $errors->first('unit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goldPrice.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.goldPrice.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', $goldPrice->price) }}" required>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goldPrice.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.goldPrice.fields.currency_code') }}</label>
                <select class="form-control {{ $errors->has('currency_code') ? 'is-invalid' : '' }}" name="currency_code" id="currency_code">
                    <option value disabled {{ old('currency_code', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\GoldPrice::CURRENCY_CODE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('currency_code', $goldPrice->currency_code) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency_code'))
                    <span class="text-danger">{{ $errors->first('currency_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goldPrice.fields.currency_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.goldPrice.fields.up_or_down') }}</label>
                <select class="form-control {{ $errors->has('up_or_down') ? 'is-invalid' : '' }}" name="up_or_down" id="up_or_down" required>
                    <option value disabled {{ old('up_or_down', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\GoldPrice::UP_OR_DOWN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('up_or_down', $goldPrice->up_or_down) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('up_or_down'))
                    <span class="text-danger">{{ $errors->first('up_or_down') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goldPrice.fields.up_or_down_helper') }}</span>
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