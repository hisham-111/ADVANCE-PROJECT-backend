<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request){
        $transactions = Transaction::orderBy('startDate', 'desc')->get();
    }
    
    public function show(Request $request,$id){
        $transaction =  Transaction::find($id)->get();
  
        return response()->json(['message' => $transaction]);

    }

    public function store(Request $request){
        $transaction = new Transaction();
        $title=$request->input('title');
        $description=$request->input('description');
        $amount=$request->input('amount');
        $startDate=$request->input('startDate');
        $endDate=$request->input('endDate');
        $schedule=$request->input('schedule');
        $status=$request->input('status');

        $transaction->title = $title;
        $transaction->description = $description;
        $transaction->amount = $amount;
        $transaction->schedule = $schedule;
        $transaction->startDate = $startDate;
        $transaction->endDate = $endDate;
        $transaction->status = $status;

        $transaction->save();
        return response()->json(['message' =>'transaction added successfully!',
        'transaction' => $transaction]);
    }

    public function edit(Request $request, $id){
        $transaction =  Transaction::find($id);
        $inputs= $request
        // ->except('currency','category','_method')
        ;
        $transaction->update($inputs);
        // if($request->has('category')){
        //     $transaction->category()->sync(json_decode($request->input('categories')));
        // }

         // if($request->has('currency')){
        //     $transaction->categories()->sync(json_decode($request->input('categories')));
        // }

        return response()->json([
            'message' => 'transaction edited successfully!',
            'transaction' => $transaction,
     
        ]);
    }

    public function delete(Request $request, $id){
         
        $transaction =  Transaction::find($id);
        $transaction->delete();
        return response()->json([
            'message' => 'transaction deleted Successfully!',
     
        ]);
    }
}
