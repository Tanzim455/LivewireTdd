<?php

namespace Tests\Feature\Livewire;

use App\Livewire\JobList;
use App\Models\Category;
use App\Models\Company;
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
    public function test_job_list_component_exists_for_specific_route(){
        // $this->withoutExceptionHandling();
        $this->get(route('jobs.index'))
            ->assertSeeLivewire(JobList::class);
          
    }

    public function test_render_function_returns_a_view(){
        Livewire::test(JobList::class)
        ->assertViewHas('jobs')
        ->assertViewIs('livewire.job-list');
    }
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
    public function test_all_jobs_can_be_seen_by_companies_from_their_dashboard(){
        $this->withoutExceptionHandling();
        // 
      $this->job_creation_by_company(times:2);
         
          $job1=Job::select('id','title','description')->first();
        //find last id
       
        $job2=Job::select('id','title','description')->orderBy('id','desc')->first();
        Livewire::test(JobList::class)
        ->assertSee([
            'title'=>$job1->title,
             'description'=>$job1->description
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
       
        $this->job_creation_by_company();
        $job=Job::select('id','title','description')->first();
    Livewire::test(JobList::class)
        ->call('delete', $job->id);
        
        $deletedJob = Job::withTrashed()->find($job->id);
        $this->assertNotNull($deletedJob->deleted_at);
        $this->assertSoftDeleted('jobs', ['id' => $job->id]);
        
        
    }
    


}
