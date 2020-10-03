<?php

namespace App\Http\Controllers\Customer;

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
        $profile = user::with('customer')->find( auth()->user()->id );

        if (!$profile) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('dashboard');
        }

        return view('customer.profile.edit', [
            'profile' => $profile
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
            return redirect()->route('customer.profile.edit');
        }

        $validate = [
            "name" => 'required|max:255|unique:customers,name,' . auth()->user()->customer_id,
            "coordinator" => 'required|max:255|unique:users,name,' . auth()->user()->id,
            "tel" => 'required|min:10|max:15|regex:/\(?([0-9]{2,3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/|unique:customers,tel,' . auth()->user()->customer_id,
            "email" => 'required|email|unique:users,email,' . auth()->user()->id,
            "address" => 'required|max:255',
        ];

        if ($request->password) {
            $validate['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($validate);

        $user->name = $request->coordinator;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $customer = Customer::where('id', auth()->user()->customer_id)->first();
        $customer->name = $request->name;
        $customer->tel = $request->tel;
        $customer->save();

        alert()->success(__('Success'), __('Profile data edited'));
        return redirect()->route('dashboard');
    }
}
