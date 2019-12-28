<html>

@foreach($route_param_items as $route_param_item)

    //{{$route_param_item['var_name']}}
    Route::get('{{$route_param_item['var_name']}}/getById', 'Api\{{$route_param_item['model_name']}}Controller@getById');
    Route::get('{{$route_param_item['var_name']}}/getListByCon', 'Api\{{$route_param_item['model_name']}}Controller@getListByCon');
    Route::post('{{$route_param_item['var_name']}}/edit', 'Api\{{$route_param_item['model_name']}}Controller@edit');
    Route::post('{{$route_param_item['var_name']}}/deleteById', 'Api\{{$route_param_item['model_name']}}Controller@deleteById');

@endforeach

</html>