<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;


class UsersTest extends TestCase
{
    use RefreshDatabase;

    private function ddResponse($response)
    {
        if ($response->exception == null) {
            $contents = json_decode(($response->baseResponse->getContent()));

            if ($contents == null) {
                dd(null);
            }

            dd($contents);
        } else {
            dd($response->exception);
        }
    }

    protected function setUp(): void // ※ Voidが必要
    {
        // 必ずparent::setUp()を呼び出す
        parent::setUp();
        // 1.ログインユーザー作成
        User::create([
            'name' => 'sample user',
            'email' => 'sample@sankosc.co.jp',
            'password' => Hash::make('sample123'),
        ]);
        // 2.ログインAPIでアクセストークン取得
        $response = $this->post('/api/login', [
            'email' => 'sample@sankosc.co.jp',
            'password' => 'sample123'
        ]);
//        dd($response->getCookie('jwt')->getValue());
        $response->assertOk();
        // 3.アクセストークンを変数に保存しておく
        try {
//            $this->accessToken = $response->decodeResponseJson('jwt')->json('jwt');
            $this->accessToken = $response->getCookie('jwt')->getValue();
        } catch (\Throwable $e) {
            echo $e;
        }
//        dd($this->accessToken);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index()
    {
        User::create([
            'name' => 'sample user2',
            'email' => 'sample2@sankosc.co.jp',
            'password' => Hash::make('sample123'),
        ]);

        $response = $this->get('/api/users', [
            'Authorization' => 'Bearer ' . $this->accessToken
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'role',
                    'avatar',
                    'created_at',
                    'updated_at',
                ],
            ]
        );
        $response->assertJsonCount(2);
    }

    public function test_login()
    {
        User::create([
            'name' => 'aaa',
            'email' => 'aaa@aaa.aaa',
            'password' => Hash::make('aaa'),
        ]);
//        dd(User::all());
        $data = [
            'email' => 'aaa@aaa.aaa',
            'password' => 'aaa',
        ];
        $response = $this->post('/api/login', $data);

//        $this->ddResponse($response);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'jwt',
        ]);
        $this->assertAuthenticated();
    }

    public function test_user()
    {
        User::create([
            'name' => 'aaa',
            'email' => 'aaa@aaa.aaa',
            'password' => Hash::make('aaa'),
        ]);
//        dd(User::all());
        $data = [
            'email' => 'aaa@aaa.aaa',
            'password' => 'aaa',
        ];
        $response = $this->post('/api/user', $data);

//        $this->ddResponse($response);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'jwt',
        ]);
        $this->assertAuthenticated();
    }
}
