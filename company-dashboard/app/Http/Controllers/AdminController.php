<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('/admin/dashboard');
    }

    public function users() {
        $users = User::all();
        return view('admin.staffs', compact('users'));
    }

    public function viewstaff($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        return view('admin.view-profile', compact('user'));
    }

    public function delete($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Staff deleted successfully!');
        //return redirect()->back()->with('success', 'Staff deleted successfully!');
    }

    public function addstaff() {
        return view('admin.add-staff');
    }

    public function store(Request $request) {
        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'role' => 'required|max:255',
            'position' => 'required|max:255',
            'office' => 'required|max:255',
            'age' => 'required|integer|min:18|max:65',
            'startdate' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'email' => 'required|email|unique:users',
        ]);

        $addstaff = new User();
        $addstaff->name = $request->input('fname') . ' ' . $request->input('lname');
        $addstaff->role = $request->input('role');
        $addstaff->position = $request->input('position');
        $addstaff->office = $request->input('office');
        $addstaff->age = $request->input('age');
        $addstaff->startdate = $request->input('startdate');
        $addstaff->salary = $request->input('salary');
        $addstaff->email = $request->input('email');
        $addstaff->password = Hash::make($request->input('lname'));
        $addstaff->save();

        return redirect()->back()->with('success', 'Staff added successfully!');
    }

    public function editstaff($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        return view('admin.edit', compact('user'));
    }

    public function update($id, Request $request){
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'position' => 'required|max:255',
            'office' => 'required|max:255',
            'age' => 'required|integer|min:18|max:65',
            'startdate' => 'required|date',
            'salary' => 'required|numeric|min:0',
        ]);

        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->position = $request->input('position');
        $user->office = $request->input('office');
        $user->age = $request->input('age');
        $user->startdate = $request->input('startdate');
        $user->salary = $request->input('salary');
        $user->save();

        return redirect()->back()->with('success', 'Staff information updated successfully!');
    }
}

?>