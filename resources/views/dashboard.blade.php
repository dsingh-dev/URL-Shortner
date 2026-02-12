<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <div class="flex justify-between px-6 py-4 border-b bg-gray-50">
                        <div class="flex">
                            <h2 class="text-lg font-semibold text-gray-800">
                                Generated Short URLs
                            </h2> 
                            <a href="{{ route('shorturls.create') }}" class="ms-2 px-3 py-2 text-xs rounded-full bg-blue-100 text-blue-600">
                                Generate
                            </a>
                        </div>
                        <a href="#" class="px-3 py-2 text-xs rounded-full bg-blue-100 text-blue-600 float-right">
                            Download
                        </a> 
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
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <div class="flex justify-between px-6 py-4 border-b bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Team Members
                        </h2>
                        <a href="#" class="px-3 py-2 text-xs rounded-full bg-blue-100 text-blue-600 float-right">
                            Invite Admin/Member
                        </a> 
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">

                            <!-- Head -->
                            <thead class="bg-gray-100 text-xs uppercase text-gray-500 text-center">
                                <tr>
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3">Email</th>
                                    <th class="px-6 py-3">Role</th>
                                    <th class="px-6 py-3">Total Generated urls</th>
                                </tr>
                            </thead>

                            <!-- Body -->
                            <tbody class="divide-y text-center">

                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
