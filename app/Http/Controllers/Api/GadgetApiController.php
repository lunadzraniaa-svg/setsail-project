<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gadget;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GadgetApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Gadget::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
        }

        $gadgets = $query->latest()->paginate(10)->withQueryString();

        return response()->json([
            'data'  => $gadgets->items(),
            'meta'  => [
                'current_page' => $gadgets->currentPage(),
                'last_page'    => $gadgets->lastPage(),
                'per_page'     => $gadgets->perPage(),
                'total'        => $gadgets->total(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
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
        $gadget = Gadget::create($data);

        return response()->json(['data' => $gadget, 'message' => 'Gadget created.'], 201);
    }

    public function show(Gadget $gadget): JsonResponse
    {
        return response()->json(['data' => $gadget]);
    }

    public function update(Request $request, Gadget $gadget): JsonResponse
    {
        $data = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'brand'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
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

        return response()->json(['data' => $gadget->fresh(), 'message' => 'Gadget updated.']);
    }

    public function destroy(Gadget $gadget): JsonResponse
    {
        if ($gadget->image_path) {
            Storage::disk('public')->delete($gadget->image_path);
        }
        $gadget->delete();

        return response()->json(['message' => 'Gadget deleted.'], 200);
    }
}
