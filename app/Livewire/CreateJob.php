<?php

namespace App\Livewire;

use App\Http\Requests\JobPostRequest;
use App\Models\Job;
use Livewire\Component;
use Livewire\Attributes\Validate;
class CreateJob extends Component
{
    
     public  $title='';
    
     public  $description='';
    
     public  $min_experience='';
    
     public  $max_experience='';
    
     public  $min_salary='';
   
     public  $max_salary='';
    
     public  $apply_url='';
    
      public $expiration_date='';

      public $job_location='';

      public $job_location_type='';

      public $category_id='';
      
     public $company_id='';
     public $tags=[];
 
    public function save(){
         $validated=$this->validate();
        
        $job=Job::create($validated);

        if (!empty($this->tags)) {
            $job->tags()->attach($this->tags);
        }
    }
    protected function rules(): array
    {
        return (new JobPostRequest())->rules();
    }
    public function render()
    {
        return view('livewire.create-job');
    }

    
}
