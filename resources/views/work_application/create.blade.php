<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('works.index'),$work->title => route('works.show', $work),'Apply' => '#']" class="mb-4"/>

    <x-job-card :$work></x-job-card>

    <x-card>
        <h2 class="mb-4 text-lg font-medium">Your job application</h2>

        <form action="{{ route('work.application.store', $work) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label for="expected_salary" :required="true">Expected salary</x-label>
                <x-text-input type="number" name="expected_salary"/>
            </div>

            <div class="mb-4">
                <x-label for="cv" :required="true">Upload CV</x-label>
                <x-text-input type="file" name="cv"/>
            </div>

            <x-button class="w-full">Apply</x-button>
        </form>
    </x-card>
</x-layout>
