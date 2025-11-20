<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'payment_method' => 'Cash',
                'description' => 'Cash',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'payment_method' => 'Bank Deposit',
                'description' => 'Bank Deposit',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'payment_method' => 'Visa Debit Card',
                'description' => 'Visa Debit Card',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'payment_method' => 'Mobile/Internet Banking',
                'description' => 'Mobile or Internet Banking',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'payment_method' => 'Cheque',
                'description' => 'Cheque',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'payment_method' => 'other',
                'description' => 'Other',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
