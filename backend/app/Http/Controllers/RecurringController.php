<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurring;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;

class RecurringController extends Controller
{
    //********Get All Recurrings******** */

    public function index(Request $request)
    {
        $pagination = $request->input('pagination') || 2;
        $recurring = Recurring::with('currency')->orderBy('start_date', 'desc')->paginate($pagination);
        
        //*********querry currency********* */
        if ($request->has('currency')) {
            $currency = $request->input('currency');
            $recurring = Recurring::whereHas('currency', function ($query) use ($currency) {
                $query->where('name', $currency);
            })->orderBy('start_date', 'desc')->paginate($pagination);
        }
        
        //*********querry income/outcome********* */
        // if ($request->has('typeCode')) {
        //     $typeCode = $request->input('typeCode');
        //     $recurring = Recurring::whereHas('category', function ($query) use ($typeCode) {
        //         $query->where('typeCode', $typeCode);
        //     })->orderBy('start_date', 'desc')->paginate($pagination);
        // }
        

        return response()->json([
            'status' => 201,
            'message' => "recurrings",
            'data' => $recurring
        ]);
    }

    //********Get Recurring by Id******** */
    public function show(Request $request, $id)
    {
        $recurring = Recurring::findOrFail($id);
        return response()->json([
            'status' => 201,
            'message' => "recurring",
            'data' => $recurring
        ]);

    }

    //********create Recurring******** */
    public function store(Request $request)
    {
        $recurring = new Recurring();
        $title = $request->input('title');
        $description = $request->input('description');
        $amount = $request->input('amount');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $currency_id = $request->input('currency_id');
        $currency = Currency::find($currency_id);
        // $category_id=$request->input('category_id');
        //$category = Cayegory::find($category_id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:250',
            'amount' => 'required|numeric|gt:0',
            'currency_id' => 'required|integer|min:1|exists:currencies,id',
            // 'category_id' => 'required|integer|min:1|exists:categories,id',
            "start_date" => 'required|date_format:Y-m-d',
            "end_date" => 'required|date_format:Y-m-d|after:start_date',
        ]);
        if ($validator->fails()) {
            $respond['message'] = $validator->errors();
            return $respond;
        }

        $recurring->title = $title;
        $recurring->description = $description;
        $recurring->amount = $amount;
        $recurring->currency()->associate($currency);
        //$recurring->category()->associate($category);
        $recurring->start_date = $start_date;
        $recurring->end_date = $end_date;

        $recurring->save();
        return response()->json([
            'message' => 'recurring added successfully!',
            'recurring' => $recurring
        ]);
    }

    //********Edit Recurring******** */
    public function edit(Request $request, $id)
    {
        $recurring = Recurring::findOrFail($id);
        $inputs = $request
            ->except('category', '_method')
        ;
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:100',
            'description' => 'string|max:250',
            'amount' => 'numeric|gt:0',
            'currency_id' => 'integer|min:1|exists:currencies,id',
            // 'category_id' => 'integer|min:1|exists:categories,id',
            "start_date" => 'date_format:Y-m-d',
            "end_date" => 'date_format:Y-m-d|after:start_date',
        ]);
        if ($validator->fails()) {
            $respond['message'] = $validator->errors();
            return $respond;
        }

        $recurring->update($inputs);
        // $recurring = Recurring::with('currency')->get();
        return response()->json([
            'message' => 'recurring edited successfully!',
            'recurring' => $recurring,

        ]);
    }

    //********Delete Recurring******** */
    public function delete(Request $request, $id)
    {

        $recurring = Recurring::findOrFail($id);
        $recurring->delete();
        return response()->json([
            'message' => 'recurring deleted Successfully!',

        ]);
    }

}