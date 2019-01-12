<?php

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

// Route::get('/', function () {
    
//     return view('auth.login');
// });

Route::get('/', 'welcomeController@showWelcomePage')->name('welcomePage');
Route::post('/', 'welcomeController@showlogin')->name('show.role.login');


Auth::routes();

//clients only
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/logout', 'HomeController@userlogout');
Route::get('/view/user/transaction','userController@getTransactions')->name('view.transaction');
Route::post('propertyRegistration/fetch', 'HomeController@fetch')->name('dynamicdependent.fetch');
Route::get('/confirm/meeting/{pid}{mid}', 'HomeController@confirmMeeting');
Route::get('/compose/email', 'HomeController@showMailCompose')->name('show.mailCompose');
Route::get('/upload/documents', 'HomeController@showUploadDoc')->name('show.uploadDoc');
Route::post('/upload/documents', 'HomeController@uploadDoc')->name('show.UploadDocs');
Route::get('/uploaded/documents', 'HomeController@viewUploadedDoc')->name('show.UploadedDocs');
Route::get('/meetings', 'HomeController@meeting')->name('client.meetings');
Route::get('/meeting/add/del/up', 'HomeController@meetingForm')->name('client.show.meetingsForms');
Route::post('/meeting/add/del/up', 'HomeController@addMeeting')->name('client.meetings.add');


//staff only
Route::prefix('staff')->group(function(){
    Route::get('/','StaffController@index')->name('staffdashboard');
    Route::get('/login','Auth\StaffLoginController@showLoginForm')->name('staff.login');
    Route::post('/login','Auth\StaffLoginController@login')->name('staff.login.submit');
    Route::get('/logout', 'Auth\StaffLoginController@logout')->name('staff.logout');
    Route::get('/registernew', 'StaffController@newRegisterPage')->name('registernew');
    Route::post('/registernew','StaffController@add_user')->name('add_user');
    Route::get('/registerSpouse', 'StaffController@newRegisterSpousePage')->name('registerSpouse');
    Route::post('/registerSpouse','StaffController@add_spouse')->name('add_spouse');
    Route::get('/propertyRegistration', 'StaffController@propertyRegistration')->name('propertyRegistration');
    Route::post('/propertyRegistration', 'StaffController@add_property')->name('add_property');
    Route::get('/generateContract', 'StaffController@generateContract')->name('generateContract');
    Route::post('/generateWord', 'WordTest@createWordDocx')->name('createWord');
    Route::get('/profile/view', 'StaffController@myProfile')->name('myProfile');
    Route::post('/profile/view', 'StaffController@profileupdate')->name('profileUpdate');
    Route::get('/meetings', 'StaffController@meeting')->name('meetings');
    Route::post('/meeting/add/del/up', 'StaffController@addMeeting')->name('meetings.add');
    Route::get('/upload/contract', 'StaffController@showUploadForm')->name('upload.contract');
    Route::post('/upload/contract', 'StaffController@uploadContract')->name('upload.contract.submit');
    Route::get('/view/contract/{id}','StaffController@viewContract')->name('view.contract');
    Route::get('/show/client/{id}', 'StaffController@clientDetails')->name('client.profile.show');
    Route::get('/client/delete/{id}', 'StaffController@deleteClient')->name('staff.client.delete');
    Route::get('/client/transaction/{id}', 'StaffController@getListTransactions')->name('transaction.list');
    Route::get('/add/client/children', 'StaffController@showChildrenForm')->name('show.children.form');
    Route::post('/add/client/children', 'StaffController@addChildren')->name('add.children');
    Route::get('/confirm/number/children', 'StaffController@showChildrenConfirmation')->name('confirm.children');
    Route::post('/confirm/number/children', 'StaffController@addNumberChildren')->name('add.num.children');
    Route::get('/generate/contract/partage', 'StaffController@partageGeneration')->name('show.partage');
    Route::post('/generate/contract/partage' ,'partageController@generatePartage')->name('generate.partage');
    Route::get('/meeting/add/del/up', 'StaffController@meetingForm')->name('show.meetingsForms');
    Route::get('/compose/email', 'StaffController@showMailCompose')->name('show.mailCompose');
    Route::post('/compose/email', 'StaffController@sendMailToParty')->name('send.party.mail');
    Route::get('/upload/documents', 'StaffController@showUploadDoc')->name('staff.show.uploadDoc');
    Route::post('/upload/documents', 'StaffController@uploadDoc')->name('staff.show.UploadDocs');
    Route::get('view/download/uploaded/documents','StaffController@viewUploadedDocuments')->name('download.uploadedDocs');
    Route::get('/confirm/meeting/{mid}{pid}', 'StaffController@confirmMeeting'); 
    Route::get('/confirm/meeting/reject/{mid}{pid}', 'StaffController@rejectMeetingRequest'); 
    Route::get('/meeting/delete/{id}', 'StaffController@deleteMeeting')->name('staff.client.delete');
    // Route::post('/preview/contract/pdf', 'previewPDFController@previewContractSOIP')->name('view.pdf');
});

