<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            'id' => 1,
            'name' => 'Bachelor of Artificial Intelligence with Honours',
            'code' => 'SAIAH',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 2,
            'name' => 'Bachelor of Science (Industrial Design)',
            'code' => 'SRTIH',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 3,
            'name' => 'Doctor of Engineering',
            'code' => 'ERSA2',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 4,
            'name' => 'Doctor of Engineering in Engineering Business Management',
            'code' => 'ERTE2',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 5,
            'name' => 'Executive Master Occupational Safety and Health Management',
            'code' => 'MRSA1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 6,
            'name' => 'Master in Occupational Safety & Health Management',
            'code' => 'MRTH1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 7,
            'name' => 'Master in Science, Technology and Innovation Policy',
            'code' => 'MFFT1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 8,
            'name' => 'Master in Science, Technology and Innovation Policy',
            'code' => 'MRTT1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 9,
            'name' => 'Master of Professional Science',
            'code' => 'MRSQ1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 10,
            'name' => 'Master of Science (Business Intelligence and Analytics)',
            'code' => 'MANB1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 11,
            'name' => 'Master of Science (Business Intelligence and Analytics)',
            'code' => 'MRTB1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 12,
            'name' => 'Master of Science (Business Intelligence and Analytics)',
            'code' => 'MRTB4',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 13,
            'name' => 'Master of Science (Computer System Engineering)',
            'code' => 'MANS1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 14,
            'name' => 'Master of Science (Engineering Business Management)',
            'code' => 'MRSE1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 15,
            'name' => 'Master of Science (Engineering Business Management)',
            'code' => 'MRTE1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 16,
            'name' => 'Master of Science (Engineering Business Management)',
            'code' => 'MRSD1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);

        DB::table('programs')->insert([
            'id' => 17,
            'name' => 'Master of Science (Engineering Design)',
            'code' => 'MRSF1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 18,
            'name' => 'Master of Science (Engineering Education)s',
            'code' => 'MRST1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 19,
            'name' => 'Master of Science (Informatics)',
            'code' => 'MANQ1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 20,
            'name' => 'Master of Science (Information Assurance)',
            'code' => 'MANA1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 21,
            'name' => 'Master of Science (Sustainable Infrastructure)',
            'code' => 'MRSC1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 22,
            'name' => 'Master of Science (Sustainable Urban Design)',
            'code' => 'MRSS1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 23,
            'name' => 'Master of Science (Systems Engineering)',
            'code' => 'MRSL1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 24,
            'name' => 'Master of Science (Systems Engineering)',
            'code' => 'MRTL1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 25,
            'name' => 'Master of Science in Computer System Engineering',
            'code' => 'MRTS1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 26,
            'name' => 'Master of Science in Informatics',
            'code' => 'MRTQ1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 27,
            'name' => 'Master of Science in Information Security Assurance',
            'code' => 'MRTA1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('programs')->insert([
            'id' => 28,
            'name' => 'Master of Software Engineering',
            'code' => 'MANP1',
            'department_id' => 1,
            'staff_id' => 1,
            'department' => 'II',
            'coordinator' => 'PM. Ts. DR. NOR ZAIRAH BINTI AB RAHIM',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
