<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class CreateJob extends Component
{
     public string $title='';
     public string $description='';
     public  $min_experience='';
     public  $max_experience='';
     public  $min_salary='';
     public  $max_salary='';
     public  $apply_url='';
      public $expiration_date='';
    public function save(){
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
