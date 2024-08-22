<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Information;
use App\Models\Informationbackup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use const http\Client\Curl\AUTH_ANY;

class AdminController extends Controller
{
    public function dashboard(){
        $categories = Category::count('id');
        $products = Product::count('id');
        $information = Information::count('id');
        $information_backup = Informationbackup::count('id');
        $users = User::count('id');
        return view('admin.index',compact('categories', 'products', 'information','users', 'information_backup'));
    }

    public function index()
    {
        return view('admin.profile.index');
    }

    public function updatePro(Request $request)
    {
        //dd($request);
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validation for image
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            // Store new image
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/admin'), $fileName);

            // Update user image path
            $user->image = 'images/admin/' . $fileName;
        }

        // Save updated user data
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your profile has been updated successfully.');
    }


    public function updatePass(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:30',
            'confirm_password' => 'required|same:new_password',
        ]);

        if(Hash::check($request->current_password, Auth::guard('web')->user()->password)){
            if($request->new_password == $request->confirm_password){
                $admin = User::where('id', Auth::guard('web')->user()->id)->first();
                $admin->password = Hash::make($request->new_password);
                $admin->save();
                return redirect()->back()->with('success', 'Your Password Updated Successfully.');
            }else{
                return redirect()->back()->with('error', 'Password Do not match');
            }
        }else{
            return redirect()->back()->with('error', 'Current Password Do not match');
        }
    }
}
