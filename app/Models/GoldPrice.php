<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoldPrice extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'gold_prices';

    public const UNIT_SELECT = [
        '1' => '1',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CURRENCY_CODE_SELECT = [
        'USD' => 'USD',
        'MMK' => 'MMK',
    ];

    public const TYPE_SELECT = [
        'world'   => 'For World',
        'myanmar' => 'For Myanmar',
    ];

    public const UP_OR_DOWN_SELECT = [
        'same' => 'same',
        'up'   => 'up',
        'down' => 'down',
    ];

    public const GOLD_TYPE_SELECT = [
        '24K' => '24K( ၁၆ပဲရည် )',
        '22k' => '22K( ၁၅ပဲရည် )',
    ];

    protected $fillable = [
        'gold_type',
        'type',
        'unit',
        'price',
        'currency_code',
        'up_or_down',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
