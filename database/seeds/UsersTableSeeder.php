<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pl_PL');

//      VARIABLES
        
        $user_numer = 20;
        $password = '1';
        
        for ($i = 1; $i <= $user_numer; $i++) {
            
            if ($i === 1) {
                DB::table('users')->insert([
                    'name'     => 'Rafał Kucharski',
                    'email'    => 'kuchar.rafal@gmail.com',
                    'gender'   => 'm',
                    'password' => bcrypt($password),
                ]);
            }
            
            $gender = $faker->randomElement(['m', 'f']);
            
            switch ($gender) {
                case 'm':
                    $name = $faker->firstNameMale . ' ' . $faker->lastNameMale;
                    break;
                
                case 'f':
                    $name = $faker->firstNameFemale . ' ' . $faker->lastNameFemale;
                    break;
            }
            
            DB::table('users')->insert([
                'name'     => $name,
                'email'    => str_replace('-', '.', str_slug($name)) . '@' . $faker->safeEmailDomain,
                'gender'   => $gender,
                'password' => bcrypt($password),
            ]);
            
        }
        
    }
}
