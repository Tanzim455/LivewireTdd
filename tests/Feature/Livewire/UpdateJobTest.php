<?php

namespace Tests\Feature\Livewire;

use App\Livewire\UpdateJob;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateJobTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    public function test_company_can_update_a_post()
{
    $this->withoutExceptionHandling();
    $job=Job::factory()->create();
    $job->update([
       'title'=>'Updated title'
    ]);
    
    Livewire::test(UpdateJob::class)
      ->call('update',$job->id)
      ->set('title', 'Updated Title again');
}
}
