<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Services\TodoServices;
use App\Models\Todo;

class TodoController extends Controller
{


    public function __construct()
    {
        $this->todoservices = new TodoServices();


    }

    public function getTodo()
    {


        try {

            return TodoResource::collection($this->todoservices->getAllTodo());

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTodoRequest $request)
    {
        try {
            $createtodo = $this->todoservices->createTodo($request->validated());

            return new TodoResource($createtodo);


        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            return new TodoResource($this->todoservices->getTodoById($id));

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, $id)
    {
        try {
            $updatetodo = $this->todoservices->updateTodo($request->validated(),$id);

            return response($updatetodo)
            ->setStatusCode(200);

            //return $this->responseJson( 'Todo created', new TaskResource($createtodo), 200);

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $updatetodo = $this->todoservices->deleteTodo($id);

            return response($updatetodo)
            ->setStatusCode(200);

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }
}