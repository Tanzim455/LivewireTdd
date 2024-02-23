<?php

namespace Tests\Feature\Livewire;

use App\Livewire\JobList;
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

        $job=Job::factory()->create();
        $job2=Job::factory()->create();
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

        $job=Job::factory()->create();
        $jobToArray=$job->toArray();
        
        Livewire::test(JobList::class)
       ->call('delete',$job->id);

       $this->assertEquals(0,Job::count());
         $this->assertDatabaseMissing('jobs',$jobToArray);
    }


}
