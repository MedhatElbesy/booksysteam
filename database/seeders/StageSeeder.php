<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stages')->insert([
            [
                "name" => "المرحلة الابتدائية"
            ],
            [
                "name" => "المرحلة الاعدادية"
            ],
            [
                "name" => "المرحلة الثانوية"
            ],

        ]);
    }
}
