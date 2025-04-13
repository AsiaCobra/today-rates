<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CurrencySeeder extends Seeder
{
    public $apiKey = 'fca_live_8IY9rHYkrgAFV0KT5Op05JhL9aHlzdJgXSZQRRWo';
    public $apiKey2 = 'fca_live_8IY9rHYkrgAFV0KT5Op05JhL9aHlzdJgXSZQRRWo';
    /**
     * The currencies we want to seed
     */
    protected $currencies = [
        'USD', 'EUR', 'SGD', 'THB', 'JPY', 'MYR', 'CNY', 'KRW', 'GBP', 'AUD', 'CAD', 'TWD', 'AED', 'INR', 'HKD', 'MOP', 'LAK', 'VND', 'PHP', 'KHR'
    ];

    protected $black_market_rates_percentage = [
        "AED" => ["buy" => 103.56002955999996, "sell" => 107.58572231999996],
        "AUD" => ["buy" => 103.46529935, "sell" => 107.25422484999999],
        "CAD" => ["buy" => 103.5162976, "sell" => 107.48090080000001],
        "CNY" => ["buy" => 103.5747006, "sell" => 107.3960687],
        "EUR" => ["buy" => 103.619671, "sell" => 107.60399000000001],
        "GBP" => ["buy" => 103.56884989999999, "sell" => 107.57467699999998],
        "HKD" => ["buy" => 103.57430584999999, "sell" => 107.63840269999999],
        "INR" => ["buy" => 103.2362524844, "sell" => 107.21323785680002],
        "JPY" => ["buy" => 103.6678995689, "sell" => 107.63590029950001],
        "KHR" => ["buy" => 105.84112291640002, "sell" => 111.55893188630002],
        "KRW" => ["buy" => 102.64128911000002, "sell" => 106.69411489220002],
        "LAK" => ["buy" => 95.16029730119999, "sell" => 105.431891896],
        "MOP" => ["buy" => 102.54773791999997, "sell" => 106.7200696],
        "MYR" => ["buy" => 109.66398215, "sell" => 112.82474569999998],
        "PHP" => ["buy" => 103.618882856, "sell" => 107.629061819],
        "SGD" => ["buy" => 108.56631759999999, "sell" => 111.7073766],
        "THB" => ["buy" => 104.72674598740002, "sell" => 108.7347339168],
        "TWD" => ["buy" => 103.81669748, "sell" => 108.44889515],
        "USD" => ["buy" => 107.31330049999998, "sell" => 109.69621199999999],
        "VND" => ["buy" => 108.27586360280002, "sell" => 120.5273849912]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $currencies = $this->getCurrencies();
        $currenciesByDate = $this->getCurrenciesByDate();
        foreach ($currenciesByDate as $date => $currencies) {
            $this->command->table(['Currency Code', 'Rate', 'Buy Rate', 'Sell Rate', 'Created At', 'Up or Down'], $currencies);
            foreach ($currencies as $currency) {
                $subDate = date('Y-m-d', strtotime($date . ' -1 day'));
                $this->command->info('Sub date: ' . $subDate);
                // Check up or down by comparing the last stored rate
                $last_stored_rate = Currency::where('currency_code', $currency['currency_code'])->whereDate('created_at', $subDate)->orderBy('created_at', 'desc')->first();
                if ($last_stored_rate) {
                    $this->command->info('Last stored rate: ' . $last_stored_rate->rate);
                    $this->command->info('Current rate: ' . $currency['rate']);
                    if ($currency['rate'] > $last_stored_rate->rate) {
                        $currency['up_or_down'] = 'up';
                    } else {
                        $currency['up_or_down'] = 'down';
                    }
                } else {
                    $currency['up_or_down'] = 'same';
                }
                // $this->command->info('Saving currency: ' . $currency['currency_code'] . ' on date: ' . $date);
                Currency::create($currency);
            }
        }
        // $this->command->table(['Date', 'Currency Code', 'Rate', 'Buy Rate', 'Sell Rate', 'Up or Down'], $currenciesByDate);
        // return;
        // $currencies = [
        //     [
        //         'currency_code' => 'USD',
        //         'rate' => 2100,
        //         'buy_rate' => 2095,
        //         'sell_rate' => 2105,
        //         'up_or_down' => 'same',
        //     ],
        //     [
        //         'currency_code' => 'EUR',
        //         'rate' => 2250,
        //         'buy_rate' => 2245,
        //         'sell_rate' => 2255,
        //         'up_or_down' => 'same',
        //     ],
        //     [
        //         'currency_code' => 'SGD',
        //         'rate' => 1550,
        //         'buy_rate' => 1545,
        //         'sell_rate' => 1555,
        //         'up_or_down' => 'same',
        //     ],
        //     [
        //         'currency_code' => 'THB',
        //         'rate' => 58,
        //         'buy_rate' => 57,
        //         'sell_rate' => 59,
        //         'up_or_down' => 'same',
        //     ],
        //     [
        //         'currency_code' => 'JPY',
        //         'rate' => 14,
        //         'buy_rate' => 13.5,
        //         'sell_rate' => 14.5,
        //         'up_or_down' => 'same',
        //     ],
        // ];

        // foreach ($currencies as $currency) {
        //     Currency::create($currency);
        // }
    }

    public function estimateBlackMarketRate( $offical_rate, $markup_percentage )
    {
        return $offical_rate * (1 + ($markup_percentage / 100));
    }

    public function getCurrencies()
    {
        $currencies = array();

        // $offical_rates = $this->getRates( config('services.currency_api.api_key') );
        $offical_rates = $this->getRates( $this->apiKey );

        foreach ($offical_rates as $currencyCode => $rate) {
            $rate_price = 1/$rate['value'];
            $currencies[] = [
                'currency_code' => $currencyCode,
                // 'rate' => $rate['value'],
                'rate' => $rate_price,
                'buy_rate' => $this->estimateBlackMarketRate($rate_price, $this->black_market_rates_percentage[$currencyCode]['buy']),
                'sell_rate' => $this->estimateBlackMarketRate($rate_price, $this->black_market_rates_percentage[$currencyCode]['sell']),
                // 'up_or_down' => 'same',
            ];

            // Check up or down by comparing the last stored rate
            $last_stored_rate = Currency::where('currency_code', $currencyCode)->orderBy('created_at', 'desc')->first();
            if ($last_stored_rate) {
                if ($currencies[$currencyCode]['rate'] > $last_stored_rate->rate) {
                    $currencies[$currencyCode]['up_or_down'] = 'up';
                } else {
                    $currencies[$currencyCode]['up_or_down'] = 'down';
                }
            } else {
                $currencies[$currencyCode]['up_or_down'] = 'same';
            }
        }

        $this->command->info('Currencies fetched successfully!');
        $this->command->table(['Currency Code', 'Rate', 'Buy Rate', 'Sell Rate', 'Up or Down'], $currencies);
        return $currencies;
    }

    public function getRates( $apiKey, $date = null ) {
        $baseUrl = 'https://api.currencyapi.com/v3';

        if (!$apiKey) {
            $this->command->error('Currency API key not found in configuration!');
            return;
        }

        $current_data =   [];

        $endpoint = 'latest';
        if ($date) {
            $endpoint = 'historical';
        }

        $queryParams = [
                'apikey' => $apiKey,
            'base_currency' => "MMK",
            'currencies' => implode(',', $this->currencies),
        ];

        if ($date) {
            $queryParams['date'] = $date;
        }

        $response = Http::get("{$baseUrl}/{$endpoint}", $queryParams);

        if ($response->successful()) {
            $data = $response->json();
            $rates = $data['data'];

            return $rates;
        } else {
            // $nextAPIKey = $this->apiKey2;
            // if ($nextAPIKey) {
            //     return $this->getRates($nextAPIKey, $date);
            // } else {
            //     $this->command->error('No more API keys available!');
            //     return [];
            // }
            $this->command->error('Error fetching rates: ' . $response->body());
            return [];
        }
    }

    public function getCurrenciesByDate() {

        // Start date
        $startDate = '2025-04-03';

        // End date
        $endDate = '2025-04-13';

        // Get all dates between start and end date
        $dates = [];
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $dates[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        $currencies = array();
        foreach ($dates as $date) {
            $rates = $this->getRates( $this->apiKey, $date );
            foreach ($rates as $currencyCode => $rate) {
                $rate_price = 1/$rate['value'];
                $currencies[$date][$currencyCode] = array(
                    'currency_code' => $currencyCode,
                    'rate' => $rate['value'],
                    'buy_rate' => $this->estimateBlackMarketRate($rate_price, $this->black_market_rates_percentage[$currencyCode]['buy']),
                    'sell_rate' => $this->estimateBlackMarketRate($rate_price, $this->black_market_rates_percentage[$currencyCode]['sell']),
                    'created_at' => $date,
                );

            }
        }

        return $currencies;
    }
} 
