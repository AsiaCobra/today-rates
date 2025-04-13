<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;

class _CurrencySeeder extends Seeder
{
    /**
     * The currencies we want to seed
     */
    protected $currencies = [
        'USD', 'EUR', 'SGD', 'THB', 'JPY', 'MYR', 'CNY', 'KRW', 'GBP', 'AUD', 'CAD', 'TWD', 'AED', 'INR', 'HKD', 'MOP', 'LAK', 'VND', 'PHP', 'KHR'
    ];

    /**
     * Currency names mapping
     */
    protected $currencyNames = [
        'USD' => 'United States Dollar',
        'EUR' => 'Euro',
        'SGD' => 'Singapore Dollar',
        'THB' => 'Thai Baht',
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
        'KHR' => 'Cambodian Riel'
    ];

    /**
     * Black market rate for MMK
     */
    protected $blackMarketRates = [
        'THB' => [
            // 'buy' => 104.73,
            // 'sell' => 108.74
            'buy' => 104.74, // Percentage 108.74
            'sell' => 108.74 // Percentage 108.74
        ],
        'USD' => [
            // 'buy' => 107.29,
            // 'sell' => 109.7
            'buy' => 107.14, // Percentage 109.52
            'sell' => 109.52 // Percentage 109.52
        ],
        'EUR' => [
            'buy' => 4855.00, // Percentage 4950.00
            'sell' => 4950.00 // Percentage 4950.00
        ],
        'SGD' => [
            'buy' => 3320.00, // Percentage 3370.00
            'sell' => 3370.00 // Percentage 3370.00
        ],
        'JPY' => [
            'buy' => 29.77, // Percentage 30.35 
            'sell' => 30.35 // Percentage 30.35
        ],
        
        
    ];

