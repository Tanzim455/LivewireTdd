<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class JobList extends Component
{
    public function render()
    {
        $jobs=Job::select('id','title','description','min_experience','max_experience','min_salary','max_salary','apply_url',
        'expiration_date')->paginate(10);
    return view('livewire.job-list',compact('jobs'));
    }
    
    public function delete($id){
       $job=Job::find($id);
       $job->delete();
    }

}
