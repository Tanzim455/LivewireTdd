<div>
    @foreach ($jobs as $job)
    {{$job->id}}
        {{$job->title}}
        {{$job->description}}
    @endforeach
</div>
