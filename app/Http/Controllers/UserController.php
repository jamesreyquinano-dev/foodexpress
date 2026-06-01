<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 

class UserController extends Controller
{
    // 1. Render data values grid list layout
    public function showUser()
    {
        $user = User::all();
        return view('users_list', compact('user'));
    }

    // 2. Update user from the admin grid list
    public function updateUser(Request $request, int $id)
    {
        $user = User::findOrFail($id);
    
        // Save name and email cleanly
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // 💡 FIXED: Removed strtolower() so it preserves case formats (e.g., 'Active', 'Inactive')
        // This stops SQLite from throwing Integrity Constraint Errors!
        $user->status = $request->input('status', 'Active'); 
        
        $user->save();
        
        return redirect()->back()->with('success', 'User account records have been modified successfully!');
    }

    // 3. Delete user from the system
    public function deleteUser(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User account has been securely removed from the database system.');
    }

    // 4. Update the logged-in user's personal profile, password, and profile image
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // Validate basic parameters and make sure the file uploaded is an image
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max 2MB file limit
        ]);

        // Update the basic account details
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Process and upload the image file to local storage directory layout
        if ($request->hasFile('profile_image')) {
            
            // Delete their previous profile image from the system disk if it exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Save the new image to storage/app/public/profile_images
            $path = $request->file('profile_image')->store('profile_images', 'public');
            
            // Save the string file location name into the database column field
            $user->profile_image = $path;
        }

        // Only change the password if they actually typed something in the box
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Your personal profile details have been updated successfully!');
    }

    // 5. Handle the form login submission process
    public function loginProcess(Request $request)
    {
        // Validate form inputs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt authentication match against database records
        if (Auth::attempt($credentials)) {
            // Generate the secure session token to prevent the login loop bug
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // If it fails, send back an error text banner
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // 6. Handle user logout session destruction
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}