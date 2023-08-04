<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;

class AdminController extends Controller
{
    use PasswordValidationRules;
    
    public function index(){
        $admins = User::where('isAdmin','1')->get();
        //session()->flash('success', 'Data successfully saved!');
        return view('admin.index',compact('admins'));
    }

    public function addAdmin(Request $input){
        $input->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|numeric|min:10',
            'gender' => 'required',
            'password' => $this->passwordRules(),
        ]);
        
        $user = new User();
        $user->first_name =  $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->phone_number = $input['phone_number'];
        $user->address = $input['address'];
        $user->gender = $input['gender'];
        $user->password = Hash::make($input['password']);
        $user->isAdmin = true;
        
        if ($user->save()) {
            // User created successfully
            return back()->with('success', 'Admin added successfully');
        } else {
            // User creation failed
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }

    public function destroy($adminId){
        $admin=User::find($adminId);
        if($admin->delete()){
            return redirect()->back()->with('success', 'Admin deleted successfully.');
        }else{
            return back()->with('error', 'deletion failed. Please try again.');
        }
    }
}