    protected $today_black_market_rates = [
        "USD" => ["buy" => 4350.00, "sell" => 4400.00],
        "EUR" => ["buy" => 4855.00, "sell" => 4950.00],
        "SGD" => ["buy" => 3320.00, "sell" => 3370.00],
        "THB" => ["buy" => 128.21, "sell" => 130.72],
        "JPY" => ["buy" => 29.77, "sell" => 30.35],
        "MYR" => ["buy" => 995.00, "sell" => 1010.00],
        "CNY" => ["buy" => 586.00, "sell" => 597.00],
        "KRW" => ["buy" => 3.00, "sell" => 3.06],
        "GBP" => ["buy" => 5590.00, "sell" => 5700.00],
        "AUD" => ["buy" => 2685.00, "sell" => 2735.00],
        "CAD" => ["buy" => 3080.00, "sell" => 3140.00],
        "TWD" => ["buy" => 132.00, "sell" => 135.00],
        "AED" => ["buy" => 1163.00, "sell" => 1186.00],
        "INR" => ["buy" => 49.57, "sell" => 50.54],
        "HKD" => ["buy" => 551.00, "sell" => 562.00],
        "MOP" => ["buy" => 534.00, "sell" => 545.00],
        "LAK" => ["buy" => 0.19, "sell" => 0.20],
        "VND" => ["buy" => 0.17, "sell" => 0.18],
        "PHP" => ["buy" => 74.64, "sell" => 76.11],
        "KHR" => ["buy" => 1.08, "sell" => 1.11]
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
        $apiKey = config('services.currency_api.key');
        $baseUrl = config('services.currency_api.base_url');

        if (!$apiKey) {
            $this->command->error('Currency API key not found in configuration!');
            return;
        }

        $estimateBlackMarketRate = function($officialRate, $markupPercent) {
                return $officialRate * (1 + ($markupPercent / 100));
        };

        $current_data =   [];

        $response = Http::get("{$baseUrl}/latest", [
            'apikey' => $apiKey,
            'base_currency' => "MMK",
            'currencies' => implode(',', $this->currencies),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $rates = $data['data'] ?? [];

            foreach ($rates as $currencyCode => $rate) {
                $rate_value = $rate['value'];
                $rate_price = 1 / $rate_value;

                $black_market_profit_percentage = $this->black_market_rates_percentage[$currencyCode];

                $buy_price = $estimateBlackMarketRate($rate_price, $black_market_profit_percentage['buy']);
                $sell_price = $estimateBlackMarketRate($rate_price, $black_market_profit_percentage['sell']);

                $current_data[$currencyCode] = [
                    'buy' => round($buy_price, 2),
                    'sell' => round($sell_price, 2)
                ];

                $this->command->error($currencyCode . ' ' . $buy_price . ' ' . $sell_price);    
            }

            $this->command->error(json_encode($current_data));
        }

            // $response = Http::get("{$baseUrl}/latest", [
            //     'apikey' => $apiKey,
            //     'base_currency' => "MMK",
            //     'currencies' => implode(',', $this->currencies),
            // ]);

            // if ($response->successful()) {
            //     $data = $response->json();
            //     $rates = $data['data'] ?? [];

            //     foreach ($rates as $currencyCode => $rate) {
            //         $rate_value = $rate['value'];
            //         $rate_price = 1 / $rate_value;

            //         $today_black_market_rate = $this->today_black_market_rates[$currencyCode];

            //         $black_margin_buy = $today_black_market_rate['buy'] - $rate_price;
            //         $black_margin_sell = $today_black_market_rate['sell'] - $rate_price;

            //         $diff_percentage_buy = ($black_margin_buy / $rate_price) * 100;
            //         $diff_percentage_sell = ($black_margin_sell / $rate_price) * 100;

            //         $this->black_market_rates_percentage[$currencyCode] = [
            //             'buy' => $diff_percentage_buy,
            //             'sell' => $diff_percentage_sell
            //         ];
            //     }
            // }

            // // $this->command->error(json_encode($this->black_market_rates_percentage));
        
        // $rates = [
        //     'THB' => [
        //         '2025-04-10' => 61.8413281758,
        //         '2025-04-11' => 62.6249433079,
        //         '2025-04-12' => 62.6249391872,
        //         '2025-04-13' => 62.62,
        //     ],
        //     'USD' => [
        //         '2025-04-10' => 2091.0807727106,
        //         '2025-04-11' => 2098.273515195,
        //         '2025-04-12' => 2098.2733951475,
        //         '2025-04-13' => 2100.00,
        //     ]
        // ];

        // foreach ($rates as $currencyCode => $rate) {
        //     $blackMarketRates = $this->blackMarketRates[$currencyCode];
        //     foreach ($rate as $date => $value) {
        //         $this->command->error($currencyCode . ' ' . $date . ' ' . $value);

        //         $baseRateForOneMMK = $value;
        //         $buy_price = $estimateBlackMarketRate($baseRateForOneMMK, $blackMarketRates['buy']);
        //         $sell_price = $estimateBlackMarketRate($baseRateForOneMMK, $blackMarketRates['sell']);

        //         // Do price with 2 decimal places and if above .5 round up

        //         $buy_price = round($buy_price, 2);
        //         $sell_price = round($sell_price, 2);

        //         $this->command->error( ' buy: ' . $buy_price );
        //         $this->command->error( ' sell: ' . $sell_price );
                
        //     }
        // }
        
        

        // try {
        //     foreach ($this->currencies as $currencyCode) {
        //         $this->command->error($currencyCode);
        //         // Get latest rates from the API with USD as base
        //         $response = Http::get("{$baseUrl}/latest", [
        //             'apikey' => $apiKey,
        //             'base_currency' => $currencyCode,
        //             'currencies' => 'MMK',
        //         ]);

        //         $this->command->error($baseUrl);
        //         $this->command->error( json_encode($response->json()));
        //         if ($response->successful()) {
        //             $data = $response->json();
        //             $rates = $data['data'] ?? [];

        //                 try {
        //                     // Get rate relative to USD
        //                     $rateToUsd = $rates['MMK'] ?? null;

                            
        //                     if ($rateToUsd) {
        //                         $baseRateForOneMMK = $rateToUsd['value'];
        //                         $baseRate = 1 / $baseRateForOneMMK; // 1 thb = 1 / 62.6249433079 = 0.015967845238095237
        //                         $estimateBlackMarketRate = function($officialRate, $markupPercent) {
        //                                 return $officialRate * (1 + ($markupPercent / 100));
        //                         };

        //                         $blackMarketRates = $this->blackMarketRates[$currencyCode];

        //                         $buy_price = $estimateBlackMarketRate($baseRateForOneMMK, $blackMarketRates['buy']);
        //                         $sell_price = $estimateBlackMarketRate($baseRateForOneMMK, $blackMarketRates['sell']);

        //                         $this->command->error($buy_price);
        //                         $this->command->error($sell_price);

        //                         // $this->command->error($estimateBlackMarketRate($baseRateForOneMMK, 108.74));
        //                         // $this->command->error($spread);
        //                         // // add 52.09% to base rate
        //                         // $rate = $baseRate + $spread;
        //                         // $this->command->error($rate);
        //                     }
        //                 } catch (Exception $e) {
        //                     $this->command->error("Error processing {$currencyCode}: " . $e->getMessage());
        //                 }
                    
        //         } else {
        //             $this->command->error('Failed to fetch rates from API.');
        //         }
        //     }
        // } catch (Exception $e) {
        //     $this->command->error('API request failed: ' . $e->getMessage());
        // }
    }

    /**
     * Calculate the current USD to MMK rate based on market factors
     * This is where you would implement your specific logic for Myanmar market rates
     */
    protected function calculateUsdToMmkRate(): float
    {
        // This is where you would implement your specific logic for Myanmar market rates
        // For example, you could:
        // 1. Fetch from a local source
        // 2. Calculate based on multiple sources
        // 3. Use economic indicators
        // 4. Use recent trading data
        // For now, using a base rate that you should adjust
        return 4400.00; // Base rate - adjust this according to current market
    }

    /**
     * Calculate spread based on currency volatility
     */
    protected function calculateSpread(string $currencyCode): float
    {
        // Different spreads for different currencies based on their volatility
        $volatilityFactors = [
            'USD' => 0.005, // 0.5% spread for USD
            'EUR' => 0.007, // 0.7% spread for EUR
            'GBP' => 0.007, // 0.7% spread for GBP
            'JPY' => 0.008, // 0.8% spread for JPY
            'SGD' => 0.008, // 0.8% spread for SGD
            'THB' => 0.010, // 1.0% spread for THB
            // Add more currencies with their volatility factors
        ];

        // Default spread for currencies not specifically defined
        return $volatilityFactors[$currencyCode] ?? 0.010; // 1% default spread
    }

    /**
     * Round rate based on its magnitude
     */
    protected function roundRate(float $rate): float
    {
        if ($rate >= 1000) {
            // Round to nearest whole number for large values
            return round($rate);
        } elseif ($rate >= 100) {
            // Round to 1 decimal place for medium values
            return round($rate, 1);
        } elseif ($rate >= 1) {
            // Round to 2 decimal places for small values
            return round($rate, 2);
        } else {
            // Round to 3 decimal places for very small values
            return round($rate, 3);
        }
    }
}
