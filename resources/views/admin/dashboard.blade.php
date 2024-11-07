<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.create') }}">
            <button class="m-3 p-3 bg-blue-300">Create Package</button>
        </a>
    </div>

    <div class="flex gap-4 my-4">
        @foreach ($packages as $package)
            <div class="bg-white text-center p-4 rounded-lg shadow-lg w-1/4">
                <h2 class="text-2xl font-bold">{{ $package->name }}</h2>
                <p class="text-gray-600">{{ $package->description }}</p>
                <p class="text-gray-600">Price: ${{ $package->price }}</p>
                <div class="flex gap-2 justify-center">
                    <a href="{{ route('admin.edit', $package->id) }}">
                        <button class="bg-blue-300 p-2 mt-2">Edit</button>
                    </a>
                    <form action="{{ route('admin.destroy', $package->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-300 p-2 mt-2">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
