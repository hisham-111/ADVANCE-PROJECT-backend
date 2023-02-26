<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\goal;

class GoalController extends Controller
{
    //********* Add Goal *********

    public function addGoal(Request $request){
        $goal = new goal;
        $incomes = $request->input('incomes');
        $expenses = $request->input('expenses');
        $goal->save();
        return response()->json([
            'message' => $request->all()
        ]);
    }

//********* Get Goal *********


    public function getGoal(Request $request, $id){
        $goal = goal::find($id);

        return response()->json([
            'message' => $goal
        ]);
    }
}

//********* Edit Goal *********

    function editGoal(Request $request, $id){

        $goal = goal::find($id);
        $goal->update($input);

        return response()->json([
            'message' => 'Goal updated successfully',
            'goal' => $goal
        ]);
}

//*********  Detele Goal *********

    function deleteGoal(Request $request, $id){
        $goal = categories::find($id);
        $goal->delete();

        return response()->json([
            'message' => 'Goal deleted successfully',
        ]);
    }

