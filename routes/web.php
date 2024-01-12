<?php
namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Enquete;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $enqueteDb = Enquete::all();

    return view('welcome',compact('enqueteDb'));
})->name('home');
//Rotas para o crud(gerenciamento das enquetes)
Route::prefix('enquete')->group(function () {
    Route::get('/criar', function () {
        return view('enquete.create');
    })->name('create.enquete');
    Route::post('/store', [EnqueteController::class, 'store'])->name('enquete.store');

    Route::get('/editar/{enquete_id}', function ($enquete_id) {
        $edit=Enquete::where('id',$enquete_id)->first();
        
        return view('enquete.edit',compact('enquete_id','edit'));
    })->name('enquete.edit');

    Route::patch('/modificar/{enquete_id}', [EnqueteController::class, 'update'])->name('enquete.update');
    Route::delete('/deletar/{enquete_id}', [EnqueteController::class, 'destroy'])->name('enquete.destroy');
});
//Rota para apresentação e votação
Route::get('/apresentacao', [EnqueteController::class, 'show'])->name('enquete.show');
Route::post('/store/{enquete_id}', [OpcaoRespostaController::class, 'store'])->name('enquete.resp');
require __DIR__.'/auth.php';
