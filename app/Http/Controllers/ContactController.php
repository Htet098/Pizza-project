<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct to admin contact list page
    public function contactList(){
        $contact = Contact::orderBy('id','desc')->paginate(5);
        $contact->appends(request()->all());

        // dd($contact->toArray());
        return view('admin.contact.list',compact('contact'));
    }

    //direct to contact more info page
    public function contactMoreInfoList($id){
        // dd($id);
        $contact = Contact::where('id',$id)->first();
       return view('admin.contact.moreInfo',compact('contact'));
    }
    //delete contact
    public function contactDeleteList($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#contactList')->with(['deleteSuccess' => 'Contact Message Delete Success']);

    }


    //direct to user contact message section
    public function userContactList(){
        return view('user.contact.contactList');
    }

    //contact message send
    public function UserListCreate(Request $request){
        // dd($request->all());
        $this->contactValidationCheck($request);
        $data =$this->requestContactInfo($request);
        // dd($this->requestContactInfo($request));
        // dd($data);
        // dd(Auth::user()->email);
        dd(Auth::user()->email === $data["email"] ? 'true' :'false' );
         Contact::create($contactData);
        return redirect()->route('user#contactList')->with(['MessageSuccess'=>'Contact Message Success....']);



    }

    //request data from form
    private function requestContactInfo($request){
        $data =[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
        return $data;
    }

    //validation check
    private function contactValidationCheck($request){
        $validationRules=[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required'
        ];
        Validator::make($request->all(),$validationRules)->validate();
    }
}
