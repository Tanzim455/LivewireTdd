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
        //  $this->withoutExceptionHandling();
         $job=Job::factory()->make()->toArray();
         $company=Company::factory()->create();
         
         $category=Category::factory()->create();
         $job['category_id']=$category['id'];
         $job['company_id']=$company['id'];
        
        
        Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
           
          $this->assertEquals(1,Job::count());
         $this->assertDatabaseHas('jobs',$job);
    }
    public function test_category_belongs_to_a_job_and_company_belongs_to_a_job(){
         
        $company=Company::factory()->create();
        $category=Category::factory()->create();
         $job=Job::factory()->make()->toArray();
        
        
        $job['category_id']=$category['id'];
        $job['company_id']=$company['id'];
       Livewire::test(CreateJob::class)
       ->set($job)
       ->call('save');
        $latestJob=Job::latest()->first();
        // dd($latestJob->company->name);
        
           $this->assertInstanceOf(Category::class,$latestJob->category);
        //   $this->assertInstanceOf(Company::class,$latestJob->company);
   }
   public function test_company_belongs_to_a_job(){
    
    $company=Company::factory()->create();
    $category=Category::factory()->create();
     $job=Job::factory()->make()->toArray();
   $job['category_id']=$category['id'];
   $job['company_id']=$company['id'];
   
  Livewire::test(CreateJob::class)
  ->set($job)
  ->call('save');
   $latestJob=Job::latest()->first();
    
 
   $this->assertEquals(1,Job::count());
    $this->assertInstanceOf(Company::class,$latestJob->company);   
}
}
