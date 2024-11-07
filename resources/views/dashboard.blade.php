<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex gap-4 my-4">
        @foreach ($packages as $package)
            <div class="bg-white text-center p-4 rounded-lg shadow-lg w-1/4">
                <h2 class="text-2xl font-bold">{{ $package->name }}</h2>
                <p class="text-gray-600">{{ $package->description }}</p>
                <p class="text-gray-600">Price: ${{ $package->price }}</p>
                <div class="flex gap-2 justify-center">
                    <a href="{{ route('stripe', $package->id) }}">
                        <button class="bg-blue-300 px-4 py-1 mt-2">Buy</button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
