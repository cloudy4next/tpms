<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/cache_clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    //    header("Cache-Control: no-cache, must-revalidate");
    //    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    //    header("Content-Type: application/xml; charset=utf-8");

});

Route::get('/session-update-command', function () {
    Artisan::call('quote:updatereminder');
});

Route::get('/view_clear', function () {
    Artisan::call('view:clear');
});
Route::get('/config_clear', function () {
    Artisan::call('config:cache');
});
Route::get('/route_clear', function () {
    Artisan::call('route:clear');
});


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::get('/', [\App\Http\Controllers\Auth\CustomLoginController::class, 'user_login'])->name('user.login');
Route::post('/custom-login-submit', [\App\Http\Controllers\Auth\CustomLoginController::class, 'custom_login_submit'])->name('user.custom.login.submit');
Route::get('/admin-logout', [\App\Http\Controllers\Auth\CustomLoginController::class, 'superadmin_logout'])->name('superadmin.logout');

Route::get('/create-superadmin', [\App\Http\Controllers\Auth\CustomLoginController::class, 'create_superadmin'])->name('create.superadmin');
Route::get('/create-admin', [\App\Http\Controllers\FrontendController::class, 'create_admin'])->name('create.admin');


Route::get('/demo-route', [\App\Http\Controllers\FrontendController::class, 'demo_route'])->name('demo.send');
Route::get('/send-sms', [\App\Http\Controllers\FrontendController::class, 'send_sms'])->name('send.sms');
Route::get('/send-voice-mail', [\App\Http\Controllers\FrontendController::class, 'send_voice_mail'])->name('send.voice.mail');

Route::get('/privacy-policy', [\App\Http\Controllers\FrontendController::class, 'privacy_policy'])->name('privacy.policy');


//delete all record
Route::get('/delete-all-record', [\App\Http\Controllers\VisitorController::class, 'delete_all_record']);

//update record for text
Route::get('/amromed-test', [\App\Http\Controllers\VisitorController::class, 'test_url']);
Route::post('/update-record-for-test', [\App\Http\Controllers\VisitorController::class, 'update_record_for_text'])->name('update.test.data');


//forgot password
Route::get('/forgot-password', [\App\Http\Controllers\FrontendController::class, 'forgot_password'])->name('user.forgot.password');
Route::post('/forgot-password-email-submit', [\App\Http\Controllers\FrontendController::class, 'forgot_password_email_submit'])->name('user.forgot.password.email.submit');
Route::get('/forgot-password-code-check', [\App\Http\Controllers\FrontendController::class, 'forgot_password_enter_code'])->name('user.forgot.password.enter.code');
Route::post('/forgot-password-code-submit', [\App\Http\Controllers\FrontendController::class, 'forgot_password_code_submit'])->name('user.forgot.password.code.submit');
Route::get('/change-password/{url}', [\App\Http\Controllers\FrontendController::class, 'forgot_password_change_password'])->name('user.forgot.password.change.password');
Route::post('/change-password-submit', [\App\Http\Controllers\FrontendController::class, 'forgot_password_change_password_submit'])->name('user.forgot.password.change.password.submit');


//provider access email
Route::get('/account-setup/{token}', [\App\Http\Controllers\VisitorController::class, 'account_setup'])->name('access.email.add.password');
Route::post('/provider-account-setup', [\App\Http\Controllers\VisitorController::class, 'account_password_setup'])->name('provider.account.pass.setup');

//client access email
Route::get('/patient-account-setup/{token}', [\App\Http\Controllers\VisitorController::class, 'patient_account_setup'])->name('patient.access.email.add.password');
Route::post('/patient-account-setup', [\App\Http\Controllers\VisitorController::class, 'patient_account_password_setup'])->name('patient.account.pass.setup');

//staff reset password
Route::get('/staff-reset-password-view/{token}', [\App\Http\Controllers\VisitorController::class, 'staff_reset_password_view'])->name('reset.password.link');
Route::post('/staff-reset-password-by-link', [\App\Http\Controllers\VisitorController::class, 'staff_reset_password_by_link'])->name('staff.reset.password.by.link');


//Lockscreen
Route::get('/locked-screen/{user_id}', [\App\Http\Controllers\VisitorController::class, 'do_locked'])->name('user.login.locked');
Route::get('/locked/{token}', [\App\Http\Controllers\VisitorController::class, 'locked'])->name('user.show.login.locked');
Route::post('login/locked', [\App\Http\Controllers\VisitorController::class, 'unlock'])->name('user.login.unlock');


