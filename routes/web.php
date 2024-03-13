<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
    // Route::get('/payments', function () {
    //     $gateway = new Braintree\Gateway([
    //         'environment' => config('services.braintree.environment'),
    //         'merchantId' => config('services.braintree.merchantId'),
    //         'publicKey' => config('services.braintree.publicKey'),
    //         'privateKey' => config('services.braintree.privateKey')
    //     ]);
    
    //     $token = $gateway->ClientToken()->generate();
    
    //     return view('admin.payments', [
    //         'token' => $token
    //     ]);
    // });



    // Route::post('/checkout', function (Request $request) {
    //     $gateway = new Braintree\Gateway([
    //         'environment' => config('services.braintree.environment'),
    //         'merchantId' => config('services.braintree.merchantId'),
    //         'publicKey' => config('services.braintree.publicKey'),
    //         'privateKey' => config('services.braintree.privateKey')
    //     ]);
    
    //     $amount = $request->amount;
    //     $nonce = $request->payment_method_nonce;
    
    
    //     $result = $gateway->transaction()->sale([
    //         'amount' => $amount,
    //         'paymentMethodNonce' => $nonce,
    //         'options' => [
    //             'submitForSettlement' => true
    //         ]
    //     ]);
    
    //     if ($result->success) {
    //         $transaction = $result->transaction;
    //         // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
    //         return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    //     } else {
    //         $errorString = "";
    
    //         foreach ($result->errors->deepAll() as $error) {
    //             $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    //         }
    
    //         // $_SESSION["errors"] = $errorString;
    //         // header("Location: " . $baseUrl . "index.php");
    //         return back()->withErrors('An error occurred with the message: '.$result->message);
    //     }
    // });
Route::get('/transaction', function(){
    return view('transaction');
});

Route::get('/', function () {
    return redirect()->route('login');
    if (Auth::check()) {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        if (!$logged_user->doctor) {
            return view('welcome', compact('logged_user'));
        } else {
            // Recupera il dottore associato all'utente loggato.
            // Restituisce un array di lunghezza 1 (relazione one-to-one)
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
            $doctor = $doctors[0];

            return view('welcome', compact('doctor', 'logged_user'));
        }
    } else {
        $logged_user = Auth::user();
        return view('welcome', compact('logged_user'));
    }
});

// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('doctors', DoctorController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::get('/statistics/{year}', [StatisticController::class, 'index'])->name('statistics');
    // Route::resource('statistics', StatisticController::class);
    Route::resource('sponsorship', SponsorshipController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('transaction', TransactionController::class);
});

require __DIR__ . '/auth.php';
