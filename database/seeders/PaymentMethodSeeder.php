<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = ['Cash', 'MPESA', 'Airtel Money', 'T-CASH'];

        foreach ($methods as $method) {

            PaymentMethod::create(['name' => $method]);
            
        }
    }
}
