<div>
    Job edit-{{$job->id}}
    <form wire:submit.prevent="update()">
        {{-- <input type="hidden" value="{{$job->id}}"> --}}
        <input type="text" wire:model="title" value="{{$job->title}}">
        <button>Update</button>
    </form>
</div>
