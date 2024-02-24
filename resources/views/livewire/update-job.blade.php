<div>
    
     
    <form wire:submit.prevent="update()">
        {{-- <input type="hidden" value="{{$job->id}}"> --}}
        <input type="text" wire:model="title" >
        <button>Update</button>
    </form>
</div>
