<?php

namespace App\Livewire;

use App\Http\Requests\JobPostRequest;
use App\Models\Job;
use Livewire\Component;
use Livewire\Attributes\Validate;
class CreateJob extends Component
{
    // #[Validate('required|min:10')]
     public  $title='';
    //  #[Validate('required|min:100')]
     public  $description='';
    //  #[Validate('required|int')]
     public  $min_experience='';
    //  #[Validate('required|int')]
     public  $max_experience='';
    //  #[Validate('required|int')]
     public  $min_salary='';
    //  #[Validate('required|int')]
     public  $max_salary='';
    //  #[Validate('required|url')]
     public  $apply_url='';
    //  #[Validate('required')]
      public $expiration_date='';
      
   
 
    public function save(){
         $validated=$this->validate();
        // Job::create([
        //   'title'=>$this->title,
        //   'description'=>$this->description,
        //   'min_experience'=>$this->min_experience,
        //   'max_experience'=>$this->max_experience,
        //   'min_salary'=>$this->min_salary,
        //   'max_salary'=>$this->max_salary,
        //   'apply_url'=>$this->apply_url,
        //   'expiration_date'=>$this->expiration_date
        

        // ]);
        Job::create($validated);
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
