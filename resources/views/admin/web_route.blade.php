<html>

@foreach($route_param_items as $route_param_item)

    //{{$route_param_item['var_name']}}
    Route::any('/{{$route_param_item['var_name']}}/index', 'Admin\{{$route_param_item['model_name']}}Controller@index');  //{{$route_param_item['var_name']}}首页
    Route::get('/{{$route_param_item['var_name']}}/edit', 'Admin\{{$route_param_item['model_name']}}Controller@edit');  //编辑{{$route_param_item['var_name']}}
    Route::post('/{{$route_param_item['var_name']}}/edit', 'Admin\{{$route_param_item['model_name']}}Controller@editPost');  //编辑{{$route_param_item['var_name']}}
    Route::get('/{{$route_param_item['var_name']}}/setStatus/{id}', 'Admin\{{$route_param_item['model_name']}}Controller@setStatus');  //设置{{$route_param_item['var_name']}}状态
    Route::post('/{{$route_param_item['var_name']}}/deleteById/{id}', 'Admin\{{$route_param_item['model_name']}}Controller@deleteById');  //删除{{$route_param_item['var_name']}}


@endforeach

</html>