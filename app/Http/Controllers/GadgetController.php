<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class GadgetController extends Controller
{
    public function index(Request $request): View
    {
        $query = Gadget::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
        }

        $gadgets = $query->latest()->paginate(10)->withQueryString();

        return view('gadgets.index', compact('gadgets', 'search'));
    }

    public function create(): View
    {
        return view('gadgets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('gadgets', 'public');
        }

        unset($data['image']);
        Gadget::create($data);

        return redirect()->route('gadgets.index')->with('success', 'Gadget added successfully.');
    }

    public function show(Gadget $gadget): View
    {
        return view('gadgets.show', compact('gadget'));
    }

    public function edit(Gadget $gadget): View
    {
        return view('gadgets.edit', compact('gadget'));
    }

    public function update(Request $request, Gadget $gadget): RedirectResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($gadget->image_path) {
                Storage::disk('public')->delete($gadget->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gadgets', 'public');
        }

        unset($data['image']);
        $gadget->update($data);

        return redirect()->route('gadgets.index')->with('success', 'Gadget updated successfully.');
    }

    public function destroy(Gadget $gadget): RedirectResponse
    {
        if ($gadget->image_path) {
            Storage::disk('public')->delete($gadget->image_path);
        }
        $gadget->delete();

        return redirect()->route('gadgets.index')->with('success', 'Gadget deleted.');
    }
}
