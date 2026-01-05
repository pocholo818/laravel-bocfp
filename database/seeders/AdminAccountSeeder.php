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

        $user->name = config('app.admin_name');
        $user->email = config('app.admin_email');
        $user->username = config('app.admin_username');
        $user->password = bcrypt(config('app.admin_password'));
        $user->status = "active";
        // $user->is_default_password = "0";
        $user->save();
    }
}
