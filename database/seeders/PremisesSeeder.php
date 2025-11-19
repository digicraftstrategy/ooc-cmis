<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PublicationPremises;
use Carbon\Carbon;

class PremisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premises_owner = DB::table('premises_owners')->pluck('id', 'owners_name');

        /*DB::table('premises')->insert([
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
        ]);*/

        /**
         * Generate a more "real life" date series:
         * - Start in January of the current year
         * - Sometimes multiple premises share the same date (batch)
         * - Sometimes there are longer gaps (slow periods)
         */
        $startDate   = Carbon::create(now()->year, 1, 5);
        $currentDate = $startDate->copy();
        $dates       = [];

        // We want 15 records total
        for ($i = 0; $i < 15; $i++) {
            if ($i === 0) {
                $dates[$i] = $currentDate->copy();
            } else {
                // 40% chance: same day as previous (burst of premises)
                if (rand(0, 100) < 40) {
                    $dates[$i] = $currentDate->copy();
                } else {
                    // 60% chance: move forward 10–45 days
                    $incrementDays = rand(10, 45);
                    $currentDate   = $currentDate->copy()->addDays($incrementDays);

                    // avoid going too far into the future
                    if ($currentDate->greaterThan(now())) {
                        $currentDate = now()->copy()->subDays(rand(0, 7));
                    }

                    $dates[$i] = $currentDate->copy();
                }
            }
        }

        DB::table('premises')->insert([
            // 1 – NCD
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Eliseo One',
                'business_registration_no' => '123456789',
                'contact_person' => 'John Doe',
                'location' => 'Waigani, Port Moresby, National Capital District',
                'premises_owner_id' => $premises_owner['Eliseo Limited'],
                'address' => 'PO Box 3786, Waigani, NCD',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 16, // NCD
                'created_at' => $dates[0],
                'updated_at' => $dates[0],
            ],

            // 2 – Central
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Eliseo Two',
                'business_registration_no' => '1234567890',
                'contact_person' => 'John Doe',
                'location' => 'Kwikila, Rigo, Central Province',
                'premises_owner_id' => $premises_owner['Eliseo Limited'],
                'address' => 'PO Box 102, Kwikila, Central',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 12, // Central
                'created_at' => $dates[1],
                'updated_at' => $dates[1],
            ],

            // 3 – Morobe
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Kova Limited One',
                'business_registration_no' => '1256789',
                'contact_person' => 'John Doe',
                'location' => 'Top Town, Lae, Morobe Province',
                'premises_owner_id' => $premises_owner['Kova Limited'],
                'address' => 'PO Box 401, Lae, Morobe',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 8, // Morobe
                'created_at' => $dates[2],
                'updated_at' => $dates[2],
            ],

            // 4 – Eastern Highlands
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Kova Limited Two',
                'business_registration_no' => '123457890',
                'contact_person' => 'John Doe',
                'location' => 'Goroka Town, Eastern Highlands Province',
                'premises_owner_id' => $premises_owner['Kova Limited'],
                'address' => 'PO Box 89, Goroka, EHP',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 1, // Eastern Highlands
                'created_at' => $dates[3],
                'updated_at' => $dates[3],
            ],

            // 5 – East New Britain
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Sunland Limited One',
                'business_registration_no' => '12947256789',
                'contact_person' => 'John Doe',
                'location' => 'Kokopo, East New Britain Province',
                'premises_owner_id' => $premises_owner['Sunland Limited'],
                'address' => 'PO Box 211, Kokopo, ENBP',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 17, // East New Britain
                'created_at' => $dates[4],
                'updated_at' => $dates[4],
            ],

            // 6 – West New Britain
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Sunland Limited Two',
                'business_registration_no' => '0923457890',
                'contact_person' => 'John Doe',
                'location' => 'Kimbe, West New Britain Province',
                'premises_owner_id' => $premises_owner['Sunland Limited'],
                'address' => 'PO Box 76, Kimbe, WNBP',
                'telephone' => '72001234',
                'mobile' => '72001234',
                'status' => 'operational',
                'province_id' => 18, // West New Britain
                'created_at' => $dates[5],
                'updated_at' => $dates[5],
            ],

            // 7 – Madang
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Harmony Media House',
                'business_registration_no' => '776543210',
                'contact_person' => 'Sarah Wilson',
                'location' => 'Modilon Road, Madang Town, Madang Province',
                'premises_owner_id' => $premises_owner['Eliseo Limited'],
                'address' => 'PO Box 998, Madang',
                'telephone' => '71004567',
                'mobile' => '71004567',
                'status' => 'operational',
                'province_id' => 9, // Madang
                'created_at' => $dates[6],
                'updated_at' => $dates[6],
            ],

            // 8 – Milne Bay
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Urban Pulse Studio',
                'business_registration_no' => '8899001122',
                'contact_person' => 'Michael Tane',
                'location' => 'Alotau, Milne Bay Province',
                'premises_owner_id' => $premises_owner['Kova Limited'],
                'address' => 'PO Box 2211, Alotau, MBP',
                'telephone' => '72331234',
                'mobile' => '72331234',
                'status' => 'operational',
                'province_id' => 14, // Milne Bay
                'created_at' => $dates[7],
                'updated_at' => $dates[7],
            ],

            // 9 – Western Highlands
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Creative Vision Lab',
                'business_registration_no' => '5566778899',
                'contact_person' => 'Anna Rova',
                'location' => 'Mt Hagen, Western Highlands Province',
                'premises_owner_id' => $premises_owner['Sunland Limited'],
                'address' => 'PO Box 5431, Mt Hagen, WHP',
                'telephone' => '78904562',
                'mobile' => '78904562',
                'status' => 'operational',
                'province_id' => 2, // Western Highlands
                'created_at' => $dates[8],
                'updated_at' => $dates[8],
            ],

            // 10 – Simbu
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Pacific Echo Studios',
                'business_registration_no' => '6677889900',
                'contact_person' => 'Jacob Muri',
                'location' => 'Kundiawa, Simbu Province',
                'premises_owner_id' => $premises_owner['Eliseo Limited'],
                'address' => 'PO Box 7788, Kundiawa, SIM',
                'telephone' => '76234567',
                'mobile' => '76234567',
                'status' => 'operational',
                'province_id' => 3, // Simbu
                'created_at' => $dates[9],
                'updated_at' => $dates[9],
            ],

            // 11 – Hela
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Highlands Print Hub',
                'business_registration_no' => '900112233',
                'contact_person' => 'Luka Hami',
                'location' => 'Tari, Hela Province',
                'premises_owner_id' => $premises_owner['Kova Limited'],
                'address' => 'PO Box 33, Tari, Hela',
                'telephone' => '76451234',
                'mobile' => '76451234',
                'status' => 'operational',
                'province_id' => 5, // Hela
                'created_at' => $dates[10],
                'updated_at' => $dates[10],
            ],

            // 12 – East Sepik
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Coastal Media Centre',
                'business_registration_no' => '911223344',
                'contact_person' => 'Peter Sori',
                'location' => 'Wewak, East Sepik Province',
                'premises_owner_id' => $premises_owner['Sunland Limited'],
                'address' => 'PO Box 120, Wewak, ESP',
                'telephone' => '76551234',
                'mobile' => '76551234',
                'status' => 'operational',
                'province_id' => 10, // East Sepik
                'created_at' => $dates[11],
                'updated_at' => $dates[11],
            ],

            // 13 – New Ireland
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Island Wave Studio',
                'business_registration_no' => '922334455',
                'contact_person' => 'Maria Lona',
                'location' => 'Kavieng, New Ireland Province',
                'premises_owner_id' => $premises_owner['Eliseo Limited'],
                'address' => 'PO Box 5, Kavieng, NIP',
                'telephone' => '76661234',
                'mobile' => '76661234',
                'status' => 'operational',
                'province_id' => 20, // New Ireland
                'created_at' => $dates[12],
                'updated_at' => $dates[12],
            ],

            // 14 – Gulf
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Frontier Newsroom',
                'business_registration_no' => '933445566',
                'contact_person' => 'Jonas Kila',
                'location' => 'Kerema, Gulf Province',
                'premises_owner_id' => $premises_owner['Kova Limited'],
                'address' => 'PO Box 55, Kerema, Gulf',
                'telephone' => '76771234',
                'mobile' => '76771234',
                'status' => 'operational',
                'province_id' => 13, // Gulf
                'created_at' => $dates[13],
                'updated_at' => $dates[13],
            ],

            // 15 – Bougainville
            [
                'uuid' => PublicationPremises::generateUniqueUuid(),
                'premises_name' => 'Bougainville Voice Media',
                'business_registration_no' => '944556677',
                'contact_person' => 'Emily Rorovana',
                'location' => 'Buka Town, Autonomous Region of Bougainville',
                'premises_owner_id' => $premises_owner['Sunland Limited'],
                'address' => 'PO Box 401, Buka, AROB',
                'telephone' => '76881234',
                'mobile' => '76881234',
                'status' => 'operational',
                'province_id' => 21, // AROB
                'created_at' => $dates[14],
                'updated_at' => $dates[14],
            ],
        ]);
    }
}
