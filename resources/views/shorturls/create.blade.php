<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generate new url') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="p-6">
                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <form method="POST" class="ms-3 mr-6 mb-2 mt-3" action="{{ route('shorturls.store') }}">
                            @csrf
                                <div class="flex flex-col">
                                    <x-input-label for="long_url" :value="__('Long url')" />
                                    <x-text-input id="long_url" class="block mt-1 w-full" type="text" name="long_url" :value="old('long_url')" autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('long_url')" class="mt-2" />
                                </div>
                                <x-primary-button type="submit" class="ms-3 mt-3">
                                    {{ __('Create') }}
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
