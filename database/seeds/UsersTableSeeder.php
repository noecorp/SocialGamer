<?php

use App\Friend;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');

        //---// VARIABLES //---//

        $user_number = 100;
        $password = '1';
        $post_per_user = 100;

        //---// USERS //---//
        for ($user_id = 1; $user_id <= $user_number; $user_id ++) {

            if ($user_id === 1) {
                DB::table('users')->insert([
                    'name'       => 'Rafał Kucharski',
                    'email'      => 'kuchar.rafal@gmail.com',
                    'gender'     => 'm',
                    'avatar'     => '7dbb528762465f5e7efa095b3497225e.jpeg',
                    'password'   => bcrypt($password),
                    'created_at' => $faker->dateTimeThisYear($max = 'now')
                ]);
                DB::table('profiles')->insert([
                    'user_id' => $user_id,
                ]);
            } elseif ($user_id === 2) {
                DB::table('users')->insert([
                    'name'     => 'Monika Balwin',
                    'email'    => 'monika.balwin@vp.pl',
                    'gender'   => 'f',
                    'avatar'   => '86b41a2826a035887c2079fdad49598e.jpeg',
                    'password' => bcrypt($password),
                    'created_at' => $faker->dateTimeThisYear($max = 'now')
                ]);
                DB::table('profiles')->insert([
                    'user_id' => $user_id,
                ]);
            } else {

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
                    'created_at' => $faker->dateTimeThisYear($max = 'now')
                ]);

                DB::table('profiles')->insert([
                    'user_id' => $user_id,
                ]);

            }

            //---// FRIENDS //---//
            for ($i = 1; $i <= $faker->numberBetween($min = 0, $max = $user_number - 1); $i ++) {
                $friend_id = $faker->numberBetween($min = 1, $max = $user_number);

                $friend_condition = Friend::where([
                    'user_id'   => $user_id,
                    'friend_id' => $friend_id,
                ])->orWhere([
                    'user_id'   => $friend_id,
                    'friend_id' => $user_id,
                ])->exists();

                if (!$friend_condition) {

                    DB::table('friends')->insert([
                        'user_id'   => $user_id,
                        'friend_id' => $friend_id,
                        'accepted'    => 1,
                        'created_at' => $faker->dateTimeThisYear($max = 'now')
                    ]);

                }

            }

            //---// POSTS //---//
            for ($i = 1; $i <= $faker->numberBetween($min = 0, $max = $post_per_user); $i ++) {

                DB::table('posts')->insert([
                    'user_id'   => $user_id,
                    'body' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                    'updated_at' => $faker->dateTimeThisYear($max = 'now'),
                ]);

                //---// COMMENTS //---//

            }

        }
    }
}
