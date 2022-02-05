@extends('dashboard')

@section('content')



    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("List of reports") }}
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("List of reports registered in the system.") }}
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="{{ route('report.index') }}" >
                    <x-search/>
                </form>
            </div>

        </div>

        <x-table.list>
            <x-slot name="thead">
                <tr>
                    <x-table.th>{{ __("Title") }}</x-table.th>
                    <x-table.th>{{ __("Author") }}</x-table.th>
                    <x-table.th>{{ __("Created at") }}</x-table.th>
                    <x-table.th>{{ __("State") }}</x-table.th>
                    <x-table.th>{{ __("Actions") }}</x-table.th>
                </tr>
            </x-slot>

            <x-slot name="tbody">

                @foreach($reports as $report)
                    <tr>
                        <x-table.td>
                            {{ $report->title }}
                        </x-table.td>

                        <x-table.td>
                            {{ $report->user->getFullName() }}
                        </x-table.td>

                        <x-table.td>
                            {{ $report->created_at }}
                        </x-table.td>

                        <x-table.td>
                            <x-badge :color="$report->state ? 'green' : 'red'">
                                {{ $report->state ? 'active' : 'inactive'}}
                            </x-badge>
                        </x-table.td>

                        <x-table.td class="space-x-3 whitespace-nowrap">
                            <x-link color="gray" class="inline-flex"
                                    href="{{ route('report.show', ['report' => $report->id]) }}">
                                <x-icons.show/>
                            </x-link>
                            <x-link color="indigo" class="inline-flex"
                                    href="{{ route('report.edit', ['report' => $report->id]) }}">
                                <x-icons.edit/>
                            </x-link>
                            <x-link color="{{ $report->state ? 'red' : 'green'}}" class="inline-flex"
                                    href="{{ route('report.destroy', ['report' => $report->id]) }}">
                                @if($report->state)
                                    <x-icons.delete/>
                                @else
                                    <x-icons.check/>
                                @endif
                            </x-link>
                        </x-table.td>
                    </tr>
                @endforeach

            </x-slot>
            <x-slot name="pagination">
                {{ $reports->links() }}
            </x-slot>
        </x-table.list>
    </div>
    @endsection