Route::group(['middleware' => ['auth:admin', 'onlineStatus']], function () {
    Route::prefix('admin')->group(function () {

        Route::get('/', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'index'])->name('superadmin.dashboard')->middleware('adminPage:1');
        //Dashboard 2
        Route::get('/dashboard', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'index2'])->name('superadmin.dashboard2')->middleware('adminPage:10');

        //Profile

        Route::get('/profile', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'profile'])->name('superadmin.profile');
        Route::post('/profile-personal-update', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'personal_update'])->name('superadmin.profile.personal.update');
        Route::post('/profile-email-update', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'email_update'])->name('superadmin.profile.email.update');
        Route::post('/profile-contact-update', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'contact_update'])->name('superadmin.profile.contact.update');
        Route::post('/profile-password-verify', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'verify_password'])->name('superadmin.profile.verify.password');
        Route::post('/profile-password-update', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'password_update'])->name('superadmin.profile.password.update');
        Route::get('/account-change-password', [\App\Http\Controllers\Superadmin\SuperAdminController::class, 'account_chnage_password'])->name('superadmin.profile.change.password');

        //dashboard charts
        Route::post('/dashboard-barchart1', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'barchart1'])->name('superadmin.dashboard.barchart1');
        Route::post('/dashboard-linechart', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'linechart'])->name('superadmin.dashboard.linechart');
        Route::post('/dashboard-barchart2', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'barchart2'])->name('superadmin.dashboard.barchart2');


        //dashboard data
        Route::get('/auth-to-expire', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'auth_to_expire'])->name('superadmin.auth.to.expire');
        Route::post('/auth-to-expire-get', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'auth_to_expire_get'])->name('superadmin.auth.to.expire.get');
        Route::get('/non-payor-tag', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'non_payor_tag'])->name('superadmin.non.payor.tag');
        Route::get('/no-authorization', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'without_plan_care'])->name('superadmin.no.authorization');
        Route::get('/todays-copay', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'todays_copay'])->name('superadmin.todays.copay');
        Route::get('/session-not-bulled', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'session_not_bulled'])->name('superadmin.home.session.not.bullied');
        Route::get('/last-weeks-deposit', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'last_weeks_deposit'])->name('superadmin.last.five.deposit');
        Route::get('/last-five-statement', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'last_five_statement'])->name('superadmin.last.five.statement');
        Route::get('/auth-place-holder', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'auth_place_holder'])->name('superadmin.home.auth.placeholder');

        //dashboard staff
        Route::get('/vacation-pending', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'vacation_pending'])->name('superadmin.vacation.pending');
        Route::get('/missing-credentials', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'missing_credentials'])->name('superadmin.home.missing.credntials');
        Route::get('/credentials-expire', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'credentials_expire'])->name('superadmin.credntials.expire');
        Route::post('/credentials-expire-get', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'credentialsExpireGet'])->name('superadmin.credntials.expire.get');

        Route::get('/signatire-not-update', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'sinature_not_upload'])->name('superadmin.singature.not.upload');

        Route::post('/signatire-get-payor', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'get_all_payor'])->name('superadmin.signature.get.all.payor');
        Route::post('/signatire-fetch-data', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'fetch_signature_upload_data'])->name('superadmin.signature.fetch.data');


        //last month bulled data
        Route::get('/last-month-billed-dated', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'last_month_bulled_data'])->name('superadmin.last.month.dates');
        Route::post('/last-month-billed-dated-get', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'last_month_bulled_data_get'])->name('superadmin.last.month.dates.get');
        Route::post('/last-month-billed-dated-filter', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'last_month_bulled_data_filter'])->name('superadmin.last.month.dates.filter');
        Route::post('/last-month-billed-dated-details', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'last_month_bulled_data_details'])->name('superadmin.last.month.dates.details');
        Route::post('/last-month-billed-dated-export', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'last_month_bulled_data_export'])->name('superadmin.last.month.dates.export');


        Route::get('/scheduled-not-rendered', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'scheduled_not_rendered'])->name('superadmin.scheduled.not.renderes');
        Route::get('/scheduled-not-attended-last-week', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'scheduled_not_attended_last_week'])->name('superadmin.scheduled.not.atten.lastweek');
        Route::get('/session-note-missing', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'session_note_missing'])->name('superadmin.session.note.missing');
        Route::get('/cancelled-sesstion', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'cancelled_session'])->name('superadmin.cancelled.session');
        Route::get('/provider-singatire-missing-sessions', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'prov_missing_sign_sess'])->name('superadmin.home.provider.missing.sign');
        Route::get('/schedula-billable', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'schedule_billable'])->name('superadmin.home.schedule.billable');
        Route::get('/payment-deposit', [\App\Http\Controllers\Superadmin\SuperAdminDashboardController::class, 'payment_deposit'])->name('superadmin.home.payment.deposit');


        //edi data
        Route::get('/send-edi', [\App\Http\Controllers\Superadmin\SuperAdmiEdiController::class, 'edi_data'])->name('superadmin.edi.data');
        Route::get('/claim-edi/{id}', [\App\Http\Controllers\Superadmin\SuperAdmiEdiController::class, 'claim_edi_by_id'])->name('superadmin.claim.show.edi.single');

        //callender data
        Route::get('/calender-view', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender'])->name('superadmin.calender.view')->middleware('adminPage:2');
        Route::post('/calender-view-data', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_submit'])->name('superadmin.calender.view.submit');
        Route::get('/calender-get-data', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_data'])->name('superadmin.get.calender.data');
        Route::post('/calender-get-data-update', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_data_update'])->name('superadmin.get.calender.data.update');
        Route::post('/calender-get-data-single', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_data_single'])->name('superadmin.get.calender.data.single');
        Route::post('/calender-get-data-drop-single', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_data_drop_single'])->name('superadmin.get.calender.data.dropupdate');
        Route::get('/calender-get-data-sync', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_data_sunc'])->name('superadmin.calender.sync');
        Route::get('/calender-get-redirect', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_redirect'])->name('user.integration.authorize_google_calendar');
        Route::post('/calender-session-create-new', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_session_create_new'])->name('superadmin.calender.session.createnew');

        //calender data filter
        Route::get('/calender-get-data-filter', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_data_filter'])->name('superadmin.get.calender.data.filter');

        //calender master data
        Route::post('/calender-get-all-client', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_all_client'])->name('superadmin.calender.get.all.client');
        Route::post('/calender-get-all-employee', [\App\Http\Controllers\Superadmin\SuperAdmiCalenderController::class, 'calender_get_all_employee'])->name('superadmin.calender.get.all.empoyee');


        //superadmin session
        Route::get('/session-manage', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'manage_session'])->name('superadmin.manage.session')->middleware('adminPage:2');
        Route::get('/session-note-manage/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_note_create'])->name('superadmin.create.note');
        Route::post('/session-note-create-save', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_note_create_save'])->name('superadmin.create.note.save');
        Route::get('/session-note-view/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_note_view'])->name('superadmin.session.note.view.data');
        Route::post('/session-client-get-all', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'session_client_get_all'])->name('superadmin.get.session.client.all');
        Route::post('/session-client-authorization-get', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'session_client_authorization_get'])->name('superadmin.get.session.client.authorization');
        Route::post('/session-get-template-name', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_get_template_name'])->name('superadmin.get.appoinment.templatename');
        Route::post('/session-template-notes', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_note_open'])->name('superadmin.session.note.form.open');
        Route::post('/session-created-template-notes', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_created_template_name'])->name('superadmin.get.appoinment.created.templatename');
        Route::post('/session-created-template-notes-open', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_created_template_open'])->name('superadmin.session.note.createdform.open');
        Route::post('/session-created-template-notes-open', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_created_template_open'])->name('superadmin.session.note.createdform.open');
        Route::post('/session-created-template-notes-open', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'session_created_template_open'])->name('superadmin.session.note.createdform.open');


        //sesstion note submit
        Route::post('/usp-form-one-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'usp_form_one_submit'])->name('superadmin.usp.form.one.submit');
        Route::post('/usp-form-one-by-ajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'usp_form_one_by_ajax'])->name('superadmin.usp.form.one.by.ajax');
        Route::post('/dsptn-form-two-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'sdptn_form_two_submit'])->name('superadmin.dsptn.two.form.submit');
        Route::post('/dsptn-form-two-by-ajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'sdptn_form_two_by_ajax'])->name('superadmin.dsptn.two.by.ajax');
        Route::post('/btsmf-form-three-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'btsmf_form_three_submit'])->name('superadmin.btsmf.three.form.submit');
        Route::post('/btusf-form-four-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'btusf_form_four_submit'])->name('superadmin.btusf.form.four.submit');
        Route::post('/msn-form-five-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'msn_form_five_submit'])->name('superadmin.msn.five.form.submit');
        Route::post('/tcsn-form-six-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'tcsn_form_six_submit'])->name('superadmin.tcsn.six.form.submit');

        Route::post('/form-7-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_7_submit'])->name('superadmin.7.form.submit');
        Route::post('/form-7-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_7_byajax'])->name('superadmin.7.form.by.ajax');


        Route::post('/tp-form-edight-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'tp_form_eight_submit'])->name('superadmin.tp.eight.form.submit');

        Route::post('/form-9-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_9_submit'])->name('superadmin.9.form.submit');
        Route::post('/form-9-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_9_byajax'])->name('superadmin.9.form.by.ajax');

        Route::post('/form-10-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_10_submit'])->name('superadmin.10.form.submit');
        Route::post('/form-10-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_10_byajax'])->name('superadmin.10.form.by.ajax');


        Route::post('/cn-form-eleven-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'cn_form_eleven_submit'])->name('superadmin.sn.eleven.form.submit');
        Route::post('/cn-form-eleven-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'cn_form_eleven_byajax'])->name('superadmin.sn.eleven.form.by.ajax');

        Route::post('/form-12-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_12_submit'])->name('superadmin.12.form.submit');
        Route::post('/form-12-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_12_byajax'])->name('superadmin.12.form.by.ajax');

        Route::post('/form-13-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_13_submit'])->name('superadmin.13.form.submit');
        Route::post('/form-13-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_13_byajax'])->name('superadmin.13.form.by.ajax');

        Route::post('/form-14-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_14_submit'])->name('superadmin.14.form.submit');
        Route::post('/form-14-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_14_byajax'])->name('superadmin.14.form.by.ajax');

        Route::post('/form-15-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_15_submit'])->name('superadmin.15.form.submit');
        Route::post('/form-15-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_15_byajax'])->name('superadmin.15.form.by.ajax');

        Route::post('/form-16-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_16_submit'])->name('superadmin.16.form.submit');
        Route::post('/form-16-byajax', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_16_byajax'])->name('superadmin.16.form.by.ajax');

        Route::post('/form-17-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_17_submit'])->name('superadmin.17.form.submit');
        Route::post('/form-18-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_18_submit'])->name('superadmin.18.form.submit');
        Route::post('/form-19-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_19_submit'])->name('superadmin.19.form.submit');
        Route::post('/form-20-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_20_submit'])->name('superadmin.20.form.submit');
        Route::post('/form-21-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_21_submit'])->name('superadmin.21.form.submit');
        Route::post('/form-22-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_22_submit'])->name('superadmin.22.form.submit');
        Route::post('/form-23-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_23_submit'])->name('superadmin.23.form.submit');
        Route::post('/form-24-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_24_submit'])->name('superadmin.24.form.submit');
        Route::post('/form-25-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_25_submit'])->name('superadmin.25.form.submit');
        Route::post('/form-26-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_26_submit'])->name('superadmin.26.form.submit');
        Route::post('/form-27-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_27_submit'])->name('superadmin.27.form.submit');
        Route::post('/form-28-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_28_submit'])->name('superadmin.28.form.submit');
        Route::post('/form-29-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_29_submit'])->name('superadmin.29.form.submit');
        Route::post('/form-30-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_30_submit'])->name('superadmin.30.form.submit');
        Route::post('/form-60-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_60_submit'])->name('superadmin.60.form.submit');
        Route::post('/form-61-submit', [\App\Http\Controllers\Superadmin\SuperAdminSessionNoteController::class, 'form_61_submit'])->name('superadmin.61.form.submit');

        //client
        Route::post('/create-patient', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'create_client'])->name('superadmin.create.client');
        Route::get('/patient-list', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_list'])->name('superadmin.client.list')->middleware('adminPage:3');
        Route::post('/patient-list-get', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_list_get'])->name('superadmin.clients.list.get');
        Route::get('/patient-list-get', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_list_get_ajax']);
        Route::post('/patient-list-get-search', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_list_get_search'])->name('superadmin.clients.list.get.search');
        Route::post('/patient-list-update-active', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_list_update_active'])->name('superadmin.clients.list.update.active');


        Route::get('/patient-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_delete'])->name('superadmin.client.delete');
        Route::get('/patient-make-inactive/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_make_inactive'])->name('superadmin.client.make.inactive');
        Route::get('/patient-make-active/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_make_active'])->name('superadmin.client.make.active');

        //client info
        Route::get('/patient-info/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_info'])->name('superadmin.client.info');
        Route::post('/patient-info-update', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_info_update'])->name('superadmin.client.info.update');
        Route::post('/patient-exists-phone-delete', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_exists_client_phon_delete'])->name('superadmin.delete.exist.client.phone');
        Route::post('/patient-exists-email-delete', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_exists_client_email_delete'])->name('superadmin.delete.exist.client.email');
        Route::post('/patient-exists-address-delete', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_exists_client_address_delete'])->name('superadmin.delete.exist.client.address');
        Route::post('/patient-sing-delete', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_sing_delete'])->name('superadmin.client.sing.delete');

        //client billing
        Route::get('/patient-billing/{clientid}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_billing'])->name('superadmin.client.billing');
        Route::post('/patient-billing-update', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_billing_update'])->name('superadmin.client.billing.update');

        //client portal
        Route::get('/patient-portal/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_portal'])->name('superadmin.client.portal');
        Route::post('/patient-portal-save', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_portal_save'])->name('superadmin.client.portal.save');
        Route::post('/patient-portal-send-invitation', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_portal_send_invitation'])->name('superadmin.client.portal.send.invitaion');

        //client ledger
        Route::get('/patient-ledger/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_ledger'])->name('superadmin.client.ledger');
        Route::post('/patient-ledger-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'client_ledger_get'])->name('superadmin.client.ledger.get');
        Route::get('/patient-ledger-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'client_ledger_get_next']);

        //client ledger transaction
        Route::post('/patient-ledger-transaction-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'client_ledger_transaction_get'])->name('superadmin.client.ledger.get.transaction');

        //client activity
        Route::get('/patient-activity/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_activity'])->name('superadmin.client.activity');


        //client authorization
        Route::get('/patient-authorization/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization'])->name('superadmin.client.authorization');
        Route::get('/patient-authorization-create/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_create'])->name('superadmin.client.authorization,create');
        Route::post('/patient-authorization-save', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_save'])->name('superadmin.client.authorization.save');
        Route::get('/patient-authorization-edit/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_edit'])->name('superadmin.client.authorization.edit');
        Route::post('/patient-authorization-fetch-subactivity', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'fetch_subactivity'])->name('superadmin.client.authorization.fetch.subactivity');
        Route::post('/patient-authorization-update', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_update'])->name('superadmin.client.authorization.update');
        Route::get('/patient-authorization-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_delete'])->name('superadmin.client.authorization.delete');

        Route::post('/patient-contactrate-copy-authorization', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_contact_rate_copy_authorization'])->name('superadmin.copy.contact.rate');
        Route::post('/patient-check-has-secondary', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_check_has_secondary'])->name('superadmin.check.auth.has.secondary');

        //client activity
        Route::post('/patient-authorization-activity-save', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_activity_save'])->name('superadmin.client.authorization.ativity.save');
        Route::post('/patient-authorization-activity-update', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_activity_update'])->name('superadmin.client.authorization.ativity.update');
        Route::get('/patient-authorization-activity-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_authorization_activity_delete'])->name('superadmin.client.authorization.ativity.delete');

        //get subtype by tx
        Route::post('/get-service-by-tx-type', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'get_service_tx_type'])->name('superadmin.get.service.by.tx');
        Route::post('/get-subtype-by-tx-type', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'get_sub_type_tx_type'])->name('superadmin.get.subtype.by.tx');
        Route::post('/get-cptcodes-by-tx-type', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'get_cpt_codes_tx_type'])->name('superadmin.get.cpt.codes.by.tx');
        Route::post('/get-authdata-by-act', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'get_authdata_by_act'])->name('superadmin.get.authdata.by.act');


        //client document
        Route::get('/patient-document/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_document'])->name('superadmin.client.documents');
        Route::post('/patient-document-upload', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_document_upload'])->name('superadmin.client.upload.document');
        Route::post('/patient-document-update', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_document_update'])->name('superadmin.client.document.update');
        Route::get('/patient-document-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminClientController::class, 'client_document_delete'])->name('superadmin.client.document.delete');


        //appoinment section
        Route::post('/get-all-client', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'get_all_client'])->name('superadmin.get.all.client');
        Route::post('/get-all-employee', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'get_all_employee'])->name('superadmin.get.all.employee');
        Route::post('/get-single-client', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'get_single_client'])->name('superadmin.appoinment.client.get');
        Route::post('/client-authorization-by-client-id', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'get_authorization_by_client'])->name('superadmin.appoinment.autho.get');
        Route::post('/client-authorization-activity-by-auth-id', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'get_authorization_activity_by_auth_id'])->name('superadmin.appoinment.autho.activity.get');
        Route::post('/client-authorization-activity-all', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'get_authorization_activity_all'])->name('superadmin.appoinment.autho.activity.get.all');
        Route::post('/get-all-provider', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'get_all_provider'])->name('superadmin.get.all.provider');
        Route::post('/appoinement-save', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'appoinement_save'])->name('superadmin.appoinment.save');

        //appoinment billable data
        Route::post('/appoinement-get-data', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'appoinement_get_date'])->name('superadmin.get.appoinment.data');
        Route::get('/appoinement-get-data', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'appoinement_get_date_get']);

        //appoinment non billable data
        Route::post('/appoinement-get-data-nonbil', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'appoinement_get_date_nonbil'])->name('superadmin.get.appoinment.data.nonbil');
        Route::get('/appoinement-get-data-nonbil', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'appoinement_get_date_nonbil_get']);

        //appoinment status update
        Route::post('/appoinement-status-update', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'appoinement_update_status'])->name('superadmin.update.appoinment.status');

        //appoinment edit section
        Route::post('/appoinement-update', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'appoinement_update'])->name('superadmin.appoinment.update');
        Route::post('/appoinement-update-get-details', [\App\Http\Controllers\Superadmin\SuperAdminAppoinmentController::class, 'appoinement_update_get_details'])->name('superadmin.appoinment.update.get.details');


        //recurring session
        Route::get('/recurring-session', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'recurring_session'])->name('superadmin.recurring.session')->middleware('adminPage:2');
        Route::post('/recurring-session-get-ptpro', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'recurring_session_get_ptpro'])->name('superadmin.recurring.session.get.patpro');
        Route::post('/recurring-session-get', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'recurring_session_get'])->name('superadmin.get.recurring.list');
        Route::get('/recurring-session-get', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'recurring_session_get_next']);
        Route::get('/recurring-session-edit/{id}', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'recurring_session_edit'])->name('superadmin.edit.recurring.session');
        Route::post('/recurring-session-update', [\App\Http\Controllers\Superadmin\SuperAdminManageSessionController::class, 'recurring_session_update'])->name('superadmin.recurring.session.update');


        //employee section

        //employee
        Route::get('/staffs', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee'])->name('superadmin.employee')->middleware('adminPage:4');
        Route::post('/staffs-get', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_get'])->name('superadmin.employee.list.get');
        Route::get('/staffs-get', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_get_filter']);
        Route::post('/staffs-get-update-actice', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_get_active_update'])->name('superadmin.employee.list.update.active');
        Route::get('/create-staffs/{em_type}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_create'])->name('superadmin.create.employee');
        Route::post('/staffs-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_save'])->name('superadmin.employee.save');
        Route::get('/staffs-biographic/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_biographic'])->name('superadmin.emaployee.biographic');
        Route::post('/staffs-biographic-update', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_biographic_update'])->name('superadmin.emaployee.biographic.update');

        //employee contact
        Route::get('/staffs-contact-details/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_contact_details'])->name('superadmin.emaployee.contact.details');
        Route::post('/staffs-contact-details-update', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_contact_details_update'])->name('superadmin.emaployee.contact.details.update');
        Route::post('/staffs-emergency-contact-details-update', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_emergency_contact_details_update'])->name('superadmin.emaployee.emergency.contact.details.update');

        //employee credentials
        Route::get('/staffs-credentials/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_credentials'])->name('superadmin.emaployee.credentials');

        Route::post('/staffs-credentials-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_credentials_save'])->name('superadmin.emaployee.credentials.save');
        Route::post('/staffs-credentials-update', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_credentials_update'])->name('superadmin.emaployee.credentials.update');
        Route::get('/staffs-credentials-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_credentials_delete'])->name('superadmin.emaployee.credentials.delete');

        Route::post('/staffs-clearance-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_clearance_save'])->name('superadmin.employee.clearance.save');
        Route::post('/staffs-clearance-update', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_clearance_update'])->name('superadmin.employee.clearance.update');
        Route::get('/staffs-clearance-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_clearance_delete'])->name('superadmin.employee.clearance.delete');

        Route::post('/staffs-qualification-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_qualification_save'])->name('superadmin.employee.qualification.save');
        Route::post('/staffs-qualification-update', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_qualification_update'])->name('superadmin.employee.qualification.update');
        Route::get('/staffs-qualification-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_qualification_delete'])->name('superadmin.employee.qualification.delete');


        //employee department
        Route::get('/staffs-department/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_department'])->name('superadmin.emaployee.department');
        Route::post('/staffs-department-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_department_save'])->name('superadmin.employee.department.save');

        //employee payroll
        Route::get('/staffs-payroll/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_payroll'])->name('superadmin.emaployee.payroll');
        Route::post('/staffs-payroll-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_payroll_save'])->name('superadmin.emaployee.payroll.save');
        Route::post('/staffs-payroll-edit', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_payroll_edit'])->name('superadmin.emaployee.payroll.edit');
        Route::get('/staffs-payroll-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_payroll_delete'])->name('superadmin.emaployee.payroll.delete');
        Route::post('/staffs-payroll-edit-bulk', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_payroll_edit_bulk'])->name('superadmin.emaployee.payroll.edit.bulk');

        //employee other setup
        Route::get('/staffs-other-setup/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_other_setup'])->name('superadmin.emaployee.other.setup');
        Route::post('/staffs-other-setup-update', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_other_setup_update'])->name('superadmin.emaployee.other.setup.update');

        //employee leave tracking
        Route::get('/staffs-leave-tracking/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_leave_tracking'])->name('superadmin.emaployee.leave.tracking');
        Route::post('/staffs-leave-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_leave_save'])->name('superadmin.employee.leave.save');
        Route::get('/staffs-leave-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_leave_delete'])->name('superadmin.employee.leave.delete');
        Route::get('/vacation-approval/{id}/{status}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_vacation_approval'])->name('superadmin.employee.vacation.approval');

        //employee payor exclusion
        Route::get('/staffs-payor-exclusion/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_payor_exclusion'])->name('superadmin.emaployee.payor.exclusion');
        Route::post('/staffs-payor-exclusion-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_payor_exclusion_save'])->name('superadmin.emaployee.payor.exclusion.save');
        Route::post('/staffs-show-all-payor', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_show_all_payor'])->name('superadmin.employee.show.all.payor');
        Route::post('/staffs-show-add-payor', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_show_add_payor'])->name('superadmin.employee.add.payor');
        Route::post('/staffs-show-assign-payor', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_show_show_assign_payor'])->name('superadmin.employee.show.assign.payor');
        Route::post('/staffs-delete-assign-payor', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_delete_assign_payor'])->name('superadmin.employee.delete.assign.payor');

        //employee sub-activity exclusion
        Route::get('/staffs-sub-activity-exclusion/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_subactivity_exclusion'])->name('superadmin.emaployee.subactivity.exclusion');
        Route::post('/staffs-sub-activity-exclusion-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_subactivity_exclusion_save'])->name('superadmin.emaployee.subactivity.exclusion.save');
        Route::post('/staffs-sub-activity-get-all', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_subactivity_get_all'])->name('superadmin.employee.get.all.sub.type');
        Route::post('/staffs-get-assign-sub-activity', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_get_assign_subactivity'])->name('superadmin.employee.get.assign.sub.type');
        Route::post('/staffs-sub-activity-exclusion-delete', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_subactivity_exclusion_delete'])->name('superadmin.emaployee.subactivity.exclusion.delete');

        //employee hr notes
        Route::get('/staffs-hr-notes/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_hr_notes'])->name('superadmin.emaployee.hr.notes');
        Route::post('/staffs-hr-notes-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_hr_notes_save'])->name('superadmin.emaployee.hr.notes.save');

        //employee client exclusion
        Route::get('/staffs-client-exclusion/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_client_exclusion'])->name('superadmin.emaployee.client.exclusion');
        Route::post('/staffs-client-exclusion-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_client_exclusion_save'])->name('superadmin.emaployee.client.exclusion.save');
        Route::post('/staffs-client-all-get', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_client_all_get'])->name('superadmin.employee.get.all.clients');
        Route::post('/staffs-get-assign-clients', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_get_assign_clients'])->name('superadmin.emaployee.get.assign.clients');
        Route::post('/staffs-delete-assign-clients', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_delete_assign_clients'])->name('superadmin.emaployee.client.exclusion.delete');

        //epoployee portal
        Route::get('/staffs-portal/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_portal'])->name('superadmin.employee.portal');
        Route::post('/staffs-portal-features-save', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_portal_features_save'])->name('superadmin.employee.portal.geatures.save');
        Route::post('/staffs-portal-send-access', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_portal_send_access'])->name('superadmin.employee.portal.send.access');
        Route::post('/staff-reset-link', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_reset_link'])->name('superadmin.employee.reset.link');
        Route::post('/staff-reset-password-send', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'staff_send_reset_password'])->name('superadmin.send.staff.reset.password');


        //employee activity
        Route::get('/staffs-activity', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_activity'])->name('superadmin.employee.activity');


        //employee view schedule
        Route::get('/staff-schedule/{id}', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_schedule'])->name('superadmin.employee.schedule');
        Route::get('/staff-schedule-data-get', [\App\Http\Controllers\Superadmin\SuperAdminEmployeeController::class, 'employee_schedule_data_get'])->name('superadmin.employee.schedule.data.get');


        //billing
        Route::get('/billing/submit-billing', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing'])->name('superadmin.billing')->middleware('adminPage:5');
        Route::post('/billing-get-record-by-date', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_recod_by_date'])->name('superadmin.billing.get.record.by.date');
        Route::post('/billing-update-data-all', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_update_data_all'])->name('superadmin.billing.update.billing.data');
        Route::post('/billing-get-clients', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_clients'])->name('superadmin.billing.get.clients');
        Route::post('/billing-get-treating-therapist', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_treating_therapist'])->name('superadmin.billing.get.treating.therapist');
        Route::post('/billing-get-csm-therapist', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_csm_therapist'])->name('superadmin.billing.get.csm.therapist');
        Route::post('/billing-get-activity-type', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_activity_type'])->name('superadmin.billing.get.activity.type');
        Route::post('/billing-get-degree-level', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_degree_level'])->name('superadmin.billing.get.degree.level');
        Route::post('/billing-get-zone', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_zone'])->name('superadmin.billing.get.zone');
        Route::post('/billing-get-cpt-code', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_cpt_code'])->name('superadmin.billing.get.cpt.code');
        Route::post('/billing-get-modifire', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_get_modifire'])->name('superadmin.billing.get.modifire');
        Route::post('/billing-record-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_record_get'])->name('superadmin.billing.get.billing.recored');
        Route::get('/billing-record-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_record_get_next']);

        //billing claim update
        Route::post('/billing-record-update', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_record_update'])->name('superadmin.procession.claim.update');
        Route::post('/billing-record-action-get-csm-provider', [\App\Http\Controllers\Superadmin\SuperAdminBillingController::class, 'billing_record_get_cms_provider'])->name('superadmin.billing.action.get.csm.provider');


        //Scrubbing

        Route::post('/run-scrubbing', [\App\Http\Controllers\Superadmin\SuperAdminScrubbingController::class, 'run_scrubbing'])->name('superadmin.run.scrubbing');

        //batching claim
        Route::get('/billing/batching-claim', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_claim'])->name('superadmin.billing.batching.claim');
        Route::post('/billing/batching-claim-get-client', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_claim_get_client'])->name('superadmin.batchingclaim.get.clients');
        Route::post('/billing/batching-claim-get-payor', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_claim_get_payor'])->name('superadmin.batchingclaim.get.payor');
        Route::post('/billing/batching-claim-get-providerj', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_claim_get_providerj'])->name('superadmin.batchingclaim.get.providerj');
        Route::post('/billing/batching-claim-get-claim', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_claim_get_claim'])->name('superadmin.batchingclaim.get.claim');
        Route::post('/billing/batching-claim-make-process', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_claim_make_process'])->name('superadmin.batchingclaim.make.process');
        Route::post('/billing/batching-claim-edi-count', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_claim_edi_count'])->name('superadmin.batchingclaim.get.claim.genedi.count');
        Route::post('/billing/batching-report', [\App\Http\Controllers\Superadmin\SuperAdminBillingBatchingClaimController::class, 'batching_report'])->name('superadmin.batchingclaim.batching.report');

        //process to edi
        Route::post('/billing/process-to-edi', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'process_to_edi'])->name('superadmin.processed.to.edi');


        //claim management
        Route::get('/billing/claim-management', [\App\Http\Controllers\Superadmin\SuperAdminBillingClaimController::class, 'billing_claim_management'])->name('superadmin.billing.claim.management');
        Route::post('/billing/claim-getbyfilter', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_byfilter'])->name('superadmin.claim.get.claimbyfilter');
        Route::post('/billing/claim-update-data', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_update_data'])->name('superadmin.billing.claim.update.data');
        Route::post('/billing/claim-update-auth', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_update_auth'])->name('superadmin.billing.claim.update.auth');


        Route::get('/billing/claim-management-view', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_view'])->name('superadmin.billing.claim.management.view');
        Route::post('/billing/claim-management-history', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_history'])->name('superadmin.billing.claim.management.history');
        Route::post('/billing/claim-rebullied-transantion', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_rebilled_transaction'])->name('superadmin.billing.claim.rebuiiled.transaction');
        Route::post('/billing/claim-split-transantion', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_split_transaction'])->name('superadmin.billing.claim.split.transaction');
        Route::post('/billing/claim-transantion-search', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_transaction_search'])->name('superadmin.billing.claim.management.history.search');

        //claim push sftp
        Route::post('/billing/claim-push-sftp', [\App\Http\Controllers\Superadmin\SuperAdminSftpController::class, 'push_cliam_to_sftp'])->name('superadmin.billing.claim.management.push.sftp');


        //claim hecfa form
        Route::post('/billing/claim-hcfa-with-bg', [\App\Http\Controllers\Superadmin\SuperAdminHecfaFormController::class, 'claim_hcfa_with_bg'])->name('superadmin.claim.with.background');
        Route::post('/billing/claim-hcfa-without-bg', [\App\Http\Controllers\Superadmin\SuperAdminHecfaFormController::class, 'claim_hcfa_without_bg'])->name('superadmin.claim.without.background');
        Route::get('/billing/claim-show-hcfa/{clid}', [\App\Http\Controllers\Superadmin\SuperAdminHecfaFormController::class, 'claim_hcfa_show_by_claim_id'])->name('superadmin.claim.show.hcfa');

        //general sec claim
        Route::post('/billing/claim-manage-generate-sec-claim', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'claim_generate_sec_claim'])->name('superadmin.billing.claim.management.sec.claim.generate');

        //claim filter
        Route::post('/billing/claim-management-batchid', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_get_batchid'])->name('superadmin.claim.get.batchid');
        Route::post('/billing/claim-management-getpayor', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_get_payor'])->name('superadmin.claim.get.payor');
        Route::post('/billing/claim-management-getclient', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_get_client'])->name('superadmin.claim.get.client');
        Route::post('/billing/claim-management-gettreatingempoyee', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_get_treating_employee'])->name('superadmin.claim.get.treating.employee');
        Route::post('/billing/claim-management-getcmsempoyee', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_get_cms_employee'])->name('superadmin.claim.get.cms.employee');
        Route::post('/billing/claim-management-getactivitytype', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_get_activitytype'])->name('superadmin.claim.get.activitytype');
        Route::post('/billing/claim-management-getclaimstatus', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_get_claimstatus'])->name('superadmin.claim.get.claimstatus');


        //gnerate claim csv
        Route::post('/billing/claim-management-generalte-csv', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_generate_csv'])->name('superadmin.claim.generate.csv');
        Route::get('/billing/claim-management-generalte-csv/download/{file}', [\App\Http\Controllers\Superadmin\SuperAdminBillingManageClaimController::class, 'billing_claim_management_generate_csv_download']);


        //general claim 837
        Route::post('/billing/claim-management-generalte-837', [\App\Http\Controllers\Superadmin\SuperAdmiEdiController::class, 'billing_claim_management_generate_837'])->name('superadmin.claim.generate.837');
        Route::get('/billing/claim-management-generate-837/download/{filename}', [\App\Http\Controllers\Superadmin\SuperAdmiEdiController::class, 'billing_claim_management_generate_837_download'])->name('superadmin.claim.generate.837.download');


        //era remitance
        Route::get('/payment/era-remittance', [\App\Http\Controllers\Superadmin\SuperAdminBillingRemittanceController::class, 'era_remittance'])->name('superadmin.era.remittance')->middleware('adminPage:6');
        Route::post('/payment/era-remittance-upload', [\App\Http\Controllers\Superadmin\SuperAdminBillingRemittanceController::class, 'era_remittance_upload'])->name('superadmin.era.remittance.upload');
        Route::post('/payment/era-process', [\App\Http\Controllers\Superadmin\SuperAdminBillingRemittanceController::class, 'era_process'])->name('superadmin.era.process');

        //deposit
        Route::get('/billing/m-remittance', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit'])->name('superadmin.billing.deposit')->middleware('adminPage:6');
        Route::get('/billing/deposit-add', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_add'])->name('superadmin.add.deposit');
        Route::post('/billing/deposit-add-save', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_add_save'])->name('superadmin.add.deposit.save');
        Route::get('/billing/deposit-edit/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_edit'])->name('superadmin.deposit.edit');
        Route::post('/billing/deposit-update', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_update'])->name('superadmin.deposit.update');
        Route::get('/billing/deposit-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_delete'])->name('superadmin.deposit.delete');
        Route::post('/billing/deposit-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_data_get'])->name('superadmin.get.deposit.data');
        Route::get('/billing/deposit-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_data_get_two']);
        Route::post('/billing/deposit-data-get-payee-type', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_data_get_payee_type'])->name('superadmin.get.deposit.payee.type');
        Route::get('/billing/deposit-receipt/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_receipt'])->name('superadmin.deposit.recipt');

        //deposit view details by ar ledger
        Route::get('/billing/deposit-view-details/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_view_details'])->name('superadmin.deposit.view.details');
        Route::post('/billing/deposit-view-details-ar-ledger', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_view_details_arledger'])->name('superadmin.deposit.details.arledger');

        //deposit data search
        Route::post('/billing/deposit-data-search', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_data_search'])->name('superadmin.get.deposit.data.search');

        //deposit details revert
        Route::post('/billing/deposit-data-revert', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_data_revert'])->name('superadmin.get.deposit.details.revert');

        //deposit apply
        Route::get('/billing/deposit-apply/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply'])->name('superadmin.deposit.apply');

        // Route::any('/billing/deposit-apply-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply_get_data_get']);

        Route::any('/billing/deposit-apply-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply_get_data'])->name('superadmin.get.deposit.apply.data');


        Route::post('/billing/deposit-apply-data-save', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply_get_save'])->name('superadmin.get.deposit.apply.data.save');
        Route::post('/billing/deposit-apply-transaction-data', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply_transaction_get'])->name('superadmin.get.deposit.apply.transaction.data');
        Route::post('/billing/deposit-apply-show-all-client', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply_show_all_client'])->name('superadmin.get.deposit.apply.show.all.client');
        Route::post('/billing/deposit-apply-show-payor-client', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply_show_payor_client'])->name('superadmin.get.deposit.apply.show.payor.client');
        Route::post('/billing/deposit-apply-show-pay-adj-total', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_apply_show_adj_pay_total'])->name('superadmin.get.deposit.apply.get.adj.pay.total');

        //deposit details
        Route::post('/billing/deposit-details', [\App\Http\Controllers\Superadmin\SuperAdminBillingDepositController::class, 'billing_deposit_details'])->name('superadmin.get.deposit.data.details');

        //ledger
        Route::post('/billing/ar-ledger-create', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_create'])->name('superadmin.processed.to.arlegder');


        Route::get('/billing/ar-ledger', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger'])->name('superadmin.billing.ledger')->middleware('adminPage:5');
        Route::post('/billing/ledger-get-all-client', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_get_all_client'])->name('superadmin.ledger.get.all.client');
        Route::post('/billing/ledger-get-all-payor', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_get_all_payor'])->name('superadmin.ledger.get.all.payor');
        Route::post('/billing/ledger-get-all-cptcode', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_get_all_cptcode'])->name('superadmin.ledger.get.all.cptcode');
        Route::any('/billing/ledger-get-data', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_get_data'])->name('superadmin.ledger.get');
        Route::post('/billing/ledger-sum-total', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_sum_total'])->name('superadmin.ledger.sum.total');
        Route::post('/billing/ledger-note-save', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_note_save'])->name('superadmin.legder.add.note');
        Route::post('/billing/ledger-transaction-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_transaction_get'])->name('superadmin.ledger.get.transaction');
        Route::post('/billing/ledger-multi-note-save', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_multi_note_save'])->name('superadmin.ledger.get.multi.note.save');
        Route::post('/billing/ledger-bucket-multi-note-save', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_bucket_multi_note_save'])->name('superadmin.ledger.bucket.get.multi.note.save');

        //ledger followup bucket
        Route::get('/billing/ar-followup-bucket/{type}', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_ar_followup_bucket'])->name('superadmin.ar.followup.bucket');
        Route::post('/billing/ar-followup-bucket-filter', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_ar_followup_bucket_filter'])->name('superadmin.ar.followup.bucket.filter');
        //        Route::post('/billing/ar-followup-bucket-comment-get',[\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class,'billing_ledger_ar_followup_bucket_comment_get'])->name('superadmin.ar.followup.bucket.comment.data');
        Route::post('/billing/ar-followup-bucket-filter-client', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_ar_followup_bucket_filter_client'])->name('superadmin.ar.followup.bucket.filter.data.client');
        Route::post('/billing/ar-followup-bucket-filter-payor', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_ar_followup_bucket_filter_payor'])->name('superadmin.ar.followup.bucket.filter.data.payor');
        Route::post('/billing/ar-followup-bucket-filter-cpt', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_ar_followup_bucket_filter_cpt'])->name('superadmin.ar.followup.bucket.filter.data.cpt');

        // ar followup types
        Route::get('/billing/ar-followup-bucket-filter-types/{type}', [\App\Http\Controllers\Superadmin\SuperAdminBillingLegderController::class, 'billing_ledger_ar_followup_bucket_filter_types'])->name('superadmin.ar.followup.bucket.types');

        //payroll
        Route::get('/process-payroll', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll'])->name('superadmin.process.payroll')->middleware('adminPage:7');
        Route::post('/process-payroll-pay-priod-time-get', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_pay_time_get'])->name('superadmin.payroll.pay.period.time.get');
        Route::post('/process-payroll-payor-by-payid', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_get_payor_by_payid'])->name('superadmin.payroll.payor.by.payid');
        Route::post('/process-payroll-get-data', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_process_get_data'])->name('superadmin.payroll.process.get.data');
        Route::post('/process-payroll-update', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_process_update'])->name('superadmin.payroll.process.update');
        Route::post('/process-payroll-revert', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_revert'])->name('superadmin.revert.payroll');


        //submit payroll
        Route::get('/submit-payroll', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'submit_payroll'])->name('superadmin.submit.payroll');
        Route::post('/submit-payroll-get', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'submit_payroll_get'])->name('superadmin.payroll.submission.get');
        Route::post('/process-submit-update', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'submit_payroll_update'])->name('superadmin.payroll.submit.update');


        //Compeleted Payroll

        Route::get('/completed-payroll', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'completed_payroll'])->name('superadmin.completed.payroll');
        Route::post('/completed-payroll-pay-priod-time-get', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'completed_payroll_pay_time_get'])->name('superadmin.completed.payroll.pay.period.time.get');
        Route::post('/completed-payroll-payor-by-payid', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'completed_payroll_get_payor_by_payid'])->name('superadmin.completed.payroll.payor.by.payid');
        Route::post('/completed-payroll-get', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'completed_payroll_get'])->name('superadmin.completed.payroll.get');
        Route::post('/completed-payroll-update-status', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'completed_payroll_update_status'])->name('superadmin.completed.payroll.update.status');

        //payroll timesheet
        Route::get('/payroll-timesheet', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_timesheet'])->name('superadmin.payroll.timesheet')->middleware('adminPage:7');
        Route::post('/payroll-timesheet-appoinment', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_timesheet_appoinment'])->name('superadmin.payroll.timesheet.appoinment');
        Route::post('/payroll-timesheet-save', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_timesheet_save'])->name('superadmin.payroll.timesheet.save');
        Route::post('/payroll-timesheet-delete-single', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_timesheet_single'])->name('superadmin.payroll.timesheet.delete.single');
        Route::post('/payroll-timesheet-bydayname', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_timesheet_bydayname'])->name('superadmin.payroll.timesheet.bydayname');
        Route::post('/payroll-timesheet-revert', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'revert_timesheet'])->name('superadmin.revert.timesheet');
        Route::post('/payroll-timesheet-submit', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'submit_timesheet'])->name('superadmin.timesheet.submit');

        //rate list
        Route::get('/billing/contract-rate', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list'])->name('superadmin.billing.ratelist')->middleware('adminPage:5');
        Route::get('/billing/rate-list-add/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_add'])->name('superadmin.add.ratelist');
        Route::get('/billing/rate-list-back/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_back'])->name('superadmin.add.ratelist');
        Route::post('/billing/rate-list-save', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_save'])->name('superadmin.ratelist.save');
        Route::get('/billing/rate-list-edit/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_edit'])->name('superadmin.ratelist.edit');
        Route::post('/billing/rate-list-update', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_update'])->name('superadmin.ratelist.update');
        Route::get('/billing/rate-list-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_delete'])->name('superadmin.ratelist.delete');
        Route::post('/billing/rate-list-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_data_get'])->name('superadmin.get.ratelist.data');
        Route::get('/billing/rate-list-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_data_get_show']);
        Route::get('/billing/rate-list-file-download/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_file_download'])->name('superadmin.ratelist.file.download');
        Route::post('/billing/rate-list-payor-filename-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_payor_filename_get'])->name('superadmin.ratelist.get.payor.filename');
        Route::post('/billing/rate-list-get-service', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_get_service'])->name('superadmin.get.ratelist.service');
        Route::post('/billing/rate-list-get-subtype', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_get_subtype'])->name('superadmin.get.ratelist.subtype');
        Route::post('/billing/rate-list-get-cptcode', [\App\Http\Controllers\Superadmin\SuperAdminBillingRateListController::class, 'billing_rate_list_get_cptcode'])->name('superadmin.get.ratelist.cptcode');

        //statement
        Route::get('/billing/patient-statement', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement'])->name('superadmin.billing.statement')->middleware('adminPage:5');
        Route::post('/billing/statement-data-get-all', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_get_data_all'])->name('superadmin.get.statement.data.all');
        Route::get('/billing/statement-data-get-all', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_get_data_all_filter']);
        Route::post('/billing/statement-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_get_data'])->name('superadmin.get.statement.data');
        Route::get('/billing/statement-data-get', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_get_data_filter']);
        Route::get('/billing/statement-view', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_view'])->name('superadmin.billing.statement.view');
        Route::post('/billing/statement-view-pdf', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_view_pdf'])->name('superadmin.statement.view.pdf');
        Route::post('/billing/statement-save-pdf', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_save_pdf'])->name('superadmin.statement.save.pdf');
        Route::post('/billing/submit-single-status', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'submit_single_status'])->name('superadmin.submit.single.status');
        Route::post('/billing/submit-all-status', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'submit_all_status'])->name('superadmin.submit.all.status');
        Route::get('/billing/statement-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_delete'])->name('superadmin.statement.delete');
        Route::get('/billing/statement-email/{c_id?}/{f_name?}', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_email_editor'])->name('superadmin.billing.statement.email.editor');
        Route::post('/billing/statement-send', [\App\Http\Controllers\Superadmin\SuperAdminBillingStatementController::class, 'billing_statement_send'])->name('superadmin.statement.send');

        //report

        Route::get('/report', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'report'])->name('superadmin.report')->middleware('adminPage:8');
        Route::any('/report-show', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'report13Generate'])->name('superadmin.report.show');
        Route::get('/report-show-data', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'report13GenerateGet']);
        Route::post('/report-export', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'report_export'])->name('superadmin.report.export');
        Route::get('/report-export-view', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'report_export_view'])->name('superadmin.report.export.view');
        Route::post('/report-export-download', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'report_export_download'])->name('superadmin.report.export.download');
        Route::get('/kpi-report-by-months-view', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'kpi_report_by_months_view'])->name('superadmin.kpi.report.by.months.view');
        Route::post('/kpi-report-by-months', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'kpi_report_by_months'])->name('superadmin.kpi.report.by.months');
        Route::get('/kpi-report-by-patient-view', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'kpi_report_by_patient_view'])->name('superadmin.kpi.report.by.patient.view');
        Route::post('/kpi-report-by-patient', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'kpi_report_by_patient'])->name('superadmin.kpi.report.by.patient');
        Route::get('/kpi-report-by-insurance-view', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'kpi_report_by_insurance_view'])->name('superadmin.kpi.report.by.insurance.view');
        Route::post('/kpi-report-by-insurance', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'kpi_report_by_insurance'])->name('superadmin.kpi.report.by.insurance');
        Route::get('/kpi-report', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'open_pdf_by_ajax'])->name('superadmin.open.pdf.by.ajax');


        //account activity
        Route::get('/account-activity', [\App\Http\Controllers\Superadmin\SuperAdminAccountActivityController::class, 'account_activity'])->name('superadmin.account.activity');


        //secondary claim
        Route::get('/pending-secondary', [\App\Http\Controllers\Superadmin\SuperAdminSecClaimController::class, 'pending_secondary'])->name('superadmin.home.pending.secondary');
        Route::post('/pending-secondary-get', [\App\Http\Controllers\Superadmin\SuperAdminSecClaimController::class, 'pending_secondary_get'])->name('superadmin.secondary.claim.get');
        Route::post('/pending-secondary-show-details', [\App\Http\Controllers\Superadmin\SuperAdminSecClaimController::class, 'pending_secondary_show_details'])->name('superadmin.secondary.claim.show.details');
        Route::post('/pending-secondary-generate', [\App\Http\Controllers\Superadmin\SuperAdminSecClaimController::class, 'pending_secondary_generate'])->name('superadmin.secondary.claim.generate');


        //setting name location
        Route::get('/settting/name-location', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'name_location'])->name('superadmin.setting.name.location')->middleware('adminPage:9');
        Route::post('/settting/get-working-hours', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'get_working_hours'])->name('superadmin.get.working.hour.ajax');
        Route::post('/settting/name-location-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'name_location_save'])->name('superadmin.setting.name.location.save');
        Route::post('/settting/name-location-box-32-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'name_location_box_32_save'])->name('superadmin.setting.name.location.box.two.save');
        Route::post('/settting/name-location-box-32-exist-remove', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'name_location_box_32_exsist_remove'])->name('superadmin.remove.exsts.box32');

        //setting add payor
        Route::get('/settting/add-insurance', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'add_payor'])->name('superadmin.setting.addpayor');
        Route::post('/settting/all-payor-show', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'all_payor_show'])->name('superadmin.setting.get.all.payor');
        Route::post('/settting/all-payor-facility-show', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'all_payor_faclility_show'])->name('superadmin.setting.get.all.payor.facility');
        Route::post('/settting/add-payor-facility', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'add_payor_facility'])->name('superadmin.save.payor.to.facility');
        Route::post('/settting/remove-payor-facility', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'remove_payor_facility'])->name('superadmin.remove.payor.to.facility');
        Route::post('/settting/get-payor-facility-details', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_facility_get_details'])->name('superadmin.get.payor.facility.details');
        Route::post('/settting/get-payor-selected-facility-details', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_selected_facility_get_details'])->name('superadmin.get.payor.selected.facility.details');
        Route::post('/settting/get-all-payor-details', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'all_payor_get_details'])->name('superadmin.get.all.payor.details');
        Route::post('/settting/payor-facility-details-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_facility_details_update'])->name('superadmin.payor.facility.details.update');

        //setting payor setup
        Route::get('/settting/insurance-setup', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_setup'])->name('superadmin.setting.payorSetup');
        Route::post('/settting/payor-setup-details-get', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_setup_detaisl_get'])->name('superadmin.get.payor.setup.details');
        Route::post('/settting/payor-setup-details-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_setup_detaisl_update'])->name('superadmin.get.payor.setup.details.update');
        Route::post('/settting/payor-setup-update-table', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_setup_update_table'])->name('superadmin.payor.setup.update.table');
        Route::post('/settting/fetch-scrubbing-info', [\App\Http\Controllers\Superadmin\SuperAdminScrubbingController::class, 'fetch_scrubbing_info'])->name('superadmin.fetch.scrubbing.info');
        Route::post('/settting/save-scrubbing-info', [\App\Http\Controllers\Superadmin\SuperAdminScrubbingController::class, 'save_scrubbing_info'])->name('superadmin.save.scrubbing.info');


        //setting add treatment
        Route::get('/settting/add-treatment', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_treatment'])->name('superadmin.setting.add.treatment');
        Route::post('/settting/add-treatment-facility', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_treatment_facility'])->name('superadmin.save.treatment.to.facility');
        Route::post('/settting/add-treatment-get', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'payor_treatment_get'])->name('superadmin.treatment.get');
        Route::post('/settting/assign-treatment-get', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'assign_treatment_get'])->name('superadmin.get.assign.treatment');
        Route::post('/settting/remove-assign-treatment', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'assign_treatment_remove'])->name('superadmin.remove.treatment.to.facility');


        //setting add employee
        Route::get('/settting/add-staff-type', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'add_employee'])->name('superadmin.setting.add.employee');
        Route::post('/settting/employee-get-all', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'employee_get_all'])->name('superadmin.setting.get.employee.type');
        Route::post('/settting/employee-assign-get-all', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'employee_get_assign_all'])->name('superadmin.setting.get.assign.employee.type');
        Route::post('/settting/employee-save-type', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'employee_save_type'])->name('superadmin.save.employee.type');
        Route::post('/settting/employee-remove-type', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'employee_remove_type'])->name('superadmin.remove.employee.type');


        //setting rendering provider
        Route::get('/settting/rendering-provider', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'rendering_provider'])->name('superadmin.setting.rendering.provider');
        Route::post('/settting/rendering-provider-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'rendering_provider_save'])->name('superadmin.setting.rendering.provider.save');
        Route::post('/settting/rendering-provider-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'rendering_provider_update'])->name('superadmin.setting.rendering.provider.update');
        Route::get('/settting/rendering-provider-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'rendering_provider_delete'])->name('superadmin.setting.rendering.provider.delete');

        //setting pos
        Route::get('/settting/pos', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pos'])->name('superadmin.setting.pos');
        Route::post('/settting/pos-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pos_save'])->name('superadmin.setting.pos.save');
        Route::post('/settting/pos-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pos_update'])->name('superadmin.setting.pos.update');
        Route::get('/settting/pos-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pos_delete'])->name('superadmin.setting.pos.delete');

        //setting add employee
        Route::get('/settting/services', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'services'])->name('superadmin.setting.services');
        Route::post('/settting/services-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'services_save'])->name('superadmin.setting.services.save');
        Route::post('/settting/services-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'services_update'])->name('superadmin.setting.services.update');
        Route::get('/settting/services-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'services_delete'])->name('superadmin.setting.services.delete');


        //setting File Manager
        Route::get('/settting/file-manager', [\App\Http\Controllers\Superadmin\SuperAdminFileController::class, 'file_manager'])->name('superadmin.setting.file.manager');

        Route::post('/settting/file-manager/era-list', [\App\Http\Controllers\Superadmin\SuperAdminFileController::class, 'era_list'])->name('superadmin.setting.era.list');

        Route::post('/settting/file-manager/edi-list', [\App\Http\Controllers\Superadmin\SuperAdminFileController::class, 'edi_list'])->name('superadmin.setting.edi.list');

        Route::get('/settting/file-manager/open-sftp-txt/{user}/{name}', [\App\Http\Controllers\Superadmin\SuperAdminFileController::class, 'open_sftp_txt'])->name('open.sftp.txt');
        Route::post('/settting/file-manager/open-sftp-file', [\App\Http\Controllers\Superadmin\SuperAdminFileController::class, 'open_sftp_file'])->name('open.sftp.file');

        //cpt code
        Route::get('/settting/cpt/code', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'cpt_code'])->name('superadmin.setting.cpt.code');
        Route::post('/settting/cpt/code/save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'cpt_code_save'])->name('superadmin.setting.cpt.code.save');
        Route::post('/settting/cpt/code/update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'cpt_code_update'])->name('superadmin.setting.cpt.code.update');
        Route::get('/settting/cpt/code/delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'cpt_code_delete'])->name('superadmin.setting.cpt.code.delete');

        //CPT Code Exclusion
        Route::get('/settting/cpt/code/exclusion', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'cpt_code_exclusion'])->name('superadmin.setting.cpt.code.exclusion');
        Route::post('/settting/cpt/code/all', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'fetch_all_cpt'])->name('superadmin.fetch.all.cpt');
        Route::post('/settting/cpt/code/include', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'include_cpt'])->name('superadmin.include.cpt');
        Route::post('/settting/cpt/code/exclude', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'exclude_cpt'])->name('superadmin.exclude.cpt');


        //vendor number
        Route::get('/settting/vendor-number', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number'])->name('superadmin.setting.vendor.number');
        Route::post('/settting/vendor-number-get-region-center', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number_get_region_center'])->name('superadmin.vendor.get.region.center');
        Route::post('/settting/vendor-number-get-tx', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number_get_tx'])->name('superadmin.vendor.get.tx');
        Route::post('/settting/vendor-number-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number_save'])->name('superadmin.vendor.save');
        Route::post('/settting/vendor-number-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number_update'])->name('superadmin.vendor.update');
        Route::get('/settting/vendor-number-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number_delete'])->name('superadmin.vendor.number.delete');
        Route::post('/settting/vendor-number-filter', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number_filter'])->name('superadmin.vendor.number.filter');
        Route::get('/settting/vendor-number-filter', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'vendor_number_filter_get']);


        //setting add logo
        Route::get('/settting/logo', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'logo'])->name('superadmin.setting.logo');
        Route::post('/settting/logo-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'logo_update'])->name('superadmin.setting.logo.update');

        //setting ubbillbe activity
        Route::get('/settting/unbillable-activity', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'unbillable_activity'])->name('superadmin.setting.unbillable.activity');
        Route::post('/settting/unbillable-activity-get', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'unbillable_activity_get'])->name('superadmin.setting.unbillable.activity.get');
        Route::post('/settting/unbillable-activity-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'unbillable_activity_update'])->name('superadmin.setting.unbillable.activity.update');


        //setting zone setup
        Route::get('/settting/region-setup', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'zone_setup'])->name('superadmin.setting.zone.setup');
        Route::post('/settting/zone-setup-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'zone_setup_save'])->name('superadmin.setting.zone.setup.save');
        Route::get('/settting/zone-setup-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'zone_setup_delete'])->name('superadmin.setting.zone.setup.delete');


        //holiday setup
        Route::get('/settting/holiday-setup', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'holiday_setup'])->name('superadmin.setting.holiday.setup');
        Route::post('/settting/holiday-setup-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'holiday_setup_save'])->name('superadmin.holiday.setup');
        Route::get('/settting/holiday-setup-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'holiday_setup_delete'])->name('superadmin.holiday.setup.delete');
        Route::post('/settting/federal-holiday-setup-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'federal_holiday_save'])->name('superadmin.add.federal.holiday');

        //pay period
        Route::get('/settting/pay-period', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pay_period'])->name('superadmin.pay.period');
        Route::post('/settting/pay-period-fetch', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pay_period_fetch'])->name('superadmin.pay.period.fetch');
        Route::get('/settting/pay-period-fetch', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pay_period_fetch_filter'])->name('superadmin.pay.period.fetch.filter');
        Route::post('/settting/pay-period-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pay_period_save'])->name('superadmin.pay.period.save');
        Route::post('/settting/pay-period-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pay_period_update'])->name('superadmin.pay.period.update');
        Route::get('/settting/pay-period-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pay_period_delete'])->name('superadmin.pay.period.delete');
        Route::post('/settting/pay-period-delete-bulk', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'pay_period_delete_bulk'])->name('superadmin.pay.period.delete.bulk');

        //sub activity setup
        Route::get('/settting/sub-activity-setup', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_setup'])->name('superadmin.setting.sub.activity.setup');
        Route::post('/settting/sub-activity-treatment-billable-type', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_treatment_billable_type'])->name('superadmin.get.subactivity.bill.type');
        Route::post('/settting/sub-activity-service-get', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_treatment_service_get'])->name('superadmin.get.subactivity.service');
        Route::post('/settting/sub-activity-get-data', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_get_data'])->name('superadmin.get.subactivity.data');
        Route::post('/settting/sub-activity-setup-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_setup_save'])->name('superadmin.new.subactivity.save');
        Route::post('/settting/sub-activity-single', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_single'])->name('superadmin.get.single.activity');
        Route::post('/settting/sub-activity-single-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_single_update'])->name('superadmin.get.single.activity.update');
        Route::post('/settting/sub-activity-single-delete', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_single_delete'])->name('superadmin.get.single.activity.delete');
        Route::get('/settting/adp-code', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'adp_code'])->name('superadmin.setting.adp.codes');
        Route::post('/settting/sub-activity-change-status', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'sub_activity_change_status'])->name('superadmin.subactivity.change.status');

        //session rule
        Route::get('/settting/session-rule', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'session_rule'])->name('superadmin.setting.session.rule.setup');
        Route::post('/settting/session-rule-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'session_rule_update'])->name('superadmin.setting.session.rule.update');

        //employee setup
        Route::get('/settting/staff-setup', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'employee_setup'])->name('superadmin.setting.employee.setup');
        Route::get('/settting/hr-note-type', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'hr_note_type'])->name('superadmin.setting.hrnotetype');
        Route::get('/settting/employee-position', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'employee_position'])->name('superadmin.setting.employee.position');
        Route::get('/settting/game-goal', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'game_goal'])->name('superadmin.setting.game.goal');
        Route::get('/settting/game-goal-copay', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'game_goal_copay'])->name('superadmin.setting.game.goal.copay');

        //user setup
        Route::get('/settting/user-setup', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'user_setup'])->name('superadmin.setting.user.setup');
        Route::post('/settting/user-setup-get-user', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'user_setup_get_user'])->name('superadmin.user.setup.getuser');
        Route::get('/settting/user-setup-get-user', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'user_setup_get_user_ge']);

        //documents
        Route::get('/settting/documents', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'documents'])->name('superadmin.setting.documents');


        //notes and froms
        Route::get('/settting/notes-forms', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'notes_forms'])->name('superadmin.setting.notes.forms');
        Route::post('/settting/notes-forms-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'notes_forms_save'])->name('superadmin.setting.notes.forms.save');

        //form builders
        Route::get('/settting/froms-builder', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders'])->name('superadmin.setting.forms.builder');
        Route::get('/settting/froms-builder-create', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_create'])->name('superadmin.setting.forms.builder.create');
        Route::post('/settting/froms-builder-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_save'])->name('superadmin.setting.forms.builder.save');
        Route::post('/settting/froms-builder-edit-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_edit_save'])->name('superadmin.setting.forms.builder.edit.save');
        Route::post('/settting/froms-builder-duplicate-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_duplicate_save'])->name('superadmin.setting.forms.builder.duplicate.save');
        Route::get('/settting/froms-builder-template-view/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_template_view'])->name('superadmin.setting.forms.builder.template.view');
        Route::get('/settting/froms-builder-edit/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_template_edit'])->name('superadmin.setting.forms.builder.template.edit');
        Route::get('/settting/froms-builder-duplicate/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_template_duplicate'])->name('superadmin.setting.forms.builder.template.duplicate');
        Route::get('/settting/froms-builder-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_template_delete'])->name('superadmin.setting.forms.builder.template.delete');

        Route::get('/settting/froms-builder-view/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_view'])->name('superadmin.setting.forms.builder.view');

        Route::post('/settting/froms-builder-save-data', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'forms_builders_save_data'])->name('superadmin.setting.forms.builder.save.data');


        Route::post('/settting/save-forms', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'save_forms'])->name('superadmin.save.forms');
        Route::post('/settting/remove-forms', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'remove_forms'])->name('superadmin.remove.forms');
        Route::post('/settting/available-forms', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'available_forms'])->name('superadmin.available.forms');
        Route::post('/settting/assigned-forms', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'assigned_forms'])->name('superadmin.assigned.forms');


        //template library
        Route::get('/settting/template-library', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'template_library'])->name('superadmin.setting.template.library');
        Route::post('/settting/template-library', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'template_library_form'])->name('superadmin.setting.template.library.from');
        Route::get('/settting/template-library-apply/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'template_library_apply'])->name('superadmin.setting.template.library.apply');


        //PDF
        Route::get('/settting/pdf', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'index'])->name('superadmin.pdf');
        Route::post('/settting/print-form-1', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'unique_supervision'])->name('superadmin.print.form.1');
        Route::post('/settting/print-form-2', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'parent_training'])->name('superadmin.print.form.2');
        Route::post('/settting/print-form-3', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'bcba_monthly'])->name('superadmin.print.form.3');
        Route::post('/settting/print-form-4', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'bcba_unique'])->name('superadmin.print.form.4');
        Route::post('/settting/print-form-5', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'monthly_supervision'])->name('superadmin.print.form.5');
        Route::post('/settting/print-form-6', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'communication'])->name('superadmin.print.form.6');
        Route::post('/settting/print-form-7', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'clinical_treatment'])->name('superadmin.print.form.7');
        Route::post('/settting/print-form-8', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'treatment_plan'])->name('superadmin.print.form.8');
        Route::post('/settting/print-form-9', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'client_intake'])->name('superadmin.print.form.9');
        Route::post('/settting/print-form-10', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'otr_form'])->name('superadmin.print.form.10');
        Route::post('/settting/print-form-11', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'cata'])->name('superadmin.print.form.11');
        Route::post('/settting/print-form-12', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'p_training'])->name('superadmin.print.form.12');
        Route::post('/settting/print-form-13', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'session_notes'])->name('superadmin.print.form.13');
        Route::post('/settting/print-form-14', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'reg_form_1'])->name('superadmin.print.form.14');
        Route::post('/settting/print-form-15', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'reg_form_2'])->name('superadmin.print.form.15');
        Route::post('/settting/print-form-16', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'service_plan'])->name('superadmin.print.form.16');
        Route::post('/settting/print-form-17', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'cp_clinical'])->name('superadmin.print.form.17');
        Route::post('/settting/print-form-18', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'cp_notes'])->name('superadmin.print.form.18');
        Route::post('/settting/print-form-19', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'cp_soap'])->name('superadmin.print.form.19');
        Route::post('/settting/print-form-20', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'gs_assessment'])->name('superadmin.print.form.20');
        Route::post('/settting/print-form-21', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'gs_parent'])->name('superadmin.print.form.21');
        Route::post('/settting/print-form-22', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'gs_supervision'])->name('superadmin.print.form.22');
        Route::post('/settting/print-form-23', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'gs_treatment'])->name('superadmin.print.form.23');
        Route::post('/settting/print-form-24', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'biopsych'])->name('superadmin.print.form.24');
        Route::post('/settting/print-form-25', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'birp_progress'])->name('superadmin.print.form.25');
        Route::post('/settting/print-form-26', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'dis_summary'])->name('superadmin.print.form.26');
        Route::post('/settting/print-form-27', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'language_progress'])->name('superadmin.print.form.27');
        Route::post('/settting/print-form-28', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'language_session'])->name('superadmin.print.form.28');
        Route::post('/settting/print-form-29', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'diagnosis_summary'])->name('superadmin.print.form.29');
        Route::post('/settting/print-form-30', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'datasheet'])->name('superadmin.print.form.30');
        Route::post('/settting/print-form-60', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'supervision_and_session'])->name('superadmin.print.form.60');
        Route::post('/settting/print-form-61', [\App\Http\Controllers\Superadmin\SuperAdminPDFController::class, 'session_notes_2'])->name('superadmin.print.form.61');


        //bussiness documents
        Route::get('/settting/bussiness-documents', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'bussiness_documents'])->name('superadmin.setting.bussiness.documents');
        Route::post('/settting/bussiness-documents-save', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'bussiness_documents_save'])->name('superadmin.setting.bussiness.documents.save');
        Route::post('/settting/bussiness-documents-update', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'bussiness_documents_update'])->name('superadmin.setting.bussiness.documents.update');
        Route::get('/settting/bussiness-documents-delete/{id}', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'bussiness_documents_delete'])->name('superadmin.setting.bussiness.documents.delete');

        //subscription information
        Route::get('/settting/subscription-information', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'subscription_information'])->name('superadmin.setting.subscription.information');
        Route::get('/settting/subscription-information-billing', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'subscription_information_billing'])->name('superadmin.setting.subscription.information.billing');

        //notification
        Route::get('/settting/notification', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'notification'])->name('superadmin.setting.notification');

        //demo data
        Route::get('/settting/demo-data', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'demo_data'])->name('superadmin.setting.demo.data');


        //data export
        Route::get('/settting/data-export', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'data_export'])->name('superadmin.setting.data.export');


        //all extra upload
        Route::post('/settting/import-all-payor', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'import_all_payor'])->name('superadmin.import.all.payor');


        //Unbillable Timesheet
        Route::get('/settting/unbillable-timesheet', [\App\Http\Controllers\Superadmin\SuperAdminPayrollController::class, 'payroll_timesheet_unbillable'])->name('superadmin.unbillable.timesheet');

        //sftp
        Route::get('/sftp-data', [\App\Http\Controllers\Superadmin\SuperAdminSftpController::class, 'auth_password'])->name('superadmin.sftp.data');
        Route::get('/sftp-read-data', [\App\Http\Controllers\Superadmin\SuperAdminSftpController::class, 'read_data'])->name('sftp.read.data');


        //meet
        Route::get('/meet-lists', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'meet_list'])->name('superadmin.meet.lists');
        Route::get('/meet-create', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'meet_create'])->name('superadmin.meet.create');
        Route::post('/meet-session-start', [\App\Http\Controllers\Superadmin\SuperAdminSettingController::class, 'meet_session_start'])->name('superadmin.meet.session.start');


        //Chat Module
        Route::get('/chat', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'view_chat_page'])->name('superadmin.view.chat.page');
        Route::post('/chat/existing-chats', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'existing_chats'])->name('superadmin.existing.chats');
        Route::post('/chat/existing-msgs', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'existing_msgs'])->name('superadmin.existing.msgs');
        Route::post('/chat/scroll-msgs', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'scroll_msgs'])->name('superadmin.scroll.msgs');
        Route::post('/chat/send-msg', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'send_msg'])->name('superadmin.send.msg');
        Route::post('/chat/update-read-status', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'update_read_status'])->name('superadmin.update.read.status');
        Route::post('/chat/delete-chat', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'delete_chat'])->name('superadmin.delete.chat');
        Route::post('/chat/fetch-all-contacts', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'fetch_all_contacts'])->name('superadmin.fetch.all.contacts');
        Route::post('/chat/fetch-all-patients', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'fetch_all_patients'])->name('superadmin.fetch.all.patients');
        Route::post('/chat/generate-link', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'generate_link'])->name('superadmin.chat.generate.link');
        Route::post('/chat/find-all', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'find_all'])->name('superadmin.find.all');
        Route::get('/chat/download-file/{id}', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'download_file'])->name('superadmin.chat.download.file');
        Route::get('/chat/chat-history/{id}', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'chat_history'])->name('superadmin.chat.history');
        Route::post('/chat/upload-file', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'upload_file'])->name('superadmin.chat.upload.file');
        Route::post('/chat/delete-msg', [\App\Http\Controllers\Superadmin\SuperAdminChatController::class, 'delete_msg'])->name('superadmin.chat.delete.msg');


        //Report by Mail

        Route::get('/report-download-by-mail/{id}', [\App\Http\Controllers\Superadmin\SuperAdminReportController::class, 'report_download_by_mail'])->name('report.download.by.mail');
    });
});


