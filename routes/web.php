<?php

use App\Http\Controllers\DashboardController;
use App\Models\User\Role;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
include 'features/profile.php';
include 'features/user.php';
include 'features/role.php';
include 'features/email.php';
include 'features/color.php';
include 'features/scam-status.php';
include 'features/scam-category.php';
include 'features/webhook.php';
include 'features/subscriber.php';
include 'features/scam.php';
