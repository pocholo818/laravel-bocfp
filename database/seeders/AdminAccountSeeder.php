<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Laravel\Models\User;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        if(!$user){
            $user = new User;
        }

        $user->name = "Super User";
        $user->email = "admin@email.com";
        $user->username = "master_admin";
        $user->password = bcrypt("admin");
        $user->status = "active";
        // $user->type = "super_admin";
        // $user->role = "Super Admin";
        // $user->role_id = 1;
        // $user->is_default_password = "0";
        $user->save();
    }
}
