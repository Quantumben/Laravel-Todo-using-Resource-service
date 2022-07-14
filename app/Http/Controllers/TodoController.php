<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AddTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Services\TodoServices;
use App\Models\Todo;
use App\Models\TodoActivity;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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

                $user = Auth::User()->id;
                $dt = Carbon::now();
                $timestamp = $dt->toDateTimeString();

                $activitylog = [
                    'action' => 'Todo Created',
                    'user_id' => $user,
                    'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                    'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
                ];

                DB::table('todo_activities')->insert($activitylog);


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
    public function update(UpdateTodoRequest $req, $id)
    {
        try {

            $updatetodo = $this->todoservices->updateTodo($id);

            $updatetodo->update(
                [
                    'Title' => $req['Title'],

                    'Description' => $req['Description'],
                ]
            );

            //Log User Activities

            $user = Auth::User()->id;

            $activitylog = [
                'action' => 'Todo Updated',
                'user_id' => $user,
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
            ];

            DB::table('todo_activities')->insert($activitylog);


            return new TodoResource($updatetodo);


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

            //Log User Activities

            $user = Auth::User();
            $userid = $user->id;

            $activitylog = [
                'action' => 'Todo Deleted',
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

            $Marktodo = $this->todoservices->MarkTodo($id);

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

            $Marktodo = $this->todoservices->OverDue($id);

            return response($Marktodo)
            ->setStatusCode(200);

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }

    public function RescheduleTodo($id)
    {
        try {

            $Marktodo = $this->todoservices->RescheduleTodo($id);

            return response($Marktodo)
            ->setStatusCode(200);

        } catch (\Throwable $throwable) {
            ($throwable);
            throw $throwable;
        }
    }
}
