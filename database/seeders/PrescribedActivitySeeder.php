<?php

namespace Database\Seeders;

use App\Models\PrescribedActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrescribedActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prescribedActivitesTypes = DB::table('prescribed_activity_types')->pluck('id', 'type');

        DB::table('prescribed_activities')->insert([
            //1
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Papua New Guinea Produced Digital Video Disc Featured Film Advertising Matter',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            // 2
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Foreign Produced Digital Video Disc Featured Film (Trailers) Advertising Matter',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            // 3
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Papua New Guinea Produced Digital Video Disc Featured Film',
                'prescribed_fee' => 200.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            // 4
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Foreign Produced Digital Video Disc Featured Film',
                'prescribed_fee' => 150.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //5
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Papua New Guinea Produced Digital Film Advertising Matter',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //6
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Papua New Guinea Produced Digital Featured Film',
                'prescribed_fee' => 200.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //7
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Foreign Produced Digital Advertising Matter',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //8
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Foreign Produced Digital Featured Film',
                'prescribed_fee' => 200.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //9
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Digital Commercials intended for radio broadcasting',
                'prescribed_fee' => 200.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //10
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Digital Commercials intended for television broadcasting',
                'prescribed_fee' => 200.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //11
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Film Advertising Matter (Preview) intended for television broadcasting',
                'prescribed_fee' => 150.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //12
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Papua New Guinea Produced Film intended for television broadcasting',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //13
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Foreign Produced Film intended for television broadcasting',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //14
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Papua New Guinea Produced Digital Disc Film Advertising Matter',
                'prescribed_fee' => 150.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //15
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Foreign Produced Digital Video Disc Advertising Matter',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //16
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Digital Video Disc Advertising Matter that contains dialogue or captions in foreign language',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //17
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Digital Video Disc Featured Film that contains dialogue or captions in foreign language',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //18
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Papua New Guinea Produced Digital Video Disc (DVD) Featured film',
                'prescribed_fee' => 50.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //19
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Foreign Produced Digital Video Disc (DVD) Featured film',
                'prescribed_fee' => 50.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //20
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Digital Film Advertising Matter that contains dialogue or captions in Foreign language',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //21
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Papua New Guinea Produced Digital Advertising Matter',
                'prescribed_fee' => 150.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //22
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Foreign Produced Digital Advertising Matter',
                'prescribed_fee' => 200.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //23
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Digital Film that contains dialogue or caption',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //24
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Papua New Guinea Produced Digital Featured Film',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //25
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Foreign Produced Cinema Featured Film',
                'prescribed_fee' => 150.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //26
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Papua New Guinea Periodic Series Publication Other that Film',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //27
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Foreign Periodic Series Publication Other that Film',
                'prescribed_fee' => 150.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //28
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Papua New Guinea Produced Publication Other that Film',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //29
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Review of Foreign Produced Publication Other that Film',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //30
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Foreign Periodic Series Publication Other that Film',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //31
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Papua New Guinea Produced Publication Other that Film',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //32
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Foreign Produced Publication Other that Film',
                'prescribed_fee' => 100.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Classification of Films & Publications'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //33
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Advertising Production',
                'prescribed_fee' => 5000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //34
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Multimedia Production',
                'prescribed_fee' => 5000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //35
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Online Gaming',
                'prescribed_fee' => 6000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //36
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Gaming - Ware Dealer (Hardware & Software)',
                'prescribed_fee' => 2500.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //37
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Gaming - Ware Distributor (Hardware & Software)',
                'prescribed_fee' => 5000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //38
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Compact Digital Music Dealer',
                'prescribed_fee' => 300.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //39
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Recording Studio',
                'prescribed_fee' => 1000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //40
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Internet Cafe',
                'prescribed_fee' => 1000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //41
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Digital Music Distributor',
                'prescribed_fee' => 1000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //42
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Film/Movies Importer',
                'prescribed_fee' => 2000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //43
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Film Reproduction',
                'prescribed_fee' => 5000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //44
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Video Dealer',
                'prescribed_fee' => 500.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //45
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Video Distributor',
                'prescribed_fee' => 1000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //46
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Change of Publication Premises',
                'prescribed_fee' => 300.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //47
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Internet Gateway',
                'prescribed_fee' => 50000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //48
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Internet Service Provider',
                'prescribed_fee' => 10000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //49
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Audio Dealer',
                'prescribed_fee' => 300.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //50
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Audio Distributor',
                'prescribed_fee' => 500.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //51
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Literature Dealer',
                'prescribed_fee' => 1000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //52
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Literature Distributor',
                'prescribed_fee' => 1500.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //53
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Film Production',
                'prescribed_fee' => 6000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //54
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Video Outlet',
                'prescribed_fee' => 300.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //55
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Video Cinema',
                'prescribed_fee' => 5000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //56
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Video Library',
                'prescribed_fee' => 500.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //57
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Film Theatre',
                'prescribed_fee' => 500.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //58
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Radio Station',
                'prescribed_fee' => 6000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //59
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Special Cable Television',
                'prescribed_fee' => 2000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //60
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Limited Hotel Television',
                'prescribed_fee' => 3000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //61
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Public Cable Television',
                'prescribed_fee' => 20000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //62
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Public Television Station',
                'prescribed_fee' => 20000.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
            //63
            [
                'uuid' => PrescribedActivity::generateUniqueUuid(),
                'activity_type' => 'Publisher',
                'prescribed_fee' => 500.00,
                'is_active' => true,
                'prescribed_activity_type_id' => $prescribedActivitesTypes['Registration of Publication Premises'],
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
