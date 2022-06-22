<?php
namespace App\Services;
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

    public function updateTodo($id, $data)
    {
        $update = Todo::find($id);
        $update->update($data->only(['Title', 'Description']));
        return $update;
    }

    public function deleteTodo($id)
    {
        $delete = Todo::find($id);
        $delete->delete();
        return "Todo Deleted Successfully";
    }
}
?>
