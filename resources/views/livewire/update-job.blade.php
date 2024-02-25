<div>
    
    
    <form wire:submit.prevent="update()">
       
        <input type="text" wire:model="title" >
        <button>Update</button>
        {{$job?->job_location}}
    </form>
</div>
