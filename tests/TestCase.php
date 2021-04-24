<?php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected static $setUpHasRunOnce = false;

    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        if(!static::$setUpHasRunOnce) {

            $this->artisan('config:cache --env=testing');
            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            static::$setUpHasRunOnce = true;
        }

    }

    /**
     * @inheritDoc
     */
    public function actingAs(UserContract $user, $driver = null)
    {
        parent::actingAs($user, $driver);

        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        $this->withHeaders(['Authorization' => 'Bearer ' . $token]);

        return $this;
    }
}
