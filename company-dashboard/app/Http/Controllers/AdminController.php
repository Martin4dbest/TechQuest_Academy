<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Import Str class for generating random strings

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

    public function confirmDelete($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        return view('admin.delete-staff', compact('user'));
    }


    public function delete($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $user->delete();
        return redirect()->back()->with('success', 'Staff deleted successfully!');
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
            'age' => 'required|integer|min:18|max:65', // Example validation for age
            'startdate' => 'required|date', // Example validation for date
            'salary' => 'required|numeric|min:0', // Example validation for salary
            'email' => 'required|email|unique:users',
            //'password' => 'required|min:8', // Add validation rule for password

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
        //$addstaff->password = Hash::make(Str::random(8)); // Using Str::random for secure password generation
        $addstaff->password = Hash::make($request->input('lname')); // Use the input password and hash it
    
        $addstaff->save();

        // Optionally, send an email to the user with their new password

        //return redirect()->route('admin.users')->with('success', 'Staff added successfully!');
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
            'age' => 'required|integer|min:18|max:65', // Ensure the age validation is correct
            'startdate' => 'required|date', // Ensure the date validation is correct
            'salary' => 'required|numeric|min:0', // Ensure the salary validation is correct
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