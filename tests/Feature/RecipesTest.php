<?php

namespace Tests\Feature;

use App\Recipe;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_view_a_recipe()
    {
        $recipe = factory(Recipe::class)->create([
            'title' => 'My Fancy Recipe'
        ]);

        $response = $this->get('recipes/' . $recipe->id);
        $response->assertStatus(200);
        $response->assertSee('My Fancy Recipe');
    }

    /** @test */
    public function users_can_view_a_recipe()
    {
        $user = factory(\App\User::class)->create();
        $recipe = factory(\App\Recipe::class)->create([
            'title' => 'My Fancy Recipe'
        ]);

        Passport::actingAs($user);

        $response = $this->get('recipes/' . $recipe->id);
        $response->assertStatus(200);
        $response->assertSee('My Fancy Recipe');
    }

    /** @test */
    public function a_user_is_associated_with_a_recipe_they_add()
    {
        $user = factory(\App\User::class)->create();
        Passport::actingAs($user);

        $response = $this->json('POST', '/api/recipes', [
            'title' => 'Install Kitetail',
            'body' => 'My awesome kitetail setup'
        ]);

        $response->assertStatus(201);

        $recipe = Recipe::firstOrFail();
        $this->assertEquals('Install Kitetail', $recipe->title);
        $this->assertEquals('My awesome kitetail setup', $recipe->body);
        $this->assertTrue($recipe->owner->is($user));
    }

    /** @test */
    public function a_guest_cannot_create_a_recipe()
    {
        $response = $this->json('POST', '/api/recipes', [
            'title' => 'Install Kitetail',
            'body' => 'My awesome kitetail setup'
        ]);

        $response->assertStatus(401);
        $this->assertNull(Recipe::first());
    }

    /** @test */
    public function a_recipe_must_have_a_title()
    {
        // $this->withoutExceptionHandling();
        $user = factory(\App\User::class)->create();
        Passport::actingAs($user);

        $response = $this->json('POST', '/api/recipes', [
            'title' => '',
            'body' => 'My awesome kitetail setup'
        ]);

        $response->assertStatus(422);
        $this->assertNull(Recipe::first());
    }

    /** @test */
    public function a_recipe_must_have_a_body()
    {
        $user = factory(\App\User::class)->create();
        Passport::actingAs($user);

        $response = $this->json('POST', '/api/recipes', [
            'title' => 'Kitetail Recipe',
            'body' => ''
        ]);

        $response->assertStatus(422);
        $this->assertNull(Recipe::first());
    }
}
