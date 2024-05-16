<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DesignationList;
use App\Models\Branch;
class DesignationListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = Branch::where('id',1)->first();

       

            $user = new DesignationList();
            $user->branch_id =  $user1->id;
            $user->designation_name	 = "super admin";
           // $user->designation_step	 =1;
            $user->designation_serial	 =1;
            $user->save();



    }
}
