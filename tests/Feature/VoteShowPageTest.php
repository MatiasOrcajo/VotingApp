<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteShowPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_contains_idea_show_livewire_component()
    {
        $user = User::factory()->create();

        $categorOne = Category::factory()->create(['name' => 'Category 1']);
        $categorTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
           'user_id' => $user->id,
           'category_id' => $categorOne->id,
           'status_id' => $statusOpen->id,
           'title' => 'My first Idea',
           'description' => 'Description'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-show');
    }

    /** @test */
    public function index_page_correctly_receives_votes_count()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categorOne = Category::factory()->create(['name' => 'Category 1']);
        $categorTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categorOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'Description'
        ]);

        Vote::factory()->create([
           'idea_id' => $idea->id,
           'user_id' => $user->id
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $userB->id
        ]);

        $this->get(route('idea.index'))
            ->assertViewHas('ideas', function ($ideas){
                return $ideas->first()->votes_count == 2;
            });
    }

    /** @test */
    public function votes_count_shows_correctly_on_show_page_livewire_component()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categorOne = Category::factory()->create(['name' => 'Category 1']);
        $categorTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categorOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'Description'
        ]);

        Livewire::test(IdeaShow::class, [
           'idea' => $idea,
           'votesCount' => 5
        ])
            ->assertSet('votesCount', 5)
            ->assertSeeHtml('<div class="text-xl leading-snug">5</div>');
    }
}
