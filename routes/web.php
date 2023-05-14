<?php

use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\FrameworkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\LinkedinSocialiteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\MollieController;
use App\Http\Controllers\TwoFAController;
use App\Http\Controllers\Userweb\ArticleController;
use App\Http\Controllers\Userweb\ChatController;
use App\Http\Controllers\Userweb\LanguageController;
use App\Http\Controllers\Userweb\ProfileController;
use App\Http\Controllers\Userweb\ResultController;
use App\Http\Controllers\Userweb\ResponseController;
use App\Http\Controllers\Userweb\AudioController;
use App\Http\Controllers\Userweb\TemsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Installer\InstallerController;
use App\Http\Controllers\Userweb\NewChatController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UserTeamsController;
use App\Http\Controllers\Userweb\TeamsController;
use App\Http\Controllers\Admin\MostController;
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


Route::get('/clear-all', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cache, route, view, config is cleared";
});


Route::group(['namespace' => 'Installer'], function () {
Route::get('/verifyLicense', [InstallerController::class, 'verifyLicense'])->name('verifyLicense');
Route::get('/installFinish', [InstallerController::class, 'installFinish'])->name('installFinish');
Route::get('/verification', [InstallerController::class, 'requirement'])->name('verification');
Route::get('/verify', [InstallerController::class, 'verify'])->name('verify');
Route::post('/verifyPost', [InstallerController::class, 'verifyPost'])->name('verifyPost');
Route::get('/databaseinst', [InstallerController::class, 'databaseinst'])->name('databaseinst');
Route::post('/databasePost', [InstallerController::class, 'databasePost'])->name('databasePost');

Route::get('/verifyLicense', [InstallerController::class, 'verifyLicense'])->name('verifyLicense');

 Route::post('databaseVerifyPost', function () {
        Artisan::call('config:cache');
        Artisan::call('config:clear');

        return app(\App\Http\Controllers\Installer\InstallerController::class)->databaseVerifyPost();
    });
  });

Route::group(['prefix' => 'install'], function () {
    Route::post('/settings', [InstallerController::class, 'system_settings'])->name('system_settings');
   
      });



Route::get('/', [HomeController::class, 'homepage'])->name('mainhome');



