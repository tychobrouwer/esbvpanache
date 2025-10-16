<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\ImageAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ImageController extends Controller
{
    /**
     * Add the image information.
     */
    public function create(ImageAddRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $path = $request->file('image')->store('content-images', 'public');
        $filename = $request->file('image')->getClientOriginalName();

        Image::create([
            'tag' => $validated['tag'],
            'path' => $path,
            'filename' => $filename,
        ]);

        return redirect()->back()->with('status', 'image-created');
    }

    /**
     * Delete the image.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'image_id' => 'required|exists:images,id',
        ]);

        $image = Image::find($request->image_id);
        $image->delete();

        Storage::disk('public')->delete($image->path);

        return redirect()->back()->with('success', 'image-destroyed');
    }
}
