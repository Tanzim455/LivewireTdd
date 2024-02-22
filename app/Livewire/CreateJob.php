<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class CreateJob extends Component
{
     public string $title='';
     public string $description='';
    public function save(){
        Job::create([
          'title'=>$this->title,
           'description'=>$this->description
        ]);
    }
    public function render()
    {
        return view('livewire.create-job');
    }

    
}
