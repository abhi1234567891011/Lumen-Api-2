<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //this is for https exception
        if($exception instanceof HttpException){
            //First get the status code by following method

            $code = $exception->getStatusCode();

            //now we can build the message using resopnse class
            //Response class has a static attribute($statusTexts) which is an array  which has as index for differnent http status code which has differnent error messages
            $message = Response::$statusTexts[$code];

            return $this->errorResponse($message,$code);
        }
        //this is for model not found exception which is for findOrFail() method.

        if($exception instanceof ModelNotFoundException){

            //fetch the model name
        //                         return class only    return model name with namespace
            $model = strtolower(class_basename($exception->getModel()));


            return $this->errorResponse("Does not exist any instance of {$model} with given id ",Response::HTTP_NOT_FOUND);

        }
        if($exception instanceof AuthorizationException){
            return $this->errorResponse($exception->getMessage(),Response::HTTP_FORBIDDEN);

        }
        if($exception instanceof AuthenticationException){
            return $this->errorResponse($exception->getMessage(),Response::HTTP_UNAUTHORIZED);

        }

        if($exception instanceof ValidationException){
            $errors = $exception->validator->errors()->getMessages();
            return $this->errorResponse($errors,Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        //If we are developing and App_DEBUG is set to true than we want detail error

        if(env('APP_DEBUG',false)){
            return parent::render($request,$exception);
        }

        //To user we will show this error

        $this->errorResponse('Unexpected error. Try later',Response::HTTP_INTERNAL_SERVER_ERROR);

        return parent::render($request, $exception);
        return parent::render($request, $exception);
    }
}
