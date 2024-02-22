<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class JobList extends Component
{
    public function render()
    {
        $jobs=Job::select('title','description','min_experience','max_experience','min_salary','max_salary','apply_url',
        'expiration_date')->get();
        return view('livewire.job-list',compact('jobs'));
    }
}
