<?php

namespace App\Livewire;

use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;

class HomePageJobList extends Component
{
    public function render()
    {
        $companyWithJobs = Company::with(['jobs' => function($query) {
            $query->where('expiration_date', '>=', Carbon::now()->format('Y-m-d'));
        }])->get();
        return view('livewire.home-page-job-list',compact('companyWithJobs'));
    }
}
