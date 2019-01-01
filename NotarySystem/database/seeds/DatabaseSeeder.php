<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            [
                'firstname' => 'Noor',
                'lastname' => 'Khayrattee',  
                'title'=> '1',
                'contactnum' => '57896461',
                'email' => 'nooree@gmail.com',
                'password' => bcrypt('123456'),
                'dob' => '1997-11-13',
                'birthCertificateNumber' =>'7',
                'districtIssued' => '2',
                'placeOfBirth' =>'Dr Jeetoo Hospital',
                'gender' => '1',
                'address' => 'Royal Road Lavenir St Pierre',
                'nic' => 'K1234567890987',
                'marriageStatus' => '1',
                'roles' => '1',
                'profession'=>'software tester'
            ],   

            [
                'firstname' => 'John',
                'lastname' => 'Rattee',  
                'title'=> '1',
                'contactnum' => '54896461',
                'email' => 'cdcdc@gmail.com',
                'password' => bcrypt('123456'),
                'dob' => '1997-11-13',
                'birthCertificateNumber' =>'8',
                'districtIssued' => '2',
                'placeOfBirth' =>'Dr Jeetoo Hospital',
                'gender' => '1',
                'address' => 'Royal Road Lavenir St Pierre',
                'nic' => 'K1334567890987',
                'marriageStatus' => '2',
                'roles' => '6',
                'profession'=>'software tester'
            ],   

            [
                'firstname' => 'bob',
                'lastname' => 'kool',  
                'title'=> '1',
                'contactnum' => '50896461',
                'email' => 'bobkool@gmail.com',
                'password' => bcrypt('123456'),
                'dob' => '1997-11-13',
                'birthCertificateNumber' =>'9',
                'districtIssued' => '2',
                'placeOfBirth' =>'Dr Jeetoo Hospital',
                'gender' => '1',
                'address' => 'Royal Road Lavenir St Pierre',
                'nic' => 'K1534567890987',
                'marriageStatus' => '2',
                'roles' => '7',
                'profession'=>'software tester'
            ],   

            [
                'firstname' => 'Hannah',
                'lastname' => 'Grace',  
                'title'=> '2',
                'contactnum' => '52896461',
                'email' => 'possession@gmail.com',
                'password' => bcrypt('123456'),
                'dob' => '1997-11-13',
                'birthCertificateNumber' =>'10',
                'districtIssued' => '2',
                'placeOfBirth' =>'Dr Jeetoo Hospital',
                'gender' => '1',
                'address' => 'Royal Road Lavenir St Pierre',
                'nic' => 'K1239567890987',
                'marriageStatus' => '2',
                'roles' => '7',
                'profession'=>'software tester'
            ],   
        ]);

        DB::table('staff')->insert([
            [
                'title' =>'1',
                'roles' =>'1',
                'firstname' => 'Sarah',
                'lastname' => 'Muller',  
                'email' => 'sarah@gmail.com',
                'password' => Hash::make(123456),
                'dob' => '1997-11-13',
                'nic'=>'M1122334450667',
                'contactnum'=>'56780990',
                'gender'=>'1'
            ],   
        ]);
    }
}
