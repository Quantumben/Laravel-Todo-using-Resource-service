<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\TodoActivity;
use Hamcrest\Description;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TodoServices{

    public function getAllTodo()
    {

       return Todo::all();


    }

    public function getTodoById($id)
    {
        return Todo::find($id);
    }

    public function createTodo(array $par)
    {
        $user = Auth::User();

        return Todo::create(
            [

                'user_id' => auth()->user()->id,
                'Title' => $par['Title'],
                'Description' => $par['Description'],
            ]
        );

    }

    public function updateTodo($id)
    {

        $todo = Todo::find($id);


        return $todo;

    }

    public function deleteTodo($id)
    {
        $delete = Todo::find($id);
        $delete->delete();
        return "Todo Deleted Successfully";
    }

    public function MarkTodo($id)
    {
        $user = Auth::id();
        $to = Todo::find(1)->user_id;

        if($user === $to)
        {

            $completed = Todo::find($id);

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
        $to = Todo::find($id)->created_at;

        $d = Carbon::now();

        if($d > $to)
        {

        return "Todo Time Has Pass";

        }else{

            return "Todo Still in Progress";
        }

    }
}
?>
