<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My job applications' => '#']"/>

    @forelse($applications as $application)
        <x-job-card :work="$application->work">
            <div class="flex justify-between items-center text-xs text-slate-500">
                <div>
                    <div>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div>
                        Other {{ Str::plural('applicant', $application->work->work_applications_count - 1) }} {{ $application->work->work_applications_count - 1 }}
                    </div>
                    <div>
                        Your asking salary is € {{ number_format($application->expected_salary) }}
                    </div>
                    <div>
                        Average asking salary {{ number_format($application->work->work_applications_avg_expected_salary) }}
                    </div>
                </div>
                <div>
                    <form action="{{ route('my-work-applications.destroy', $application) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <x-button>Cancel</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No job application yet
            </div>
            <div class="text-center">
                Go find some jobs <a href="{{ route('works.index') }}" class="text-indigo-500 hover:underline">Here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
