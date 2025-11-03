<?php

namespace Database\Seeders;

use App\Models\PremisesOwner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PremisesOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('premises_owners')->insert([
            [
                'uuid' => PremisesOwner::generateUniqueUuid(),
                'owners_name' => 'Green Timber Limited',
                'phone' => '72002100',
                'address' => 'PO Box 107, Sawmill Road, Vanimo, West Sepik Province',
                'email' => 'email@greentimberltd.com.pg',
                'premises_owner_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid' => PremisesOwner::generateUniqueUuid(),
                'owners_name' => 'Kova Limited',
                'phone' => '72002201',
                'address' => 'PO Box 1219, Waterfront, Konedobu, National Capital District',
                'email' => 'email@kovaltd.com.pg',
                'premises_owner_type_id' => 1,
                'created_at' => now(),
                'updated-at' => now()
            ],

            [
                'uuid' => PremisesOwner::generateUniqueUuid(),
                'owners_name' => 'Sunland Limited',
                'phone' => '72002202',
                'address' => 'PO Box 393, Trasmitter, Sawmill Road, Vanimo, West Sepik Province',
                'email' => 'email@sunlandltd.com.pg',
                'premises_owner_type_id' => 1,
                'created_at' => now(),
                'updated-at' => now()
            ],

            [
                'uuid' => PremisesOwner::generateUniqueUuid(),
                'owners_name' => 'PH Plantation Limited',
                'phone' => '72002203',
                'address' => 'PO Box 665, Trasmitter, Sawmill Road, Vanimo, West Sepik Province',
                'email' => 'email@ph-plantationltd.com.pg',
                'premises_owner_type_id' => 1,
                'created_at' => now(),
                'updated-at' => now()
            ],

            [
                'uuid' => PremisesOwner::generateUniqueUuid(),
                'owners_name' => 'Eliseo Limited',
                'phone' => '72002204',
                'address' => 'PO Box 3786, Gerehu Drive, Rainbow, Boroko, National Capital District',
                'email' => 'email@eliseoltd.com.pg',
                'premises_owner_type_id' => 1,
                'created_at' => now(),
                'updated-at' => now()
            ],

            [
                'uuid' => PremisesOwner::generateUniqueUuid(),
                'owners_name' => 'Seventh-day Adventist Church - Central Papua Conference',
                'phone' => '72002206',
                'address' => 'PO Box 37, Ela Beach, DownTown, National Capital District',
                'email' => 'email@sda-cpc.com.pg',
                'premises_owner_type_id' => 3,
                'created_at' => now(),
                'updated-at' => now()
            ]
        ]);
    }
}
