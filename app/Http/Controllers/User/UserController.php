<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        // dd(count($cart));
        return view('user.main.home',compact('pizza','category','cart','history'));
    }


    // direct user list page
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }
    // change user role
    public function userChangeRole(Request $request){
        $updateSource =[
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
        logger($request->all());

    }



    //user change password
    public function changePasswordPage(){
        return view('user.password.change');
    }
    public function changePassword(Request $request){
         $this->passwordValidatorCheck($request);
         $user=User::select('password')->where('id',Auth::user()->id)->first();
         $dbHashValue=$user->password;//hash valus
         if(Hash::check($request->oldPassword, $dbHashValue)){
             $data=[
                 'password'=>Hash::make($request->newPassword)
             ];
             User::where('id',Auth::user()->id)->update($data);
             return redirect()->route('category#list')->with(['changeSuccess'=>'Password Change Success....']);
         }
         return back()->with(['notMatch'=>'The old password not match.Try Again!']);

    }

    //user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //account change
    public function accountChange($id,Request $request){
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
        return back()->with(['updateSuccess'=>'Admin Update Success.....']);
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
    //pizza filter
    public function filter($categoryId){
        $pizza=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizza','category','cart','history'));

    }


    //pizza details
    public function pizzaDetails($pizzaId){
        $pizza=Product::where('id',$pizzaId)->first();
        $pizzaList=Product::get();
        // dd($pizzaList);
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //cart detail list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());
        $totalPrice ='0';
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));

    }

    //history page
    public function history(){
        $order= Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('order'));
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
