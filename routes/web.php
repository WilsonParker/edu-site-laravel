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

Auth::routes();

Route::namespace('Home')->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
});

Route::namespace('Auth')->prefix('auth')->name('auth.')->group(function () {
    Route::get('/', 'AuthController@index')->name('index');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::namespace('Members')->group(function () {
    Route::prefix('members')->name('members.')->group(function () {
        Route::redirect('/', '/members/lectures/learning')->name('index');
        Route::get('/create', 'MemberController@create')->name('create');
        Route::get('/create2', 'MemberController@create2')->name('create2');
        Route::get('/create3', 'MemberController@create3')->name('create3');
        Route::get('/create4', 'MemberController@create4')->name('create4');
        Route::get('/payments', 'MemberController@payments')->name('payments');

        Route::prefix('lectures')->name('lectures.')->group(function () {
            Route::get('/learning', 'LectureController@learning')->name('learning');
            Route::get('/ended', 'LectureController@ended')->name('ended');
            Route::get('/detail/{lecture}', 'LectureController@detail')->name('detail');
            Route::get('/before/play/{program}/{class}', 'LectureController@beforePlay')->name('before.play');
            Route::get('/play/{program}/{class}', 'LectureController@play')->name('play');
            Route::get('/playing/{history}', 'LectureController@playing')->name('playing');
        });

        Route::prefix('edit')->name('edit.')->group(function () {
            Route::get('/', 'MemberController@edit')->name('index');
            Route::get('/password', 'MemberController@editPassword')->name('password');
            Route::put('/password', 'MemberController@updatePassword')->name('password');
        });
        Route::put('/', 'MemberController@update')->name('update');
        Route::get('/delete', 'MemberController@deleteMember')->name('delete');

        Route::prefix('carts')->name('carts.')->group(function () {
            Route::delete('/deletes', 'CartController@deletes')->name('deletes');
        });
        Route::resource('carts', 'CartController')->only(['index', 'store', 'destroy']);

        Route::prefix('coupons')->name('coupons.')->group(function () {
            Route::get('/', 'CouponController@index')->name('index');
            Route::post('use', 'CouponController@useCoupon')->name('use');
        });
    });
    Route::resource('members', 'MemberController')->except(['index', 'edit', 'update', 'destroy']);
});

Route::namespace('Lectures')->group(function () {
    Route::prefix('lectures')->name('lectures.')->group(function () {
        Route::get('search', 'LectureController@search')->name('search');
        Route::get('preview/{id}', 'LectureController@preview')->name('preview');

        Route::get('otp', 'CertificationController@otp')->name('otp');
        Route::get('otp/complete', 'CertificationController@complete')->name('otp.complete');

        Route::prefix('exams')->name('exams.')->group(function () {
            Route::get('{type}/{program}/agree', 'ExamController@agree')->name('agree');
            Route::post('{type}/{program}/agree', 'ExamController@agreeSubmit')->name('agree.submit');

            Route::get('{type}/{program}', 'ExamController@exam')->name('exam');
            Route::post('{type}/{program}', 'ExamController@examStore')->name('store');
            Route::get('{type}/{program}/submit', 'ExamController@examSubmit')->name('submit');

            /*
            Route::get('middle/{program}', 'MiddleExamController@exam')->name('middle');
            Route::prefix('middle')->name('middle.')->group(function () {
                Route::get('{program}/agree', 'MiddleExamController@agree')->name('agree');
                Route::post('{program}/agree', 'MiddleExamController@agreeSubmit')->name('agree.submit');

                Route::post('{program}', 'MiddleExamController@examStore')->name('store');
                Route::get('{program}/submit', 'MiddleExamController@examSubmit')->name('submit');
            });*/
        });

        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/normal', 'PaymentController@normal')->name('normal');
            Route::get('/cart', 'PaymentController@cart')->name('cart');
            Route::get('/nbc', 'PaymentController@nbc')->name('nbc');

            Route::post('/ready', 'PaymentController@paymentReady')->name('ready');
            Route::post('/paid', 'PaymentController@paymentPaid')->name('paid');
            Route::post('/hooks', 'PaymentController@hooks')->name('hooks');
        });
    });
    Route::resource('lectures', 'LectureController');
});

Route::namespace('Pages')->prefix('pages')->name('pages.')->group(function () {
    Route::prefix('nbc')->name('nbc.')->group(function () {
        Route::redirect('/', '/pages/nbc/1')->name('index');
        Route::get('/1', 'PageController@nbcPage1')->name('1');
        Route::get('/2', 'PageController@nbcPage2')->name('2');
        Route::get('/3', 'PageController@nbcPage3')->name('3');
        Route::get('/4', 'PageController@nbcPage4')->name('4');
        Route::get('/training', 'PageController@nbcPageTraining')->name('training');
        Route::get('/card', 'PageController@nbcPageCard')->name('card');
    });

    Route::prefix('business')->name('business.')->group(function () {
        Route::redirect('/', '/pages/business/1')->name('index');
        Route::get('/1', 'PageController@businessPage1')->name('1');
        Route::get('/2', 'PageController@businessPage2')->name('2');
        Route::get('/3', 'PageController@businessPage3')->name('3');
        Route::get('/4', 'PageController@businessPage4')->name('4');
        Route::get('/training', 'PageController@businessPageTraining')->name('training');
        Route::get('/refunds', 'PageController@businessPageRefunds')->name('refunds');
    });
});

Route::namespace('Courses')->prefix('course')->name('course.')->group(function () {
    Route::get('/', 'CourseController@index');
});

Route::namespace('Boards')->group(function () {
    Route::prefix('board')->name('board.')->group(function () {
        Route::get('/faq', 'BoardController@faq')->name('faq');
        Route::get('/manual', 'BoardController@manual')->name('manual');
        Route::get('/ncs_guide/{board}', 'BoardController@ncs_guide')->name('ncs_guide');

        Route::prefix('careful')->name('careful.')->group(function () {
            Route::redirect('/', '/board/careful/1')->name('index');
            Route::get('/1', 'BoardController@carefulPage1')->name('1');
            Route::get('/2', 'BoardController@carefulPage2')->name('2');
            Route::get('/3', 'BoardController@carefulPage3')->name('3');
            Route::get('/4', 'BoardController@carefulPage4')->name('4');
        });
    });

    Route::resource('board', 'BoardController')->only(['index', 'show']);
});

Route::namespace('Qna')->middleware('auth:web')->group(function () {
    Route::prefix('qna')->name('qna.')->group(function () {

    });

    Route::resource('qna', 'QnaController');
});

Route::get('download/{resource}', 'BaseController@download')->name('download');

Route::get('404', 'ErrorController@notFound')->name('404');
Route::get('500', 'ErrorController@internalServerError')->name('500');
