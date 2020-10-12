<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show edit form
     *
     * @return View
     */
    public function edit()
    {
        $setting = Setting::first();
        $user = User::find( auth()->user()->id );
        return view('admin.setting.edit', [
            'setting' => $setting,
            'user' => $user
        ]);
    }

    /**
     * Update company data
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update_setting(Request $request)
    {
        $rules = [
            'company' => 'required|min:2|max:255',
            'com_email' => 'required|min:2|max:255',
            'com_tel' => 'required|min:10|max:15|regex:/\(?([0-9]{2,3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'com_address' => 'required|min:2|max:255',
        ];

        if ($request->image) {
            $rules["image"] = 'image|max:500000';
        }

        if ($request->authorised) {
            $rules["authorised"] = 'image|max:500000';
        }

        $request->validate($rules);

        $setting = Setting::first();
        $setting->company = $request->company;
        $setting->email = $request->com_email;
        $setting->tel = $request->com_tel;
        $setting->address = $request->com_address;

        if ($request->image) {
            $url = Storage::disk('public')->put(null, $request->image);
            $setting->image = 'uploads/' . $url;
        }

        if ($request->authorised) {
            $url = Storage::disk('public')->put(null, $request->authorised);
            $setting->authorised_signature = 'uploads/' . $url;
        }

        $setting->save();

        alert()->success(__('Success'), __('Update company profile success'));
        return redirect()->route('dashboard');

    }

    /**
     * Update admin data
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update_profile(Request $request)
    {
        $rules = [
            "name" => 'required|min:2|max:255|unique:users,name,' . auth()->user()->id,
            "email" => 'required|max:255|unique:users,email,' . auth()->user()->id,
        ];

        if ($request->password) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        $user = User::find( auth()->user()->id );
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        alert()->success(__('Success'), __('Update admin profile success'));
        return redirect()->route('dashboard');
    }
}
