<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staff')->insert([
            'id' => 1,
            'title' => 'PM. Ts. DR.',
            'name' => 'NOR ZAIRAH BINTI AB RAHIM',
            'department' => 'BIHG',
            'major' => 'PENYELIDIKAN DAN AMALAN PROFESIONAL',
            'email' => 'norzairah@utm.my',
            'gred' => 'DS54',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 2,
            'title' => 'DR.',
            'name' => 'AZIZUL BIN AZIZAN',
            'department' => 'II',
            'major' => 'PENYELIDIKAN DAN AMALAN PROFESIONAL',
            'gred' => 'DS51',
            'email' => 'azizul@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 3,
            'title' => 'PM. Ts. DR.',
            'name' => 'AZRI BIN AZMI',
            'department' => 'II',
            'major' => 'KEPIMPINAN AKADEMIK',
            'gred' => 'DS52',
            'email' => 'azri@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 4,
            'title' => 'DR.',
            'name' => 'ABDUL GHAFAR BIN JAAFAR',
            'department' => 'BIHG',
            'major' => 'KEPIMPINAN AKADEMIK',
            'gred' => 'DS51',
            'email' => 'abd@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 5,
            'title' => 'DR.',
            'name' => 'FIZA BINTI ABDUL RAHIM',
            'department' => 'BIHG',
            'major' => 'KEPIMPINAN AKADEMIK',
            'gred' => 'DS51',
            'email' => 'abd@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 6,
            'title' => 'DR.',
            'name' => 'GANTHAN A/L NARAYANA SAMY',
            'department' => 'BIHG',
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'email' => 'gan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 7,
            'title' => 'DR.',
            'name' => 'HAYATI @ HABIHAH BINTI ABDUL TALIB',
            'department' => 'BIHG',
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'email' => 'hayati@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 8,
            'title' => 'DR.',
            'name' => 'INTAN SAZRINA BINTI SAIMY @ SAMAN',
            'department' => 'BIHG',
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'email' => 'intan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 9,
            'title' => 'DR.',
            'name' => 'NOOR HAFIZAH BINTI HASSAN',
            'department' => 'BIHG',
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'email' => 'intan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 10,
            'title' => 'Ts. DR.',
            'name' => 'NOORLIZAWATI BINTI ABD RAHIM',
            'department' => 'BIHG',
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'email' => 'intan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
