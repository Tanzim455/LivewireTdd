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
        ->assertViewHas('companyWithJobs')
        
        ->assertViewIs('livewire.home-page-job-list');;
          
    }
    public function test_only_three_active_jobs_from_a_single_company_can_be_seen_in_homepage()
    {
        $company=Company::factory()->create();
        $company2=Company::factory()->create();
        $category=Category::factory()->create();
        Job::factory(4,[
           'category_id'=>$category['id'],
           'company_id'=>$company['id'],
           
        ])->create();
        Job::factory(4,[
            'category_id'=>$category['id'],
            'company_id'=>$company2['id'],
            
         ])->create();
        $response=$this->get(route('home'));
         
         
         $companyWithJobs = Company::with(['jobs' => function($query) {
            $query->where('expiration_date', '>=', Carbon::now());
        }])->get();
        foreach($companyWithJobs as $company){
        if($company->jobs->count()){
            $allIdOfJobs=$company->jobs->take(3)->pluck('id')->toArray();
            $allJobs=Job::whereIn('id',$allIdOfJobs)->get();
            foreach($allJobs as $alljob){
                $response->assertSee($alljob->title);
                $response->assertSee($alljob->description);
            }
        }
        }
         
         
        
        
      
    }
}
