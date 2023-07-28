<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {

        $alladminuser = User::paginate(15);
        return view('admin.index', compact('alladminuser'));
    }

    public function Tambah()
    {
        $roles = DB::table('roles')->get();
        return view('admin.tambah', compact('roles'));;
    }

    public function StoreAdmin(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password =  Hash::make($request->password);
        $user->role = $request->role;
        $user->status = 'inactive';
        $user->save();

        $notification = array(
            'message' => 'New Added Successful',
            'alert-type' => 'success'
        );
        return redirect()->route('admin')->with($notification);
    }

    public function EditAdmin($id)
    {
        $roles = DB::table('roles')->get();
        $adminuser = User::findOrFail($id);
        return view('admin.edit', compact('adminuser', 'roles'));
    }

    public function UpdateAdmin(Request $request)
    {

        $admin_id = $request->id;
        $user = User::findOrFail($admin_id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->status = 'active';
        $user->save();

        $notification = array(
            'message' => 'Admin Update Successful',
            'alert-type' => 'success'
        );
        return redirect()->route('admin')->with($notification);
    }

    public function DeleteAdmin($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Portfolio Deleted Successfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function InactiveAdminUser($id)
    {

        DB::table('users')->where('id', $id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Inactivated User Successfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ActiveAdminUser($id)
    {

        DB::table('users')->where('id', $id)->update([
            'status' => 'active',
        ]);
        $notification = array(
            'message' => 'Activated User Successfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function Profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.profile', compact('adminData'));
    }

    public function ProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        // Mengambil dari model user.
        $data =  User::find($id);
        $data->name         = $request->name;
        $data->username     = $request->username;
        $data->email        = $request->email;
        $data->phone        = $request->phone;
        // file('photo') = file() mengambil type input file
        if ($request->file('photo')) {

            $file = $request->file('photo');
            @unlink(public_path('upload/profile/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/profile'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Update Successful',
            'alert-type' => 'success'
        );
        return redirect()->route('profile')->with($notification);
    }

    public function ChangePassword()
    {
        return view('admin.password');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([

            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',

        ]);
        $hashedPassword = Auth::user()->password;
        if (!Hash::check($request->old_password, $hashedPassword)) {
            return redirect()->back()->with('error', 'Old Password Doesn"t" Match');
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->back()->with('status', 'Password Changed Succesfully');
    }
}
