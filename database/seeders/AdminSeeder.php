<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $admin = User::where('email','admin@gx.uz')->first();
        if(is_null($admin))
        {
            User::create([
                'email'=>'admin@gx.uz',
                'password'=>bcrypt('admin12345'),
                'name'=>'admin',
            ]);
        }
    }
}
