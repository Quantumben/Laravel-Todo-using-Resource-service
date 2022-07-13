<?php
namespace App\Services;

use App\Models\SubTodo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;



class SubTodoServices{

    public function getAllTodo()
    {

       return SubTodo::all();


    }

    public function getTodoById($id)
    {
        return SubTodo::find($id);
    }

    public function createTodo(array $par)
    {
        $user = Auth::User();

        return SubTodo::create(
            [

                'user_id' => auth()->user()->id,
                'Title' => $par['Title'],
                'Description' => $par['Description'],
            ]
        );

    }

    public function updateTodo($id)
    {

        $todo = SubTodo::find($id);


        return $todo;

    }

    public function deleteTodo($id)
    {
        $delete = SubTodo::find($id);
        $delete->delete();
        return "Todo Deleted Successfully";
    }

    public function MarkTodo($id)
    {
        $user = Auth::id();
        $to = SubTodo::find(1)->user_id;

        if($user === $to)
        {

            $completed = SubTodo::find($id);

            $completed->update(
                [
                    'completed' => 'YES'
                ]
            );

        return "Todo Mark As Complete";

        }else{

            return "You Are Not The Owner";
        }

    }

    public function OverDue($id)
    {
        $to = SubTodo::find($id)->created_at;

        $d = Carbon::now();

        if($d > $to)
        {

        return "Todo Time Has Pass";

        }else{

            return "Todo Still in Progress";
        }

    }



}

