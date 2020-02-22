<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Str;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return true;
        // 获取第一个用户
        $user = User::find(1);
        // users 表填充
        $users_data= array();
        for($i=0; $i<50; $i++){
            $name = uniqid();
            $email = $name.'@example.com';
            $current_time = date('Y-m-d H:i:s');
            $passowrd = Str::random(10);
            $created_at = $current_time;
            $updated_at = $current_time;
            $users_data[] = array(
                'name' => $name,
                'email' => $email,
                'password' => $passowrd,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            );
        }
        DB::table('users') -> insert($users_data);
        // statuses 表填充
        $statuses_data = array();
        for($i=0;$i<50;$i++){
            $length = mt_rand(10,255);
            $contents = Str::random($length);
            if($i>30){
                $user_id = mt_rand(1,50);
            }else{
                $user_id = $user -> id;
            }
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            $statuses_data[] = array(
                'contents' => $contents,
                'user_id' => $user_id,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            );
        }
        DB::table('statuses') -> insert($statuses_data);
        // followers 表填充
        $followers_data = array();
        $user_all = DB::table('users') -> get() -> toArray();
        foreach($user_all as $k){
            if($k -> id == $user -> id){
                continue;
            }
            $followers_data[] = array(
                'user_id' => $user -> id,
                'follower_id' => $k -> id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
        }
        DB::table('followers') -> insert($followers_data);
    }
}
