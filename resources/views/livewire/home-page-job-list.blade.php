<div>
    
    <div>
        @foreach ($companyWithJobs as $company)
            @if ($company->jobs->count())
                @php
                    $allIdOfJobs = $company->jobs->take(3)->pluck('id')->toArray();
                    $allJobs = Job::whereIn('id', $allIdOfJobs)->get();
                @endphp
    
                @foreach ($allJobs as $alljob)
                    <h1>{{ $alljob->title }}</h1>
                    <p>{{ $alljob->description }}</p>
                @endforeach
            @endif
        @endforeach
    </div>
    
</div>
