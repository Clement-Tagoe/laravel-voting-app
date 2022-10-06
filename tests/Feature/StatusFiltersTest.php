<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeasIndex;
use App\Http\Livewire\StatusFilters;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_contains_status_filters_livewire_component() {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea'
        ]);

        $this->get(route('idea.index'))
            ->assertSeeLivewire('status-filters');
    }

    /** @test */
    public function show_page_contains_status_filters_livewire_component() {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('status-filters');
    }

    /** @test */
    public function shows_correct_status_count() {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        
        $statusImplemented = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea'
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('ALL IDEAS (2)')
            ->assertSee('IMPLEMENTED (2)');
    }

    /** @test */
    public function filtering_works_when_query_string_in_place() {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        
        $statusOpen = Status::factory()->create(['name' => 'Open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple-700 text-white']);
        $statusInProgress = Status::factory()->create(['name' => 'In Progress', 'classes' => 'bg-yellow-500 text-white']);
        $statusImplemented = Status::factory()->create(['name' => 'Implemented']);
        $statusClosed = Status::factory()->create(['name' => 'Closed']);


        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
        ]);

        //$response = $this->get(route('idea.index', ['status' => 'In Progress']));
        //$response->assertSuccessful();
        //$response->assertSee('<div class="text-xxs bg-yellow-500 text-white font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">In Progress</div>', false);
        //$response->assertDontSee('<div class="text-xxs bg-purple-700 text-white font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Considering</div>', false);

        Livewire::withQueryParams(['status' => 'In Progress'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 3
                    && $ideas->first()->status->name === 'In Progress';
            });
    }

    /** @test */
    public function show_page_does_not_show_selected_status() {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        
        $statusImplemented = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea'
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertDontSee('border-blue-600 text-gray-900');
    }

    /** @test */
    public function index_page_shows_selected_status() {
        $user = User::factory()->create();
        
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        
        $statusImplemented = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea'
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSee('border-blue-600 text-gray-900');
    }
}
