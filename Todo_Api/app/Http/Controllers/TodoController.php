<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Todo;

class TodoController extends Controller
{

    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
       
        $todo = Todo::all();

        return $this->sucessResponse($todo);
     
     }

     /**
     * Creates one new todo
     * @return illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'due' => 'required|max:15',
            'user_id' => 'required|min:1'
        ];

        //this validate method is from the controller class which will check the above specified rule and through exception if rules not met.
        $this->validate($request , $rules);

        $todo = Todo::create($request->all());

        //This HTTP_CREATED is for error code 201
        return $this->sucessResponse($todo , Response::HTTP_CREATED);

        
    }




     /**
     * Obtains and show one user
     * @return illuminate\Http\Response
     */
    public function show($id){
      
        // return "abhi";
        $todo = Todo::findOrFail($id);

        return $this->sucessResponse($todo);

    }


     /**
     * remove an existing author
     * @return illuminate\Http\Response
     */
    public function update(Request $request , $id){

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'due' => 'required|max:15',
            'user_id' => 'required|min:1'
        ];

        //this validate method is from the controller class which will check the above specified rule and through exception if rules not met.
        $this->validate($request , $rules);

         $todo = Todo::findOrFail($id);

         $todo->fill($request->all());

         if($todo->isClean()){
         return $this->errorResponse("At least one value must change ",Response::HTTP_UNPROCESSABLE_ENTITY);

         }
         $todo->save();
        
         return $this->sucessResponse($todo);
       
    }


     /**
     * Removes an existing todo
     * @return illuminate\Http\Response
     */
    public function destroy($id){
  
        $todo = Todo::findOrFail($id);

        $todo->delete();

        return $this->sucessResponse($todo);
    }
    //
    //
}
