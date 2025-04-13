<?php

namespace Database\Seeders;

use App\Models\GoldPrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GoldPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // World Gold Price (Using metals-api.com free API)
        try {
            $response = Http::withHeaders([
                'x-access-token' => env('METAL_API_KEY')
            ])->get('https://api.metalpriceapi.com/v1/latest', [
                'base' => 'USD',
                'currencies' => 'XAU'
            ]);

            $this->command->info('Response: ' . $response->body());

            if ($response->successful()) {
                $data = $response->json();
                $worldPrice = 1 / $data['rates']['XAU']; // Convert to USD per ounce

                // // Save World Gold Price (24K)
                // GoldPrice::create([
                //     'gold_type' => '24K',
                //     'type' => 'world',
                //     'unit' => '1',
                //     'price' => $worldPrice,
                //     'currency_code' => 'USD',
                //     'up_or_down' => 'same',
                // ]);

                // // Calculate and save 22K world price
                // $price22k = $worldPrice * (22/24);
                // GoldPrice::create([
                //     'gold_type' => '22k',
                //     'type' => 'world',
                //     'unit' => '1',
                //     'price' => $price22k,
                //     'currency_code' => 'USD',
                //     'up_or_down' => 'same',
                // ]);

                $this->command->info('World Gold Prices fetched successfully!');
            }
        } catch (\Exception $e) {
            // // Fallback to default values if API fails
            // GoldPrice::create([
            //     'gold_type' => '24K',
            //     'type' => 'world',
            //     'unit' => '1',
            //     'price' => 2000.00,  // Default world price per ounce
            //     'currency_code' => 'USD',
            //     'up_or_down' => 'same',
            // ]);

            // GoldPrice::create([
            //     'gold_type' => '22k',
            //     'type' => 'world',
            //     'unit' => '1',
            //     'price' => 1833.33,  // Default 22K price
            //     'currency_code' => 'USD',
            //     'up_or_down' => 'same',
            // ]);
        }

        // // Myanmar Gold Prices (16 Pae)
        // GoldPrice::create([
        //     'gold_type' => '24K',
        //     'type' => 'myanmar',
        //     'unit' => '1',
        //     'price' => 3450000, // Example price for 1 Kyat Thar
        //     'currency_code' => 'MMK',
        //     'up_or_down' => 'same',
        // ]);

        // // Myanmar Gold Prices (15 Pae)
        // GoldPrice::create([
        //     'gold_type' => '22k',
        //     'type' => 'myanmar',
        //     'unit' => '1',
        //     'price' => 3200000, // Example price for 1 Kyat Thar
        //     'currency_code' => 'MMK',
        //     'up_or_down' => 'same',
        // ]);
    }
} 