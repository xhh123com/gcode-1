<?php

namespace App\Http\Middleware;

use App\Components\Common\Utils;
use App\Components\UserLoginManager;
use App\Components\UserManager;
use App\Components\XcxFormIdManager;
use App\Components\Common\ApiResponse;
use App\Models\XcxFormId;
use Closure;


class RecordFormId
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $request->all();
        if (array_key_exists('form_id', $data) && !Utils::isObjNull($data['form_id'])
            && array_key_exists('user_id', $data) && !Utils::isObjNull($data['user_id'])) {
            $xcx_formId = new XcxFormId();
            $xcx_formId->user_id = $data['user_id'];
            $xcx_formId->form_id = $data['form_id'];
            $xcx_formId->save();
        }

        return $next($request);

    }
}
