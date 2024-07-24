<?php

use App\Http\Controllers\ApplicantInteractionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobAlertController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobSearchController;
use App\Http\Controllers\JobseekerController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\RecruiterInteractionController;
use App\Http\Controllers\ResumeInteractionReplyController;
use App\Http\Controllers\ResumeInteractionController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ResumeVideoController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\SavedSearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\CreateNewRecruiter;
use App\Actions\Fortify\CreateNewJobseeker;

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

/*
|--------------------------------------------------------------------------
| Feed Routes
|--------------------------------------------------------------------------
|
| These routes handle the job feed and RSS feed functionality.
*/
Route::get('/jobfeed', [FeedController::class, 'jobFeed'])->name('jobFeed');
//Route::get('/rss', [FeedController::class, 'rssFeed'])->name('rssFeed');


/*
|--------------------------------------------------------------------------
| OAuth Routes
|--------------------------------------------------------------------------
|
| These routes handle the OAuth authentication process.
*/
Route::get('/auth/{provider}', [OAuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [OAuthController::class, 'handleProviderCallback']);
Route::get('/register/recruiter', function () {
    return view('auth.register-recruiter');
})->middleware(['guest'])->name('register.recruiter');
Route::post('/register/recruiter', [CreateNewRecruiter::class, 'create'])->middleware('guest')->name('register.recruiter');
Route::get('/register/jobseeker', function () {
    return view('auth.register-jobseeker');
})->middleware(['guest'])->name('register.jobseeker');
Route::post('/register/jobseeker', [CreateNewJobseeker::class, 'create'])->middleware('guest')->name('register.jobseeker');
;
/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| These routes require authentication and are grouped by user roles.
*/
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Recruiter Routes
    |--------------------------------------------------------------------------
    |
    | These routes are accessible only to authenticated recruiters.
    */
    Route::middleware('role:recruiter')->group(function () {
        Route::get('/recruiter/dashboard', [RecruiterController::class, 'dashboard'])->name('recruiter.dashboard');
        Route::post('/recruiter/dashboard', [RecruiterController::class, 'createUser'])->name('recruiter.create');
        Route::get('/recruiter/subscriptions', [RecruiterController::class, 'subscriptions'])->name('recruiter.subscriptions');
        Route::get('/recruiter/user-deactivate/{user}', [RecruiterController::class, 'deactivateUser'])->name('recruiter.deactivate');
        Route::get('/recruiter/messages/', [ApplicantInteractionController::class, 'messages'])->name('recruiter.messages');
        Route::get('/recruiter/messages/create/', [ApplicantInteractionController::class, 'create'])->where('id', '[0-9]+')->name('recruiter.message.create');
        Route::get('/recruiter/messages/{message:id}/reply', [ApplicantInteractionController::class, 'reply'])->where('id', '[0-9]+')->name('recruiter.message.reply');
        Route::get('/recruiter/messages/{message:id}', [ApplicantInteractionController::class, 'view'])->where('id', '[0-9]+')->name('recruiter.message.view');
        Route::get('/recruiter/messages/{message:id}/download', [ApplicantInteractionController::class, 'download'])->where('id', '[0-9]+')->name('recruiter.message.attachment');
        Route::get('/recruiter/resume-messages/', [ResumeInteractionController::class, 'messages'])->name('recruiter.resume-messages');
        Route::get('/recruiter/resume-messages/create/', [ResumeInteractionController::class, 'create'])->where('id', '[0-9]+')->name('recruiter.resume-message.create');
        Route::get('/recruiter/resume-messages/{message:id}/reply', [ResumeInteractionController::class, 'reply'])->where('id', '[0-9]+')->name('recruiter.resume-message.reply');
        Route::get('/recruiter/resume-messages/{message:id}', [ResumeInteractionController::class, 'view'])->where('id', '[0-9]+')->name('recruiter.resume-message.view');
        Route::get('/recruiter/resume-messages/{message:id}/download', [ResumeInteractionController::class, 'download'])->where('id', '[0-9]+')->name('recruiter.resume-message.attachment');

        // Job Post Routes
        Route::get('/job/{job}/questions', [JobPostController::class, 'questions'])->name('job.questions');
        Route::get('/job/{job}/copy', [JobPostController::class, 'copy'])->name('job.copy');
        Route::get('/job/{job}/expire', [JobPostController::class, 'expire'])->name('job.expire');
        Route::get('/job/{job}/download', [JobPostController::class, 'download'])->name('job.download');
        Route::get('/job/{job}/duplicate', [JobPostController::class, 'duplicate'])->name('job.duplicate');
        Route::get('/job/{job}/expire', [JobPostController::class, 'expire'])->name('job.expire');
        Route::get('/job/all', [JobPostController::class, 'all'])->name('job.all');
        Route::resource('job', JobPostController::class);

        // Resume Routes
        Route::get('/resume/search', [ResumeController::class, 'search'])->name('resume.search');
        Route::get('/resume/download/{resume}/application/{application}', [ResumeController::class, 'download'])->name('resume.download.application');
        Route::get('/resume/download/{resume}/recruiter', [ResumeController::class, 'download'])->name('resume.download.recruiter')->middleware('auth.resume:resume,canViewResume');
        Route::get('/resume/{resume:id}/contact', [ResumeController::class, 'contact'])->where('id', '[0-9]+')->name('resume.contact');
        Route::get('/resume-video/view/{user:id}', [ResumeVideoController::class, 'watch'])->where('id', '[0-9]+')->name('resume-video.watch');
        Route::get('/view-video/{user:id}', [ResumeVideoController::class, 'view'])->where('id', '[0-9]+')->name('resume-video.view');

        // Application Routes
        Route::get('/applications/{job:job_id}', [ApplicationController::class, 'list'])->where('job_id', '[0-9]+')->name('applications.list');
        Route::get('/application/{application:id}', [ApplicationController::class, 'review'])->where('id', '[0-9]+')->name('application.review');
        Route::get('/application/{application:id}/contact', [ApplicationController::class, 'contact'])->where('id', '[0-9]+')->name('application.contact');
        Route::get('/application/{application:id}/status/{status}', [ApplicationController::class, 'statusUpdate'])->where('id', '[0-9]+')->where('status', '[0-6]+')->name('application.status');
        Route::get('/application/{application:id}/status/6', [ApplicationController::class, 'statusUpdate'])->where('id', '[0-9]+')->name('application.decline');

        // Order and Payment Routes
        Route::get('/checkout/{order:orders_id}/success', [OrderController::class, 'success'])->where('orders_id', '[0-9]+')->middleware('auth.recruiter:order,canViewInvoice')->name('order.success');
        Route::get('/checkout/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
        Route::get('/checkout/{rate:id}', [OrderController::class, 'create'])->where('id', '[0-9]+')->name('order.create');
        Route::get('/order/{order:orders_id}', [OrderController::class, 'view'])->where('orders_id', '[0-9]+')->middleware('auth.recruiter:order,canViewInvoice')->name('order.view');
        Route::get('/invoice/{order:orders_id}', [PDFController::class, 'invoice'])->where('orders_id', '[0-9]+')->middleware('auth.recruiter:order,canViewInvoice')->name('pdf.invoice');
        Route::get('/checkout/process/{rate:id}', [OrderController::class, 'process'])->where('id', '[0-9]+')->name('order.process');
    });

    /*
    |--------------------------------------------------------------------------
    | Jobseeker Routes
    |--------------------------------------------------------------------------
    |
    | These routes are accessible only to authenticated jobseekers.
    */
    Route::middleware(['role:jobseeker', 'App\Http\Middleware\CheckJobseekerAuthorization'])->group(function () {
        Route::get('jobseeker/dashboard', [JobseekerController::class, 'dashboard'])->name('jobseeker.dashboard');
        Route::get('/jobseeker/messages/', [RecruiterInteractionController::class, 'messages'])->name('jobseeker.messages');
        Route::get('/jobseeker/messages/create/', [RecruiterInteractionController::class, 'create'])->where('id', '[0-9]+')->name('jobseeker.message.create');
        Route::get('/jobseeker/messages/{message:id}/reply', [RecruiterInteractionController::class, 'reply'])->where('id', '[0-9]+')->name('jobseeker.message.reply');
        Route::get('/jobseeker/messages/{message:id}', [RecruiterInteractionController::class, 'view'])->where('id', '[0-9]+')->name('jobseeker.message.view');
        Route::get('/jobseeker/messages/{message:id}/download', [RecruiterInteractionController::class, 'download'])->where('id', '[0-9]+')->name('jobseeker.message.attachment');
        Route::get('/jobseeker/resume-messages/', [ResumeInteractionReplyController::class, 'messages'])->name('jobseeker.resume-message');
        Route::get('/jobseeker/resume-messages/create/', [ResumeInteractionReplyController::class, 'create'])->where('id', '[0-9]+')->name('jobseeker.resume-message.create');
        Route::get('/jobseeker/resume-messages/{message:id}/reply', [ResumeInteractionReplyController::class, 'reply'])->where('id', '[0-9]+')->name('jobseeker.resume-message.reply');
        Route::get('/jobseeker/resume-messages/{message:id}', [ResumeInteractionReplyController::class, 'view'])->where('id', '[0-9]+')->name('jobseeker.resume-message.view');
        Route::get('/jobseeker/resume-messages/{message:id}/download', [ResumeInteractionReplyController::class, 'download'])->where('id', '[0-9]+')->name('jobseeker.resume-message.attachment');

        // Application Routes
        Route::get('/apply/{job:job_id}', [ApplicationController::class, 'create'])->where('job_id', '[0-9]+')->name('apply.create');
        Route::get('/apply/{application:id}/{job:job_id}/', [ApplicationController::class, 'update'])->where('id', '[0-9]+')->where('job_id', '[0-9]+')->name('apply.view');
        Route::delete('/apply/{application:id}/', [ApplicationController::class, 'destroy'])->where('id', '[0-9]+')->name('apply.destroy');

        // Resume Routes
        Route::get('/resume/download/{resume}', [ResumeController::class, 'download'])->name('resume.download.jobseeker')->middleware('auth.resume:resume,canViewResume');
        Route::get('/resume/create', [ResumeController::class, 'create'])->name('resume.create');
        Route::post('/resume', [ResumeController::class, 'store'])->name('resume.store');

        // Job Alert Routes
        Route::get('/jobalert/create', [JobAlertController::class, 'create'])->name('jobalert.jobseeker');
        Route::get('/jobalert/edit/{jobalert}', [JobAlertController::class, 'edit'])->where('id', '[0-9]+')->name('jobalert.jobseeker.edit');
        Route::delete('/jobalert/{jobalert}', [JobAlertController::class, 'destroy'])->where('id', '[0-9]+')->name('jobalert.jobseeker.destroy');

        // Cover Letter Routes
        Route::get('/cover-letter/create', [CoverLetterController::class, 'create'])->name('cover-letter.create');
        Route::get('/cover-letter/edit/{coverletter}', [CoverLetterController::class, 'edit'])->where('id', '[0-9]+')->name('cover-letter.edit');
        Route::delete('/cover-letter/{coverletter}', [CoverLetterController::class, 'destroy'])->where('id', '[0-9]+')->name('cover-letter.destroy');

        // Saved Search and Saved Job Routes
        Route::resource('saved-searches', SavedSearchController::class);
        Route::resource('saved-jobs', SavedJobController::class);

        // Resume Video Routes
        Route::get('/resume-video/create', [ResumeVideoController::class, 'create'])->name('resume-video.create');
        Route::post('/resume-video/store', [ResumeVideoController::class, 'store'])->name('resume-video.store');
        Route::get('/resume-video/show', [ResumeVideoController::class, 'show'])->name('resume-video.show');
        Route::get('/play-video/', [ResumeVideoController::class, 'play'])->name('resume-video.play');
    });

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    |
    | These routes are accessible to all authenticated users.
    */
    Route::middleware('role:user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Resume Routes
    |--------------------------------------------------------------------------
    |
    | These routes handle the CRUD operations for resumes.
    */
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');
    Route::get('/resume/{resume}', [ResumeController::class, 'show'])->name('resume.show')->middleware('auth.resume:resume,canViewResume');
    Route::get('/resume/{resume}/edit', [ResumeController::class, 'edit'])->name('resume.edit')->middleware('auth.resume:resume,canViewResume');
    Route::put('/resume/{resume}', [ResumeController::class, 'update'])->name('resume.update')->middleware('auth.resume:resume,canViewResume');
    Route::delete('/resume/{resume}', [ResumeController::class, 'destroy'])->name('resume.destroy')->middleware('auth.resume:resume,canViewResume');
});

/*
|--------------------------------------------------------------------------
| Job Search Routes
|--------------------------------------------------------------------------
|
| These routes handle the job search functionality.
*/
Route::get('/jobs', [JobSearchController::class, 'index'])->name('jobs');
Route::get('/jobs/category/{category:slug}/keywords/{keywords}', [JobSearchController::class, 'categoryKeyword'])->name('jobs.category_keyword');
Route::get('/jobs/category/{category:slug}', [JobSearchController::class, 'category'])->name('jobs.category');
Route::get('/jobs/category/{category:slug}/location/{location}/keywords/{keywords}', [JobSearchController::class, 'categoryLocationKeyword'])->name('jobs.category_location_keyword');
Route::get('/jobs/category/{category:slug}/location/{location}', [JobSearchController::class, 'categoryLocation'])->name('jobs.category_location');
Route::get('/jobs/category/{category:slug}/{sub_category:slug}/keywords/{keywords}', [JobSearchController::class, 'subCategoryKeyword'])->name('jobs.sub_category_keyword');
Route::get('/jobs/category/{category:slug}/{sub_category:slug}', [JobSearchController::class, 'subCategory'])->name('jobs.sub_category');
Route::get('/jobs/category/{category:slug}/{sub_category:slug}/location/{location}/keywords/{keywords}', [JobSearchController::class, 'subCategoryLocationKeyword'])->name('jobs.sub_category_location_keyword');
Route::get('/jobs/category/{category:slug}/{sub_category:slug}/location/{location}', [JobSearchController::class, 'subCategoryLocation'])->name('jobs.sub_category_location');
Route::get('/jobs/location/{location}/keywords/{keywords}', [JobSearchController::class, 'locationKeyword'])->name('jobs.location_keyword');
Route::get('/jobs/location/{location}', [JobSearchController::class, 'location'])->name('jobs.location');
Route::get('/jobs/search/{keywords}', [JobSearchController::class, 'keywords'])->name('jobs.keywords');
Route::post('/jobs/search', [JobSearchController::class, 'search'])->name('jobs.search');
Route::get('/jobs/{job:job_id}', [JobSearchController::class, 'single'])->where('job_id', '[0-9]+')->name('jobs.single_id');
Route::get('/jobs/{job:job_id}/{job_title:slug?}', [JobSearchController::class, 'single'])->where('job_id', '[0-9]+')->name('jobs.single_slug');

// JobAlerts for unregistered users
Route::get('/jobalert/new', [JobAlertController::class, 'new'])->name('jobalert.unregistered');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| These routes are accessible to all users, including guests.
*/
Route::get('/company/{recruiter:recruiter_company_seo_name}', [RecruiterController::class, 'single'])->name('company.single');
Route::get('/rates', [RateController::class, 'index'])->name('rates');
Route::get('/rates/{rate:slug}', [RateController::class, 'single'])->name('rate');
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/blog/category/{category:slug}', [PostController::class, 'category'])->name('category');
Route::get('/blog/{post:slug}', [PostController::class, 'single'])->name('post');
Route::get('{page:slug}', [PageController::class, 'single'])->name('page');
Route::get('/', [HomeController::class, 'index'])->name('home');