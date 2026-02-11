<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invite New Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="p-6">
                        <div class="bg-white shadow-md rounded-2xl overflow-hidden">

                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <form method="POST" class="ms-3 mr-6 mb-2 mt-3" action="{{ route(SUPER . '.invite-company') }}">
                            @csrf
                                    <div class="flex flex-col">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="flex flex-col">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <x-primary-button onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="ms-3 mt-3">
                                        {{ __('Invite') }}
                                    </x-primary-button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
