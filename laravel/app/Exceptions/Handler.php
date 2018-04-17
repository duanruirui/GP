<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        
public function render($request, Exception $exception)
{
        // 刷新Token过期之自定义错误  www.firstphp.com 
        if ($exception-&amp;amp;gt;getCode() == 401) {
        return Response::json(['status' = false, 'msg' = 'The refresh token is invalid', 'code' = 401]);
        }
         
        // Token过期之自定义错误  www.firstphp.com
        if($exception-&amp;amp;gt;getMessage() == 'Unauthenticated.'){
        // return redirect('login');
        return Response::json(['status' = false, 'msg' = 'Unauthenticated', 'code' = 40001]);
        }
        
        return parent::render($request, $exception);
    }
}
