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
        $comments_per_post = 20;

        DB::table('roles')->insert([
            'id'       => 1,
            'type'      => 'admin',
        ]);
        DB::table('roles')->insert([
            'id'       => 2,
            'type'      => 'user',
        ]);

        //---// USERS //---//
        for ($user_id = 1; $user_id <= $user_number; $user_id ++) {
            $date = $faker->dateTimeThisYear($max = 'now');
            if ($user_id === 1) {
                DB::table('users')->insert([
                    'name'       => 'Rafał Kucharski',
                    'email'      => 'kuchar.rafal@gmail.com',
                    'gender'     => 'm',
                    'avatar'     => '7dbb528762465f5e7efa095b3497225e.jpeg',
                    'role_id'   => 1,
                    'password'   => bcrypt($password),
                    'created_at' => $date
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
                    'role_id'   => 2,
                    'password' => bcrypt($password),
                    'created_at' => $date
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
                    'role_id'   => 2,
                    'password' => bcrypt($password),
                    'created_at' => $date
                ]);

                DB::table('profiles')->insert([
                    'user_id' => $user_id,
                ]);

            }

            //---// FRIENDS //---//
            for ($i = 1; $i <= $faker->numberBetween($min = 0, $max = $user_number - 1); $i ++) {
                $friend_id = $faker->numberBetween($min = 1, $max = $user_number);
                $date = $faker->dateTimeThisYear($max = 'now');
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
                        'created_at' => $date
                    ]);

                }

            }

            //---// POSTS //---//
            for ($post_id = 1; $post_id <= $faker->numberBetween($min = 0, $max = $post_per_user); $post_id ++) {
                $date = $faker->dateTimeThisYear($max = 'now');
                DB::table('posts')->insert([
                    'user_id'   => $user_id,
                    'body' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                //---// COMMENTS //---//
                $post_id_comment = DB::getPdo()->lastInsertId();
                for ($comment_id = 1; $comment_id <= $faker->numberBetween($min = 0, $max = $comments_per_post); $comment_id ++) {
                    $date = $faker->dateTimeThisYear($max = 'now');

                    DB::table('comments')->insert([
                        'user_id'   => $faker->numberBetween($min = 1, $max = $user_number),
                        'post_id'   => $post_id_comment,
                        'body' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);

                } // comments

            } // posts

        } // users
    }
}
