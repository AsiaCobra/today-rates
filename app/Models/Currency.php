<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'currencies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const UP_OR_DOWN_SELECT = [
        'same' => 'Same',
        'up'   => 'Up',
        'down' => 'Down',
    ];

    protected $fillable = [
        'currency_code',
        'rate',
        'buy_rate',
        'sell_rate',
        'up_or_down',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CURRENCY_CODE_SELECT = [
        'USD' => 'United States Dollar',
        'EUR' => 'Euro',
        'SGD' => 'Singapore Dollar',
        'JPY' => 'Japanese Yen',
        'MYR' => 'Malaysian Ringgit',
        'CNY' => 'Chinese Yuan',
        'KRW' => 'South Korean Won',
        'GBP' => 'British Pound Sterling',
        'AUD' => 'Australian Dollar',
        'CAD' => 'Canadian Dollar',
        'TWD' => 'New Taiwan Dollar',
        'AED' => 'United Arab Emirates Dirham',
        'INR' => 'Indian Rupee',
        'HKD' => 'Hong Kong Dollar',
        'MOP' => 'Macanese Pataca',
        'LAK' => 'Lao Kip',
        'VND' => 'Vietnamese Dong',
        'PHP' => 'Philippine Peso',
        'KHR' => 'Cambodian Riel',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
