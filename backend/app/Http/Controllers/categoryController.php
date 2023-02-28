<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class categoryController extends Controller
{

//********* Add category *********

    public function addCategory(Request $request){
        $category = new category();
        $category->name = $request->input('name');
        $category->save();
        return response()->json([
            'message' => $request->all()
        ]);
    }


//********* Get category *********


    public function getCategory(Request $request, $id){
        $category = category::find($id)->get();

        return response()->json([
            'message' => $category
        ]);
    }


//********* Edit category *********

    public function editCategory(Request $request, $id){

        $category = category::find($id);
        $inputs = $request->except('_method');
        $category->update($inputs);
        $inputs = $request;
        return response()->json([
            'message' => 'category updated successfully',
            'category' => $category
        ]);
}

//*********  Detele category *********

    public function deleteCategory(Request $request, $id){
        $category = category::find($id);
        $category->delete();

        return response()->json([
            'message' => 'category deleted successfully',
        ]);
    }

}
