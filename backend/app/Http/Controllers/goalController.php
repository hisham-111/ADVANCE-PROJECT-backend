<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\goal;

class GoalController extends Controller
{
    //********* Add Goal *********

    public function addGoal(Request $request){
        $goal = new goal;
        $amount = $request->input('amount');
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
        $goal->update($input);

        return response()->json([
            'message' => 'Goal updated successfully',
            'goal' => $goal
        ]);
}

//*********  Detele Goal *********

    public function deleteGoal(Request $request, $id){
        $goal = categories::find($id);
        $goal->delete();

        return response()->json([
            'message' => 'Goal deleted successfully',
        ]);
    }

}
