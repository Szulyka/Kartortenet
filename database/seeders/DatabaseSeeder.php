<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2)->create();
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'a@a.hu',
            'password' => 'admin',
            'remember_token' => Str::random(10),
            'is_admin' => 1,
            'is_premium'=> 1,
        ]);
        \App\Models\User::create([
            'name' => 'noAdmin',
            'email' => 'n@n.hu',
            'password' => 'noadmin',
            'remember_token' => Str::random(10),
            'is_admin' => 0,
            'is_premium'=> 0,
        ]);
        
        \App\Models\Vehicle::factory(4)->create();
        \App\Models\SearchHistory::factory(4)->create();
        \App\Models\CrashEvent::factory(4)->create();


        $vehicle = \App\Models\Vehicle::find(1);
        $vehicle->crashEvents()->sync([1, 2]);

        $ce = \App\Models\CrashEvent::find(2);
        $ce->vehicles()->sync([1,2]);
    }
}
