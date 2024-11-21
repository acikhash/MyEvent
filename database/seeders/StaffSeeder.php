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
            'title_id' => 10,
            'title' => 'PM. Ts. DR.',
            'name' => 'NOR ZAIRAH BINTI AB RAHIM',
            'department' => 'BIHG',
            'department_id' => 3,
            'major' => 'PENYELIDIKAN DAN AMALAN PROFESIONAL',
            'major_id' => 2,
            'email' => 'norzairah@utm.my',
            'gred_id' => 3,
            'gred' => 'DS54',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 2,
            'title_id' => 6,
            'title' => 'DR.',
            'name' => 'AZIZUL BIN AZIZAN',
            'department' => 'II',
            'department_id' => 1,
            'major' => 'PENYELIDIKAN DAN AMALAN PROFESIONAL',
            'major_id' => 2,
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'azizul@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 3,
            'title_id' => 10,
            'title' => 'PM. Ts. DR.',
            'name' => 'AZRI BIN AZMI',
            'department' => 'II',
            'department_id' => 1,
            'major_id' => 3,
            'major' => 'KEPIMPINAN AKADEMIK',
            'gred' => 'DS52',
            'gred_id' => 2,
            'email' => 'azri@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 4,
            'title_id' => 6,
            'title' => 'DR.',
            'name' => 'ABDUL GHAFAR BIN JAAFAR',
            'department' => 'BIHG',
            'department_id' => 3,
            'major_id' => 3,
            'major' => 'KEPIMPINAN AKADEMIK',
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'abd@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 5,
            'title' => 'DR.',
            'title_id' => 6,
            'name' => 'FIZA BINTI ABDUL RAHIM',
            'department' => 'BIHG',
            'department_id' => 3,
            'major_id' => 3,
            'major' => 'KEPIMPINAN AKADEMIK',
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'abd@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 6,
            'title' => 'DR.',
            'title_id' => 6,
            'name' => 'GANTHAN A/L NARAYANA SAMY',
            'department' => 'BIHG',
            'department_id' => 3,
            'major_id' => 1,
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'gan@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 7,
            'title' => 'DR.',
            'title_id' => 6,
            'name' => 'HAYATI @ HABIHAH BINTI ABDUL TALIB',
            'department' => 'BIHG',
            'department_id' => 3,
            'major_id' => 1,
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'hayati@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 8,
            'title' => 'DR.',
            'title_id' => 6,
            'name' => 'INTAN SAZRINA BINTI SAIMY @ SAMAN',
            'department' => 'BIHG',
            'department_id' => 3,
            'major_id' => 1,
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'intan@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 9,
            'title' => 'DR.',
            'title_id' => 6,
            'name' => 'NOOR HAFIZAH BINTI HASSAN',
            'department' => 'BIHG',
            'department_id' => 3,
            'major_id' => 1,
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'intan@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 10,
            'title' => 'Ts. DR.',
            'title_id' => 5,
            'name' => 'NOORLIZAWATI BINTI ABD RAHIM',
            'department' => 'BIHG',
            'department_id' => 3,
            'major_id' => 1,
            'major' => 'PENGAJARAN',
            'gred' => 'DS51',
            'gred_id' => 1,
            'email' => 'intan@utm.my',
            'phone' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
