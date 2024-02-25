<?php

namespace Tests\Feature\Livewire;

use App\Livewire\JobList;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class JobListTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    public function renders_successfully()
    {
        Livewire::test(JobList::class)
       
            ->assertStatus(200);
    }
    public function test_create_job_component_exists_for_specific_route(){
        // $this->withoutExceptionHandling();
        $this->get(route('jobs.index'))
            ->assertSeeLivewire(JobList::class);
          
    }

    public function test_render_function_returns_a_view(){
        Livewire::test(JobList::class)
        ->assertViewHas('jobs')
        ->assertViewIs('livewire.job-list');
    }

    public function test_all_jobs_can_be_seen_by_companies_from_their_dashboard(){
        $this->withoutExceptionHandling();
        $category=Category::factory()->create();
        $category=Category::factory()->create();
        $job = Job::factory()->create(['category_id' => $category->id]);
        $job2 = Job::factory()->create(['category_id' => $category->id]);

        Livewire::test(JobList::class)
        ->assertSee([
            'title'=>$job->title,
             'description'=>$job->description
        ])
        ->assertSee([
            'title'=>$job2->title,
             'description'=>$job2->description
        ])
        ->assertViewHas('jobs')
        
        ;
    }
    public function test_jobs_can_be_deleted(){
        $this->withoutExceptionHandling();
        $category=Category::factory()->create();
        $job = Job::factory()->create(['category_id' => $category->id]);
        
    Livewire::test(JobList::class)
        ->call('delete', $job->id);
        
        $deletedJob = Job::withTrashed()->find($job->id);
        $this->assertNotNull($deletedJob->deleted_at);
        $this->assertSoftDeleted('jobs', ['id' => $job->id]);
        //Check at what time softdelete was done
        
    }
    


}
