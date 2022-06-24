<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;


class TodoServices{

    public function getAllTodo()
    {
       return Todo::all();
    }

    public function getTodoById($id)
    {
        return Todo::find($id);
    }

    public function createTodo(array $params)
    {

        return Todo::create($params);

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
}
?>
