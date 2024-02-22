<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateJob;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateJobTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_job_component_exists()
    {
        Livewire::test(CreateJob::class)
            ->assertStatus(200);
    }

    public function test_create_job_component_exists_for_specific_route(){
        // $this->withoutExceptionHandling();
        $this->get(route('jobs.create'))
            ->assertSeeLivewire(CreateJob::class);
    }

    public function test_user_can_post_a_job(){
        // $this->withoutExceptionHandling();
        $job=Job::factory()->make()->toArray();
        
       
        Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
           
         $this->assertEquals(1,Job::count());
        $this->assertDatabaseHas('jobs',$job);
    }
}
