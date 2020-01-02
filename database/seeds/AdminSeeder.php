<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Admin::create([
            'name' => 'abdo osama',
            'email'=> 'admin@admin.com',
            'password'=>bcrypt('admin'),
        ]);

        $male = \App\Gender::create([
            'name' => 'Male',
        ]);

        $female = \App\Gender::create([
            'name' => 'Female',
        ]);


    }
}
