<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            'name' => 'Jabatan Kewangan',
        ]);

        DB::table('jabatan')->insert([
            'name' => 'Jabatan IT',
        ]);
    }
}
