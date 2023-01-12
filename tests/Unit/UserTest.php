<?php

namespace Tests\Unit;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function test_user_create()
//    {
//        $data = [
//            'name' => 'aaa',
//            'email' => 'aaa@aaa.aaa',
//            'password' => 'aaa',
//            'password_confirm' => 'aaa',
//            'role' => 'user',
//            'avatar' => 'https://i.pravatar.cc/300',
//        ];
//
//        $user = User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'role' => $data['role'],
//            'avatar' => $data['avatar'],
//            'password' => $data['password'],
//        ]);
//
//        $this->assertEquals(1,$user->count());
//    }

//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function test_user_create()
//    {
//        $this->assertTrue(true);
////        $data = [
////            'name' => 'aaa',
////            'email' => 'aaa@aaa.aaa',
////            'password' => 'aaa',
////            'password_confirm' => 'aaa',
////            'role' => 'user',
////            'avatar' => 'https://i.pravatar.cc/300',
////        ];
////
////        $user = User::create([
////            'name'=>data[name],
////            'email'=>data[email],
////            'role'=>data[role],
////            'avatar'=>data[avatar],
////            'password'=>data[password],
////        ]);
//
//        $this->assertTrue(true);
////        dd($user);
//    }

    /**
     * A basic test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_user_method()
    {
        $userData = [
            'name' => 'aaa test',
            'email' => 'aaa@aaa.aaa',
            'password' => 'aaa',
            'password_confirm' => 'aaa',
            'role' => 'user',
            'avatar' => 'https://i.pravatar.cc/300',
        ];

        list($data, $error) = User::register($userData);

        if($error){
            dd($error);
        }

        \Log::debug($data);

        $users = User::get();
        dd($users->toJson());
        $this->assertTrue(true);
    }
}
