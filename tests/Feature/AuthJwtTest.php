<?php

namespace Tests\Feature;

use Modules\HumanResources\Entities\User;
use Tests\TestCase;

class AuthJwtTest extends TestCase
{

    /**
     * Testa autenticação.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(User::class)->create();

        $response = $this->post('api/auth/login', ['email' => $user->email, 'password' => 'password']);

        $response->assertStatus(200);
    }

    /**
     * Testa se apos a autenticação, retorna o usuário corretamente.
     *
     * @return void
     */
    public function testGetMe()
    {
        $user = factory(User::class)->create();

        $authorization = $this->post('/api/auth/login', ['email' => $user->email, 'password' => 'password']);
        $response = $this->postJson('/api/auth/me', [], ['Authorization' => 'Bearer ' . $authorization['access_token']]);

        $response->assertStatus(200)->assertJson([
            "id" => $user->id ,
            "name" => $user->name ,
            "email" => $user->email ,
            "email_verified_at" => $user->email_verified_at ,
            "created_at" => $user->created_at ,
            "updated_at" => $user->updated_at
        ]);
    }

    /**
     * Testa logout.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = factory(User::class)->create();
        $authorization = $this->post('api/auth/login', ['email' => $user->email, 'password' => 'password']);
        $response = $this->json('POST', 'api/auth/logout', [], ['Authorization' => 'Bearer ' . $authorization['access_token']]);

        $response->assertStatus(200);
    }

    /**
     * Testa se apos o logout o token fica invalido.
     *
     * @return void
     */
    public function testAfterLogoutTokenIsInvalid()
    {
        $user = factory(User::class)->create();
        $authorization = $this->post('api/auth/login', ['email' => $user->email, 'password' => 'password']);
        $this->json('POST', 'api/auth/logout', [], ['Authorization' => 'Bearer ' . $authorization['access_token']]);
        $response = $this->json('POST', 'api/auth/logout', [], ['Authorization' => 'Bearer ' . $authorization['access_token']]);
        $response->assertStatus(401)->assertJson(['status' => 'Token is Invalid']);
    }

    /**
     * Testa se falha autenticação.
     *
     * @return void
     */
    public function testLoginFail()
    {
        $response = $this->post('api/auth/login', ['email' => 'qualquer@teste.com', 'password' => 'password']);

        $response->assertStatus(401);
    }
}
