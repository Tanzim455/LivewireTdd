<div>
    @foreach ($jobs as $job)
        {{$job->title}}
        {{$job->description}}
    @endforeach
</div>
