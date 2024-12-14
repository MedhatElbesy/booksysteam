<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->insert([
            [
                "name"     => "الصف الأول",
                "stage_id" => 1,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الثاني",
                "stage_id" => 1,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الثالث",
                "stage_id" => 1,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الرابع",
                "stage_id" => 1,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الخامس",
                "stage_id" => 1,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف السادس",
                "stage_id" => 2,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف السابع",
                "stage_id" => 2,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الثامن",
                "stage_id" => 2,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف التاسع",
                "stage_id" => 2,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف العاشر",
                "stage_id" => 3,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الحادي عشر",
                "stage_id" => 3,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الثاني عشر",
                "stage_id" => 3,
                "term_id"  => 1
            ],
            [
                "name"     => "الصف الأول",
                "stage_id" => 1,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف الثاني",
                "stage_id" => 1,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف الثالث",
                "stage_id" => 1,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف الرابع",
                "stage_id" => 1,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف الخامس",
                "stage_id" => 1,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف السادس",
                "stage_id" => 2,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف السابع",
                "stage_id" => 2,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف الثامن",
                "stage_id" => 2,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف التاسع",
                "stage_id" => 2,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف العاشر",
                "stage_id" => 3,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف الحادي عشر",
                "stage_id" => 3,
                "term_id"  => 2
            ],
            [
                "name"     => "الصف الثاني عشر",
                "stage_id" => 3,
                "term_id"  => 2
            ],

        ]);
    }
}
