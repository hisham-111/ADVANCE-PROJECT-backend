<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
class currencyController extends Controller
{
    public function getAllCurrency() // returns all currencies
    {
        $currencies = Currency::all();
        return response()->json([
            'currencies' => $currencies,
        ]);
    }

    public function getCurrency(Request $request, $id) // returns a Currency by id
    {
        try {
            $currency = Currency::findOrFail($id);
    
            return response()->json([
                'currency' => $currency,
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'error' => 'Currency not found',
            ], 404); // 404 status code indicates resource not found
        }
    }
    public function addCurrency(Request $request) // add a currency
    {
        try {
            $currency = new Currency;
            $rate = $request->input('rate');
            $name = $request->input('name');
            $currency->rate = $rate;
            $currency->name = $name;
            $currency->save();
            return response()->json([ 
                'message' => 'Currency Added successfully!'. $rate. ' '. $name,  
            ]); // successed response
        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Error adding currency: ' . $err->getMessage(),  
            ], 500); // 500 status code indicates internal server error
        }
    }
    public function editCurrency(Request $request, $id)
    {
        try {
            $currency = Currency::findOrFail($id);
            
            $currency->name = $request->input('name');
            $currency->rate = $request->input('rate');
            $currency->save();
            return response()->json([ 
            'message' => 'Currency Updated successfully!',
            'currency' => $currency,
            ]); // successed response

        }catch (\Exception $err) {
            return response()->json([
                'message' => 'Error updating currency: ' . $err->getMessage(),  
            ], 500); // 500 status code indicates internal server error
        }
    }
    public function deleteCurrency(Request $request, $id){
         
        $author =  Currency::find($id);
        $author->delete();
        return response()->json([
            'message' => 'Currency deleted Successfully!',
     
        ]);
    }
    
}
