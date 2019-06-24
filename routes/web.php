<?php
Route::group(['namespace' => 'Site'], function(){
    Route::get('/', 'SiteController@index');

    Route::get('/contato', 'SiteController@contato');
    Route::get('/contato2', 'SiteController@contato2');
    
    Route::get('/categoria/{idCat?}', 'SiteController@categoria');
    
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('products/teste', 'ProductController@teste');
    Route::resource('products', 'ProductController');
    
});


Route::get('/login', function(){
    return 'Login';
})->name('login');


// Route::group(['prefix' => '/admin'], function () {
//     Route::group(['middleware' => 'auth'], function () {
//         Route::get('/', function(){
//             return 'dashboard';
//         });
//         Route::get('/usuarios', function(){
//             return 'Gerenciamento de usuários';
//         });
//     });
//     Route::get('/produtos', function(){
//         return 'Gerenciamento de produtos';
//     });

// });




// Route::get('/query/{q?}', function($q=null){
//     return 'Buscando por:'.$q;
// });

// Route::get('/categoria/{idCat}/{idProd}', function($idCat, $idProd){
//     return 'Categoria com id='.$idCat.' Produto com id-'.$idProd;
// });

// Route::get('/categoria/{idCat?}', function($idCat=999){
//     return 'Categoria com id='.$idCat;
// });

// Route::get('/nome1/nome2/nome5', function(){
//     return 'rota grande';
// })->name('rota_grande');


// Route::any('/any', function () {
//     return 'any';
// });

// Route::match(['get', 'post'],'/match', function(){
//     return 'Rota match';
// });

// Route::get('/', function () {
//     return redirect()->route('rota_grande');
// });

// Route::get('/primeira_rota', function(){
//     return 'primeira rota';
// });

// Route::get('/empresa', function(){
//     return 'empresa';
// });

// Route::get('/contato', function(){
//     return 'contato';
// });
