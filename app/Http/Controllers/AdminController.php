<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidatorCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue=$user->password;//hash valus
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // return back();
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            // return back()->with(['changeSuccess'=>'Password Change Success....']);
            return redirect()->route('category#list')->with(['changeSuccess'=>'Password Change Success....']);

        }
        return back()->with(['notMatch'=>'The old password not match.Try Again!']);
    }

    //direct admin details page
    public function details(){
        return view("admin.account.detail");
    }
    //direct admin edit page
    public function edit(){
        return view('admin.account.edit');
    }
    //update account
    public function update($id,Request $request){
        $this->accountValidatorCheck($request);
        $data=$this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            //1. old image name | check ->delete
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }


            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;

        }


        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Update Success.....']);
    }

    //admin list
    public function list(){
        $admin= User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })

        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //admin delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Delete Success....']);
    }

    //admin change role
    public function changeRole($id){
        $account= User::where('id',$id)->first();
        return view("admin.account.changeRole",compact('account'));
    }

    //change
     public function change($id,Request $request){
        $data = $this->requestGetData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');

     }

     //request get data
     private function requestGetData($request){
        return[
            'role'=>$request->role
        ];
     }


    //request user data
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now()
        ];
    }
    //account validator check
    private function accountValidatorCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'image'=>'mimes:jpg,png,jpeg,webp|file'
        ])->validate();
    }

    //password validator check
    private function passwordValidatorCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10' ,
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
