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
        $user = User::find(1);

        $response = $this->actingAs($user)->postJson('/api/role/store', [
            'name' => 'Admin',
            'description' => 'Group for admin'
        ]);

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
    public function testCreateFailRole()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->postJson('/api/role/store', [
            'name' => '',
            'description' => 'Group for admin'
        ]);

        $response->assertStatus(422);
    }

    /**
     * Update Role.
     *
     * @return void
     */
    public function testUpdateRole()
    {
        $user = User::find(1);

        $role = factory(Role::class)->create();

        $response = $this->actingAs($user)->putJson("/api/role/{$role->id}/update", [
            'name' => 'Financial',
            'description' => 'Group for Financial',
            'status' => false
        ]);

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
    public function testUpdateFailRole()
    {
        $user = User::find(1);

        $role = factory(Role::class)->create();

        $response = $this->actingAs($user)->putJson("/api/role/{$role->id}/update", [
            'name' => '',
            'description' => 'Group for Financial'
        ]);

        $response->assertStatus(422);
    }

    /**
     * Destroy Role.
     *
     * @return void
     */
    public function testDestroyRole()
    {
        $user = User::find(1);

        $role = factory(Role::class)->create();

        $response = $this->actingAs($user)->deleteJson("/api/role/{$role->id}/destroy", []);

        $response->assertStatus(200);
    }

}
