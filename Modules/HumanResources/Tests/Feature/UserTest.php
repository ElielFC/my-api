<?php

namespace Modules\HumanResources\Tests\Feature;

use Modules\HumanResources\Entities\User;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * Create User.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('api/auth/login', ['email' => $user->email, 'password' => 'password']);
        $this->_authorization = ['Authorization' => 'Bearer ' . $response['access_token']];

        $response = $this->postJson('/api/user/store', [
            'name' => 'Teste1',
            'email' => 'teste@teste.com',
            'password' => 'Ead00464698',
            'password_confirmation' => 'Ead00464698',
        ], $this->_authorization);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Teste1',
                'email' => 'teste@teste.com'
            ]);
    }

    /**
     * Create Fail User.
     *
     * @return void
     */
    public function testCreateFailUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('api/auth/login', ['email' => $user->email, 'password' => 'password']);
        $this->_authorization = ['Authorization' => 'Bearer ' . $response['access_token']];

        $response = $this->postJson('/api/user/store', [
            'name' => '',
            'email' => 'teste@teste.com',
            'password' => 'Ead00464698',
            'password_confirmation' => '',
        ], $this->_authorization);

        $response->assertStatus(422);
    }

    /**
     * Update User.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('api/auth/login', ['email' => $user->email, 'password' => 'password']);
        $this->_authorization = ['Authorization' => 'Bearer ' . $response['access_token']];

        $response = $this->putJson("/api/user/{$user->id}/update", [
            'name' => 'Teste2',
            'email' => 'teste2@teste.com'
        ], $this->_authorization);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Teste2',
                'email' => 'teste2@teste.com'
            ]);
    }

    /**
     * Update Fail User.
     *
     * @return void
     */
    public function testUpdateFailUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('api/auth/login', ['email' => $user->email, 'password' => 'password']);
        $this->_authorization = ['Authorization' => 'Bearer ' . $response['access_token']];

        $response = $this->putJson("/api/user/{$user->id}/update", [
            'name' => 'Teste2',
            'email' => 'teste2@teste.com',
            'password' => ''
        ], $this->_authorization);

        $response->assertStatus(422);
    }

    /**
     * Destroy User.
     *
     * @return void
     */
    public function testDestroyUser()
    {
        $this->_authorization = ['Authorization' => 'Bearer ' .
            $this->post('api/auth/login', [
                'email' => factory(User::class)->create()->email,
                'password' => 'password'
            ])['access_token']
        ];

        $user = factory(User::class)->create();
        $response = $this->deleteJson("/api/user/{$user->id}/destroy", [], $this->_authorization);

        $response->assertStatus(200);
    }

    /**
     * Destroy Fail User.
     *
     * @return void
     */
    public function testDestroyFailUser()
    {
        $this->_authorization = ['Authorization' => 'Bearer ' .
            $this->post('api/auth/login', [
                'email' => factory(User::class)->create()->email,
                'password' => 'password'
            ])['access_token']
        ];

        $response = $this->deleteJson("/api/user/1000/destroy", [], $this->_authorization);

        $response->assertStatus(404);
    }
}
