<x-app-layout>
    <div class="flex justify-center w-3/4 mx-auto my-4">
        <form action="{{ route('admin.store') }}" method="post" class="flex flex-col gap-3">
            @csrf
            <h2 class="text-3xl text-center">Add Package</h2>
            <label for="name">Package Name</label>
            <input type="text" name="name">
            <label for="price">Price</label>
            <input type="number" name="price">
            <label for="description">Description</label>
            <textarea name="description" id="" cols="70" rows="5"></textarea>
            <button class="bg-blue-400 w-20 mx-auto">Add</button>
        </form>
    </div>
</x-app-layout>