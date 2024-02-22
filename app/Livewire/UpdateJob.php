<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class UpdateJob extends Component
{
    public $title;
    public $postId;
    
     public function update($id){
         $job=Job::findorFail($id);
         $job->update([
            'title'=>$this->title,
             
         ]);
         
     }
    public function render()
    {
        
        return view('livewire.update-job');
    }
}
