<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateJob;
use App\Livewire\HomePageJobList;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageJobListTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    public function test_home_page_renders_successfully()
    {
        Livewire::test(HomePageJobList::class)
            ->assertStatus(200);
    }
    public function test_home_page_job_list_component_exists_for_specific_route(){
        // $this->withoutExceptionHandling();
        $this->get(route('home'))
            ->assertSeeLivewire(HomePageJobList::class);
          
    }
    public function test_home_page_returns_a_view(){
        // $this->withoutExceptionHandling();
        Livewire::test(HomePageJobList::class)
        ->assertViewHas('jobs')
        
        ->assertViewIs('livewire.home-page-job-list');;
          
    }
    public function test_only_three_active_jobs_from_a_single_company_can_be_seen_in_homepage()
    {
        $company = Company::factory()->create();
$company2 = Company::factory()->create();
$company3 = Company::factory()->create();
$category = Category::factory()->create();

// Create 4 jobs for company 1, with an expiration date in the future
$futureDate = Carbon::now()->addDays(30); // Adjust the number of days as needed
Job::factory(4, [
    'category_id' => $category->id,
    'company_id' => $company->id,
    'expiration_date' => $futureDate,
])->create();

// Create 4 jobs for company 2, with an expiration date in the future
Job::factory(4, [
    'category_id' => $category->id,
    'company_id' => $company2->id,
    'expiration_date' => $futureDate,
])->create();
Job::factory(4, [
    'category_id' => $category->id,
    'company_id' => $company3->id,
    'expiration_date' => $futureDate,
])->create();

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
    
    
$response=$this->get(route('home'));







foreach($jobs as $job){
    $response->assertSee($job->title);
    $response->assertSee($job->description);
}

}
}