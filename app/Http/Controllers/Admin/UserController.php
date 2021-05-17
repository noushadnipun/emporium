<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
      //User
    public function userIndex($id = null)
    {
        $getUser = User::skip(1)->take(1)->paginate(15);
        if(!empty($id)){
            $editUser = User::find($id);
        }else{
            $editUser = '';
        }
        return view('admin.user.index', compact('getUser', 'editUser'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            //'email' => 'required|unique:users|email:rfc,dns',
            'email' => 'required|unique:users',
            'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            'user_type' => 'required',
            'password_confirmation' => 'min:4'
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->postcode = $request->postcode;
        $data->country = $request->country;
        $data->user_type = $request->user_type;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->back()->with('success', 'Added Successfully');
    }

    public function userUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            'user_type' => 'required',
            'password_confirmation' => 'min:4'
        ]);

        $data = User::find($request->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->postcode = $request->postcode;
        $data->country = $request->country;
        $data->user_type = $request->user_type;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->back()->with('success', 'Edited Successfully');
    }

     public function userDestroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }




    //Customer

     public function customerIndex($id = null)
    {
        $getUser = User::where('role_id', '3')->orderBy('id', 'desc')->get();
        if(!empty($id)){
            $editUser = User::find($id);
        }else{
            $editUser = '';
        }
        return view('admin.customer.index', compact('getUser', 'editUser'));
    }

    public function customerStore(Request $request)
    {
        $data = new User();
        $data->name = $request->name;
        // $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        // $data->city = $request->city;
        // $data->state = $request->state;
        // $data->postcode = $request->postcode;
        // $data->country = $request->country;
        $data->role_id = 3;
        $data->fb_url = $request->fb_url;
        ///$data->password = bcrypt($request->password);
        $data->save();
        return redirect()->back()->with('success', 'Added Successfully');
    }

     public function customerUpdate(Request $request)
    {

        $data = User::find($request->id);
        $data->name = $request->name;
        // $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        // $data->city = $request->city;
        // $data->state = $request->state;
        // $data->postcode = $request->postcode;
        // $data->country = $request->country;
        $data->role_id = 3;
        $data->fb_url = $request->fb_url;
        // $data->user_type = $request->user_type;
        // $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->back()->with('success', 'Edited Successfully');
    }

     public function customerDestroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
