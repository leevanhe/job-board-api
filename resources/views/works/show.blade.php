<x-layout>
    <x-breadcrumbs :links="[
    'Jobs' => route('works.index'),
    $work->title => '#'
    ]" class="mb-4"/>
    <x-job-card :$work>
        <p class="text-sm text-slate-500 mb-4">{!! nl2br(e($work->description)) !!}</p>

        @can('apply', $work)
            <x-link-button :href="route('work.application.create', $work)">Apply</x-link-button>
        @else
            <div class="text-center text-sm font-medium text-slate-800">
                You already applied to this job
            </div>
        @endcan
    </x-job-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">More {{ $work->employer->company_name }} jobs</h2>

        <div class="text-sm text-slate-500">
            @foreach($work->employer->works as $otherWork)
                <div class="flex mb-4 justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('works.show', $otherWork) }}">{{ $otherWork->title }}</a>
                        </div>
                        <div class="text-xs">
                            {{ $otherWork->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="text-xs">
                        € {{ number_format($otherWork->salary) }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
