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

        return back()->with('status', 'image-created');
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

        return back()->with('success', 'image-destroyed');
    }

    /**
     * Process a section to add an image if the tag is found.
     */
    public static function processAddImage(string $section): string
    {
        $image = preg_match('/\[image:([^\s\]]+)(?:\s+([^]]*))?\]/', $section, $matches);
        if (!$image) {
            return '<p>' . nl2br(e(trim($section)), false) . '</p>';
        }

        $tag = $matches[1];
        $attrString = $matches[2] ?? '';

        $image = Image::where('tag', $tag)->first();
        if (!$image) {
            return '[Image not found: ' . htmlspecialchars($tag) . ']';
        }

        $attrs = [];
        if ($attrString) {
            preg_match_all('/(\w+)=([\w-]+)/', $attrString, $m);
            $attrs = array_combine($m[1], $m[2]);
        }

        $align = $attrs['align'] ?? 'none';
        $size  = $attrs['size'] ?? 'medium';

        $classes = ['max-w-full', 'h-auto', 'object-contain', 'w-100'];
        $sizeClasses = [
            'icon'   => 'sm:h-40 sm:w-auto',
            'small'  => 'sm:h-48 sm:w-auto',
            'medium' => 'sm:h-64 sm:w-auto',
            'large'  => 'sm:h-80 sm:w-auto',
            'full'   => 'w-full h-auto',
        ];
        $classes[] = $sizeClasses[$size] ?? '';

        $imgTag = sprintf(
            '<img src="%s" alt="%s" class="%s" />',
            e(Storage::url($image->path)),
            e($image->tag),
            implode(' ', $classes)
        );

        $alignDivClasses = [
            'left'   => 'flex flex-col sm:flex-row items-start gap-4 justify-start my-4',
            'right'  => 'flex flex-col-reverse sm:flex-row-reverse items-start gap-4 justify-end my-4',
            'center' => 'flex flex-col items-center justify-center text-center my-4 sm:my-6',
            'none'   => 'flex flex-col items-start my-4',
        ];

        $textContent = trim(preg_replace('/\[image:[^\]]+\]/', '', $section));
        $output = sprintf(
            '<div class="%s">%s%s</div>',
            $alignDivClasses[$align] ?? $alignDivClasses['none'],
            $imgTag,
            $textContent ? '<p>' . nl2br(e($textContent), false) . '</p>' : ''
        );

        return $output;
    }

    public static function processTextStyling(string $text): string
    {
        $text = preg_replace('/\*\*([^\*]+)\*\*/', '<span class="font-semibold">$1</span>', $text);
        $text = preg_replace('/\*([^\*]+)\*/', '<span class="italic">$1</span>', $text);
        return $text;
    }
    
    /**
     * Process content to add images based on tags.
     */
    public static function addImageToContent(string $content): string
    {
        $sections = preg_split('/---/', $content);
        $processedSections = [];

        foreach ($sections as $section) {
            $processedSections[] = self::processTextStyling(self::processAddImage($section));

        }

        return implode('', $processedSections);
    }
}