//super admin section-----------------------------------------------------------
Route::get('/superadmin/login', [\App\Http\Controllers\Auth\CustomLoginController::class, 'user_login'])->name('mainadmin.login');
Route::get('/superadmin/logout', [\App\Http\Controllers\Auth\MainAdminLoginController::class, 'main_admin_logout'])->name('mainadmin.logout');
Route::group(['middleware' => ['auth:superadmin']], function () {
    Route::prefix('superadmin')->group(function () {

        Route::get('/', [\App\Http\Controllers\Mainadmin\MainAdminController::class, 'index'])->name('mainadmin.dashboard');

        //provider access
        Route::get('/provider-access', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'provider_access'])->name('mainadmin.provider.access');

        //admin access
        Route::get('/admin-access', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_access'])->name('mainadmin.admin.access');
        Route::post('/admin-access-get-facility', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_access_get_facility'])->name('mainadmin.admin.access.get.faiclity');
        Route::post('/admin-access-get-adminbyfac', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_access_get_adminbyfac'])->name('mainadmin.admin.access.get.adminbyfac');
        Route::post('/admin-access-sortbyadmin', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_access_sortbyadmin'])->name('mainadmin.admin.access.get.sortbyadmin');
        Route::post('/admin-access-check', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_access_check'])->name('mainadmin.admin.page.access.check');
        Route::post('/admin-access-get', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_access_get'])->name('mainadmin.admin.page.access.get');
        Route::post('/admin-page-access-add', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_page_access_add'])->name('mainadmin.admin.page.access.add');
        Route::post('/admin-page-access-remove', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'admin_page_access_remove'])->name('mainadmin.admin.page.access.remove');

        //provider create
        Route::get('/provider-create', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'provider_create'])->name('mainadmin.provider.create');

        //provider remove
        Route::get('/provider-user-remove', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'provider_user_remove'])->name('mainadmin.provider.delete');
        Route::post('/provider-remove-get-all-admin', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'provider_remove_get_all_admin'])->name('mainadmin.provider.remove.get.all.admin');
        Route::post('/provider-by-admin', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'provider_by_admin'])->name('mainadmin.provider.by.admin');
        Route::get('/provider-by-admin', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'provider_by_admin_get']);
        Route::post('/provider-delete-by-admin', [\App\Http\Controllers\Mainadmin\MainAdminAccessController::class, 'provider_delete_by_admin'])->name('mainadmin.provider.delete.by.admin');

        //compnay
        Route::get('/company-facility', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'compnay_facility'])->name('mainadmin.company.facility');
        Route::post('/company-details-save', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'compnay_details_save'])->name('mainadmin.company.save');
        Route::post('/company-details-all', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'compnay_get_all'])->name('mainadmin.company.get.all');
        Route::post('/company-details-get', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'compnay_details_get'])->name('mainadmin.company.get.company.details');
        Route::post('/company-details-update', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'compnay_details_update'])->name('mainadmin.company.update');
        Route::post('/get-admin-by-facility', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'get_admin_by_facility'])->name('mainadmin.get.admin.byfaicility');

        //facility save
        Route::post('/facility-save', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'facility_save'])->name('mainadmin.facility.save');

        //create sub admin
        Route::post('/create-sub-admin', [\App\Http\Controllers\Mainadmin\MainAdminFacilityController::class, 'create_sub_admin'])->name('mainadmin.create.subadmin');

        //manage payor
        Route::get('/manage-payor', [\App\Http\Controllers\Mainadmin\MainAdminPayorController::class, 'manage_payor'])->name('mainadmin.payor.manager');
        Route::post('/manage-payor-save', [\App\Http\Controllers\Mainadmin\MainAdminPayorController::class, 'manage_payor_save'])->name('mainadmin.payor.save');

        //billerlog user
        Route::get('/billerlog-user', [\App\Http\Controllers\Mainadmin\MainAdminBillerLogUserController::class, 'billerlog_user'])->name('mainadmin.billerlog.user');
        Route::post('/billerlog-user-save', [\App\Http\Controllers\Mainadmin\MainAdminBillerLogUserController::class, 'billerlog_user_save'])->name('mainadmin.billerlog.user.save');
        Route::post('/billerlog-user-update', [\App\Http\Controllers\Mainadmin\MainAdminBillerLogUserController::class, 'billerlog_user_update'])->name('mainadmin.billerlog.user.update');
        Route::post('/billerlog-user-delete', [\App\Http\Controllers\Mainadmin\MainAdminBillerLogUserController::class, 'billerlog_user_delete'])->name('mainadmin.billerlog.user.delete');
    });
});


