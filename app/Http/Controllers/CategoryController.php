<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('pages.item-category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Category::where('is_parent',1)->orderBy('item_cat_name','ASC')->get();
        return view('pages.item-category.create',compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_cat_name' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_parent' => 'sometimes|in:1',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        
        if($request->input('parent_id')){
            $data['is_parent'] = $request->input('parent_id');
        }else{
            $data['is_parent'] = $request->input('is_parent');
        }
        $status = Category::create($data);
        if($status){
            return redirect()->route('category.index')->with('success','Category Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCategory = Category::find($id);
        $parent_cats = Category::where('is_parent',1)->orderBy('item_cat_name','ASC')->get();
        if($editCategory){
            return view('pages.item-category.edit',compact(['editCategory','parent_cats']));
        }else{
            return back()->with('error','Category not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($category){
            $validator = Validator::make($request->all(), [
                'item_cat_name' => 'required|string',
                'parent_id' => 'nullable|exists:categories,id',
                'is_parent' => 'sometimes|in:1'
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $category->item_cat_name = $request->input('item_cat_name');
            $category->item_cat_desc = $request->input('item_cat_desc');
            $category->parent_id = $request->input('parent_id');
            
            if($request->is_parent==1){
                $category->parent_id = null;
            }
            $category->is_parent = $request->input('is_parent',0);
  
            $category->update();
            if($category){
                return redirect()->route('category.index')->with('success','Category Updated Successfully');
            }else{
                return redirect()->back()->with('error','Something Went Wrong!');
            }
        }else{
            return back()->with('error','Data not found');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
    public function getChildByParentId(Request $request)
    {
        $category = Category::find($request->id);
        if($category){
            $child_id = Category::getChildByParentId($request->id);
            if(count($child_id)<=0){
                return response()->json(['status'=>false,'data'=>null,'msg'=>'']);
            }
            return response()->json(['status'=>true,'data'=>$child_id,'msg'=>'']);
        }else{
            return response()->json(['status'=>false,'data'=>null,'msg'=>'Category not found']);
        }
       
    }
}
