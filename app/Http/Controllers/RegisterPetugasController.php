<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('dashboard.staff.index', [
            'title' => 'staff',
            'active' => 'staff',
            'staffs' => User::where('role', 'admin')->orWhere('role', 'petugas')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.staff.register', [
            'title' => 'add',
            'active' => 'staff'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'phone_number' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255',
            'role' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/dashboard/staff')->with('success', 'Registration success');
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
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff){
        return view('dashboard.staff.staff_edit', [
            'title' => 'edit',
            'active' => 'edit',
            'staff' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255'],
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:255',
            'role' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::where('id', $staff->id)->update($validatedData);
        return redirect('/dashboard/staff')->with('success', 'A staff has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $staff){
        User::destroy($staff->id);
        // tangkap slug yang dikirim, lalu cari idnya dan hapus
        return redirect('/dashboard/staff')->with('success', 'A staff has been deleted');
    }
}
