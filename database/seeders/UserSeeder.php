<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::where('email','superadmin@gmail.com')->first();
        if (is_null($user)) {
            $user = new Admin();
            $user->admin_name = "super admin";
            $user->admin_name_ban = "super admin ban";
            $user->designation_list_id = 1;
            $user->branch_id = 1;
            $user->email = "superadmin@gmail.com";
            $user->admin_mobile = "123456789";
            $user->password = Hash::make('12345678');
            $user->save();

            $user->assignRole('superadmin');
        }
    }
}
