@extends('layouts.app')

@section('title', 'Edit Gadget')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-bold mb-5">Edit Gadget</h1>

    <form method="POST" action="{{ route('gadgets.update', $gadget) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $gadget->name) }}"
                   class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('name') border-red-400 @enderror">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Brand <span class="text-red-500">*</span></label>
            <input type="text" name="brand" value="{{ old('brand', $gadget->brand) }}"
                   class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('brand') border-red-400 @enderror">
            @error('brand') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Price (USD) <span class="text-red-500">*</span></label>
            <input type="number" name="price" value="{{ old('price', $gadget->price) }}" step="0.01" min="0"
                   class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('price') border-red-400 @enderror">
            @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('description', $gadget->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Image</label>
            @if($gadget->image_path)
                <div class="mb-2 flex items-center gap-3">
                    <img src="{{ $gadget->image_url }}" class="w-20 h-20 object-cover rounded border" alt="Current image">
                    <span class="text-xs text-gray-400">Current image. Upload a new one to replace.</span>
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                   class="text-sm text-gray-600 file:mr-3 file:py-1.5 file:px-4 file:border file:rounded file:text-sm file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="bg-indigo-600 text-white px-5 py-2 rounded text-sm hover:bg-indigo-700 transition">Update Gadget</button>
            <a href="{{ route('gadgets.index') }}" class="text-sm text-gray-500 self-center hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
