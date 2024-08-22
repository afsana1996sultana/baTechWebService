<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class StaffController extends Controller
{
    public function index()
    {
        $data['staffs'] = User::whereNotIn('user_role',[1])->orderBy('id','desc')->get();
        return view('admin.staff.index',$data);
    }

    public function create()
    {
        $staff =User::latest()->get();
        return view('admin.staff.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:15|min:11|unique:users,phone',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $staff = new User();
            $staff->name   = $request->name;
            $staff->email  = $request->email;
            $staff->phone  = $request->phone;
            $staff->password = Hash::make($request->password);
            $staff->plain_password  = $request->password;
            $staff->user_role = 2;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $ext;
                $file->move('images/staff/', $fileName);
                $staff->image = 'images/staff/' . $fileName;
            }
            $staff->save();
            DB::commit();
            return redirect()->route('staff.index')->with('success','Data Created Successfully');
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
    }

    public function edit($id)
    {
        $data['staff'] = User::find($id);
        return view('admin.staff.edit',$data);
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|max:15|min:11|unique:users,phone,'.$id,
            'password' => 'required|min:6|confirmed',

        ]);

        DB::beginTransaction();
        try {
            $staff = User::find($id);
            $staff->name   = $request->name;
            $staff->email  = $request->email;
            $staff->phone  = $request->phone;
            $staff->password = Hash::make($request->password);
            $staff->plain_password  = $request->password;
            $staff->user_role = 2;

            if ($request->hasFile('image')) {

                if($staff->image){
                    File::delete($staff->image);
                }

                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $ext;
                $file->move('images/staff/', $fileName);
                $staff->image = 'images/staff/' . $fileName;
            }
            $staff->save();
            DB::commit();
            return redirect()->route('staff.index')->with('success','Data Updated Successfully');
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
    }

    public function delete($id)
    {
        $staff = User::find($id);
        $staff->delete();
        return redirect()->back()->with('success','Data Deleted Successfully');
    }
}