Auth::routes();
	 


Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'adminlogout'])->name('admin.logout');
Route::get('/admin/register', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register', [RegisterController::class, 'createAdmin'])->name('admin.register');
Route::get('/verify/{token}', [VerificationController::class, 'verifyAccount'])->name('email.verify');

Route::group(['namespace' => 'Admin', 'middleware' => ['auth:admin'], 'as' => 'admin.'], function () {

    Route::get('/edit-admins-profile', [AdminProfileController::class, 'edit_profile'])->name('edit-admins-profile');
    Route::post('/update-admins-profile', [AdminProfileController::class, 'update_profile'])->name('update-admins-profile');


    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     Route::get('/admin/edithomepage', [HomeController::class, 'edithomepage'])->name('edithomepage');
    Route::get('/admin/edithome/{id}', [HomeController::class, 'edithome'])->name('edithome');
    Route::post('/admin/updatehome/{id}', [HomeController::class, 'updatehome'])->name('updatehome');
    Route::get('/admin/home_how_to_list', [HomeController::class, 'how_to_list'])->name('home_how_to_list');
    Route::post('/admin/how_to_box_create', [HomeController::class, 'how_to_box_create'])->name('how_to_box_create');
    Route::post('/admin/how_to_section_update/{id}', [HomeController::class, 'how_to_section_update'])->name('how_to_section_update');

    
    Route::get('/admin/use_cases_list', [HomeController::class, 'use_cases_list'])->name('use_cases_list');
    Route::post('/admin/use_cases_create', [HomeController::class, 'use_cases_create'])->name('use_cases_create');
    Route::get('/admin/use_cases_edit/{id}', [HomeController::class, 'use_cases_edit'])->name('use_cases_edit');
    Route::post('/admin/use_cases_update/{id}', [HomeController::class, 'use_cases_update'])->name('use_cases_update');
    
    Route::get('/admin/home2_box_list', [HomeController::class, 'home2_box_list'])->name('home2_box_list');
    Route::post('/admin/home2_box_create', [HomeController::class, 'home2_box_create'])->name('home2_box_create');
    Route::get('/admin/home2_box_edit/{id}', [HomeController::class, 'home2_box_edit'])->name('home2_box_edit');
    Route::post('/admin/home2_box_update/{id}', [HomeController::class, 'home2_box_update'])->name('home2_box_update');

    
    Route::get('/admin/faq_list', [HomeController::class, 'faq_list'])->name('faq_list');
    Route::post('/admin/faq_create', [HomeController::class, 'faq_create'])->name('faq_create');
    Route::get('/admin/faq_edit/{id}', [HomeController::class, 'faq_edit'])->name('faq_edit');
    Route::post('/admin/faq_update/{id}', [HomeController::class, 'faq_update'])->name('faq_update');
    
    // Route::get('/admin/footer_block_list', [HomeController::class, 'footer_block_list'])->name('footer_block_list');
    // Route::post('/admin/footer_block_create', [HomeController::class, 'footer_block_create'])->name('footer_block_create');
    Route::get('/admin/footer_block_edit', [HomeController::class, 'footer_block_edit'])->name('footer_block_edit');
    Route::post('/admin/footer_block_update/{id}', [HomeController::class, 'footer_block_update'])->name('footer_block_update');

    Route::get('/admin/banner_edit', [HomeController::class, 'banner_edit'])->name('banner_edit');
    Route::post('/admin/banner_update/{id}', [HomeController::class, 'banner_update'])->name('banner_update');


    Route::get('/admin/pricing_list', [HomeController::class, 'pricing_list'])->name('pricing_list');
    Route::post('/admin/pricing_create', [HomeController::class, 'pricing_create'])->name('pricing_create');
    Route::get('/admin/pricing_edit/{id}', [HomeController::class, 'pricing_edit'])->name('pricing_edit');
    Route::post('/admin/pricing_update', [HomeController::class, 'pricing_update'])->name('pricing_update');

    Route::group(['prefix' => 'plan', 'as' => 'plan.'], function () {
        Route::get('plan-list', [PlanController::class, 'list'])->name('list');
        Route::get('plan-add', [PlanController::class, 'add'])->name('add');
        Route::post('store', [PlanController::class, 'store'])->name('store');
        Route::get('plan-edit/{id}', [PlanController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PlanController::class, 'update'])->name('update');
        Route::get('delete/{id}', [PlanController::class, 'delete'])->name('delete');

    });

    Route::group(['prefix' => 'language', 'as' => 'language.'], function () {
        Route::get('lang_list', [AdminLanguageController::class, 'list'])->name('list');
        Route::get('lang_add', [AdminLanguageController::class, 'add'])->name('add');
        Route::post('store', [AdminLanguageController::class, 'store'])->name('store');
        Route::get('lang_edit/{id}', [AdminLanguageController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [AdminLanguageController::class, 'update'])->name('update');
        Route::get('delete/{id}', [AdminLanguageController::class, 'delete'])->name('delete');

    });

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('index', [SettingController::class, 'index'])->name('index');
        Route::post('update', [SettingController::class, 'update'])->name('update');

    });
    Route::group(['prefix' => 'payment_gateway', 'as' => 'payment_gateway.'], function () {
        Route::get('/', [SettingController::class, 'payment_index'])->name('index');
        Route::post('update', [SettingController::class, 'payment_update'])->name('update');

    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('list', [UserController::class, 'list'])->name('list');
        Route::get('add', [UserController::class, 'add'])->name('add');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::get('docs', [UserController::class, 'docs'])->name('docs');
        Route::get('history', [UserController::class, 'history'])->name('history');
        Route::get('transactions', [UserController::class, 'transaction'])->name('transactions');


    });

    Route::group(['prefix' => 'prompt', 'as' => 'template.'], function () {
        Route::get('/', [TemplateController::class, 'list'])->name('list');
        Route::get('add-prompt', [TemplateController::class, 'add'])->name('add');
        Route::post('store', [TemplateController::class, 'store'])->name('store');
        Route::get('edit-prompt/{id}', [TemplateController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [TemplateController::class, 'update'])->name('update');
        Route::get('delete/{id}', [TemplateController::class, 'delete'])->name('delete');
        Route::get('premium/{id}', [TemplateController::class, 'premium'])->name('premium');
        Route::get('popular/{id}', [TemplateController::class, 'popular'])->name('popular');
        Route::get('highlighted/{id}', [TemplateController::class, 'highlighted'])->name('highlighted');
    });

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'list'])->name('list');
        Route::get('add-category', [CategoryController::class, 'add'])->name('add');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit-category/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'membership', 'as' => 'membership.'], function () {
        Route::get('/', [MembershipController::class, 'list'])->name('list');
        Route::get('edit_membership/{id}', [MembershipController::class, 'edit'])->name('edit');
        Route::post('update_membership/{id}', [MembershipController::class, 'update'])->name('update');
        Route::group(['prefix' => 'details', 'as' => 'details.'], function () {
            Route::get('/{id}', [MembershipController::class, 'sublist'])->name('list');
            Route::get('edit_membership/{id}', [MembershipController::class, 'subedit'])->name('edit');
            Route::post('update_membership/{id}', [MembershipController::class, 'subupdate'])->name('update');

        });

    });


    // user teams
    Route::get('/user_team/{id}', [UserTeamsController::class, 'index'])->name('user_team');
    Route::get('/user-teamlist/{id}', [UserTeamsController::class,'teamlist'])->name('user_teamlist');
    Route::post('/user-create/{id}', [UserTeamsController::class,'create'])->name('user_create_team');
    Route::get('/user-team/edit/{id}', [UserTeamsController::class,'edit'])->name('user_team_edit');
    Route::post('/user-team/delete/{id}', [UserTeamsController::class,'delete'])->name('user_team_delete');
    Route::post('/user-team/update/{id}', [UserTeamsController::class,'update'])->name('user_team.update');
    //user notification
    Route::get('/user-notification', [NotificationController::class,'index'])->name('notification');
    Route::get('/user-notification/list', [NotificationController::class,'notification_list'])->name('notification_list');
    Route::post('/user-notification/create', [NotificationController::class,'create'])->name('notification_create');
    Route::get('/user-notification/edit/{id}', [NotificationController::class,'edit'])->name('notification_edit');
    Route::post('/user-notification/update/{id}', [NotificationController::class,'update'])->name('notification_update');
    Route::get('/user-notification/delete/{id}', [NotificationController::class,'delete'])->name('notification_delete');

   
    Route::get('/notification/email', [NotificationController::class,'email'])->name('notification.email');
    Route::post('/notification/send-mail', [NotificationController::class,'send_mail'])->name('send.email');

    //Award Route
    Route::get('/award', [AwardController::class,'index'])->name('award');
    Route::get('/award/list', [AwardController::class,'awardlist'])->name('award.list');
    Route::post('/award/create', [AwardController::class,'create'])->name('award.create');
    Route::get('/award/edit/{id}', [AwardController::class,'edit'])->name('award.edit');
    Route::post('/award/update/{id}', [AwardController::class,'update'])->name('award.update');
    Route::get('/award/delete/{id}', [AwardController::class,'delete'])->name('award.delete');
	
	
	//populartools
	Route::get('/mostused_templates', [MostController::class,'popular'])->name('populartools');
	Route::get('/liked_disliked_report', [MostController::class,'liked_disliked_report'])->name('liked_disliked_report');
	
	

    




});


