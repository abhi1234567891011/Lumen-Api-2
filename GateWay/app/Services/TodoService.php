<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class TodoService{

    use ConsumesExternalService;

    /**
     * The base uri to consume user serives
     * @var string
     * 
     */
    public $baseuri;

      /**
     * The secret  to consume user serives
     * @var string
     * 
     */
    public $secret;

    public function __construct()
    {
        $this->baseuri = "http://localhost:83";
        $this->secret = "hVvOd70n30o1PFBAkE22af778b4dtlRQ";
        
    }    
    /**
 * obtain the full list of tdo from todo service
 * @return string
 * 
//  */
public function obtainTodos(){
    // return dd($this->baseuri);

    return $this->performRequest('GET',"/todos");
}

/**
 * Create one user usong todoservice
 * @return string
 * 
 */
public function createTodo($data){
    return $this->performRequest('POST','/todos',$data);
}
/**
 * obtain one user using todoservice
 * @return string
 * 
 */
public function obtainTodo($id){
    return $this->performRequest('GET',"/todos/{$id}");
}


/**
 * Update one user using the todoservice
 * @return string
 * 
 */
public function editTodo($data , $id){
    return $this->performRequest('PUT',"/todos/{$id}",$data);
}

 /**
 * Deleting one user using the todoservice
 * @return string
 * 
 */
public function deleteTodo($id){
    return $this->performRequest('DELETE',"/todos/{$id}");

}

}