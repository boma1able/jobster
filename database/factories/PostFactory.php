<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $title = fake()->sentence(),
            'slug' => function () use ($title) {
                $slug = Str::slug($title);
                $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
                return $count ? "{$slug}-" . ($count + 1) : $slug;
            },
            'content'   => fake()->paragraph()
         ];
    }
}
