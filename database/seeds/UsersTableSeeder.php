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

        $user_numer = 18;
        $password = '1';

        for ($i = 1; $i <= $user_numer; $i ++) {

            if ($i === 1) {
                DB::table('users')->insert([
                    'name'     => 'Rafał Kucharski',
                    'email'    => 'kuchar.rafal@gmail.com',
                    'gender'   => 'm',
                    'avatar'   => '7dbb528762465f5e7efa095b3497225e.jpeg',
                    'password' => bcrypt($password),
                ]);

                DB::table('users')->insert([
                    'name'     => 'Monika Balwin',
                    'email'    => 'monika.balwin@vp.pl',
                    'gender'   => 'f',
                    'avatar'   => '36b2f5ca723acb00d65f186ef8d93c55.jpeg',
                    'password' => bcrypt($password),
                ]);
            }

            $gender = $faker->randomElement(['m', 'f']);

            switch ($gender) {
                case 'm':
                    $name = $faker->firstNameMale . ' ' . $faker->lastNameMale;
                    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
                    break;

                case 'f':
                    $name = $faker->firstNameFemale . ' ' . $faker->lastNameFemale;
                    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
                    break;
            }

            DB::table('users')->insert([
                'name'     => $name,
                'email'    => str_replace('-', '.', str_slug($name)) . '@' . $faker->safeEmailDomain,
                'gender'   => $gender,
                'avatar'   => $avatar,
                'password' => bcrypt($password),
            ]);

        }

    }
}
