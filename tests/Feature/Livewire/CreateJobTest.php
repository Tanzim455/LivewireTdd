<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateJob;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
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
        
         $this->withoutExceptionHandling();
         $company=Company::factory()->create();
         
         $category=Category::factory()->create();
         $job=Job::factory([
            'category_id'=>$category['id'],
            'company_id'=>$company['id']
         ])->make()->toArray();
         
          
        
        Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
           
          $this->assertEquals(1,Job::count());
         $this->assertDatabaseHas('jobs',$job);
    }
    public function test_a_job_can_be_posted_by_company_alongside_tags(){
        $this->withoutExceptionHandling();
        $company=Company::factory()->create();
        Tag::factory(5)->create();
        //  dump($tags);
         $tagsIds=Tag::pluck('id')->sort();
         
         $category=Category::factory()->create();
         $job=Job::factory([
            'category_id'=>$category['id'],
            'company_id'=>$company['id']
         ])->make()->toArray();
          
        
         Livewire::test(CreateJob::class)
         ->set($job)
         ->set('tags',[$tagsIds[0],$tagsIds[1],$tagsIds[2]])
         ->call('save');
       
        $latestJob=Job::latest()->first();
       
       
         $this->assertDatabaseHas('job_tag',[
              'job_id'=>$latestJob->id,
               'tag_id'=>$tagsIds[0]
         ]);
         $this->assertDatabaseHas('job_tag',[
            'job_id'=>$latestJob->id,
             'tag_id'=>$tagsIds[1]
       ]);
       $this->assertDatabaseHas('job_tag',[
        'job_id'=>$latestJob->id,
         'tag_id'=>$tagsIds[2]
   ]);
         

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
