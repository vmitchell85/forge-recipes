<?php

namespace Tests\Feature;

use App\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewRecipesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_a_recipe()
    {
        $this->disableExceptionHandling();
        // Arrange

        $recipe = Recipe::create([
            'title' => 'My Fancy Recipe',
            'body' => 'The fancy script stuff'
        ]);

        // Act

        // Assert

        $response = $this->get('recipes/' . $recipe->id);
        $response->assertStatus(200);
        $response->assertSee('My Fancy Recipe');
    }
}
