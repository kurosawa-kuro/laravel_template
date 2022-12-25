<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;


class ProtectedTest extends TestCase
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

    protected function setUp(): Void // ※ Voidが必要
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
//        dd($response->decodeResponseJson('jwt'));
        $response->assertOk();
        // 3.アクセストークンを変数に保存しておく
        try {
            $this->accessToken = $response->decodeResponseJson('jwt');
        } catch (\Throwable $e) {
            echo $e;
        }
//        dd($this->accessToken->json('jwt'));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_protected_hello_list()
    {
        $response = $this->get('/api/protected_hello_list', [
            'Authorization' => 'Bearer '.$this->accessToken->json('jwt')
        ]);

//        $this->ddResponse($response);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'first',
            'second',
            'third',
        ]);
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
