@use('App\Enums\UserRole')
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
    @if (Auth::user()->can('invite-user'))
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <div class="flex justify-between px-6 py-4 border-b bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Team Members
                        </h2>
                        <a href="{{ route('invite-user.create') }}" class="px-3 py-2 text-xs rounded-full bg-blue-100 text-blue-600 float-right">
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
                                    @forelse ($users as $user)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $user->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ UserRole::tryFrom($user->roles->first()?->name)?->getDisplayName() ?? '' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->short_urls_count }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                                No users found
                                            </td>
                                        </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">  </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
