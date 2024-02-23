<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Category;
use App\Models\Category as ModelsCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    public function test_category_component_exists()
    {
        Livewire::test(Category::class)
            ->assertStatus(200);
    }
    public function test_category_component_exists_for_specific_route(){
        // $this->withoutExceptionHandling();
        $this->get(route('category'))
            ->assertSeeLivewire(Category::class);
    }
    
    public function test_admin_can_create_a_category(){
         $this->withoutExceptionHandling();
        $category=ModelsCategory::factory()->make()->toArray();
            
       
        Livewire::test(Category::class)
        ->set($category)
        ->call('save');
           
         $this->assertEquals(1,ModelsCategory::count());
        $this->assertDatabaseHas('categories',$category);
    }
    public function test_admin_can_delete_a_category(){
        $this->withoutExceptionHandling();
        $category=ModelsCategory::factory()->create();
            ;
        $categoryToArray=$category->toArray();
        
        Livewire::test(Category::class)
       ->call('delete',$category->id);

       $this->assertEquals(0,ModelsCategory::count());
         $this->assertDatabaseMissing('categories',$categoryToArray);
    }
    public function test_all_jobs_can_be_seen_by_companies_from_their_dashboard(){
        
        $category1=ModelsCategory::factory()->create();
        $category2=ModelsCategory::factory()->create();
        Livewire::test(Category::class)
        ->assertSee([
            'name'=>$category1->name,
            
        ])
        ->assertSee([
            'name'=>$category2->name
        ])
        ->assertViewHas('categories')
        
        ;
    }

  
        public function test_company_can_update_a_category()
        {
            $this->withoutExceptionHandling();
            $category=ModelsCategory::factory()->create();
            
            
            $response = Livewire::test(Category::class)
                ->set('category', $category) // Set the job property
                ->set('name', 'Updated Category') // Set the title property
                ->call('update',$category->id); // Now you can call the update method
             
            $response->assertOk();
            
              $this->assertNotEquals($category->name,'Updated Title');
              $this->assertNotEquals($category->fresh()->name,'Updated Title');

           
        }
    }


