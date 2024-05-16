<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SystemInformationController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CivilController;
use App\Http\Controllers\Admin\NameCangeController;
use App\Http\Controllers\Admin\RenewController;
use App\Http\Controllers\Admin\Fd9Controller;
use App\Http\Controllers\Admin\Fd9OneController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\DesignationStepController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FD6Controller;
use App\Http\Controllers\Admin\FD7Controller;
use App\Http\Controllers\Admin\Fc1Controller;
use App\Http\Controllers\Admin\Fc2Controller;
use App\Http\Controllers\Admin\FD3Controller;
use App\Http\Controllers\Admin\DocumentPresentController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\ChildNoteController;
use App\Http\Controllers\Admin\ParentNoteController;
use App\Http\Controllers\Admin\OfficeSarokController;
use App\Http\Controllers\Admin\NothiPrapokController;
use App\Http\Controllers\Admin\NothiAttractController;
use App\Http\Controllers\Admin\NothiCopyController;
use App\Http\Controllers\Admin\NothiApproverController;
use App\Http\Controllers\Admin\NothiSenderController;
use App\Http\Controllers\Admin\SendNothiController;
use App\Http\Controllers\Admin\ReceiveNothiController;
use App\Http\Controllers\NGO\PotroController;
use App\Http\Controllers\Admin\NothiJatController;
use App\Http\Controllers\Admin\ExecutiveCommitteeController;
use App\Http\Controllers\Admin\ConstitutionController;
use App\Http\Controllers\Admin\DuplicateCertificateController;
use App\Http\Controllers\Admin\Fd5Controller;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TaskManagerController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ComplainMonitorController;
use App\Http\Controllers\Admin\LeaveManagementController;
use App\Http\Controllers\Admin\ProjectSubjectController;

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

// Route::get('/', function () {
//     return view('admin.auth.login');
// });


Route::get('/', [App\Http\Controllers\HomeController::class, 'mainLogin'])->name('mainLogin');

Route::get('/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return 'Cleared!';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(ChildNoteController::class)->group(function () {

Route::get('/printPotrangsoPdfForEmail/{status}/{parentId}/{nothiId}/{id}', 'printPotrangsoPdfForEmail')->name('printPotrangsoPdfForEmail');

});

