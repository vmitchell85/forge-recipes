<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function show(Recipe $recipe)
    {
        return view('recipes.show')->with('recipe', $recipe->load('owner'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        return Recipe::create([
            'title' => request()->title,
            'body' => request()->body,
            'user_id' => Auth::user()->id
        ]);
    }
}
