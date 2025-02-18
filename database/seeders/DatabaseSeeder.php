<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Yasser Nabeel Ali',
        //     'email' => 'yasser1@gmail.com',
        //     'password' => '11111111',
        //     'photo' => 'yasser1@gmail.com',
        //     'phone' => '77777777',
        // ]);

        // $user = User::find(202501);
        // $user->delete();


        $user = User::find(202515);

        $role = Role::where('name' , 'admin');

        $user->assignRole('admin');

    }
}
