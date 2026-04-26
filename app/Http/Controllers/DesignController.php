<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DesignController extends Controller
{
    /**
     * Max dimensions for card images displayed on the website.
     * Width: 600px is more than enough for a 3:4 card.
     * Quality: 85% keeps file small while looking sharp.
     */
    private const MAX_WIDTH  = 600;
    private const MAX_HEIGHT = 800;
    private const QUALITY    = 85;

    public function index()
    {
        $designs = Design::latest()->get();
        return view('admin.designs.index', compact('designs'));
    }

    public function create()
    {
        return view('admin.designs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'notes'    => 'nullable|string',
            'link'     => 'nullable|url|max:500',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ], [
            'title.required' => 'عنوان التصميم مطلوب',
            'image.image'    => 'الملف المرفوع يجب أن يكون صورة',
            'image.mimes'    => 'يُسمح فقط بصور JPG, PNG, WEBP',
            'image.max'      => 'حجم الصورة لا يتجاوز 10MB',
            'link.url'       => 'اللينك يجب أن يبدأ بـ http أو https',
        ]);

        $data = $request->only(['title', 'subtitle', 'notes', 'link']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $this->processAndStoreImage($request->file('image'));
        }

        Design::create($data);

        return redirect()->route('admin.designs.index')
            ->with('success', 'تم إضافة التصميم بنجاح ');
    }

    public function show(Design $design)
    {
        return redirect()->route('admin.designs.index');
    }

    public function edit(Design $design)
    {
        return view('admin.designs.edit', compact('design'));
    }

    public function update(Request $request, Design $design)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'notes'    => 'nullable|string',
            'link'     => 'nullable|url|max:500',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ], [
            'title.required' => 'عنوان التصميم مطلوب',
            'image.image'    => 'الملف المرفوع يجب أن يكون صورة',
            'image.mimes'    => 'يُسمح فقط بصور JPG, PNG, WEBP',
            'image.max'      => 'حجم الصورة لا يتجاوز 10MB',
            'link.url'       => 'اللينك يجب أن يبدأ بـ http أو https',
        ]);

        $data = $request->only(['title', 'subtitle', 'notes', 'link']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image to free space
            if ($design->image && Storage::disk('public')->exists($design->image)) {
                Storage::disk('public')->delete($design->image);
            }
            $data['image'] = $this->processAndStoreImage($request->file('image'));
        }

        $design->update($data);

        return redirect()->route('admin.designs.index')
            ->with('success', 'تم تحديث التصميم بنجاح ');
    }

    public function destroy(Design $design)
    {
        if ($design->image && Storage::disk('public')->exists($design->image)) {
            Storage::disk('public')->delete($design->image);
        }
        $design->delete();
        return redirect()->route('admin.designs.index')
            ->with('success', 'تم حذف التصميم بنجاح');
    }

    /**
     * Resize image to fit within MAX_WIDTH x MAX_HEIGHT while preserving aspect ratio,
     * then save as WebP for best quality/size ratio.
     * Returns the stored relative path.
     */
    private function processAndStoreImage(\Illuminate\Http\UploadedFile $file): string
    {
        $manager = new ImageManager(new Driver());
        $image   = $manager->read($file->getRealPath());

        // Only scale down, never scale up
        $origW = $image->width();
        $origH = $image->height();

        if ($origW > self::MAX_WIDTH || $origH > self::MAX_HEIGHT) {
            $image->scaleDown(self::MAX_WIDTH, self::MAX_HEIGHT);
        }

        // Save as WebP for smaller file size
        $filename  = 'designs/' . uniqid('design_', true) . '.webp';
        $fullPath  = Storage::disk('public')->path($filename);

        // Ensure directory exists
        $dir = dirname($fullPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $image->toWebp(self::QUALITY)->save($fullPath);

        return $filename;
    }
}
