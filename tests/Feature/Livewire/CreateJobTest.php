<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateJob;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateJobTest extends TestCase
{
    use RefreshDatabase;
    public function category_company_job_creation(){
        $category=Category::factory()->create();
        $company=Company::factory()->create();
        
         Job::factory(
            [
                'category_id'=>$category->id,
                'company_id'=>$company->id
            ]
            
         )->create();
         
    }
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

    public function test_company_can_post_a_job(){
        
         $job=Job::factory()->make()->toArray();
         $company=Company::factory()->create();
         
         $category=Category::factory()->create();
         
         $job['category_id']=$category['id'];
         $job['company_id']=$company['id'];
        //  dd($job);
        
        Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
           
          $this->assertEquals(1,Job::count());
         $this->assertDatabaseHas('jobs',$job);
    }
    public function test_category_belongs_to_a_job(){
       
        $this->category_company_job_creation();
       
       
       $latestJob=Job::latest()->first();
        
           $this->assertInstanceOf(Category::class,$latestJob->category);
        
   }
   public function test_company_belongs_to_a_job(){
    
    $this->category_company_job_creation();
       
       
    $latestJob=Job::latest()->first();
    
 
   
    $this->assertInstanceOf(Company::class,$latestJob->company);   
}
}
