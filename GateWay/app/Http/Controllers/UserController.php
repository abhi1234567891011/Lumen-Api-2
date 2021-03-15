<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    use ApiResponser;

  /**
   * 
   * The service to consume the authors microservice
   * @var UserService
   */

   public $userService;


    /**
   * 
   * The service to consume the authors microservice
   * @var UserService
   */

   public $userService;


    //this is how we can use the trait

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)

    {
        // $userService = new UserService();
        $this->userService = $userService;
    }
    /**
     * Return the List of id's
     * @return illuminate\Http\Response
     */
     public function index(){
      
        
        return $this->sucessResponse($this->userService->obtainUsers());
        
     }

     /**
     * Creates one new user
     * @return illuminate\Http\Response
     */
    public function store(Request $request){

        return $this->sucessResponse($this->userService->createUser($request->all(),Response::HTTP_CREATED));
        
    }




     /**
     * Obtains and show one user
     * @return illuminate\Http\Response
     */
    public function show($id){
        return $this->sucessResponse($this->userService->obtainUser($id));

    }


     /**
     * remove an existing user
     * @return illuminate\Http\Response
     */
    public function update(Request $request , $id){

        return $this->sucessResponse($this->userService->editUser($request->all(),$id));


    }

     /**
     * Removes an existing user
     * @return illuminate\Http\Response
     */
    public function destroy($id){

       return $this->sucessResponse($this->userService->deleteUser($id));
    }
    //
}