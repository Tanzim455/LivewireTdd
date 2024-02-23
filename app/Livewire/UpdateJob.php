<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class UpdateJob extends Component
{
    public $title;
     public ?Job $job;
    public $name;
 
    public function mount()
    {
        $this->job;
    }
   
       
        
        public function update(){
            $this->job->update([
                'title' => $this->title,
            ]);
            
            
        }
        
         
     
    public function render()
    {
        
        return view('livewire.update-job');
    }
}
