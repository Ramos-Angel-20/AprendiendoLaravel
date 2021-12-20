<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Es buena practica ponerle un name a las rutas.
Route::get('/', function () {

    /*
        La función view tiene 2 parámetros, el primero en el nombre de la vista almacenada en la carpeta views que queremos
        renderizar, el segundo es un arreglo asociativo con datos que queremos pasarle a la vista.
        
        La función view por defecto busca las vistas dentro de la carperta resources/views/<nombre de la vista>,
        cuando usamos la nomenclatuta del punto (home.index) hacemos referencia a views/home/index.

    */

    return view('home.index', [
        'user' => 'Angel Ramos'
    ]);
})->name('home.index');

/*
    Otro método estatico que nos ofrece Route es view, este nos unicamente a renderizar una vista, ese es su único proposito,
    se una para vistas muy simples en nuestra aplicación.
*/


Route::get('/contact', function() {
    return view('home.contact');
})->name('home.contact');

/*
    Cuando pasamos un parámetro dinámico a una url lo hacemos mediante {}, el listado de parámetros lo recibe la función
    asociada a la ruta, esto es forma posicional, por lo que el nombre del parámetro no necesita ser igual a como esta en la
    ruta.

    El hecho de agregar un parámetro de esta forma lo hace obligatorio para la ruta.

    Podemos usar la función where para restringuir los valores que podemos recibir en los parametros de nuestr ruta, esta función
    recibe por parámetro un arreglo asociativo donde cada key hace referencia a un parámetro de ruta y su valor es una expresión 
    regular que se usara para restringuir ese parámetro.
*/
// Route::get('/posts/{id}', function($postId) {
//     return 'Post ' . $postId;
// })->name('post.find')->where([
//     'id' => '[0-9]+'
// ]);

$posts = [
    1 => [
        'title' => 'intro to laravel',
        'content' => 'This is a short intro to laravel',
        'isNew' => true
    ],
    2 => [
        'title' => 'intro to PHP',
        'content' => 'This is a short intro to PHP',
        'isNew' => false    
    ]
];


/*
    Como php es una mamada bien rara tenemos que usar la función use() despúes de la funcion anonima y pasarle las variblaes que vamos a
    utilizar desde fuera de la ruta (declaradas fuera de la ruta), no funciona solo con el scope.
*/
Route::get('/posts', function() use($posts) {
    
    return view('posts.index', [
        'posts' => $posts
    ]);

})->name('posts.index');

Route::get('/posts/{id}', function($postId) use($posts) {
    /*
        abort_if() es una función de Laravel que nos ayuda a mandar una excepción http si una condición se cumple, todo esto antes de llegar
        a la vista para evitar errores.
    */
    abort_if(!isset($posts[$postId]), 404);

    return view('posts.show', [
        'post' =>  $posts[$postId]
    ]);
})->name('post.find');

/*
    Podemos definir parámetros opcionales en nuestras rutas, esto se hace de la misma forma que con los parámetros obligatorios,
    con la diferencia de que al final del nombre del páramtro agregamos un signo de interrogación para indicar que es opcional.

    En la función que recibe este parámetro opcional tenemos que definir un valor por defecto, de lo contrario tendremos un error.
*/
Route::get('/recent-posts/{days_ago?}', function($daysAgo = 1) {
    return 'Posted ' . $daysAgo . ' days ago';
})->name('post.find_ago');


