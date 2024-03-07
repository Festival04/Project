<?php
// 02.2024 Artur Z (HUSKI3@GitHub)

use Illuminate\Support\Facades\Route;


include_once(__DIR__ . "/../resources/nophp/core.php");
include_once(__DIR__ . "/../resources/nophp/mixins.php");

/*
|--------------------------------------------------------------------------
| NoPHP based Routes
|--------------------------------------------------------------------------
|
| These routes are special since they utilize the responses from the nophp
| interpreter. NoPHP has 0% difference when compared to PHP in basic functionality
| and can run PHP code...
| 
| You can find more infomration about what NoPHP is over at https://testing.lonk.cloud/docs
|
*/
global $nophp;


$nophp = new NoPHP("nophp-app:8081");

Route::get('/nophp', $nophp->snappy("/", [new TailwindMixin]));

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| The above is from laravel and does not apply to NoPHP morphed routes.
| During the morph, you can register NoPHP Mixins, in this example case
| we register a TailwindMixin.
|
*/

Route::get('/', function () {
    // Get the index content from NoPHP
    global $nophp;
    $page = new Page("NoPHP", "TailwindMixin Example", $nophp->new_resource("/"));

    // Get the content from the page
    $content = $page->render();

    return Page::from_view(
        view('welcome', ["nophp_index" => $content])
    )->render([new TailwindMixin]); // Add tailwind css
});
