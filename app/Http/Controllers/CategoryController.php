<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list
    Public function list(){
        $categories=Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('id','desc')->paginate(4);
        $categories->appends(request()->all());
        // dd($categories)->toArray();
        return view('admin.category.list',compact('categories'));
    }

    //direct category create
    Public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->categoryValidatorCheck($request);
        $data=$this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //delete category
    Public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'category deleted......']);
    }

    //edit category
    Public function edit($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update category
    Public function update(Request $request){
        // dd($request->all());
        $this->categoryValidatorCheck($request);
        $data=$this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    //category validation check
    Private function categoryValidatorCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    //request category data
    Private function requestCategoryData($request){
        return[
            'name'=>$request->categoryName,
        ];
    }
}
