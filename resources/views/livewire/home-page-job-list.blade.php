<div>
    
    @foreach ($jobs as $job)
        <div>{{$job->title}}</div>
        <div>{{$job->description}}</div>
    @endforeach
    
</div>