//------------------- provider section ----------------------------


Route::prefix('provider')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\ProviderLoginController::class, 'showLoginform'])->name('provider.login');
    Route::post('/login', [\App\Http\Controllers\Auth\ProviderLoginController::class, 'login'])->name('provider.login.submit');
    Route::get('/logout', [\App\Http\Controllers\Auth\ProviderLoginController::class, 'logout'])->name('provider.logout');
});

Route::group(['middleware' => ['auth:provider', 'onlineStatus']], function () {
    Route::prefix('provider')->group(function () {

        Route::get('/', [\App\Http\Controllers\Provider\ProviderController::class, 'index'])->name('provider.dashboard');

        //session
        Route::post('/get-all-providers', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'get_all_provider'])->name('provider.session.get.providers');
        Route::post('/get-all-clients', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'get_all_clients'])->name('provider.session.get.clients');
        Route::post('/appoinment-delete', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'appoinment_delete'])->name('provider.appoinment.delete');
        Route::post('/monthly-utilization', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'monthly_utilization'])->name('provider.session.monthly.utilization');
        Route::post('/update-activity', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'activity_update'])->name('provider.ativity.update');
        Route::get('/delete-activity/{id}', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'activity_delete'])->name('provider.ativity.delete');
        Route::get('/show-attach-file/{id}', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'open_attach_file'])->name('provider.session.open.attach');
        Route::post('/update-render', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'update_rendered'])->name('provider.session.update.render');
        Route::post('/session-update', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_update'])->name('provider.session.update');
        Route::post('/session-app-get-details', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_app_get_details'])->name('provider.session.app.get.details');
        Route::post('/session-get-template-name', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_get_template_name'])->name('provider.session.get.templatename');
        Route::post('/session-template-notes', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_note_open'])->name('provider.session.note.form.open');
        Route::post('/session-created-template-notes', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_created_template_name'])->name('provider.get.appoinment.created.templatename');
        Route::post('/session-created-template-notes-open', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_created_template_open'])->name('provider.session.note.createdform.open');

        //Create Session

        Route::post('/get-all-client', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'get_all_client'])->name('provider.get.all.client');
        Route::post('/get-all-employee', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'get_all_employee'])->name('provider.get.all.employee');
        Route::post('/client-authorization-by-client-id-all', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'get_authorization_by_client'])->name('provider.session.autho.get');
        Route::post('/client-authorization-activity-by-auth-id-all', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'get_authorization_activity_by_auth_id'])->name('provider.session.autho.activity.get');
        Route::post('/get-all-provider', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'get_all_provider'])->name('provider.session.get.all.provider');
        Route::post('/new-appoinement-save', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'appoinement_save'])->name('provider.session.save');
        Route::post('/appoinement-update-get-details', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'appoinement_update_get_details'])->name('provider.appoinment.update.get.details');
        Route::post('/appoinement-update', [\App\Http\Controllers\Provider\ProviderAppointmentController::class, 'appoinement_update'])->name('provider.appoinment.update');

        //sesstion note submit
        Route::post('/usp-form-one-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'usp_form_one_submit'])->name('provider.usp.form.one.submit');
        Route::post('/dsptn-form-two-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'sdptn_form_two_submit'])->name('provider.dsptn.two.form.submit');
        Route::post('/btsmf-form-three-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'btsmf_form_three_submit'])->name('provider.btsmf.three.form.submit');
        Route::post('/btusf-form-four-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'btusf_form_four_submit'])->name('provider.btusf.form.four.submit');
        Route::post('/msn-form-five-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'msn_form_five_submit'])->name('provider.msn.five.form.submit');
        Route::post('/tcsn-form-six-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'tcsn_form_six_submit'])->name('provider.tcsn.six.form.submit');

        Route::post('/form-7-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_7_submit'])->name('provider.7.form.submit');


        Route::post('/tp-form-edight-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'tp_form_eight_submit'])->name('provider.tp.eight.form.submit');

        Route::post('/form-9-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_9_submit'])->name('provider.9.form.submit');

        Route::post('/form-10-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_10_submit'])->name('provider.10.form.submit');


        Route::post('/cn-form-eleven-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'cn_form_eleven_submit'])->name('provider.sn.eleven.form.submit');

        Route::post('/form-12-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_12_submit'])->name('provider.12.form.submit');

        Route::post('/form-13-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_13_submit'])->name('provider.13.form.submit');

        Route::post('/form-14-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_14_submit'])->name('provider.14.form.submit');

        Route::post('/form-15-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_15_submit'])->name('provider.15.form.submit');

        Route::post('/form-16-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_16_submit'])->name('provider.16.form.submit');

        Route::post('/form-17-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_17_submit'])->name('provider.17.form.submit');
        Route::post('/form-18-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_18_submit'])->name('provider.18.form.submit');
        Route::post('/form-19-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_19_submit'])->name('provider.19.form.submit');
        Route::post('/form-20-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_20_submit'])->name('provider.20.form.submit');
        Route::post('/form-21-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_21_submit'])->name('provider.21.form.submit');
        Route::post('/form-22-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_22_submit'])->name('provider.22.form.submit');
        Route::post('/form-23-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_23_submit'])->name('provider.23.form.submit');
        Route::post('/form-24-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_24_submit'])->name('provider.24.form.submit');
        Route::post('/form-25-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_25_submit'])->name('provider.25.form.submit');
        Route::post('/form-26-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_26_submit'])->name('provider.26.form.submit');
        Route::post('/form-27-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_27_submit'])->name('provider.27.form.submit');
        Route::post('/form-28-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_28_submit'])->name('provider.28.form.submit');
        Route::post('/form-29-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_29_submit'])->name('provider.29.form.submit');
        Route::post('/form-30-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_30_submit'])->name('provider.30.form.submit');
        Route::post('/form-60-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_60_submit'])->name('provider.60.form.submit');
        Route::post('/form-61-submit', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'form_61_submit'])->name('provider.61.form.submit');


        Route::post('/froms-builder-save', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'forms_builders_save'])->name('provider.setting.forms.builder.save');

        Route::get('/froms-builder-view/{id}', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'forms_builders_view'])->name('provider.setting.forms.builder.view');

        Route::post('/settting/froms-builder-save-data', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'forms_builders_save_data'])->name('provider.setting.forms.builder.save.data');


        //sessio filter
        Route::post('/get-all-sessions', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'get_all_sessions'])->name('provider.session.get.appoinments');
        Route::any('/get-all-sessions', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'get_all_sessions_get']);

        //session singature
        Route::post('/session-id-data-get', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_id_data_get'])->name('provider.session.id.data.get');
        Route::post('/session-sinature-save', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_sinature_save'])->name('provider.session.singature.save');
        Route::post('/session-sinature-save-provider', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'session_sinature_save_provider'])->name('provider.session.singature.save.provider');

        //calender
        Route::get('/calender', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'calender'])->name('provider.calender');
        Route::post('/calender-get-all-client', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'calender_get_all_cleint'])->name('provider.calender.get.all.client');
        Route::get('/get-callender-data', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'get_calender_data'])->name('provider.get.calender.data');
        Route::get('/get-callender-data-filter', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'get_calender_data_filter'])->name('provider.get.calender.data.filter');
        Route::get('/calender-get-data-sync', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'calender_get_data_sunc'])->name('provider.calender.sync');
        Route::get('/calender-get-redirect', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'calender_get_redirect'])->name('provider.user.integration.authorize_google_calendar');

        //single calender
        Route::post('/single-calender-data', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'single_calender_data'])->name('provider.get.calender.data.single');
        Route::post('/appoinment-client-get', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'appoinment_client_get'])->name('provider.appoinment.client.get');
        Route::post('/appoinment-client-auth-get', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'appoinment_client_auth_get'])->name('provider.appoinment.autho.get');
        Route::post('/appoinment-client-auth-act-get', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'appoinment_client_auth_act_get'])->name('provider.appoinment.autho.activity.get');
        Route::post('/appoinment-get-all-provider', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'appoinment_get_all_provider'])->name('provider.get.all.provider');
        Route::post('/appoinment-data-update', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'appoinment_data_update'])->name('provider.get.calender.data.update');
        Route::post('/appoinment-save', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'appoinment_save'])->name('provider.appoinment.save');
        Route::post('/appoinment-update-single', [\App\Http\Controllers\Provider\ProviderCalenderController::class, 'appoinment_update_single'])->name('provider.appoinment.update.single');


        //info
        Route::get('/biographic', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'provider_info'])->name('provider.info');
        Route::post('/biographic-update', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'provider_info_update'])->name('provider.biographic.update');

        //contact details
        Route::get('/contact-info', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'provider_contact_info'])->name('provider.contact.details');
        Route::post('/contact-info-update', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'provider_contact_details_update'])->name('provider.contact.details.update');
        Route::post('/emergency-contact-update', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'provider_emergency_contact_update'])->name('provider.emergency.contact.details.update');

        //credentials
        Route::get('/credentials', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'credentials'])->name('provider.credentials');
        Route::post('/credentials-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'credentials_save'])->name('provider.credentials.save');
        Route::post('/clearance-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'clearance_save'])->name('provider.clearance.save');
        Route::post('/qualification-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'qualification_save'])->name('provider.qualification.save');


        Route::post('/credentials-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'credentials_save'])->name('provider.credentials.save');
        Route::post('/credentials-update', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'credentials_update'])->name('provider.credentials.update');
        Route::get('/credentials-delete/{id}', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'credentials_delete'])->name('provider.credentials.delete');

        Route::post('/clearance-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'clearance_save'])->name('provider.clearance.save');
        Route::post('/clearance-update', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'clearance_update'])->name('provider.clearance.update');
        Route::get('/clearance-delete/{id}', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'clearance_delete'])->name('provider.clearance.delete');

        Route::post('/qualification-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'qualification_save'])->name('provider.qualification.save');
        Route::post('/qualification-update', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'qualification_update'])->name('provider.qualification.update');
        Route::get('/qualification-delete/{id}', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'qualification_delete'])->name('provider.qualification.delete');


        //department
        Route::get('/department', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'department'])->name('provider.department');
        Route::post('/department-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'department_save'])->name('provider.department.save');

        //payroll
        Route::get('/payroll', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'payroll'])->name('provider.payroll');
        Route::post('/payroll-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'payroll_save'])->name('provider.payroll.save');

        //other setup
        Route::get('/other-setup', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'other_setup'])->name('provider.other.setup');
        Route::post('/other-setup-update', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'other_setup_update'])->name('provider.other.setup.update');

        //leave tracking
        Route::get('/leave-tracking', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'leave_tracking'])->name('provider.leave.tracking');
        Route::post('/leave-tracking', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'leave_tracking_save'])->name('provider.leave.save');

        //payor
        Route::get('/insurance-exclusion', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'insurance_exclusion'])->name('provider.payor.exclusion');
        Route::post('/insurance-exclusion-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'insurance_exclusion_save'])->name('provider.payor.exclusion.save');
        Route::post('/insurance-exclusion-show-all-payor', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'insurance_exclusion_show_all_payor'])->name('provider.show.all.payor');
        Route::post('/insurance-exclusion-show-assign-payor', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'insurance_exclusion_show_assign_payor'])->name('provider.show.assign.payor');
        Route::post('/insurance-exclusion-add-payor', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'insurance_exclusion_add_payor'])->name('provider.add.payor');
        Route::post('/insurance-exclusion-delete-payor', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'insurance_exclusion_delete_payor'])->name('provider.delete.assign.payor');

        //subactivity exclusion
        Route::get('/subactivity-exclusion', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'subactivity_exclusion'])->name('provider.subactivity.exclusion');
        Route::post('/subactivity-exclusion-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'subactivity_exclusion_save'])->name('provider.subactivity.exclusion.save');
        Route::post('/subactivity-exclusion-get-all-sub-act', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'subactivity_exclusion_get_all_sub_act'])->name('provider.get.all.sub.type');
        Route::post('/subactivity-exclusion-get-assign-sub-act', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'subactivity_exclusion_get_assign_sub_act'])->name('provider.get.assign.sub.type');
        Route::post('/subactivity-exclusion-delete-sub-act', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'subactivity_exclusion_delete_sub_act'])->name('provider.subactivity.exclusion.delete');

        //paient exclusion
        Route::get('/patient-exclustion', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'patient_exclustion'])->name('provider.client.exclusion');
        Route::post('/patient-exclustion-save', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'patient_exclustion_save'])->name('provider.client.exclusion.save');
        Route::post('/patient-exclustion-get-all-client', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'patient_exclustion_get_all_client'])->name('provider.get.all.clients');
        Route::post('/patient-exclustion-get-assign-client', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'patient_exclustion_get_assign_client'])->name('provider.get.assign.clients');
        Route::post('/patient-exclustion-delete-client', [\App\Http\Controllers\Provider\ProviderInfoController::class, 'patient_exclustion_delete_client'])->name('provider.client.exclusion.delete');

        //patient list
        Route::get('/patient-list', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_list'])->name('provider.patient.list');
        Route::post('/patient-list-get', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_list_get'])->name('provider.clients.list.get');
        Route::get('/patient-list-get', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_list_get_next']);
        Route::post('/patient-list-change-client-status', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_list_change_client_status'])->name('provider.clients.list.update.active');


        //client info
        Route::get('/patient-info/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_info'])->name('provider.client.info');
        Route::post('/patient-info-update', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_update'])->name('provider.client.info.update');
        Route::post('/patient-sign-delete', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_sing_delete'])->name('provider.client.sing.delete');
        Route::post('/patient-exists-phone-delete', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_exists_client_phon_delete'])->name('provider.delete.exist.client.phone');
        Route::post('/patient-exists-email-delete', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_exists_client_email_delete'])->name('provider.delete.exist.client.email');
        Route::post('/patient-exists-address-delete', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_exists_client_address_delete'])->name('provider.delete.exist.client.address');


        //client authorization
        Route::get('/patient-authorization/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_authorization'])->name('provider.client.authorization');
        Route::get('/patient-authorization-create/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_authorization_create'])->name('provider.client.authorization,create');
        Route::post('/patient-authorization-save', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_authorization_save'])->name('provider.client.authorization.save');
        Route::get('/patient-authorization-edit/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_authorization_edit'])->name('provider.client.authorization.edit');
        Route::post('/patient-authorization-update', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_authorization_update'])->name('provider.client.authorization.update');
        Route::get('/patient-authorization-delete/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_authorization_delete'])->name('provider.client.authorization.delete');
        Route::post('/patient-activity-save', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_activity_save'])->name('provider.client.authorization.ativity.save');
        Route::post('/patient-activity-update', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_activity_update'])->name('provider.client.authorization.ativity.update');
        Route::get('/patient-activity-delete/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_activity_delete'])->name('provider.client.authorization.ativity.delete');
        Route::post('/patient-copy-contact-rate', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_copy_contact_rate'])->name('provider.copy.contact.rate');

        //client document
        Route::get('/patient-document/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_document'])->name('provider.client.documents');
        Route::post('/patient-document-save', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_document_save'])->name('provider.client.upload.document');
        Route::post('/patient-document-update', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_document_update'])->name('provider.client.document.update');
        Route::get('/patient-document-delete/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_document_delete'])->name('provider.client.document.delete');


        //client portal
        Route::get('/patient-portal/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_portal'])->name('provider.client.portal');
        Route::post('/patient-portal-save', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_portal_save'])->name('provider.client.portal.save');

        //client activity
        Route::get('/patient-activity/{id}', [\App\Http\Controllers\Provider\ProviderClientController::class, 'patient_activity'])->name('provider.client.activity');

        //get subtype by tx
        Route::post('/get-subtype-by-tx-type', [\App\Http\Controllers\Provider\ProviderClientController::class, 'get_sub_type_tx_type'])->name('provider.get.subtype.by.tx');
        Route::post('/get-service-by-tx-type', [\App\Http\Controllers\Provider\ProviderClientController::class, 'get_service_tx_type'])->name('provider.get.service.by.tx');
        Route::post('/get-cptcodes-by-tx-type', [\App\Http\Controllers\Provider\ProviderClientController::class, 'get_cpt_codes_tx_type'])->name('provider.get.cpt.codes.by.tx');
        Route::post('/get-authdata-by-act', [\App\Http\Controllers\Provider\ProviderClientController::class, 'get_authdata_by_act'])->name('provider.get.authdata.by.act');


        //provider timesheet
        Route::get('/timesheet', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'payroll_timesheet'])->name('provider.payroll.timesheet');
        Route::post('/process-payroll-pay-priod-time-get', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'payroll_pay_time_get'])->name('provider.payroll.pay.period.time.get');
        Route::post('/process-payroll-payor-by-payid', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'payroll_get_payor_by_payid'])->name('provider.payroll.payor.by.payid');
        Route::post('/payroll-timesheet-appoinment', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'payroll_timesheet_appoinment'])->name('provider.payroll.timesheet.appoinment');
        Route::post('/payroll-timesheet-save', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'payroll_timesheet_save'])->name('provider.payroll.timesheet.save');
        Route::post('/payroll-timesheet-delete-single', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'payroll_timesheet_single_delete'])->name('provider.payroll.timesheet.delete.single');
        Route::post('/payroll-timesheet-bydayname', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'payroll_timesheet_bydayname'])->name('provider.payroll.timesheet.bydayname');
        Route::post('/payroll-timesheet-submit', [\App\Http\Controllers\Provider\ProviderPayrollController::class, 'submit_timesheet'])->name('provider.timesheet.submit');


        //provider account change passwrd
        Route::get('/change-password', [\App\Http\Controllers\Provider\ProviderController::class, 'change_password'])->name('provider.profile.change.password');

        //PDF
        Route::get('/settting/pdf', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'index'])->name('provider.pdf');
        Route::post('/settting/print-form-1', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'unique_supervision'])->name('provider.print.form.1');
        Route::post('/settting/print-form-2', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'parent_training'])->name('provider.print.form.2');
        Route::post('/settting/print-form-3', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'bcba_monthly'])->name('provider.print.form.3');
        Route::post('/settting/print-form-4', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'bcba_unique'])->name('provider.print.form.4');
        Route::post('/settting/print-form-5', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'monthly_supervision'])->name('provider.print.form.5');
        Route::post('/settting/print-form-6', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'communication'])->name('provider.print.form.6');
        Route::post('/settting/print-form-7', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'clinical_treatment'])->name('provider.print.form.7');
        Route::post('/settting/print-form-8', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'treatment_plan'])->name('provider.print.form.8');
        Route::post('/settting/print-form-9', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'client_intake'])->name('provider.print.form.9');
        Route::post('/settting/print-form-10', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'otr_form'])->name('provider.print.form.10');
        Route::post('/settting/print-form-11', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'cata'])->name('provider.print.form.11');
        Route::post('/settting/print-form-12', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'p_training'])->name('provider.print.form.12');
        Route::post('/settting/print-form-13', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'session_notes'])->name('provider.print.form.13');
        Route::post('/settting/print-form-14', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'reg_form_1'])->name('provider.print.form.14');
        Route::post('/settting/print-form-15', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'reg_form_2'])->name('provider.print.form.15');
        Route::post('/settting/print-form-16', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'service_plan'])->name('provider.print.form.16');
        Route::post('/settting/print-form-17', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'cp_clinical'])->name('provider.print.form.17');
        Route::post('/settting/print-form-18', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'cp_notes'])->name('provider.print.form.18');
        Route::post('/settting/print-form-19', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'cp_soap'])->name('provider.print.form.19');
        Route::post('/settting/print-form-20', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'gs_assessment'])->name('provider.print.form.20');
        Route::post('/settting/print-form-21', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'gs_parent'])->name('provider.print.form.21');
        Route::post('/settting/print-form-22', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'gs_supervision'])->name('provider.print.form.22');
        Route::post('/settting/print-form-23', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'gs_treatment'])->name('provider.print.form.23');
        Route::post('/settting/print-form-24', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'biopsych'])->name('provider.print.form.24');
        Route::post('/settting/print-form-25', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'birp_progress'])->name('provider.print.form.25');
        Route::post('/settting/print-form-26', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'dis_summary'])->name('provider.print.form.26');
        Route::post('/settting/print-form-27', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'language_progress'])->name('provider.print.form.27');
        Route::post('/settting/print-form-28', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'language_session'])->name('provider.print.form.28');
        Route::post('/settting/print-form-29', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'diagnosis_summary'])->name('provider.print.form.29');
        Route::post('/settting/print-form-30', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'datasheet'])->name('provider.print.form.30');
        Route::post('/settting/print-form-60', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'supervision_and_session'])->name('provider.print.form.60');
        Route::post('/settting/print-form-61', [\App\Http\Controllers\Provider\ProviderPDFController::class, 'session_notes_2'])->name('provider.print.form.61');


        //meet
        Route::post('/meet-session-create', [\App\Http\Controllers\Provider\ProviderSessionController::class, 'meet_session_create'])->name('provider.meet.session.start');

        //Profile


        Route::get('/profile', [\App\Http\Controllers\Provider\ProviderController::class, 'profile'])->name('provider.profile');
        Route::post('/profile-personal-update', [\App\Http\Controllers\Provider\ProviderController::class, 'personal_update'])->name('provider.profile.personal.update');
        Route::post('/profile-email-update', [\App\Http\Controllers\Provider\ProviderController::class, 'email_update'])->name('provider.profile.email.update');
        Route::post('/profile-contact-update', [\App\Http\Controllers\Provider\ProviderController::class, 'contact_update'])->name('provider.profile.contact.update');
        Route::post('/profile-password-verify', [\App\Http\Controllers\Provider\ProviderController::class, 'verify_password'])->name('provider.profile.verify.password');
        Route::post('/profile-password-update', [\App\Http\Controllers\Provider\ProviderController::class, 'password_update'])->name('provider.profile.password.update');
        Route::get('/account-change-password', [\App\Http\Controllers\Provider\ProviderController::class, 'account_chnage_password'])->name('provider.profile.change.password');


        //Chat Module
        Route::get('/chat', [\App\Http\Controllers\Provider\ProviderChatController::class, 'view_chat_page'])->name('provider.view.chat.page');
        Route::post('/chat/existing-chats', [\App\Http\Controllers\Provider\ProviderChatController::class, 'existing_chats'])->name('provider.existing.chats');
        Route::post('/chat/existing-msgs', [\App\Http\Controllers\Provider\ProviderChatController::class, 'existing_msgs'])->name('provider.existing.msgs');
        Route::post('/chat/scroll-msgs', [\App\Http\Controllers\Provider\ProviderChatController::class, 'scroll_msgs'])->name('provider.scroll.msgs');
        Route::post('/chat/send-msg', [\App\Http\Controllers\Provider\ProviderChatController::class, 'send_msg'])->name('provider.send.msg');
        Route::post('/chat/update-read-status', [\App\Http\Controllers\Provider\ProviderChatController::class, 'update_read_status'])->name('provider.update.read.status');
        Route::post('/chat/delete-chat', [\App\Http\Controllers\Provider\ProviderChatController::class, 'delete_chat'])->name('provider.delete.chat');
        Route::post('/chat/fetch-all-contacts', [\App\Http\Controllers\Provider\ProviderChatController::class, 'fetch_all_contacts'])->name('provider.fetch.all.contacts');
        Route::post('/chat/fetch-all-patients', [\App\Http\Controllers\Provider\ProviderChatController::class, 'fetch_all_patients'])->name('provider.fetch.all.patients');
        Route::post('/chat/generate-link', [\App\Http\Controllers\Provider\ProviderChatController::class, 'generate_link'])->name('provider.chat.generate.link');
        Route::post('/chat/find-all', [\App\Http\Controllers\Provider\ProviderChatController::class, 'find_all'])->name('provider.find.all');
        Route::get('/chat/download-file/{id}', [\App\Http\Controllers\Provider\ProviderChatController::class, 'download_file'])->name('provider.chat.download.file');
        Route::get('/chat/chat-history/{id}', [\App\Http\Controllers\Provider\ProviderChatController::class, 'chat_history'])->name('provider.chat.history');
        Route::post('/chat/upload-file', [\App\Http\Controllers\Provider\ProviderChatController::class, 'upload_file'])->name('provider.chat.upload.file');
        Route::post('/chat/delete-msg', [\App\Http\Controllers\Provider\ProviderChatController::class, 'delete_msg'])->name('provider.chat.delete.msg');
    });
});


