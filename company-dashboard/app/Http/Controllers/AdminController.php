<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure correct namespace for User model
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.dashboard'); // Adjusted the view path
    }

    public function users() {
        $users = User::all();
        return view('admin.staffs', compact('users'));
    }

    public function viewstaff($id) {
        $user = User::find($id); // Corrected variable name to singular
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        return view('admin.view-profile', compact('user'));
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
        $addstaff->password = Hash::make(str_random(8)); // Generate a secure random password
        $addstaff->save();

        // Optionally, send an email to the user with their new password

        return redirect()->route('admin.users')->with('success', 'Staff added successfully!');
    }

    public function editstaff($id) {
        $user = User::find($id); // Corrected variable name to singular
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        return view('admin.edit', compact('user'));
    }
}
?>