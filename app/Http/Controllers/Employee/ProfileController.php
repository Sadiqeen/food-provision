<?php

namespace App\Http\Controllers\Employee;

use App\Customer;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return RedirectResponse | View
     */
    public function edit()
    {
        $profile = User::find( auth()->user()->id );

        if (!$profile) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('dashboard');
        }

        return view('employee.profile', [
            'employee' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $user = User::find( auth()->user()->id );

        if (!$user) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.employee.index');
        }

        $validate = [
            "name" => 'required|min:2|max:255|unique:users,name,' . auth()->user()->id,
            "email" => 'required|max:255|unique:users,email,' . auth()->user()->id,
        ];

        if ($request->password) {
            $validate['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($validate);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        alert()->success(__('Success'), __('Profile data edited'));
        return redirect()->route('dashboard');
    }
}
