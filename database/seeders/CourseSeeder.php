<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'id' => 1,
            'name' => 'DATA GOVERNANCE',
            'code' => 'MRTB1113',
            'section' => '50',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 2,
            'name' => 'DATA GOVERNANCE',
            'code' => 'MRTB1113',
            'section' => '51',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 3,
            'name' => 'DATA GOVERNANCE',
            'code' => 'MRTB1113',
            'section' => '52',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 4,
            'name' => 'BUSINESS INTELLIGENCE',
            'code' => 'MRTB1133',
            'section' => '50',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 5,
            'name' => 'BUSINESS INTELLIGENCE',
            'code' => 'MRTB1133',
            'section' => '51',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 6,
            'name' => 'BUSINESS INTELLIGENCE',
            'code' => 'MRTB1133',
            'section' => '52',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 7,
            'name' => 'DATA VISUALIZATION & INTERACTIVE DESIGN',
            'code' => 'MRTB1143',
            'section' => '50',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 8,
            'name' => 'DATA VISUALIZATION & INTERACTIVE DESIGN',
            'code' => 'MRTB1143',
            'section' => '51',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 9,
            'name' => 'DATA VISUALIZATION & INTERACTIVE DESIGN',
            'code' => 'MRTB1143',
            'section' => '52',
            'credit' => 3,
            'no_of_student' => 20,
            'program_id' => 12,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 10,
            'name' => 'INFORMATICS IN SOCIETY',
            'code' => 'UANP6013',
            'section' => '1',
            'credit' => 3,
            'no_of_student' => 1,
            'program_id' => 10,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 11,
            'name' => 'INFORMATICS IN SOCIETY',
            'code' => 'UANP6013',
            'section' => '1',
            'credit' => 3,
            'no_of_student' => 1,
            'program_id' => 13,
            'semester_id' => 2,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 12,
            'name' => 'PROJECT 2',
            'code' => 'MANN2087',
            'section' => '1',
            'credit' => 7,
            'no_of_student' => 1,
            'program_id' => 13,
            'semester_id' => 3,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 13,
            'name' => 'INFORMATICS IN SOCIETY',
            'code' => 'UANP6013',
            'section' => '2',
            'credit' => 3,
            'no_of_student' => 2,
            'program_id' => 26,
            'semester_id' => 3,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 14,
            'name' => 'RESEARCH METHODOLOGY',
            'code' => 'MRTS0013',
            'section' => '2',
            'credit' => 3,
            'no_of_student' => 2,
            'program_id' => 26,
            'semester_id' => 3,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('courses')->insert([
            'id' => 15,
            'name' => 'WIRELESS COMMUNICATION AND NETWORKING',
            'code' => 'MRTS2093',
            'section' => '1',
            'credit' => 3,
            'no_of_student' => 3,
            'program_id' => 26,
            'semester_id' => 3,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
    }
}
