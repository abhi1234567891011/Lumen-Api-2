<?php

namespace App\Services;

use App\Traits\ApiResponser;
use App\Traits\ConsumesExternalService;

class UserService{

    // use ApiResponser;

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
        $this->baseuri = "localhost:81";
        $this->secret = "ARyyIjZMlBRDtLduGPdlw5yIhNOQ7tRh";
        
    }    
/**
 * obtain the full list of author from author service
 * @return string
 * 
//  */
    public function obtainUsers(){
        // return dd($this->baseuri);

        return $this->performRequest('GET',"/users");
    }

    /**
     * Create one user usong userservice
     * @return string
     * 
     */
    public function createUser($data){
        return $this->performRequest('POST','/users',$data);
    }
    /**
     * obtain one user using userservice
     * @return string
     * 
     */
    public function obtainUser($id){
        return $this->performRequest('GET',"/users/{$id}");
    }


    /**
     * Update one user using the userservice
     * @return string
     * 
     */
    public function editUser($data , $id){
        return $this->performRequest('PUT',"/users/{$id}",$data);
    }

     /**
     * Deleting one user using the userservice
     * @return string
     * 
     */
    public function deleteUser($id){
        return $this->performRequest('DELETE',"/users/{$id}");

    }
}