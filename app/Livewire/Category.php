<?php

namespace App\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{
    public $name;

    public function save(){
        $this->validate([
             'name'=>'required|min:3'
        ]);
        
        ModelsCategory::create([
          'name'=>$this->name
        ]);
    }
    public function update($id){
        $category=ModelsCategory::find($id);
        $category->update([
          'name'=>$this->name
        ]);
    }
    public function delete($id){
        $category=ModelsCategory::find($id);
        $category->delete();
     }
    public function render()
    {
        $categories=ModelsCategory::select('name')->paginate(10);
        return view('livewire.category',compact('categories'));
    }

}
