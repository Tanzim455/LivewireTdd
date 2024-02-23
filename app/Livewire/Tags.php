<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class Tags extends Component
{
    
   public $name;
    public function save(){
        $this->validate([
             'name'=>'required|min:3'
        ]);
        
        Tag::create([
          'name'=>$this->name
        ]);
    }
    public function delete($id){
        $tag=Tag::find($id);
        
            $tag->delete();
         }
         public function update($id){
            $tag=Tag::find($id);
            $tag->update([
              'name'=>$this->name
            ]);
        }
        public function render()
    {
        $tags=Tag::select('name')->paginate(10);
        return view('livewire.tags',compact('tags'));
       
    }
        
    
}
