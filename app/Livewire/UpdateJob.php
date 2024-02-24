<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class UpdateJob extends Component
{
    public $title;
      public Job $job;
    
 
    public function mount(Job $job){
        $this->title=$job->title;
        
    }
       
        
        public function update(){
             $this->job->update([
                'title' => $this->title,
            ]);
            
            $this->reset('title');
        }
        
         
     
    public function render()
    {
        
        return view('livewire.update-job');
    }
}