//======================client portal start

Route::prefix('patient')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\ClientLoginController::class, 'showLoginform'])->name('client.login');
    Route::post('/login', [\App\Http\Controllers\Auth\ClientLoginController::class, 'login'])->name('client.login.submit');
    Route::get('/logout', [\App\Http\Controllers\Auth\ClientLoginController::class, 'logout'])->name('client.logout');
});

Route::group(['middleware' => ['auth:client', 'onlineStatus']], function () {
    Route::prefix('patient')->group(function () {

        Route::get('/', [\App\Http\Controllers\Client\ClientController::class, 'index'])->name('client.dashboard');

        //client my sessions
        Route::post('/get-my-sessions', [\App\Http\Controllers\Client\ClientSessionController::class, 'get_my_sessions'])->name('client.mysession.get');
        Route::get('/get-my-sessions', [\App\Http\Controllers\Client\ClientSessionController::class, 'get_my_sessions_next']);

        //client my callender
        Route::get('/my-callender', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender'])->name('client.mycallender');
        Route::get('/my-callender-get-data', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_get_data'])->name('client.get.mycalender.data');
        Route::get('/my-callender-get-data-filter', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_get_data_filter'])->name('client.get.mycalender.data.filter');
        Route::post('/my-callender-session-drop', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_session_drop'])->name('client.mycalender.session.drop');
        Route::post('/my-callender-get-single-data', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_get_single_data'])->name('client.get.calender.data.single');
        Route::post('/my-callender-get-client', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_get_client'])->name('client.calender.client.get');
        Route::post('/my-callender-get-auth', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_get_auth'])->name('client.calender.autho.get');
        Route::post('/my-callender-get-auth-act', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_get_auth_act'])->name('client.calender.autho.activity.get');
        Route::post('/my-callender-get-all-provider', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_get_all_provider'])->name('client.calender.get.all.provider');
        Route::post('/my-callender-appoinment-single-update', [\App\Http\Controllers\Client\ClientCallenderController::class, 'my_callender_appoinment_single_update'])->name('client.calender.appoinment.update.single');

        //client my info
        Route::get('/my-info', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_info'])->name('client.myinfo');
        Route::post('/my-info-update', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_info_update'])->name('client.myinfo.update');
        Route::post('/my-sign-delete', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_sign_delete'])->name('client.mysing.delete');
        Route::post('/my-info-phone-delete', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_info_phone_delete'])->name('clint.delete.exist.myinfo.phone');
        Route::post('/my-info-email-delete', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_info_email_delete'])->name('client.delete.exist.myinfo.email');
        Route::post('/my-info-address-delete', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_info_address_delete'])->name('client.delete.exist.myinfo.address');

        //client my authorization
        Route::get('/my-authorization', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_authorization'])->name('client.myauthorization');
        Route::get('/view-authorization/{id}', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_authorization_view'])->name('client.myauthorization.edit');
        Route::post('/view-authorization-get-subtype-tx', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_authorization_get_subtype_tx'])->name('client.myauthorization.get.subtype.by.tx');
        Route::post('/view-authorization-get-service-tx', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_authorization_get_service_tx'])->name('client.myauthorization.get.service.by.tx');
        Route::post('/view-authorization-get-cpt-tx', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_authorization_get_cpt_tx'])->name('client.myauthorization.get.cpt.codes.by.tx');
        Route::post('/view-authorization-get-authdata-by-act', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_authorization_get_authdata_act'])->name('client.myauthorization.get.authdata.by.act');

        //client my document
        Route::get('/my-documents', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_documents'])->name('client.mydocuments');
        Route::post('/my-documents-upload', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_documents_upload'])->name('client.mydocuments.upload');
        Route::post('/my-documents-update', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_documents_update'])->name('client.mydocuments.update');
        Route::get('/my-documents-delete/{id}', [\App\Http\Controllers\Client\ClientInfoController::class, 'my_documents_delete'])->name('client.mydocument.delete');

        //client my ledger
        Route::get('/my-ledger', [\App\Http\Controllers\Client\ClientLedgerController::class, 'my_ledger'])->name('client.myledger');
        Route::post('/my-ledger-get-all-cpt', [\App\Http\Controllers\Client\ClientLedgerController::class, 'my_ledger_get_all_cpt'])->name('client.myledger.get.all.cptcode');
        Route::post('/my-ledger-get', [\App\Http\Controllers\Client\ClientLedgerController::class, 'my_ledger_get'])->name('client.myledger.get');
        Route::get('/my-ledger-get', [\App\Http\Controllers\Client\ClientLedgerController::class, 'my_ledger_get_next']);

        //client myprofile change password
        Route::get('/change-password', [\App\Http\Controllers\Client\ClientController::class, 'client_myprofile_change_password'])->name('client.myprofile.change.password');
        Route::post('/change-password-update', [\App\Http\Controllers\Client\ClientController::class, 'client_myprofile_change_password_update'])->name('client.myprofile.change.password.update');

        //client my statement
        Route::get('/my-statement', [\App\Http\Controllers\Client\ClientStatementController::class, 'client_my_statement'])->name('client.mystatement');
        Route::post('/my-statement-paid', [\App\Http\Controllers\Client\ClientStatementController::class, 'client_my_statement_paid'])->name('client.statement.get.paid.data');
        Route::post('/my-statement-unpaid', [\App\Http\Controllers\Client\ClientStatementController::class, 'client_my_statement_unpaid'])->name('client.statement.get.unpaid.data');
        Route::post('/my-statement-get-data', [\App\Http\Controllers\Client\ClientStatementController::class, 'client_my_statement_get_data'])->name('client.statement.get.data');

        //payment
        Route::get('/payment', [\App\Http\Controllers\Client\ClientPaymentController::class, 'client_payment'])->name('client.mypayment');

        //stripe
        Route::post('/make-stripe-payment', [\App\Http\Controllers\Client\ClientPaymentController::class, 'client_stripe_payement_make'])->name('client.stripe.payment.make');


        //Profile
        Route::get('/profile', [\App\Http\Controllers\Client\ClientController::class, 'profile'])->name('client.profile');
        Route::post('/profile-personal-update', [\App\Http\Controllers\Client\ClientController::class, 'personal_update'])->name('client.profile.personal.update');
        Route::post('/profile-email-update', [\App\Http\Controllers\Client\ClientController::class, 'email_update'])->name('client.profile.email.update');
        Route::post('/profile-contact-update', [\App\Http\Controllers\Client\ClientController::class, 'contact_update'])->name('client.profile.contact.update');
        Route::post('/profile-password-verify', [\App\Http\Controllers\Client\ClientController::class, 'verify_password'])->name('client.profile.verify.password');
        Route::post('/profile-password-update', [\App\Http\Controllers\Client\ClientController::class, 'password_update'])->name('client.profile.password.update');
        Route::get('/account-change-password', [\App\Http\Controllers\Client\ClientController::class, 'account_chnage_password'])->name('client.profile.change.password');


        //Chat Module
        Route::get('/chat', [\App\Http\Controllers\Client\ClientChatController::class, 'view_chat_page'])->name('client.view.chat.page');
        Route::post('/chat/existing-chats', [\App\Http\Controllers\Client\ClientChatController::class, 'existing_chats'])->name('client.existing.chats');
        Route::post('/chat/existing-msgs', [\App\Http\Controllers\Client\ClientChatController::class, 'existing_msgs'])->name('client.existing.msgs');
        Route::post('/chat/scroll-msgs', [\App\Http\Controllers\Client\ClientChatController::class, 'scroll_msgs'])->name('client.scroll.msgs');
        Route::post('/chat/send-msg', [\App\Http\Controllers\Client\ClientChatController::class, 'send_msg'])->name('client.send.msg');
        Route::post('/chat/update-read-status', [\App\Http\Controllers\Client\ClientChatController::class, 'update_read_status'])->name('client.update.read.status');
        Route::post('/chat/delete-chat', [\App\Http\Controllers\Client\ClientChatController::class, 'delete_chat'])->name('client.delete.chat');
        Route::post('/chat/fetch-all-contacts', [\App\Http\Controllers\Client\ClientChatController::class, 'fetch_all_contacts'])->name('client.fetch.all.contacts');
        Route::post('/chat/fetch-all-patients', [\App\Http\Controllers\Client\ClientChatController::class, 'fetch_all_patients'])->name('client.fetch.all.patients');
        Route::post('/chat/generate-link', [\App\Http\Controllers\Client\ClientChatController::class, 'generate_link'])->name('client.chat.generate.link');
        Route::post('/chat/find-all', [\App\Http\Controllers\Client\ClientChatController::class, 'find_all'])->name('client.find.all');
        Route::get('/chat/download-file/{id}', [\App\Http\Controllers\Client\ClientChatController::class, 'download_file'])->name('client.chat.download.file');
        Route::get('/chat/chat-history/{id}', [\App\Http\Controllers\Client\ClientChatController::class, 'chat_history'])->name('client.chat.history');
        Route::post('/chat/upload-file', [\App\Http\Controllers\Client\ClientChatController::class, 'upload_file'])->name('client.chat.upload.file');
        Route::post('/chat/delete-msg', [\App\Http\Controllers\Client\ClientChatController::class, 'delete_msg'])->name('client.chat.delete.msg');
    });
});
