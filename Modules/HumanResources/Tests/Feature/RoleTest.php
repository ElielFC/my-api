<?php

namespace Modules\HumanResources\Tests\Feature;

use Modules\HumanResources\Entities\Role;
use Modules\HumanResources\Entities\User;
use Tests\TestCase;

class RoleTest extends TestCase
{

    /**
     * Create Role.
     *
     * @return void
     */
    public function testCreateRole()
    {
        $this->_authorization = ['Authorization' => 'Bearer ' .
            $this->post('api/auth/login', [
                'email' => factory(User::class)->create()->email,
                'password' => 'password'
            ])['access_token']
        ];

        $response = $this->postJson('/api/role/store', [
            'name' => 'Admin',
            'description' => 'Group for admin'
        ], $this->_authorization);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Admin',
            ]);
    }

    /**
     * Create Fail Role.
     *
     * @return void
     */
    public function testCreateFailUser()
    {
        $this->_authorization = ['Authorization' => 'Bearer ' .
            $this->post('api/auth/login', [
                'email' => factory(User::class)->create()->email,
                'password' => 'password'
            ])['access_token']
        ];

        $response = $this->postJson('/api/role/store', [
            'name' => '',
            'description' => 'Group for admin'
        ], $this->_authorization);

        $response->assertStatus(422);
    }

    /**
     * Update Role.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $this->_authorization = ['Authorization' => 'Bearer ' .
            $this->post('api/auth/login', [
                'email' => factory(User::class)->create()->email,
                'password' => 'password'
            ])['access_token']
        ];

        $role = factory(Role::class)->create();

        $response = $this->putJson("/api/role/{$role->id}/update", [
            'name' => 'Financial',
            'description' => 'Group for Financial',
            'status' => false
        ], $this->_authorization);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $role->id,
                'name' => 'Financial',
                'description' => 'Group for Financial',
                'status' => 0
            ]);
    }

    /**
     * Update Fail Role.
     *
     * @return void
     */
    public function testUpdateFailUser()
    {
        $this->_authorization = ['Authorization' => 'Bearer ' .
            $this->post('api/auth/login', [
                'email' => factory(User::class)->create()->email,
                'password' => 'password'
            ])['access_token']
        ];

        $role = factory(Role::class)->create();

        $response = $this->putJson("/api/role/{$role->id}/update", [
            'name' => '',
            'description' => 'Group for Financial'
        ], $this->_authorization);

        $response->assertStatus(422);
    }

    /**
     * Destroy Role.
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

        $role = factory(Role::class)->create();
        $response = $this->deleteJson("/api/role/{$role->id}/destroy", [], $this->_authorization);

        $response->assertStatus(200);
    }

    /**
     * Destroy Fail Role.
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

        $response = $this->deleteJson("/api/role/1000/destroy", [], $this->_authorization);

        $response->assertStatus(404);
    }
}
