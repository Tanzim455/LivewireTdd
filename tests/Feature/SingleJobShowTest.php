<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Company;
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
    public function job_creation_by_company(?int $times=1){
        $category=Category::factory()->create();
        $company=Company::factory()->create();
        
         Job::factory(
            $times,
            [
                'category_id'=>$category->id,
                'company_id'=>$company->id
            ]
            
         )->create();
         
    }
    public function test_user_can_see_details_on_single_job_page(): void
    {
       $this->withoutExceptionHandling();
        $this->job_creation_by_company();
        $job=Job::select('id','title','description')->first();
        $response=$this->get(route('job.show',['job'=>$job->id]));
       
        $response->assertOk()
        ->assertViewIs('job.show')
        ->assertSee($job->title);

        
    }

}
