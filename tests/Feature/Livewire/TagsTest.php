<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Tags;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TagsTest extends TestCase
{
    use RefreshDatabase;
    public function test_tags_component_is_rendered()
    {
        Livewire::test(Tags::class)
            ->assertStatus(200);
    }
    public function test_tags_component_is_rendered_for_a_specific_route()
    {
        $this->get(route('tags'))
            ->assertSeeLivewire(Tags::class);
    }
    public function test_tags_component_returns_a_view()
    {
        Livewire::test(Tags::class)
        
        ->assertViewIs('livewire.tags');
    }
    public function test_name_field_is_required_for_posting_a_job(){
        $response=Livewire::test(Tags::class)
        ->call('savetags')
        ->set('name','');

        $response->assertHasErrors('name');
    }
    public function test_admin_can_create_a_tag(){
        // $this->withoutExceptionHandling();
       $tag=Tag::factory()->make()->toArray();
           
      
       Livewire::test(Tags::class)
       ->set($tag)
       ->call('savetags');
          
        $this->assertEquals(1,Tag::count());
       $this->assertDatabaseHas('tags',$tag);
   }
   public function test_admin_can_delete_a_tag(){
    //    $this->withoutExceptionHandling();
       $tag=Tag::factory()->create();
        
       
       Livewire::test(Tags::class)
      ->call('delete',$tag->id)
      
      ;

      $this->assertEquals(0,Tag::count());
        
   }
   public function test_all_tags_can_be_seen_by_admins_from_their_dashboard(){
        
    $tag1=Tag::factory()->create();
    $tag2=Tag::factory()->create();
    Livewire::test(Tags::class)
    ->assertSee([
        'name'=>$tag1->name,
        
    ])
    ->assertSee([
        'name'=>$tag2->name
    ])
    ->assertViewHas('tags')
    
    ;
}
public function test_admins_can_update_a_tag()
        {
            $this->withoutExceptionHandling();
            $tag=Tag::factory()->create();
            
            
            $response = Livewire::test(Tags::class)
                ->set('tag', $tag) // Set the job property
                ->set('name', 'Updated tag') // Set the title property
                ->call('update',$tag->id); // Now you can call the update method
             
            $response->assertOk();
             
              $this->assertNotEquals($tag->name,'Updated tag');
              $this->assertEquals($tag->fresh()->name,'Updated tag');

              $this->assertDatabaseHas('tags',[
                'name'=>$tag->fresh()->name
          ]);
          $this->assertDatabaseMissing('categories',[
             'name'=>$tag->name,
             
       ]);
        }
}
