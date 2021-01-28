<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => Uuid::uuid4(),
                'name' => "Chandra Ramdhan Purnama",
                'username' => "euclife",
                'password' => Hash::make('Bandung2020'),
                'status' => true,
                'created_at' => Carbon::now()
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => "Admin",
                'username' => "admin",
                'password' => Hash::make('admin'),
                'status' => true,
                'created_at' => Carbon::now()
            ]
        ]);

        $faker = new UserFactory();

        for($i = 1 ; $i <= 10 ; $i++){
            DB::table('users')->insert($faker->definition());
        }
    }
}
