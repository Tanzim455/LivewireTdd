<?php

namespace Tests\Feature;

use App\Livewire\CreateJob;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class JobCreateValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
     use RefreshDatabase;
    public function test_all_required_fields_for_posting_a_job(){
        // $this->withoutExceptionHandling();
    
        
       $response=Livewire::test(CreateJob::class)
        ->set('title','')
        ->set('description','')
        ->set('min_experience','')
        ->set('max_experience','')
        ->set('min_salary','')
        ->set('max_salary','')
        ->set('apply_url','')
        ->set('expiration_date','')
        ->set('category_id','')
        ->set('company_id','')
            ->call('save');
          
        $response->assertHasErrors('title', 'description', 'min_experience',
        'max_experience','max_salary','min_salary','apply_url','expiration_date',
        'category_id','company_id'
    );

    
    
        
    }

    

    public function test_apply_url_must_be_a_relevant_link(){
        
        $job=Job::factory()->make()->toArray();

         $job['apply_url']='Website Link';
         

        $response=Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');

        $response->assertHasErrors('apply_url');

        
    }
    public function test_expiration_date_cannot_be_less_than_present_date(){
        
        $job=Job::factory()->make()->toArray();
            
          $job['expiration_date']=Carbon::now()->subDay(1)->format('Y-m-d');
        //  dd($job);

        $response=Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');

        // $response->assertOk('expiration_date');
        // $response->assertHasNoErrors('expiration_date');
        $response->assertHasErrors('expiration_date');

        
    }

    public function test_min_max_experience_must_be_a_number(){
        $job=Job::factory()->make()->toArray();
         $job['min_experience']='Fourty thousand';
         $job['max_experience']='Fifty Thousand';
        
        $response=Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
        
        
        
        $response->assertHasErrors('min_experience','max_experience');
       
        
    }
    public function test_min_max_salary_must_be_a_number(){
        $job=Job::factory()->make()->toArray();
         $job['min_salary']='Fourty thousand';
         $job['max_salary']='Fifty Thousand';
        
        $response=Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
        
        
        
       $response->assertHasErrors('min_salary','max_salary');
        
    }

    public function test_job_location_type_must_remote_onsite_or_hybrid()
    {
        $job=Job::factory()->make()->toArray();
        
        // $job['job_location_type']='office';
         $job['job_location_type']='Office';

          
       
       $response=Livewire::test(CreateJob::class)
       ->set($job)
       ->call('save');
       
        $response->assertHasErrors('job_location_type');
      
    //   $response->assertHasErrors('min_salary');
    }
   
}
