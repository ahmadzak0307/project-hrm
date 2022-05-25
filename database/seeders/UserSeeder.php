<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MasterRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role
        $Role = new MasterRole();
        $Role->hrm_role_name = "admin";
        $Role->hrm_role_stat = 1;
        $Role->hrm_role_createdAt = '2022-02-09 11:35:39';
        $Role->hrm_role_createdBy = 1;
        $Role->save();

        // Membuat sample Admin
        $admin = new User();
        $admin->hrm_usr_nama = "Zaky";
        $admin->hrm_usr_role = 1;
        $admin->hrm_usr_email = "admin@gmail.com";
        $admin->hrm_role_id = "1";
        $admin->password = bcrypt("rahasia");
        $admin->email_verified_at = '2022-02-09 11:35:39';
        $admin->save();
    }
}
