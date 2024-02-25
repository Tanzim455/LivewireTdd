<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingleJobShowTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_user_can_see_details_on_single_job_page(): void
    {
       $this->withoutExceptionHandling();
        $category=Category::factory()->create();
        $job=Job::factory([
            'category_id'=>$category->id
        ])->create();
       
        $response=$this->get(route('job.show',['job'=>$job->id]));
       
        $response->assertOk()
        ->assertViewIs('job.show')
        ->assertSee($job->title);

        
    }

}
