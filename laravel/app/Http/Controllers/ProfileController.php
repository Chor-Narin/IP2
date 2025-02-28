<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form to edit the authenticated user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the profile edit view with the user's data
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Add password validation if needed
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user's name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // If a new password is provided, hash and update it
        if ($request->has('password') && $request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the updated user data
        $user->save();

        // Redirect back to the profile edit page with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the authenticated user's account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if user is authenticated
        if ($user) {
            // Delete the user's account from the database
            $user->delete();
    
            // Log the user out after deleting the account
            Auth::logout();
    
            // Redirect to the homepage or another page
            return redirect('/')->with('status', 'Your account has been deleted successfully.');
        }
    
        // If no user is authenticated, redirect back
        return redirect()->route('login');
    }
    
}
