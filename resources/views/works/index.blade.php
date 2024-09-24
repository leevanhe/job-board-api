@php use App\Models\Work; @endphp

<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('works.index')]" class="mb-4"/>

    <x-card class="mb-4 text-sm" x-data="">
        <form x-ref="filters" action="{{ route('works.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4 ">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for any text" form-ref="filters"/>
                </div>

                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From" form-ref="filters"/>
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To" form-ref="filters"/>
                    </div>
                </div>

                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    <x-radio-group name="experience" :options="array_combine(array_map('ucfirst' ,Work::$experience), Work::$experience)"/>
                </div>

                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="catergory" :options="Work::$category"/>
                </div>
            </div>

            <x-button class="w-full">Filter</x-button>
        </form>
    </x-card>

    @foreach($works as $work)
        <x-job-card :$work>
            <div>
                <x-link-button :href="route('works.show', $work)">Show</x-link-button>
            </div>
        </x-job-card>
    @endforeach
</x-layout>
