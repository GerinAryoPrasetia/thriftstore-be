<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The name field is required. (and 3 more errors)",
                "errors" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                    "phone" => ["The phone field is required."],
                ]
            ]);
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "Didit",
            "email" => "didit@gmail.com",
            "password" => "1234567890",
            "phone" => "082217902434"
        ];
        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "code",
                "message",
                "data" => [
                    'name',
                    'email',
                    'phone',
                    'role',
                    'created_at',
                    'updated_at',
                    'id'
                ],
                "token",
            ]);
    }

    public function testSuccessfulLogin()
    {
        $userData = [
            "email" => "geringeringerin@mail.com",
            "password" => "whoami00"
        ];
        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "code",
                "message",
                "data" => [
                    'id',
                    'name',
                    'phone',
                    'email',
                    'email_verified_at',
                    'role',
                    'created_at',
                    'updated_at',
                ],
                "token",
            ]);
    }
}
