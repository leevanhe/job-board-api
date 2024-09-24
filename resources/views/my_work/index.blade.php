<x-layout>
    <x-breadcrumbs :links="['My Jobs' => '#']" class="mb-4" />

    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-works.create') }}">Add new</x-link-button>
    </div>

    @forelse($works as $work)
    <x-job-card :$work>
        <div class="text-xs text-slate-500">
            @forelse($work->workApplications as $application)
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <div>{{ $application->user->name }}</div>
                        <div>Applied {{ $application->created_at->diffForHumans() }}</div>
                        <div>Download cv</div>
                    </div>

                    <div>€ {{ number_format($application->expected_salary) }}</div>
                </div>
            @empty
                <div>No application</div>
            @endforelse

            <div class="flex space-x-2">
                <x-link-button href="{{ route('my-works.edit', $work) }}">Edit</x-link-button>

                <form action="{{ route('my-works.destroy', $work) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <x-button>Delete</x-button>
                </form>
            </div>
        </div>
    </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No jobs yet!
            </div>
            <div class="text-center">
                Post your first job <a href="{{ route('my-works.create') }}" class="text-indigo-500 hover:underline">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
