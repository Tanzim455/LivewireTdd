<?php

namespace Tests\Feature;

use App\Livewire\CreateJob;
use App\Models\Job;
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
        $this->withoutExceptionHandling();
    
        
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
}
