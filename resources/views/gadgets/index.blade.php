@extends('layouts.app')

@section('title', 'Gadget Catalog')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">All Gadgets</h1>
    <form method="GET" action="{{ route('gadgets.index') }}" class="flex gap-2">
        <input type="text" name="search" value="{{ $search ?? '' }}"
               placeholder="Search name or brand…"
               class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 w-60">
        <button class="bg-indigo-600 text-white px-4 py-1.5 rounded text-sm hover:bg-indigo-700 transition">Search</button>
        @if($search)
            <a href="{{ route('gadgets.index') }}" class="text-sm text-gray-500 self-center hover:underline">Clear</a>
        @endif
    </form>
</div>

@if($gadgets->isEmpty())
    <p class="text-gray-500">No gadgets found.</p>
@else
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-sm">
        <thead class="bg-indigo-50 text-indigo-700 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">Image</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Brand</th>
                <th class="px-4 py-3 text-left">Price</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($gadgets as $gadget)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3">
                    <img src="{{ $gadget->image_url }}" alt="{{ $gadget->name }}"
                         class="w-14 h-14 object-cover rounded border">
                </td>
                <td class="px-4 py-3 font-medium">{{ $gadget->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $gadget->brand }}</td>
                <td class="px-4 py-3">${{ number_format($gadget->price, 2) }}</td>
                <td class="px-4 py-3 flex gap-2 items-center">
                    <a href="{{ route('gadgets.edit', $gadget) }}"
                       class="text-indigo-600 hover:underline text-xs">Edit</a>
                    <form method="POST" action="{{ route('gadgets.destroy', $gadget) }}"
                          onsubmit="return confirm('Delete this gadget?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline text-xs">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-5">
    {{ $gadgets->links() }}
</div>
@endif
@endsection