//registrar general department(rgd)only
Route::prefix('rgd')->group(function(){
    Route::get('/','RgdController@index')->name('rgddashboard');
    Route::get('/login','Auth\RgdLoginController@showLoginForm')->name('rgd.login');
    Route::post('/login','Auth\RgdLoginController@login')->name('rgd.login.submit');
    Route::get('/logout', 'Auth\RgdLoginController@rgdlogout')->name('rgd.logout');
    Route::get('/confirm/meeting/{pid}{mid}', 'RgdController@confirmMeeting');
    Route::get('/compose/email', 'RgdController@showMailCompose')->name('Rgd.show.mailCompose');
    Route::post('/compose/email', 'RgdController@sendMailToParty')->name('Rgd.send.party.mail');
    Route::get('/upload/documents', 'RgdController@showUploadDoc')->name('Rgd.show.uploadDoc');
    Route::post('/upload/documents', 'RgdController@uploadDoc')->name('Rgd.show.UploadDocs');
    Route::get('/uploaded/documents', 'RgdController@viewMyUploadedDoc')->name('Rgd.show.UploadedDocs');
    Route::get('/confirm/meeting/{pid}{mid}', 'RgdController@confirmMeeting');
    Route::get('/profile/view', 'RgdController@myProfile')->name('rgd.myProfile');
    Route::post('/profile/view', 'RgdController@profileupdate')->name('rgd.profileUpdate');
    // Route::get('view/download/uploaded/documents','RgdController@viewUploadedDocuments')->name('Rgd.download.uploadedDocs');

});

//bank only
Route::prefix('bank')->group(function(){
    Route::get('/','bankController@index')->name('bankdashboard');
    Route::get('/login','Auth\bankLoginController@showLoginForm')->name('bank.login');
    Route::post('/login','Auth\bankLoginController@login')->name('bank.login.submit');
    Route::get('/logout', 'Auth\bankLoginController@banklogout')->name('bank.logout');
    Route::get('/confirm/meeting/{pid}{mid}', 'bankController@confirmMeeting');
    Route::get('/compose/email', 'bankController@showMailCompose')->name('bank.show.mailCompose');
    Route::post('/compose/email', 'bankController@sendMailToParty')->name('bank.send.party.mail');
    Route::get('/upload/documents', 'bankController@showUploadDoc')->name('bank.show.uploadDoc');
    Route::post('/upload/documents', 'bankController@uploadDoc')->name('bank.show.UploadDocs');
    Route::get('/uploaded/documents', 'bankController@viewMyUploadedDoc')->name('bank.show.UploadedDocs');
    Route::get('/confirm/meeting/{pid}{mid}', 'bankController@confirmMeeting');
    Route::get('/profile/view', 'bankController@myProfile')->name('bank.myProfile');
    Route::post('/profile/view', 'bankController@profileupdate')->name('bank.profileUpdate');
});

//land surveyor only
Route::prefix('landSurveyor')->group(function(){
    Route::get('/','landSurveyorController@index')->name('landSurveyordashboard');
    Route::get('/login','Auth\landSurveyorLoginController@showLoginForm')->name('landSurveyor.login');
    Route::post('/login','Auth\landSurveyorLoginController@login')->name('landSurveyor.login.submit');
    Route::get('/logout', 'Auth\landSurveyorLoginController@landSurveyorlogout')->name('landSurveyor.logout');
    Route::get('/confirm/meeting/{pid}{mid}', 'landSurveyorController@confirmMeeting');
    Route::get('/compose/email', 'landSurveyorController@showMailCompose')->name('ls.show.mailCompose');
    Route::post('/compose/email', 'landSurveyorController@sendMailToParty')->name('ls.send.party.mail');
    Route::get('/upload/documents', 'landSurveyorController@showUploadDoc')->name('ls.show.uploadDoc');
    Route::post('/upload/documents', 'landSurveyorController@uploadDoc')->name('ls.show.UploadDocs');
    Route::get('/uploaded/documents', 'landSurveyorController@viewMyUploadedDoc')->name('ls.show.UploadedDocs');
    Route::get('/confirm/meeting/{pid}{mid}', 'landSurveyorController@confirmMeeting');
    Route::get('/profile/view', 'landSurveyorController@myProfile')->name('ls.myProfile');
    Route::post('/profile/view', 'landSurveyorController@profileupdate')->name('ls.profileUpdate');
});
