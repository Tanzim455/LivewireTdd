<?php

namespace App\Livewire;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomePageJobList extends Component
{
    public function render()
    {
        $jobs = DB::table('jobs AS j1')
        ->select('j1.company_id', 'j1.description', 'j1.title','j1.id')
        ->where('j1.expiration_date', '>', Carbon::now()->format('Y-m-d'))
        ->whereRaw('(
            SELECT COUNT(*) 
            FROM jobs AS j2 
            WHERE j2.company_id = j1.company_id 
            AND j2.expiration_date > NOW()
            AND j2.id <= j1.id
        ) <= 3')
        ->get();
        return view('livewire.home-page-job-list',compact('jobs'));
    }
}
