<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AddTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\SubTodoResource;
use App\Services\SubTodoServices;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SubTodoController extends Controller
{


    public function __construct()
    {
        $this->SubTodoservices = new SubTodoServices();


    }

    public function getTodo()
    {


        try {

            return SubTodoResource::collection($this->SubTodoservices->getAllTodo());

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

                $user = Auth::User()->id;
                $dt = Carbon::now();
                $timestamp = $dt->toDateTimeString();

                $activitylog = [
                    'action' => 'SubTodo Created',
                    'user_id' => $user,
                    'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                    'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
                ];

                DB::table('todo_activities')->insert($activitylog);


            $createtodo = $this->SubTodoservices->createTodo($request->validated());

            return new SubTodoResource($createtodo);

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

            return new SubTodoResource($this->SubTodoservices->getTodoById($id));

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
    public function update(UpdateTodoRequest $req, $id)
    {
        try {

            $updatetodo = $this->SubTodoservices->updateTodo($id);

            $updatetodo->update(
                [
                    'Title' => $req['Title'],

                    'Description' => $req['Description'],
                ]
            );

            //Log User Activities

            $user = Auth::User()->id;

            $activitylog = [
                'action' => 'SubTodo Updated',
                'user_id' => $user,
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
            ];

            DB::table('todo_activities')->insert($activitylog);


            return new SubTodoResource($updatetodo);


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

            $updatetodo = $this->SubTodoservices->deleteTodo($id);

            //Log User Activities

            $user = Auth::User();
            $userid = $user->id;

            $activitylog = [
                'action' => 'SubTodo Deleted',
                'user_id' => $userid,
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
                ];

            DB::table('todo_activities')->insert($activitylog);

           // Log User Activities Ends

            return response($updatetodo)
            ->setStatusCode(200);


        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }

    public function completed($id)
    {
        try {

            $Marktodo = $this->SubTodoservices->MarkTodo($id);

            return response($Marktodo)
            ->setStatusCode(200);

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }

    public function todo()
    {
        try {

            $db = DB::table('todo_activities')->get();

            return response($db)
            ->setStatusCode(200);

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }

    public function OverDue($id)
    {
        try {

            $Marktodo = $this->SubTodoservices->OverDue($id);

            return response($Marktodo)
            ->setStatusCode(200);

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }

}