Auth::routes(['verify' => true]);


Route::get('/login/google', [GoogleLoginController::class, 'redirect'])->name('login.google-redirect');
Route::get('/login/google/callback', [GoogleLoginController::class, 'callback'])->name('login.google-callback');

Route::get('auth/facebook', [FacebookLoginController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [FacebookLoginController::class, 'loginWithFacebook']);

Route::get('auth/linkedin', [LinkedinSocialiteController::class, 'redirectToLinkedin']);
Route::get('callback/linkedin', [LinkedinSocialiteController::class, 'handleCallback']);

Route::controller(TwoFAController::class)->group(function () {
    Route::get('two-factor-authentication', 'index')->name('2fa.index');
    Route::post('two-factor-authentication/store', 'store')->name('2fa.store');
    Route::get('two-factor-authentication/resend', 'resend')->name('2fa.resend');
});


Route::get('secret-login/{id}', [TwoFAController::class, 'secretLogin'])->name('secret_login');


Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');

});


 Route::get('/user_plan_expired', function () {
            return view('verification.teamadmin');
        })->name('user_plan_expired');

// user web////
Route::group(['middleware' => ['auth', 'verified','plan_check']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/payment', [PaymentController::class, 'index']);
    Route::post('/transaction', [PaymentController::class, 'makePayment'])->name('make-payment');
    Route::get('payment_successfull', [PaymentController::class, 'success']);
    Route::get('payment_failed', [PaymentController::class, 'failed']);

    Route::get('paysuccess', [RazorpayController::class, 'razorPaySuccess'])->name('success_payments');
  

      Route::post('/token_top_up', [TokenController::class, 'makePayment'])->name('token_top_up');
      Route::get('token_payment_successfull', [TokenController::class, 'token_payment_successfull']);
      Route::get('token_payment_failed', [TokenController::class, 'token_payment_failed']);

      Route::get('paysuccess_tokens', [RazorpayController::class, 'razorPaySuccessTokens'])->name('razorPaySuccessTokens');

});

