<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products = Product::get();
        $users = User::get();
        $data =[
            'product' =>$products,
            'user' => $users
        ];
        return response()->json($data, 200);
    }
    //get category list
    public function categoryList(){
        $category = Category::orderBy('created_at','desc')->get();
        return response()->json($category, 200,);
    }

    //create category
    public function categoryCreate(Request $request){
        // dd($request->all());
       $data = [
        'name' => $request->name,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
       ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //content create
    public function contentCreate(Request $request){
        // return $request->all();
        $data = $this->getContentData($request);
        Contact::create($data);
        $Contact = Contact::get();
        return response()->json($Contact, 200);

    }
    //get content data
    private function getContentData($request){
        return[
        'name'=>$request->name,
        'email' =>$request->email,
        'message'=>$request->message,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
        ];
    }

    //category delete
    public function categoryDelete($id){
        // return $request->all();
        $data = Category::where('id',$id)->first();
        // return !empty($data);
        if (isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>true,'message'=>'delete success'], 200);
        }
            return response()->json(['status'=>false,'message'=>'there is no category'], 200);

    }
    //category details
    public function categoryDetail($id){
        $data = Category::where('id',$id)->first();

        if (isset($data)){
            return response()->json(['status'=>true,'message'=>$data], 200);
        }
            return response()->json(['status'=>false,'message'=>'there is no category'], 500);
    }
    //category update
    public function categoryUpdate(Request $request){
        //  return $request->all();
        $categoryId = $request->category_id;
        $dbSource = Category::where('id',$categoryId)->first();
        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
            $response = Category::where('id',$categoryId)->update($data);
            return response()->json(['status'=>true,'message'=>'category update success','category'=>$response], 200);

        }
        return response()->json(['status'=>false,'message'=>'there is no category'], 500);

    }
    //get category data
    private function getCategoryData($request){
        return [
            'name' =>$request->category_name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
}
