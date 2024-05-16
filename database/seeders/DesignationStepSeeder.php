<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DesignationList;
use App\Models\Branch;
use App\Models\DesignationStep;
class DesignationStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = DesignationList::where('id',1)->first();

        $user = new DesignationStep();
        $user->designation_list_id =  $user1->id;
        $user->designation_step	 = "super admin";
        $user->designation_serial	 = "super admin";
        $user->save();
    }
}
