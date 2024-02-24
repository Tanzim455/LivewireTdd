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
            ->call('save');
          
        $response->assertHasErrors('title', 'description', 'min_experience',
        'max_experience','max_salary','min_salary','apply_url','expiration_date'
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

    public function test_min_max_years_of_experience_must_be_a_number(){
        $job=Job::factory()->make()->toArray();
         $job['min_experience']='Four';
         $job['max_experience']='Five';
        
        Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
        
        
        $this->assertEquals(0,Job::count());
       
        
    }
    public function test_min_max_salary_must_be_a_number(){
        $job=Job::factory()->make()->toArray();
         $job['min_salary']='Fourty thousand';
         $job['max_salary']='Fivety Thousand';
        
        Livewire::test(CreateJob::class)
        ->set($job)
        ->call('save');
        
        
        $this->assertEquals(0,Job::count());
       
        
    }
}
