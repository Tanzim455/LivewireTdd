<?php

namespace Tests\Feature\Livewire;

use App\Livewire\UpdateJob;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateJobTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    public function test_company_can_update_a_job()
{
     $this->withoutExceptionHandling();
    $job=Job::factory()->create();
    
    
    $response = Livewire::test(UpdateJob::class)
        ->set('job', $job) // Set the job property
        ->set('title', 'Updated Title') // Set the title property
        ->call('update'); // Now you can call the update method
     
    $response->assertOk();
    //The title with which job was created
     $this->assertNotEquals($job->title,'Updated Title');
     //The title which was updated
     $this->assertEquals($job->fresh()->title,'Updated Title');

     $this->assertDatabaseHas('jobs',[
           'title'=>$job->fresh()->title
     ]);
     $this->assertDatabaseMissing('jobs',[
        'title'=>$job->title,
        
  ]);
}
}
