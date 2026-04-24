<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('characters')->insert([
            ['name' => 'Warrior', 'type' => 'Fighter', 'health' => 100, 'attack' => 20, 'defense' => 15],
            ['name' => 'Mage', 'type' => 'Spellcaster', 'health' => 70, 'attack' => 30, 'defense' => 10],
            ['name' => 'Archer', 'type' => 'Ranged', 'health' => 80, 'attack' => 25, 'defense' => 12],
        ]);
    }
}
