<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->where('guard_name','web')
       ->update([
           'guard_name' =>'admin'
        ]);

        DB::table('permissions')->where('guard_name','web')
        ->update([
            'guard_name' =>'admin'
         ]);
    }
}
