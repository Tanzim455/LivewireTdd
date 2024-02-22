<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;
use Livewire\Attributes\Validate;
class CreateJob extends Component
{
    #[Validate('required')]
     public  $title='';
     #[Validate('required')]
     public  $description='';
     #[Validate('required')]
     public  $min_experience='';
     #[Validate('required')]
     public  $max_experience='';
     #[Validate('required')]
     public  $min_salary='';
     #[Validate('required')]
     public  $max_salary='';
     #[Validate('required|url')]
     public  $apply_url='';
     #[Validate('required')]
      public $expiration_date='';
      
   
 
    public function save(){
         $this->validate();
        Job::create([
          'title'=>$this->title,
          'description'=>$this->description,
          'min_experience'=>$this->min_experience,
          'max_experience'=>$this->max_experience,
          'min_salary'=>$this->min_salary,
          'max_salary'=>$this->max_salary,
          'apply_url'=>$this->apply_url,
          'expiration_date'=>$this->expiration_date
        

        ]);
    }
    public function render()
    {
        return view('livewire.create-job');
    }

    
}
