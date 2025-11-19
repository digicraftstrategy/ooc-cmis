<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PublicationPremises;

class PremisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premises_owner = DB::table('premises_owners')->pluck('id', 'owners_name');

        DB::table('premises')->insert([
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Eliseo One',
                'business_registration_no' => '123456789',
                'contact_person' => 'John Doe',
                'location' => 'Gerehu Drive, Rainbow, Boroko, National Capital District',
                'premises_owner_id' => $premises_owner['Eliseo Limited'],
                'address' => 'PO Box 3786, Gerehu Drive, Rainbow, Boroko, National Capital District',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Eliseo Two',
                'business_registration_no' => '1234567890',
                'contact_person' => 'John Doe',
                'location' => 'Gerehu Drive, Rainbow, Boroko, National Capital District',
                'premises_owner_id' => $premises_owner['Eliseo Limited'],
                'address' => 'PO Box 3786, Gerehu Drive, Rainbow, Boroko, National Capital District',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Kova Limited One',
                'business_registration_no' => '1256789',
                'contact_person' => 'John Doe',
                'location' => 'Gerehu Drive, Rainbow, Boroko, National Capital District',
                'premises_owner_id' => $premises_owner['Kova Limited'],
                'address' => 'PO Box 3786, Gerehu Drive, Rainbow, Boroko, National Capital District',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Kova Limited Two',
                'business_registration_no' => '123457890',
                'contact_person' => 'John Doe',
                'location' => 'Gerehu Drive, Rainbow, Boroko, National Capital District',
                'premises_owner_id' => $premises_owner['Kova Limited'],
                'address' => 'PO Box 3786, Gerehu Drive, Rainbow, Boroko, National Capital District',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Sunland Limited One',
                'business_registration_no' => '12947256789',
                'contact_person' => 'John Doe',
                'location' => 'Gerehu Drive, Rainbow, Boroko, National Capital District',
                'premises_owner_id' => $premises_owner['Sunland Limited'],
                'address' => 'PO Box 3786, Gerehu Drive, Rainbow, Boroko, National Capital District',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Sunland Limited Two',
                'business_registration_no' => '0923457890',
                'contact_person' => 'John Doe',
                'location' => 'Gerehu Drive, Rainbow, Boroko, National Capital District',
                'premises_owner_id' => $premises_owner['Sunland Limited'],
                'address' => 'PO Box 3786, Gerehu Drive, Rainbow, Boroko, National Capital District',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
