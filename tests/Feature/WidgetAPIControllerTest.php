<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WidgetAPIControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public $data;

    public function testAPI()
    {
        $this->list();
        $this->create();
        $this->read();
        $this->update();
        $this->destroy();
        $this->notFoundAfterDestroy();
    }

    public function list()
    {
        $response = $this->json('GET', '/api/widget');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
            ]);
    }

    public function create()
    {
        $fake = factory(\App\Widget::class)->make()->toArray();

        $response = $this->json('POST', '/api/widget', $fake);

        $this->data = $response->getData()->data;

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => $fake,
            ]);
    }

    public function read()
    {
        $response = $this->json('GET', "/api/widget/{$this->data->id}");

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $this->data->id,
                    'name' => $this->data->name,
                    'description' => $this->data->description,
                ],
            ]);
    }

    public function update()
    {
        $name = $this->faker->name();

        $response = $this->json('PUT', "/api/widget/{$this->data->id}", [
            'name' => $name,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $this->data->id,
                    'name' => $name,
                    'description' => $this->data->description,
                ],
            ]);
    }

    public function destroy()
    {
        $response = $this->json('DELETE', "/api/widget/{$this->data->id}");

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => []
            ]);
    }

    public function notFoundAfterDestroy()
    {
        $response = $this->json('GET', "/api/widget/{$this->data->id}");

        $response->assertStatus(404);
    }

}
