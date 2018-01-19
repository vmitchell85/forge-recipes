<?php

namespace App\Http\Controllers;

use App\Recipe;

class RecipeController extends Controller
{
    public function show(Recipe $recipe)
    {
        return $recipe;
    }
}
