<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Branch::where('id',1)->first();
        if (is_null($user)) {
            $user = new Branch();
            $user->branch_name = "super admin";
            $user->branch_code = "super admin";
            $user->save();


        }
    }
}
