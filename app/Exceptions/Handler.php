<?php

namespace App\Exceptions;

use App\Components\Common\ApiResponse;
use App\Components\Common\Utils;
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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        Utils::errorLog($exception);   //添加此行代码
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $app_debug = env('APP_DEBUG');
        Utils::processLog(__METHOD__, '', " " . "app_debug:" . $app_debug);

        if ($app_debug == '1') {
            return parent::render($request, $exception);
        } else {
            $pathInfo = $request->getPathInfo();
            Utils::processLog(__METHOD__, '', " " . "getPathInfo:" . $pathInfo);
            $pathInfo = substr($pathInfo, 0, 4);
            Utils::processLog(__METHOD__, '', " " . "getPathInfo_jiequ:" . $pathInfo);
            if ($pathInfo == '/api') {
                if ($exception instanceof Exception) {
                    $data = (array)$exception;
                    Utils::errorLog($exception);   //添加此行代码
                    return ApiResponse::makeResponse(false, $data, ApiResponse::UNKNOW_ERROR);
                }
            } else {
                if ($exception instanceof Exception) {
                    Utils::processLog(__METHOD__, '', " " . "exception:" . json_encode($exception));
                    Utils::errorLog($exception);   //添加此行代码
                    return response()->view('admin.errors.error500', ['msg' => '业务出问题，请联系技术人员'], 500);
                }
            }

            return parent::render($request, $exception);
        }
    }
}