Route::group(['namespace' => 'Userweb', 'middleware' => ['auth', 'verified','plan_check']], function () {

        Route::get('user_transaction', [ProfileController::class, 'user_transaction'])->name('user_transaction');
        Route::get('user_history', [ProfileController::class, 'user_history'])->name('user_history');

        Route::get('/edit-profile', [ProfileController::class, 'edit_profile'])->name('edit-user-profile');
        Route::post('/update-user-profile', [ProfileController::class, 'update_profile'])->name('update-user-profile');
        Route::get('/ai/{slug}', [TemsController::class, 'ai_section'])->name('ai');

        /*authentication*/

        Route::get('/panel', function () {
            return view('userweb.dashboard');
        })->name('user_dashboard');

        Route::get('/templates', [TemsController::class, 'templates'])->name('templatesss');
        Route::post('/get_result', [ResultController::class, 'index'])->name('get_result');
        Route::post('/save_project', [TemsController::class, 'save_project'])->name('save_project');
        Route::post('/create_folder', [TemsController::class, 'create_folder'])->name('create_folder');


        Route::post('/move_project_to_folder', [TemsController::class, 'move_project_to_folder'])
            ->name('move_project_to_folder');

        Route::post('/set_language', [LanguageController::class, 'set_language'])->name('set_language');
        Route::get('/edit_project', [ResultController::class, 'edit'])->name('edit_project');
        Route::post('/update_project', [TemsController::class, 'update_project'])->name('update_project');
        Route::get('/folder_projects', [TemsController::class, 'folder_projects'])->name('folder_project');
        Route::get('/all_folders', [TemsController::class, 'all_folderss'])->name('all_folders');
        Route::get('/mycontent', [TemsController::class, 'mycontent'])->name('mycontent');
        Route::get('/myusage', [TemsController::class, 'myusage'])->name('myusage');
        Route::get('/billing', [TemsController::class, 'billing'])->name('billing');
        Route::get('/alltools', [TemsController::class, 'alltools'])->name('alltools');
        Route::post('/save_image', [ResultController::class, 'save_image'])->name('save_image');
        Route::get('/open_chat', [ChatController::class, 'open_chat'])->name('open_chat');
        Route::get('/all_tools', [TemsController::class, 'all_toolss'])->name('all_toolss');
        Route::get('/article_generator', [TemsController::class, 'article_generator'])->name('article_generator');
        Route::post('/generated_article', [ArticleController::class, 'generated_article'])->name('generated_article');
        Route::post('/chat_competions', [ChatController::class, 'chat_competions'])->name('chat_competions');
        Route::get('/new_chat', [ChatController::class, 'new_chat'])->name('new_chat');
        Route::get('/open_existing_chat/{chat_id}', [ChatController::class, 'open_existing_chat'])->name('reopened_chat');


         Route::post('/get_response', [ResponseController::class, 'response'])->name('get_response');
          Route::post('/start_new_chat', [ChatController::class, 'start_new_chat'])->name('start_new_chat');
          Route::get('/start_new_chat', [ChatController::class, 'open_chat']);
         Route::get('/chat_to_favourite/{status}/{slug}', [ChatController::class, 'chat_to_favourite'])->name('chat_to_favourite');


         Route::get('/audio', [AudioController::class, 'audio'])->name('audio');
         Route::post('/audio_to_text', [AudioController::class, 'audio_to_text'])->name('audio_to_text');
         Route::post('/audio_translate', [AudioController::class, 'audio_translate'])->name('audio_translate');


        Route::get('/all_experts', [NewChatController::class, 'all_experts'])->name('all_experts');
        //new route for team 
        Route::get('/team', [TeamsController::class, 'index'])->name('team');
        Route::get('/teamlist', [TeamsController::class, 'teamlist'])->name('teamlist');
        Route::post('/create_team', [TeamsController::class, 'create_team'])->name('create_team');
        Route::get('/team/edit/{id}', [TeamsController::class, 'edit'])->name('team.edit');
        Route::post('/team/update/{id}', [TeamsController::class, 'update'])->name('team.update');
        Route::post('/team/delete/{id}', [TeamsController::class, 'delete'])->name('team.delete');
     	Route::post('/user/award', [AwardController::class,'useraward'])->name('user.award');
	    Route::get('/readnoti/{id}', [NotificationController::class,'readnotification'])->name('readnoti');
	 Route::post('/get_edited_image', [ResultController::class, 'get_edited_image'])->name('get_edited_image');
	
	Route::post('/like', [ResponseController::class,'like'])->name('like');
	Route::post('/dislike', [ResponseController::class,'dislike'])->name('dislike');
	Route::post('/articlelike', [ResponseController::class,'articlelike'])->name('articlelike');
	Route::post('/articledislike', [ResponseController::class,'articledislike'])->name('articledislike');
  })->middleware('auth:user');