Route::group(['prefix' => 'admin'], function () {

    Route::resource('leaveManagement', LeaveManagementController::class);

    Route::controller(LeaveManagementController::class)->group(function () {

        Route::get('/receivedApplicationEdit/{id}', 'receivedApplicationEdit')->name('receivedApplicationEdit');
        Route::get('/sentApplicationEdit/{id}', 'sentApplicationEdit')->name('sentApplicationEdit');
        Route::get('/sentApplication', 'sentApplication')->name('sentApplication');
        Route::get('/receivedApplication', 'receivedApplication')->name('receivedApplication');

    });

    Route::resource('projectSubject', ProjectSubjectController::class);
    Route::resource('complainManager', ComplainMonitorController::class);

    Route::controller(ComplainMonitorController::class)->group(function () {

        Route::get('/allComplain', 'allComplain')->name('allComplain');
        Route::get('/ongoingComplain', 'ongoingComplain')->name('ongoingComplain');
        Route::get('/completeComplain', 'completeComplain')->name('completeComplain');
        Route::get('/rejectedComplain', 'rejectedComplain')->name('rejectedComplain');
        Route::get('/viewComplainDetail/{id}', 'viewComplainDetail')->name('viewComplainDetail');
        Route::get('/updateComplainStatus', 'updateComplainStatus')->name('updateComplainStatus');

    });



    Route::resource('eventManager', EventController::class);
    Route::resource('taskManager', TaskManagerController::class);

    Route::controller(TaskManagerController::class)->group(function () {

        Route::put('/taskManagerAssign/{id}', 'taskManagerAssign')->name('taskManagerAssign');
        Route::get('/taskManagerType', 'taskManagerType')->name('taskManagerType');
        Route::put('/taskManagerTypeUpdate/{id}', 'taskManagerTypeUpdate')->name('taskManagerTypeUpdate');

    });

    Route::controller(ReportController::class)->group(function () {

        Route::get('/monthlyReportOfNgoSearch', 'monthlyReportOfNgoSearch')->name('monthlyReportOfNgoSearch');
        Route::get('/yearlyReportOfNgoSearch', 'yearlyReportOfNgoSearch')->name('yearlyReportOfNgoSearch');
        Route::get('/monthlyReportOfNgo', 'monthlyReportOfNgo')->name('monthlyReportOfNgo');
        Route::get('/yearlyReportOfNgo', 'yearlyReportOfNgo')->name('yearlyReportOfNgo');
        Route::get('/monthlyReportOfNgoPrint', 'monthlyReportOfNgoPrint')->name('monthlyReportOfNgoPrint');
        Route::get('/monthlyReportOfNgoSearchPrint/{month}/{to}/{year}/{type}', 'monthlyReportOfNgoSearchPrint')->name('monthlyReportOfNgoSearchPrint');
        Route::get('/yearlyReportOfNgoPrint', 'yearlyReportOfNgoPrint')->name('yearlyReportOfNgoPrint');
        Route::get('/yearlyReportOfNgoSearchPrint/{fromYear}/{toYear}/{type}', 'yearlyReportOfNgoSearchPrint')->name('yearlyReportOfNgoSearchPrint');
        Route::get('/monthlyReportOfNgoRenewSearch', 'monthlyReportOfNgoRenewSearch')->name('monthlyReportOfNgoRenewSearch');
        Route::get('/yearlyReportOfNgoRenewSearch', 'yearlyReportOfNgoRenewSearch')->name('yearlyReportOfNgoRenewSearch');
        Route::get('/monthlyReportOfNgoRenew', 'monthlyReportOfNgoRenew')->name('monthlyReportOfNgoRenew');
        Route::get('/yearlyReportOfNgoRenew', 'yearlyReportOfNgoRenew')->name('yearlyReportOfNgoRenew');
        Route::get('/monthlyReportOfNgoRenewSearchPrint/{month}/{to}/{year}/{type}', 'monthlyReportOfNgoRenewSearchPrint')->name('monthlyReportOfNgoRenewSearchPrint');
        Route::get('/yearlyReportOfNgoRenewSearchPrint/{fromYear}/{toYear}/{type}', 'yearlyReportOfNgoRenewSearchPrint')->name('yearlyReportOfNgoRenewSearchPrint');
        Route::get('/yearlyReportOfNgoRenewPrint', 'yearlyReportOfNgoRenewPrint')->name('yearlyReportOfNgoRenewPrint');
        Route::get('/monthlyReportOfNgoRenewPrint', 'monthlyReportOfNgoRenewPrint')->name('monthlyReportOfNgoRenewPrint');
        Route::get('/localNgoListReport', 'localNgoListReport')->name('localNgoListReport');
        Route::get('/foreignNgoListReport', 'foreignNgoListReport')->name('foreignNgoListReport');
        Route::get('/localNgoListSearch', 'localNgoListSearch')->name('localNgoListSearch');
        Route::get('/foreignNgoListSearch', 'foreignNgoListSearch')->name('foreignNgoListSearch');
        Route::get('/districtWiseListResult', 'districtWiseListResult')->name('districtWiseListResult');
        Route::get('/districtWiseList', 'districtWiseList')->name('districtWiseList');
        Route::get('/districtWiseListSearch', 'districtWiseListSearch')->name('districtWiseListSearch');

    });

    Route::controller(NothiJatController::class)->group(function () {

        Route::get('/returnToAgotoDak/{id}/{status}', 'returnToAgotoDak')->name('returnToAgotoDak');
        Route::get('/nothiJatDakList', 'nothiJatDakList')->name('nothiJatDakList');
        Route::get('/updateNothiJat', 'updateNothiJat')->name('updateNothiJat');
        Route::get('/searchResultNothiJat', 'searchResultNothiJat')->name('searchResultNothiJat');
        Route::get('/searchResultNothiJatFdSix', 'searchResultNothiJatFdSix')->name('searchResultNothiJatFdSix');
        Route::get('/searchResultNothiJatFdSeven', 'searchResultNothiJatFdSeven')->name('searchResultNothiJatFdSeven');
        Route::get('/searchResultNothiJatFcOne', 'searchResultNothiJatFcOne')->name('searchResultNothiJatFcOne');
        Route::get('/searchResultNothiJatFcTwo', 'searchResultNothiJatFcTwo')->name('searchResultNothiJatFcTwo');
        Route::get('/searchResultNothiJatFdThree', 'searchResultNothiJatFdThree')->name('searchResultNothiJatFdThree');
        Route::get('/searchResultNothiJatDuplicateCertificate', 'searchResultNothiJatDuplicateCertificate')->name('searchResultNothiJatDuplicateCertificate');
        Route::get('/searchResultNothiJatConstitution', 'searchResultNothiJatConstitution')->name('searchResultNothiJatConstitution');
        Route::get('/searchResultNothiJatCommittee', 'searchResultNothiJatCommittee')->name('searchResultNothiJatCommittee');
        Route::get('/searchResultNothiJatFdFive', 'searchResultNothiJatFdFive')->name('searchResultNothiJatFdFive');
        Route::get('/searchResultNothiJatFdNineOne', 'searchResultNothiJatFdNineOne')->name('searchResultNothiJatFdNineOne');
        Route::get('/searchResultNothiJatFdNine', 'searchResultNothiJatFdNine')->name('searchResultNothiJatFdNine');
        Route::get('/searchResultNothiJatNameChange', 'searchResultNothiJatNameChange')->name('searchResultNothiJatNameChange');
        Route::get('/searchResultNothiJatRenew', 'searchResultNothiJatRenew')->name('searchResultNothiJatRenew');

    });


    Route::resource('potroList', PotroController::class);

    Route::controller(PotroController::class)->group(function () {

        Route::get('/createPotro/{status}/{parentId}/{nothiId}/{id}/{activeCode}', 'createPotro')->name('createPotro');
        Route::get('/createPotroForReceiver/{status}/{parentId}/{nothiId}/{id}/{activeCode}', 'createPotroForReceiver')->name('createPotroForReceiver');

    });


    Route::resource('fd5Form', Fd5Controller::class);

    Route::controller(Fd5Controller::class)->group(function () {

        Route::post('/fd5FormStatus','fd5FormStatus')->name('fd5FormStatus');
        Route::get('/fd5FormPdf/{id}','fd5FormPdf')->name('fd5FormPdf');

    });

    Route::resource('documentPresent', DocumentPresentController::class);
    Route::resource('documentType', DocumentTypeController::class);
    Route::resource('officeSarok', OfficeSarokController::class);
    Route::resource('nothiPrapok', NothiPrapokController::class);
    Route::resource('nothiAttract', NothiAttractController::class);
    Route::resource('nothiCopy', NothiCopyController::class);
    Route::resource('nothiApprover', NothiApproverController::class);
    Route::resource('nothiSender', NothiSenderController::class);
    Route::resource('sendNothi', SendNothiController::class);
    Route::resource('receiveNothi', ReceiveNothiController::class);
    Route::resource('executiveCommitteeInfo', ExecutiveCommitteeController::class);
    Route::resource('constitutionInfo', ConstitutionController::class);
    Route::resource('duplicateCertificate', DuplicateCertificateController::class);

    Route::controller(DuplicateCertificateController::class)->group(function () {

        Route::post('/updateStatusDuplicateCertificate','updateStatusDuplicateCertificate')->name('updateStatusDuplicateCertificate');
        Route::get('/duplicateCertificatePdf/{id}/{title}','duplicateCertificatePdf')->name('duplicateCertificatePdf');

    });



    Route::controller(ConstitutionController::class)->group(function () {

        Route::post('/updateStatusconstitutionInfoPdf','updateStatusconstitutionInfoPdf')->name('updateStatusconstitutionInfoPdf');
        Route::get('/constitutionInfoPdf/{id}/{title}','constitutionInfoPdf')->name('constitutionInfoPdf');

    });

    Route::controller(ExecutiveCommitteeController::class)->group(function () {

        Route::post('/updateStatusexecutiveCommittee','updateStatusexecutiveCommittee')->name('updateStatusexecutiveCommittee');
        Route::get('/executiveCommitteeInfoPdf/{id}/{title}','executiveCommitteeInfoPdf')->name('executiveCommitteeInfoPdf');

    });

    Route::controller(NothiCopyController::class)->group(function () {

        Route::post('/copyStatusUpdate', 'copyStatusUpdate')->name('copyStatusUpdate');
        Route::get('/copySelfOfficerAjaxDelete/{id}', 'copySelfOfficerAjaxDelete')->name('copySelfOfficerAjaxDelete');
        Route::get('/copySelfOfficerAdd', 'copySelfOfficerAdd')->name('copySelfOfficerAdd');
        Route::get('/copyOtherOfficerAdd', 'copyOtherOfficerAdd')->name('copyOtherOfficerAdd');

    });

    Route::controller(NothiAttractController::class)->group(function () {

        Route::post('/attractStatusUpdate', 'attractStatusUpdate')->name('attractStatusUpdate');
        Route::get('/attractSelfOfficerAjaxDelete/{id}', 'attractSelfOfficerAjaxDelete')->name('attractSelfOfficerAjaxDelete');
        Route::get('/attractSelfOfficerAdd', 'attractSelfOfficerAdd')->name('attractSelfOfficerAdd');
        Route::get('/attractOtherOfficerAdd', 'attractOtherOfficerAdd')->name('attractOtherOfficerAdd');

    });

    Route::controller(NothiPrapokController::class)->group(function () {

        Route::post('/prapokStatusUpdate', 'prapokStatusUpdate')->name('prapokStatusUpdate');
        Route::get('/selfOfficerAjaxDelete/{id}', 'selfOfficerAjaxDelete')->name('selfOfficerAjaxDelete');
        Route::get('/selfOfficerAdd', 'selfOfficerAdd')->name('selfOfficerAdd');
        Route::get('/otherOfficerAdd', 'otherOfficerAdd')->name('otherOfficerAdd');

    });

    Route::resource('childNote', ChildNoteController::class);
    Route::resource('parentNote', ParentNoteController::class);

    Route::controller(ParentNoteController::class)->group(function () {

        Route::get('/addParentAttachment', 'addParentAttachment')->name('addParentAttachment');
        Route::post('/storeDataFromSenderView', 'storeDataFromSenderView')->name('storeDataFromSenderView');
        Route::get('/addParentNote/{status}/{dakId}/{nothiId}', 'addParentNote')->name('addParentNote');
        Route::get('/addParentNoteFromView/{status}/{dakId}/{nothiId}', 'addParentNoteFromView')->name('addParentNoteFromView');

    });

    Route::controller(DocumentPresentController::class)->group(function () {

        Route::get('/searchResultForDak', 'searchResultForDak')->name('searchResultForDak');
        Route::get('/deleteAdminFromEdit', 'deleteAdminFromEdit')->name('deleteAdminFromEdit');
        Route::get('/deleteBrachFromEdit', 'deleteBrachFromEdit')->name('deleteBrachFromEdit');
        Route::get('/savePermissionNothi', 'savePermissionNothi')->name('savePermissionNothi');
        Route::get('/givePermissionToNothi/{id}', 'givePermissionToNothi')->name('givePermissionToNothi');



    });

    Route::controller(ChildNoteController::class)->group(function () {


        Route::get('/printParagraphViewSingle/{status}/{parentId}/{nothiId}/{id}/{childIdNew}', 'printParagraphViewSingle')->name('printParagraphViewSingle');
        Route::get('/printParagraphAddSingle/{status}/{parentId}/{nothiId}/{id}/{childIdNew}', 'printParagraphAddSingle')->name('printParagraphAddSingle');
        Route::get('/printAllParagraph/{status}/{parentId}/{nothiId}/{id}', 'printAllParagraph')->name('printAllParagraph');
        Route::get('/printAllParagraphFromSend/{status}/{parentId}/{nothiId}/{id}', 'printAllParagraphFromSend')->name('printAllParagraphFromSend');
		Route::get('/getdataforNothiList', 'getdataforNothiList')->name('getdataforNothiList');
        Route::get('/deleteAttachment/{id}', 'deleteAttachment')->name('deleteAttachment');
        Route::delete('/deleteAllParagraph/{id}/{status}', 'deleteAllParagraph')->name('deleteAllParagraph');
        Route::get('/givePermissionForPotroZari/{status}/{parentId}/{nothiId}/{id}/{childnote}', 'givePermissionForPotroZari')->name('givePermissionForPotroZari');
        Route::get('/givePermissionToNote/{status}/{parentId}/{nothiId}/{id}/{childnote}', 'givePermissionToNote')->name('givePermissionToNote');
        Route::post('/saveNothiPermissionReturn', 'saveNothiPermissionReturn')->name('saveNothiPermissionReturn');
        Route::post('/saveNothiPermission', 'saveNothiPermission')->name('saveNothiPermission');
        Route::get('/addChildNote/{status}/{parentId}/{nothiId}/{id}/{activeCode}', 'addChildNote')->name('addChildNote');
        Route::get('/addChildNoteFromView/{status}/{parentId}/{nothiId}/{id}/{activeCode}', 'addChildNoteFromView')->name('addChildNoteFromView');
        Route::get('/printPotrangso/{status}/{parentId}/{nothiId}/{id}/{sarokCode}', 'printPotrangso')->name('printPotrangso');
        Route::get('/viewChildNote/{status}/{parentId}/{nothiId}/{id}/{activeCode}', 'viewChildNote')->name('viewChildNote');

    });

    Route::controller(DocumentPresentController::class)->group(function () {

        Route::get('/docTypeCode', 'docTypeCode')->name('docTypeCode');
        Route::get('/presentDocument/{status}/{id}', 'presentDocument')->name('presentDocument');
        Route::get('/sheetAndNotes/{status}/{nothiId}/{id}', 'sheetAndNotes')->name('sheetAndNotes');

    });

    Route::resource('fd3Form', FD3Controller::class);
    Route::controller(FD3Controller::class)->group(function () {

        Route::get('reliefAssistanceProjectProposalPdf/{id}', 'reliefAssistanceProjectProposalPdf')->name('reliefAssistanceProjectProposalPdf');
        Route::get('authorizationLetter/{id}', 'authorizationLetter')->name('authorizationLetter');
        Route::get('letterFromDonorAgency/{id}', 'letterFromDonorAgency')->name('letterFromDonorAgency');
        Route::post('/statusUpdateForFd3', 'statusUpdateForFd3')->name('statusUpdateForFd3');
        Route::get('/fd3FormForRevision', 'fd3FormForRevision')->name('fd3FormForRevision');
        Route::get('/acceptedFd3Form', 'acceptedFd3Form')->name('acceptedFd3Form');
        Route::get('/verified_fd_three_form/{id}', 'verified_fd_three_form')->name('verified_fd_three_form');
        Route::get('/fd3PdfDownload/{id}', 'fd3PdfDownload')->name('fd3PdfDownload');
        Route::get('/fd3fd2PdfDownload/{id}', 'fd3fd2PdfDownload')->name('fd3fd2PdfDownload');
        Route::get('/fd3fd2OtherPdfDownload/{id}', 'fd3fd2OtherPdfDownload')->name('fd3fd2OtherPdfDownload');


    });

    Route::resource('fc2Form', Fc2Controller::class);

    Route::controller(Fc2Controller::class)->group(function () {

        Route::get('reliefAssistanceProjectProposalPdf/{id}', 'reliefAssistanceProjectProposalPdf')->name('reliefAssistanceProjectProposalPdf');
        Route::get('authorizationLetter/{id}', 'authorizationLetter')->name('authorizationLetter');
        Route::get('letterFromDonorAgency/{id}', 'letterFromDonorAgency')->name('letterFromDonorAgency');
        Route::post('/statusUpdateForFc2', 'statusUpdateForFc2')->name('statusUpdateForFc2');
        Route::get('/fc2FormForRevision', 'fc2FormForRevision')->name('fc2FormForRevision');
        Route::get('/acceptedFc2Form', 'acceptedFc2Form')->name('acceptedFc2Form');
        Route::get('/fc2PdfDownload/{id}', 'fc2PdfDownload')->name('fc2PdfDownload');
        Route::get('/verified_fc_two_form/{id}', 'verified_fc_two_form')->name('verified_fc_two_form');
        Route::get('/fc2fd2PdfDownload/{id}', 'fc2fd2PdfDownload')->name('fc2fd2PdfDownload');
        Route::get('/fc2fd2OtherPdfDownload/{id}', 'fc2fd2OtherPdfDownload')->name('fc2fd2OtherPdfDownload');


    });

    Route::resource('fc1Form', Fc1Controller::class);

    Route::controller(Fc1Controller::class)->group(function () {

        Route::get('reliefAssistanceProjectProposalPdf/{id}', 'reliefAssistanceProjectProposalPdf')->name('reliefAssistanceProjectProposalPdf');
        Route::get('authorizationLetter/{id}', 'authorizationLetter')->name('authorizationLetter');
        Route::get('letterFromDonorAgency/{id}', 'letterFromDonorAgency')->name('letterFromDonorAgency');
        Route::post('/statusUpdateForFc1', 'statusUpdateForFc1')->name('statusUpdateForFc1');
        Route::get('/fc1FormForRevision', 'fc1FormForRevision')->name('fc1FormForRevision');
        Route::get('/acceptedFc1Form', 'acceptedFc1Form')->name('acceptedFc1Form');
        Route::get('/fc1PdfDownload/{id}', 'fc1PdfDownload')->name('fc1PdfDownload');
        Route::get('/verified_fc_one_form/{id}', 'verified_fc_one_form')->name('verified_fc_one_form');
        Route::get('/fc1fd2PdfDownload/{id}', 'fc1fd2PdfDownload')->name('fc1fd2PdfDownload');
        Route::get('/fc1fd2OtherPdfDownload/{id}', 'fc1fd2OtherPdfDownload')->name('fc1fd2OtherPdfDownload');


    });

    Route::resource('fd7Form', FD7Controller::class);

    Route::controller(FD7Controller::class)->group(function () {

        Route::get('reliefAssistanceProjectProposalPdf/{id}', 'reliefAssistanceProjectProposalPdf')->name('reliefAssistanceProjectProposalPdf');
        Route::get('authorizationLetter/{id}', 'authorizationLetter')->name('authorizationLetter');
        Route::get('letterFromDonorAgency/{id}', 'letterFromDonorAgency')->name('letterFromDonorAgency');
        Route::post('/statusUpdateForFd7', 'statusUpdateForFd7')->name('statusUpdateForFd7');
        Route::get('/fd7FormForRevision', 'fd7FormForRevision')->name('fd7FormForRevision');
        Route::get('/acceptedFd7Form', 'acceptedFd7Form')->name('acceptedFd7Form');
        Route::get('/fd7PdfDownload/{id}', 'fd7PdfDownload')->name('fd7PdfDownload');
        Route::get('/fd7fd2PdfDownload/{id}', 'fd7fd2PdfDownload')->name('fd7fd2PdfDownload');
        Route::get('/fd7fd2OtherPdfDownload/{id}', 'fd7fd2OtherPdfDownload')->name('fd7fd2OtherPdfDownload');


    });


    Route::resource('fd6Form', FD6Controller::class);

    Route::controller(FD6Controller::class)->group(function () {

        Route::post('/statusUpdateForFd6', 'statusUpdateForFd6')->name('statusUpdateForFd6');
        Route::get('/fd6FormForRevision', 'fd6FormForRevision')->name('fd6FormForRevision');
        Route::get('/acceptedFd6Form', 'acceptedFd6Form')->name('acceptedFd6Form');
        Route::get('/fd6PdfDownload/{id}', 'fd6PdfDownload')->name('fd6PdfDownload');
        Route::get('/fd2PdfDownload/{id}', 'fd2PdfDownload')->name('fd2PdfDownload');
        Route::get('/fd2OtherPdfDownload/{id}', 'fd2OtherPdfDownload')->name('fd2OtherPdfDownload');


    });

    Route::get('/', [DashBoardController::class, 'index'])->name('admin.dashboard');


    Route::resource('noticeList', NoticeController::class);
    Route::resource('branchList', BranchController::class);
    Route::resource('dakBranchList', PostController::class);


    Route::controller(PostController::class)->group(function () {

        Route::get('/all_dak_list', 'all_dak_list')->name('all_dak_list');
        Route::get('/sent_dak', 'sent_dak')->name('receiver_dak');
        Route::get('/main_doc_download/{id}', 'main_doc_download')->name('main_doc_download');
        Route::get('/deleteMemberList/{status}/{id}', 'deleteMemberList')->name('deleteMemberList');
        Route::get('/deleteMemberListAjax', 'deleteMemberListAjax')->name('deleteMemberListAjax');
        Route::get('/createSeal/{status}/{id}', 'createSeal')->name('createSeal');
        Route::get('/dakListFirstStep', 'dakListFirstStep')->name('dakListFirstStep');
        Route::post('/dakListSecondStep', 'dakListSecondStep')->name('dakListSecondStep');
        Route::get('/showDataAll/{status}/{id}', 'showDataAll')->name('showDataAll');
        Route::get('/showDataDesignationWiseOne', 'showDataDesignationWiseOne')->name('showDataDesignationWiseOne');
        Route::get('/showDataDesignationWise', 'showDataDesignationWise')->name('showDataDesignationWise');
        Route::get('/showDataBranchWise', 'showDataBranchWise')->name('showDataBranchWise');

    });

    Route::controller(BranchController::class)->group(function () {
        Route::get('/checkBranch', 'checkBranch')->name('checkBranch');
        Route::get('/showBranchStep', 'showBranchStep')->name('showBranchStep');

    });


    Route::resource('designationList', DesignationController::class);

    Route::controller(DesignationController::class)->group(function () {
        Route::get('/checkDesignation', 'checkDesignation')->name('checkDesignation');
        Route::get('/getDesignationFromBranch', 'getDesignationFromBranch')->name('getDesignationFromBranch');
    });


    Route::resource('assignedEmployee', DesignationStepController::class);
    Route::resource('country', CountryController::class);
    Route::resource('civilInfo', CountryController::class);
    Route::resource('fd9Form', Fd9Controller::class);

    Route::controller(Fd9Controller::class)->group(function () {

        Route::get('/singlePdfDownload/{id}','singlePdfDownload')->name('singlePdfDownload');


        Route::get('/verified_fd_nine_download/{id}','verified_fd_nine_download')->name('verified_fd_nine_download');
        Route::post('/statusUpdateForFd9', 'statusUpdateForFd9')->name('statusUpdateForFd9');
        Route::post('/submitForCheck','submitForCheck')->name('submitForCheck');
        Route::get('/statusCheck','statusCheck')->name('statusCheck');
        Route::get('/downloadForwardingLetter/{id}','downloadForwardingLetter')->name('downloadForwardingLetter');
        Route::post('/postForwardingLetter','postForwardingLetter')->name('postForwardingLetter');
        Route::post('/postForwardingLetterForEdit','postForwardingLetterForEdit')->name('postForwardingLetterForEdit');
        Route::post('/forwardingLetterPost','forwardingLetterPost')->name('forwardingLetterPost');
        Route::get('/fdNinePdfDownload/{id}','fdNinePdfDownload')->name('fdNinePdfDownload');
        Route::get('/nVisaDocumentDownload/{cat}/{id}', 'nVisaDocumentDownload')->name('nVisaDocumentDownload');

    });

    Route::resource('fd9OneForm', Fd9OneController::class);

    Route::controller(Fd9OneController::class)->group(function () {
        Route::get('/forwardingLetterForNothi/{id}', 'forwardingLetterForNothi')->name('forwardingLetterForNothi');
        Route::get('/verified_fd_nine_one_download/{id}','verified_fd_nine_one_download')->name('verified_fd_nine_one_download');
        Route::post('/statusUpdateForFd9One', 'statusUpdateForFd9One')->name('statusUpdateForFd9One');
        Route::get('/fd9OneDownload/{cat}/{id}', 'fd9OneDownload')->name('fd9OneDownload');
    });

    //register_list_view

    Route::controller(RegisterController::class)->group(function () {

        Route::post('/updateStatusRegForm', 'updateStatusRegForm')->name('updateStatusRegForm');
        Route::get('/printCertificateView','printCertificateView')->name('printCertificateView');
        Route::get('/printCertificateViewDemo','printCertificateViewDemo')->name('printCertificateViewDemo');
        Route::get('/printCertificateViewRenew','printCertificateViewRenew')->name('printCertificateViewRenew');
        Route::get('/printCertificateViewDemoRenew','printCertificateViewDemoRenew')->name('printCertificateViewDemoRenew');
        Route::get('/formOnePdfMain/{id}', 'formOnePdfMain')->name('formOnePdfMain');
        Route::get('/formOnePdfMainForeign/{id}','formOnePdfMainForeign')->name('formOnePdfMainForeign');
        Route::get('/formOnePdf/{main_id}/{id}','formOnePdf')->name('formOnePdf');
        Route::get('/formEightPdf/{main_id}','formEightPdf')->name('formEightPdf');
        Route::get('/sourceOfFund/{id}','sourceOfFund')->name('sourceOfFund');
        Route::get('/otherPdfView/{id}','otherPdfView')->name('otherPdfView');
        Route::get('/ngoMemberDocPdfView/{id}','ngoMemberDocPdfView')->name('ngoMemberDocPdfView');
        Route::get('/ngoDocPdfView/{id}','ngoDocPdfView')->name('ngoDocPdfView');
        Route::get('/renewPdfList/{main_id}/{id}','renewPdfList')->name('renewPdfList');
        Route::get('/newRegistrationList','newRegistrationList')->name('newRegistrationList');
        Route::get('/revisionRegistrationList','revisionRegistrationList')->name('revisionRegistrationList');
        Route::get('/alreadyRegistrationList','alreadyRegistrationList')->name('alreadyRegistrationList');
        Route::get('/registrationView/{id}','registrationView')->name('registrationView');


    });

    Route::controller(NameCangeController::class)->group(function () {

        Route::get('/printCertificateViewName','printCertificateViewName')->name('printCertificateViewName');
        Route::get('/printCertificateViewDemoName','printCertificateViewDemoName')->name('printCertificateViewDemoName');
        Route::get('/nameChangeDoc/{id}','nameChangeDoc')->name('nameChangeDoc');
        Route::get('/newNameChangeList','newNameChangeList')->name('newNameChangeList');
        Route::get('/revisionNameChangeList','revisionNameChangeList')->name('revisionNameChangeList');
        Route::get('/alreadNameChangeList','alreadNameChangeList')->name('alreadNameChangeList');
        Route::get('/nameChangeView/{id}','nameChangeView')->name('nameChangeView');
        Route::post('/updateStatusNameChangeForm','updateStatusNameChangeForm')->name('updateStatusNameChangeForm');
    });


    Route::controller(RenewController::class)->group(function () {

        Route::get('/newRenewList','newRenewList')->name('newRenewList');
        Route::get('/revisionRenewList','revisionRenewList')->name('revisionRenewList');
        Route::get('/alreadyRenewList','alreadyRenewList')->name('alreadyRenewList');
        Route::get('/renewView/{id}','renewView')->name('renewView');
        Route::post('/updateStatusRenewForm','updateStatusRenewForm')->name('updateStatusRenewForm');
        Route::get('viewFormEightPdf/{id}', 'viewFormEightPdf')->name('viewFormEightPdf');
        Route::get('changeAcNumberDownload/{id}', 'changeAcNumberDownload')->name('changeAcNumberDownload');
        Route::get('dueVatPdfDownload/{id}', 'dueVatPdfDownload')->name('dueVatPdfDownload');
        Route::get('copyOfChalanPdfDownload/{id}', 'copyOfChalanPdfDownload')->name('copyOfChalanPdfDownload');
        Route::get('yearlyBudgetPdfDownload/{id}', 'yearlyBudgetPdfDownload')->name('yearlyBudgetPdfDownload');
        Route::get('foreginPdfDownload/{id}', 'foreginPdfDownload')->name('foreginPdfDownload');
        Route::get('verifiedFdEightDownload/{id}', 'verifiedFdEightDownload')->name('verifiedFdEightDownload');
        Route::get('renewalFileDownload/{title}/{id}', 'renewalFileDownload')->name('renewalFileDownload');
        Route::get('changeAcNumberDownloadOld/{id}', 'changeAcNumberDownloadOld')->name('changeAcNumberDownloadOld');
        Route::get('dueVatPdfDownloadOld/{id}', 'dueVatPdfDownloadOld')->name('dueVatPdfDownloadOld');
        Route::get('copyOfChalanPdfDownloadOld/{id}', 'copyOfChalanPdfDownloadOld')->name('copyOfChalanPdfDownloadOld');
        Route::get('yearlyBudgetPdfDownloadOld/{id}', 'yearlyBudgetPdfDownloadOld')->name('yearlyBudgetPdfDownloadOld');
        Route::get('foreginPdfDownloadOld/{id}', 'foreginPdfDownloadOld')->name('foreginPdfDownloadOld');
        Route::get('verifiedFdEightDownloadOld/{id}', 'verifiedFdEightDownloadOld')->name('verifiedFdEightDownloadOld');

    });



    //end register_list_view

    Route::resource('login', LoginController::class);
    Route::post('/logout/submit',[LoginController::class,'logout'])->name('admin.logout.submit');
    Route::resource('role', RoleController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('user', AdminController::class);

  Route::controller(AdminController::class)->group(function () {

        Route::get('/checkWorkingDay', 'checkWorkingDay')->name('checkWorkingDay');
        Route::get('/getAdminDetail', 'getAdminDetail')->name('getAdminDetail');
        Route::post('/employeeEndDatePost', 'employeeEndDatePost')->name('employeeEndDatePost');
        Route::get('/employeeEndDate', 'employeeEndDate')->name('employeeEndDate');
        Route::post('/postPasswordChange', 'postPasswordChange')->name('postPasswordChange');
        Route::get('/accountPasswordChange/{id}', 'accountPasswordChange')->name('accountPasswordChange');
        Route::post('/checkMailPost', 'checkMailPost')->name('checkMailPost');
        Route::get('/forgetPassword', 'forgetPassword')->name('forgetPassword');
        Route::get('/checkMailForPassword', 'checkMailForPassword')->name('checkMailForPassword');
        Route::get('/newEmailNotify', 'newEmailNotify')->name('newEmailNotify');
        Route::post('/postPasswordChange', 'postPasswordChange')->name('postPasswordChange');
        Route::get('/accountPasswordChange/{id}', 'accountPasswordChange')->name('accountPasswordChange');

    });

    Route::resource('setting', SettingController::class);

    Route::controller(SettingController::class)->group(function () {


        Route::get('/error_404', 'error_404')->name('error_404');

        Route::get('/basicInformationEdit', 'basicInformationEdit')->name('basicInformationEdit');
        Route::get('/digitalSignatureEdit', 'digitalSignatureEdit')->name('digitalSignatureEdit');
        Route::post('/digitalSignatureUpdate', 'digitalSignatureUpdate')->name('digitalSignatureUpdate');
        Route::get('/passwordEdit', 'passwordEdit')->name('passwordEdit');
        Route::post('/passwordUpdate', 'passwordUpdate')->name('passwordUpdate');
        Route::get('/profilePictureEdit', 'profilePictureEdit')->name('profilePictureEdit');
        Route::post('/profilePictureUpdate', 'profilePictureUpdate')->name('profilePictureUpdate');

    });

    Route::resource('systemInformation', SystemInformationController::class);




});
