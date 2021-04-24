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
        $user = User::find(1);

        $response = $this->actingAs($user)->postJson('/api/user/store', [
            'name' => 'Teste1',
            'email' => 'teste@teste.com',
            'password' => 'Ead00464698',
            'password_confirmation' => 'Ead00464698',
        ]);

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
        $user = User::find(1);

        $response = $this->actingAs($user)->postJson('/api/user/store', [
            'name' => '',
            'email' => 'teste@teste.com',
            'password' => 'Ead00464698',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(422);
    }

    /**
     * Update User.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->putJson("/api/user/{$user->id}/update", [
            'name' => 'Teste2',
            'email' => 'teste2@teste.com'
        ]);

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
        $user = User::find(1);

        $response = $this->actingAs($user)->putJson("/api/user/{$user->id}/update", [
            'name' => 'Teste2',
            'email' => 'teste2@teste.com',
            'password' => ''
        ]);

        $response->assertStatus(422);
    }

    /**
     * Destroy User.
     *
     * @return void
     */
    public function testDestroyUser()
    {
        $user_authenticate = User::find(1);

        $user = factory(User::class)->create();

        $response = $this->actingAs($user_authenticate)->deleteJson("/api/user/{$user->id}/destroy", []);

        $response->assertStatus(200);
    }

    /**
     * Destroy Fail User.
     *
     * @return void
     */
    public function testDestroyFailUser()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->deleteJson("/api/user/1000/destroy", []);

        $response->assertStatus(200);
    }
}
