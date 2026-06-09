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

        // $user->name = 'BOCFP Admin';
        // $user->email = 'bocfp.admin@bocfp.com';
        // $user->username = 'bocfp_admin';
        // $user->password = 'Bocfp@2023';
        // $user->status = "active";
        // // $user->is_default_password = "0";
        // $user->save();

        $user->name = 'BOCFP ADMIN';
        $user->email = 'admin@gmail.com';
        $user->username = 'master_admin';
        $user->password = 'admin';
        $user->status = "active";
        // $user->is_default_password = "0";
        $user->save();
    }
}
