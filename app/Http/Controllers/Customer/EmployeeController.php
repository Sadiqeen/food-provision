<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('customer.employee.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws
     */
    public function index_api()
    {
        $employee = User::where('customer_id', auth()->user()->customer_id)
            ->where('position', 'employee')->get();
        return datatables()->of($employee)
            ->addColumn('action', function ($employee) {
                $edit = '<a href="' . route('customer.employee.edit', $employee->id) . '" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                $delete = '<a href="javascript:void(0)" onclick="delEmployee(\'' . route('customer.employee.destroy', $employee->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $edit . $delete . '</div>';
            })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('customer.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|min:2|max:255|unique:users,name',
            "email" => 'required|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->position = 3;
        $user->password = Hash::make($request->password);
        $user->customer_id = auth()->user()->customer_id;
        $user->save();

        alert()->success(__('Success'), __('New employee added to the system'));
        return redirect()->route('customer.employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse | View
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.employee.index');
        }

        return view('customer.employee.edit', [
                'employee' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.employee.index');
        }

        $validate = [
            "name" => 'required|min:2|max:255|unique:users,name,' . $id,
            "email" => 'required|max:255|unique:users,email,' . $id,
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

        alert()->success(__('Success'), __('Employee data edited'));
        return redirect()->route('customer.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $employee = User::find($id);

        if (!$employee) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.employee.index');
        }

        $employee->delete();

        alert()->success(__('Success'), __('Employee deleted'));
        return redirect()->route('customer.employee.index');
    }
}
