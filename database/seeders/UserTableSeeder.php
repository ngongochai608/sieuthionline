<?php

namespace Database\Seeders;
use App\Models\admin;
use App\Models\roles;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admin::truncate();

        $adminRoles = roles::where('name','admin')->first();
        $authorRoles = roles::where('name','author')->first();
        $logisticsRoles = roles::where('name','logistics')->first();

        $admin = admin::create([
        	'admin_name'=>'Hải Admin',
        	'admin_email'=>'haiadmin@gmail.com',
        	'admin_phone'=>'0969710597',
        	'admin_password'=>md5('123456')
        ]);

        $author = admin::create([
        	'admin_name'=>'Hải Author',
        	'admin_email'=>'haiauthor@gmail.com',
        	'admin_phone'=>'0969710597',
        	'admin_password'=>md5('123456')
        ]);

        $logistics = admin::create([
        	'admin_name'=>'Hải Logistics',
        	'admin_email'=>'hailogistics@gmail.com',
        	'admin_phone'=>'0969710597',
        	'admin_password'=>md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $logistics->roles()->attach($logisticsRoles);
    }
}
