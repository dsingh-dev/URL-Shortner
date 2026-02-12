<x-superadmin.super-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(Auth::guard(SUPER)->user()?->name.' Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="p-6">
                        <div class="bg-white shadow-md rounded-2xl overflow-hidden">

                            <!-- Header -->
                            <div class="flex justify-between px-6 py-4 border-b bg-gray-50">
                                <h2 class="text-lg font-semibold text-gray-800">
                                    Clients
                                </h2>
                                <a href="{{ route('superadmin.invite-company') }}" class="px-3 py-2 text-xs rounded-full bg-blue-100 text-blue-600 float-right">
                                    Invite company
                                </a> 
                            </div>

                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-600">

                                    <!-- Head -->
                                    <thead class="bg-gray-100 text-xs uppercase text-gray-500 text-center">
                                        <tr>
                                            <th class="px-6 py-3">Name</th>
                                            <th class="px-6 py-3">users</th>
                                            <th class="px-6 py-3">Total Generated Urls</th>
                                        </tr>
                                    </thead>

                                    <!-- Body -->
                                    <tbody class="divide-y text-center">

                                        @forelse($companies as $company)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-4 font-medium text-gray-900">
                                                    {{ $company->name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $company->users_count }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="px-3 py-1 text-xs rounded-full">
                                                        {{ $company->short_urls_count }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    No clients found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-2"> {{$companies->links()}} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <div class="flex justify-between px-6 py-4 border-b bg-gray-50">
                        <div class="flex">
                            <h2 class="text-lg font-semibold text-gray-800">
                                Generated Short URLs
                            </h2> 
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">

                            <!-- Head -->
                            <thead class="bg-gray-100 text-xs uppercase text-gray-500 text-center">
                                <tr>
                                    <th class="px-6 py-3">Short Urls</th>
                                    <th class="px-6 py-3">Long Urls</th>
                                    <th class="px-6 py-3">Total hits</th>
                                    <th class="px-6 py-3">Company</th>
                                    <th class="px-6 py-3">Created At</th>
                                </tr>
                            </thead>

                            <!-- Body -->
                            <tbody class="divide-y text-center">

                                @forelse($shorturls as $url)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            <a href="{{ env('APP_URL') }}/pr/{{ $url->short_code }}" target="_blank">{{ env('APP_URL') }}/pr/{{ $url->short_code }}</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $url->long_url }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $url->total_hits }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $url->company->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $url->created_at }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            No urls found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2"> {{$shorturls->links()}} </div>
                </div>
            </div>
        </div>
    </div>
</x-superadmin.super-layout>
