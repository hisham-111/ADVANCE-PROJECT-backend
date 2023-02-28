<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;

class GoalController extends Controller
{
    //********* Add Goal *********

    public function addGoal(Request $request){
        $goal = new goal();
        $goal->amount = $request->input('amount');
        $goal->currency_id = $request->input('currency_id');
        $goal->schedule = $request->input('schedule');
        $goal->save();
        return response()->json([
            'message' => $request->all()
        ]);
    }


//********* Get Goal *********


    public function getGoal(Request $request, $id){
        $goal = goal::find($id)->get();

        return response()->json([
            'message' => $goal
        ]);
    }


//********* Edit Goal *********

    public function editGoal(Request $request, $id){

        $goal = goal::find($id);
        $inputs = $request->except('_method');
        $goal->update($inputs);
        $inputs = $request;
        return response()->json([
            'message' => 'Goal updated successfully',
            'goal' => $goal
        ]);
}

//*********  Detele Goal *********

    public function deleteGoal(Request $request, $id){
        $goal = goal::find($id);
        $goal->delete();

        return response()->json([
            'message' => 'Goal deleted successfully',
        ]);
    }

}
