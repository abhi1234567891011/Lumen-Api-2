<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Todo;
use App\Services\TodoService;
use App\Services\UserService;

class TodoController extends Controller
{


    use ApiResponser; 

/**
     * The service to sonsume the books microservice.
     *
     * @var TodoService
     */

     public $todoService;

     public $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TodoService $todoService , UserService $userService)
    {
        $this->todoService = $todoService;
        $this->userService = $userService;
        //
    }


   
 
    /**
     * Return the List of id's of todos
     * @return illuminate\Http\Response
     */
     public function index(){
      
        
        return $this->sucessResponse($this->todoService->obtainTodos());
        
     }

     /**
     * Creates one new todo
     * @return illuminate\Http\Response
     */
    public function store(Request $request){

        //If user id is not there in the user's table than we got the exception/error 404 here and we can't proced to
        //the creation of todo which kind of give us the surity that the user-id which we are entering 
        //in the todo list is there in the User's table.
        $this->userService->obtainUser($request->user_id);

        return $this->sucessResponse($this->todoService->createTodo($request->all(),Response::HTTP_CREATED));
        
    }




     /**
     * Obtains and show one user
     * @return illuminate\Http\Response
     */
    public function show($id){
        return $this->sucessResponse($this->todoService->obtainTodo($id));

    }


     /**
     * remove an existing user
     * @return illuminate\Http\Response
     */
    public function update(Request $request , $id){

        return $this->sucessResponse($this->todoService->editTodo($request->all(),$id));


    }

     /**
     * Removes an existing user
     * @return illuminate\Http\Response
     */
    public function destroy($id){

       return $this->sucessResponse($this->todoService->deleteTodo($id));
    }
    //
}