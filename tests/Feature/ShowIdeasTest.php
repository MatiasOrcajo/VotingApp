<?php

namespace Tests\Feature;

use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_ideas_shows_on_main_page()
    {

        $ideaOne = Idea::factory()->create([
            'title' => "My First Title",
            'description' => "Description of my first title"
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => "My Second Title",
            'description' => "Description of my second title"
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaOne->description);
        $response->assertSee($ideaTwo->title);
        $response->assertSee($ideaTwo->description);
    }

    /** @test */
    public function single_idea_shows_correctly_on_the_show_page()
    {
        $idea = Idea::factory()->create([
            'title' => "My First Title",
            'description' => "Description of my first title"
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($idea->description);
    }

    /** @test */
    public function ideas_with_same_title_has_different_slugs()
    {
        $ideaOne = Idea::factory()->create([
            'title' => "My First Title",
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => "My First Title",
        ]);

        $this->assertTrue($ideaOne->slug !== $ideaTwo->slug);
    }


}
