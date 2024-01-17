<?php
use App\Models\User;
use App\Models\setPayment;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController; 
use App\Http\Controllers\PermissionController;  
use App\Http\Controllers\SetPaymentController;  
use App\Http\Controllers\RequisitionController; 
use App\Http\Controllers\FinanceController;
use App\Models\Requisition;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $users = User::where('role','!=','admin')->paginate(5);
    $request   = Requisition::where('status','=','approved')->where('applied_by','=',auth()->user()->email)->paginate(5);
    $requestP  = Requisition::where('status','=','pending')->where('applied_by','=',auth()->user()->email)->paginate(5);
    $requestD  = Requisition::where('status','=','decline')->where('applied_by','=',auth()->user()->email)->paginate(5);
    $requestA  = Requisition::where('status','=','approved')->paginate(5);
    $requestPA = Requisition::where('status','=','pending')->paginate(5);
    $requestDA = Requisition::where('status','=','decline')->paginate(5);
    
    
    $total= PaymentDetails::where('status','successful')->sum('amount');
    return view('dashboard',compact('users','total','request','requestP','requestD','requestA','requestPA','requestDA'));
})->middleware(['auth'])->name('dashboard');
     
Route::middleware(['auth','hasPermission'])->group(function () {
    Route::get('/profile',[MembershipController::class,'index'])->name('profile');
    Route::get('/notification/pagination/paginate-data',[NotificationController::class,'pagination']);
    Route::get('/notification/search',[NotificationController::class,'searchNotification'])->name('search.notification');
    Route::get('/notification',[NotificationController::class,'index'])->name('notification');
    Route::get('/message/view/{id}',[NotificationController::class,'viewMessage'])->name('message.view');
    Route::get('/getpayment/amount/{id}', [SetPaymentController::class, 'getpayment'])->name('getpayment');

    Route::get('/payment/view/{payment}', [PaymentController::class, 'view'])->name('payment.view');

    Route::get('/verify', [PaymentController::class, 'verify'])->name('verify');

    Route::post('/pay', [PaymentController::class, 'initialize'])->name('pay');
// The callback url after a payment
    Route::get('/rave/callback', [PaymentController::class, 'callback'])->name('callback');

    Route::get('/receipt/{id}', [MembershipController::class, 'receipt'])->name('receipt');
    Route::post('/application',[RequisitionController::class,'store'])->name('application.store');
    Route::post('/finance/store', [FinanceController::class, 'store'])->name('finance.store');
});

    Route::middleware(['auth','hasPermission'])->group(function () {
        
    Route::get('/profile',[MembershipController::class,'index'])->name('profile');
    Route::get('/members',[MembersController::class,'index'])->name('members');
    Route::get('/members/pagination/paginate-data',[MembersController::class,'pagination']);
    Route::get('/members/search',[MembersController::class,'searchMembers'])->name('members.search');
    
    Route::get('/member/edit/{member}',[MembersController::class,'edit'])->name('members.edit');
    Route::post('/member/update',[MembersController::class,'update'])->name('member.update');
    Route::post('/member/destroy',[MembersController::class,'destroy'])->name('member.destroy');
    Route::get('/member/profile/{member}',[MembersController::class,'viewProfile'])->name('members.profile');

    Route::get('/payments',[PaymentController::class,'index'])->name('payments');
    Route::get('/payment/search',[PaymentController::class,'paymentSearch'])->name('payment.search');
    Route::get('/payment/pagination/paginate-data',[PaymentController::class,'pagination']);
   
    Route::post('/payment/destroy', [SetPaymentController::class, 'destroy'])->name('payment.destroy');;
   
    Route::get('/messages',[MessageController::class,'index'])->name('messages');
    Route::get('/messages/pagination/paginate-data',[MessageController::class,'pagination']);
    Route::get('/messages/search',[MessageController::class,'searchMessage'])->name('search.message');
    Route::get('/message/create',[MessageController::class,'create'])->name('message.create');
    Route::post('/messages',[MessageController::class,'store'])->name('messages.store');

    Route::get('/settings',[SettingController::class,'index'])->name('settings');
    Route::get('/settings/pagination/paginate-data',[SettingController::class,'pagination']);
    Route::get('/settings/search',[SettingController::class,'searchSettings'])->name('search.settings');
    
    Route::post('/password/change',[SettingController::class,'changePassword'])->name('password.change');
    Route::post('/import/users', [UserApiController::class, 'import'])->name('users.import');

    Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/edit/{id}', [PermissionController::class, 'edit']);
    Route::post('/permission/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');

    Route::post('/setpayment/store', [SetPaymentController::class, 'store'])->name('setpayment.store');
    Route::post('/setpayment/destroy', [SetPaymentController::class, 'destroy'])->name('setpayment.destroy');
    Route::get('/setpayment/edit/{id}', [SetPaymentController::class, 'edit'])->name('setpayment.edit');
    Route::post('/setpayment/update', [SetPaymentController::class, 'update'])->name('setpayment.update');
   
    
});


    
require __DIR__.'/auth.php';
