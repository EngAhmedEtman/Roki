<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_logo'        => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'whatsapp_number'  => 'required|string|max:20',
            'whatsapp_message' => 'required|string|max:255',
            'contact_page_url' => 'nullable|url|max:255',
            'contact_email'    => 'nullable|email|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_facebook'  => 'nullable|url|max:255',
            'social_tiktok'    => 'nullable|url|max:255',
            'social_x'         => 'nullable|url|max:255',
        ], [
            'site_logo.image'           => 'اللوجو يجب أن يكون صورة',
            'whatsapp_number.required'  => 'رقم الواتساب مطلوب',
            'whatsapp_message.required' => 'نص الرسالة مطلوب',
            'contact_page_url.url'      => 'الرابط غير صالح',
            'contact_email.email'       => 'البريد الإلكتروني غير صالح',
            'social_instagram.url'      => 'رابط انستجرام غير صالح',
            'social_facebook.url'       => 'رابط فيسبوك غير صالح',
            'social_tiktok.url'         => 'رابط تيك توك غير صالح',
            'social_x.url'              => 'رابط منصة X غير صالح',
        ]);

        $data = $request->except('_token', '_method', 'site_logo');

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $path]);
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings')->with('success', 'تم حفظ الإعدادات بنجاح ');
    }
}
