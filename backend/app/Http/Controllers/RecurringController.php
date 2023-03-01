<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurring;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;

class RecurringController extends Controller
{
    //********Get All Recurrings******** */
    
    public function index()
    {
        $recurring = Recurring::orderBy('start_date','desc')->paginate(10);
        return response()->json([
            'status' => 201,
            'message' =>  "recurrings",
            'data' => $recurring
        ]);
    }

    //********Get Recurring by Id******** */
    public function show(Request $request, $id) 
    {
        $recurring = Recurring::findOrFail($id);
        return response()->json([
           'status' => 201,
           'message' =>  "recurring",
            'data' => $recurring
        ]);
            
    }

        //********create Recurring******** */
     public function store(Request $request){
        $recurring = new Recurring();
        $title=$request->input('title');
        $description=$request->input('description');
        $amount=$request->input('amount');
        $start_date=$request->input('start_date');
        $end_date=$request->input('end_date');
        $currency_id=$request->input('currency_id');
        $currency = Currency::find($currency_id);
        // $category_id=$request->input('category_id');
      
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:250',
            'amount' => 'required|numeric|gt:0',
            'currency_id'=> 'required|integer|min:1|exists:currencies,id',
            // 'category_id' => 'required|integer|min:1|exists:categories,id',
            "start_date" => 'required|date_format:Y-m-d|before_or_equal:today',
            "end_date" => 'required|date_format:Y-m-d|after:start_date',
        ]);
        $recurring->title = $title;
        $recurring->description = $description;
        $recurring->amount = $amount;
        $recurring->currency()->associate($currency);;

        // $recurring->category_id=$category_id;
        $recurring->start_date = $start_date;
        $recurring->end_date = $end_date;
        
        $recurring->save();
        return response()->json(['message' =>'recurring added successfully!',
        'recurring' => $recurring]);
    }

        //********Edit Recurring******** */
    public function edit(Request $request, $id){
        $recurring =  Recurring::findOrFail($id);
        $inputs= $request
        ->except('category','currency','_method')
        ;
        $recurring->update($inputs);
        // if($request->has('category')){
        //     $recurring->category()->sync(json_decode($request->input('categories')));
        // }

         // if($request->has('currency')){
        //     $recurring->categories()->sync(json_decode($request->input('categories')));
        // }

        return response()->json([
            'message' => 'recurring edited successfully!',
            'recurring' => $recurring,
     
        ]);
    }

        //********Delete Recurring******** */
    public function delete(Request $request, $id){
         
        $recurring =  Recurring::findOrFail($id);
        $recurring->delete();
        return response()->json([
            'message' => 'recurring deleted Successfully!',
     
        ]);
    }
    
}