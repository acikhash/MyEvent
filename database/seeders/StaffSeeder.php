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
            'name' => 'NOR ZAIRAH BINTI AB RAHIM',
            'department_id' => 3,
            'major_id' => 2,
            'email' => 'norzairah@utm.my',
            'gred_id' => 3,
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 2,
            'title_id' => 6,
            'name' => 'AZIZUL BIN AZIZAN',
            'department_id' => 1,
            'major_id' => 2,
            'gred_id' => 1,
            'email' => 'azizul@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 3,
            'title_id' => 10,
            'name' => 'AZRI BIN AZMI',
            'department_id' => 1,
            'major_id' => 3,
            'gred_id' => 2,
            'email' => 'azri@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 4,
            'title_id' => 6,
            'name' => 'ABDUL GHAFAR BIN JAAFAR',
            'department_id' => 3,
            'major_id' => 3,
            'gred_id' => 1,
            'email' => 'abd@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 5,
            'title_id' => 6,
            'name' => 'FIZA BINTI ABDUL RAHIM',
            'department_id' => 3,
            'major_id' => 3,
            'gred_id' => 1,
            'email' => 'abd@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 6,
            'title_id' => 6,
            'name' => 'GANTHAN A/L NARAYANA SAMY',
            'department_id' => 3,
            'major_id' => 3,
            'gred_id' => 1,
            'email' => 'gan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 7,
            'title_id' => 6,
            'name' => 'HAYATI @ HABIHAH BINTI ABDUL TALIB',
            'department_id' => 3,
            'major_id' => 3,
            'gred_id' => 2,
            'email' => 'hayati@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 8,
            'title_id' => 6,
            'name' => 'INTAN SAZRINA BINTI SAIMY @ SAMAN',
            'department_id' => 3,
            'major_id' => 3,
            'gred_id' => 1,
            'email' => 'intan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 9,
            'title_id' => 5,
            'name' => 'NOOR HAFIZAH BINTI HASSAN',
            'department_id' => 3,
            'major_id' => 3,
            'gred_id' => 1,
            'email' => 'intan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('staff')->insert([
            'id' => 10,
            'title_id' => 5,
            'name' => 'NOORLIZAWATI BINTI ABD RAHIM',
            'department_id' => 3,
            'major_id' => 3,
            'gred_id' => 1,
            'email' => 'intan@utm.my',
            'contactNumber' => '0123456789',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
