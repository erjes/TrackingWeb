<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminObj = new User();
        $adminObj->name = 'Admin RC';
        $adminObj->email = 'adminrc@gmail.com';
        $adminObj->password = Hash::make('12345678');
        $adminObj->type = 1;
        $adminObj->save();

        $superAdminObj = new User();
        $superAdminObj->name = 'Super Admin RC';
        $superAdminObj->email = 'superadminrc@gmail.com';
        $superAdminObj->password = Hash::make('3rcRMWlhdbtmdre');
        $superAdminObj->type = 2;
        $superAdminObj->save();

    }
}
