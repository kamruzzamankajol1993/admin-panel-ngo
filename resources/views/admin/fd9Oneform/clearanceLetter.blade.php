<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="others_inner_section">
                        <h5>Application for Security Clearance</h5>
                        <div class="notice_underline"></div>
                    </div>
                </div>
            </div>
            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    Basic Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9 col-sm-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Approved permission period</td>
                                    <td>:{{ $nVisabasicInfo->period_validity }}</td>
                                </tr>
                                <tr>
                                    <td>Effective Date</td>
                                    <td>:{{ date('d-m-Y', strtotime($nVisabasicInfo->permit_efct_date)) }}</td>
                                </tr>
                                <tr>
                                    <td>Ref no. of issued work permit</td>
                                    <td>:{{ $nVisabasicInfo->visa_ref_no }}</td>
                                </tr>
                                <tr>
                                    <td>Received Visa Recommendation Lette</td>
                                    <td>:{{ $nVisabasicInfo->visa_recomendation_letter_received_way	 }}</td>
                                </tr>
                                <tr>
                                    <td>Ref no. of Visa Recommendation Letter</td>
                                    <td>:{{ $nVisabasicInfo->visa_recomendation_letter_ref_no	 }}</td>
                                </tr>
                                <tr>
                                    <td>Department in</td>
                                    <td>:{{ $nVisabasicInfo->department_in	 }}</td>
                                </tr>
                                <tr>
                                    <td>Work Permit type</td>
                                    <td>:{{ $nVisabasicInfo->visa_category	 }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="nvisa-avatar">
                                @if(!$nVisabasicInfo->applicant_photo)
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" style="height: 80px;" alt="">
                                @else
                                <img src="{{ $ins_url }}{{ $nVisabasicInfo->applicant_photo }}" style="height: 80px;" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    A. PARTICULAR OF SPONSOR/EMPLOYER
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2">Name of the enterprise (organization/company): {{ $nVisaSponSor->org_name }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="background-color: #d4d4d4">Address of the enterprise (Bangladesh Only)</td>
                        </tr>
                        <tr>
                            <td>House/Plot/Holding/Village:: {{ $nVisaSponSor->org_house_no }}  </td>
                            <td>Flat/Apartment/Floor: {{ $nVisaSponSor->org_flat_no }}</td>
                        </tr>
                        <tr>
                            <td>Road Number: {{ $nVisaSponSor->org_road_no }}</td>
                            <td>Post/Zip Code: {{ $nVisaSponSor->org_post_code }}</td>
                        </tr>
                        <tr>
                            <td>Post Office: {{ $nVisaSponSor->org_post_office }}</td>
                            <td>Telephone Number: {{ $nVisaSponSor->org_phone }}</td>
                        </tr>
                        <tr>
                            <td>City/District: {{ $nVisaSponSor->org_district }}</td>
                            <td>Thana/Upazilla: {{ $nVisaSponSor->org_thana }}</td>
                        </tr>
                        <tr>
                            <td>Fax Number: {{ $nVisaSponSor->org_fax_no }}</td>
                            <td>Email: {{ $nVisaSponSor->org_email }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Type of the Organization: Admin</td>
                        </tr>
                        <tr>
                            <td colspan="2">Nature of buisness: {{ $nVisaSponSor->nature_of_business }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Authorized Capital: {{ $nVisaSponSor->authorized_capital }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Paid up capital: {{ $nVisaSponSor->paid_up_capital }}</td>
                        </tr>
                        <tr>
                            <td>Remittance received during last 12 months: {{ $nVisaSponSor->remittance_received }}</td>
                            <td>Type of Industry:Admin </td>
                        </tr>
                        <tr>
                            <td>Recommendation of Company Boards: {{ $nVisaSponSor->recommendation_of_company_board }}</td>
                            <td>Whether local, foreign or joint venture company (if joint venture, percentage of local and foreign investment is to be shown): {{ $nVisaSponSor->company_share }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    B. PARTICULARS OF FOREIGN INCUMBENT
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2">Name of the foreign national: {{ $nVisaForeignerInfo->name_of_the_foreign_national }}</td>
                        </tr>
                        <tr>
                            <td>Nationality: {{ $nVisaForeignerInfo->nationality  }}</td>
                            <td>Passport Number: {{ $nVisaForeignerInfo->passport_no }}</td>
                        </tr>
                        <tr>
                            <td>Date of Issue: {{ $nVisaForeignerInfo->passport_issue_date }}</td>
                            <td>Place of Issue: {{ $nVisaForeignerInfo->passport_issue_place }} </td>
                        </tr>
                        <tr>
                            <td colspan="2">Expiry Date: {{ $nVisaForeignerInfo->passport_expiry_date }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="background-color: #d4d4d4">Permanent Address</td>
                        </tr>
                        <tr>
                            <td>Country: {{ $nVisaForeignerInfo->home_country }}</td>
                            <td>House/Plot/Holding Number: {{ $nVisaForeignerInfo->house_no }}</td>
                        </tr>
                        <tr>
                            <td>Flat/Apartment/Floor Number: {{ $nVisaForeignerInfo->flat_no }}</td>
                            <td>Road Name/Road Number: {{ $nVisaForeignerInfo->road_no }} </td>
                        </tr>
                        <tr>
                            <td><b></b> </td>
                            <td><b></b> </td>
                        </tr>
                        <tr>
                            <td>Post/Zip Code: {{ $nVisaForeignerInfo->post_code }}</td>
                            <td>State/Province: {{ $nVisaForeignerInfo->state }}</td>
                        </tr>
                        <tr>
                            <td>Telephone Number: {{ $nVisaForeignerInfo->phone }}</td>
                            <td>City: {{ $nVisaForeignerInfo->city }}</td>
                        </tr>
                        <tr>
                            <td>Fax Number:  {{ $nVisaForeignerInfo->fax_no }}</td>
                            <td>Email: {{ $nVisaForeignerInfo->email }}</td>
                        </tr>
                        <tr>
                            <td>Date of Birth: {{ $nVisaForeignerInfo->date_of_birth }}</td>
                            <td>Marital Status: {{ $nVisaForeignerInfo->martial_status }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    C. EMPLOYMENT INFORMATION
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Name of the post employed for (Designation):: {{ $nVisaEmploye->employed_designation }}</td>
                            <td>Date of arrival in Bangladesh:  {{ $nVisaEmploye->date_of_arrival_in_bangladesh }}</td>
                        </tr>
                        <tr>
                            <td>Type of visa: N-Visa </td>
                            <td>Date of first assignment: {{ $nVisaEmploye->first_appoinment_date }}</td>
                        </tr>
                        <tr>
                            <td>Desired Effective Date: {{ $nVisaEmploye->desired_effective_date }}</td>
                            <td>Desired End Date: {{ $nVisaEmploye->desired_end_date }}</td>
                        </tr>
                        <tr>
                            <td>Desired Duration: {{ $nVisaEmploye->visa_validity }}</td>
                            <td>Brief job description: {{ $nVisaEmploye->brief_job_description }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Employee Justification: {{ $nVisaEmploye->employee_justification }} </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    D. WORKPLACE ADDRESS
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>House/Plot/Holding/Village::  {{ $nVisaWorkPlace->work_house_no }}</td>
                            <td>Flat/Apartment/Floor: {{ $nVisaWorkPlace->work_flat_no }}</td>
                        </tr>
                        <tr>
                            <td>Road Number: {{ $nVisaWorkPlace->work_road_no }} </td>
                            <td>City/District: {{ $nVisaWorkPlace->work_district }}</td>
                        </tr>
                        <tr>
                            <td>Thana/Upazilla: {{ $nVisaWorkPlace->work_thana }} </td>
                            <td>Email: {{ $nVisaWorkPlace->work_email }}</td>
                        </tr>
                        <tr>
                            <td>Type of Organization: এনজিও</td>
                            <td>Contact Person Mobile Number: {{ $nVisaWorkPlace->contact_person_mobile_number }}</td>
                        </tr>
                    </table>
                </div>
            </div>


            <?php

$annual =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->where('salary_category','Annual Bonus')->first();

$medical =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->where('salary_category','Medical Allowance')->first();

$entertainment =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->where('salary_category','Entertainment Allowance')->first();


$convoy =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->where('salary_category','Conveyance')->first();

$house =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->where('salary_category','House Rent')->first();

$overseas =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->where('salary_category','Overseas Allowance')->first();


$basic =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->where('salary_category','Basic Salary')->first();


$mainDatac =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$nVisabasicInfo->id)->first();



?>

<!--compansation --->

@if(!$mainDatac)
<div class="card mt-3 ">
<div class="card-header bg-primary d-flex justify-content-between align-items-center">
E.COMPENSATION AND BENIFITS
</div>
<div class="card-body">
No Information Available
</div>
</div>
@else
<div class="card mt-3 ">
<div class="card-header bg-primary d-flex justify-content-between align-items-center">
E.COMPENSATION AND BENIFITS
</div>
<div class="card-body">
<table class="table table-bordered">
<tr>
<td><b>Salary Structure</b></td>
<td colspan="3"><b>Payble Locally</b></td>
</tr>
<tr>
<td></td>
<td>Payment</td>
<td>Amount</td>
<td>Currency</td>
</tr>
@if(!$basic)

@else
<tr>
<td>a. Basic Salary</td>
<td>{{ $basic->payment_type }}</td>
<td>{{ $basic->amount }}</td>
<td>{{ $basic->currency }}</td>
</tr>
@endif
@if(!$overseas)

@else
<tr>
<td>b. Overseas allowance</td>
<td>{{ $overseas->payment_type }}</td>
<td>{{ $overseas->amount }}</td>
<td>{{ $overseas->currency }}</td>
</tr>
@endif
@if(!$house)

@else
<tr>
<td>c. House rent/Accommodation</td>
<td>{{ $house->payment_type }}</td>
<td>{{ $house->amount }}</td>
<td>{{ $house->currency }}</td>
</tr>
@endif
@if(!$convoy)

@else
<tr>
<td>d. Conveyance</td>
<td>{{ $convoy->payment_type }}</td>
<td>{{ $convoy->amount }}</td>
<td>{{ $convoy->currency }}</td>
</tr>
@endif
@if(!$entertainment)

@else
<tr>
<td>e. Entertainmemt allowance</td>
<td>{{ $entertainment->payment_type }}</td>
<td>{{ $entertainment->amount }}</td>
<td>{{ $entertainment->currency }}</td>
</tr>
@endif
@if(!$medical)

@else
<tr>
<td>f. Medical allowance<</td>
<td>{{ $medical->payment_type }}</td>
<td>{{ $medical->amount }}</td>
<td>{{ $medical->currency }}</td>
</tr>
@endif
@if(!$annual)

@else
<tr>
<td>g. Annual Bonus</td>
<td>{{ $annual->payment_type }}</td>
<td>{{ $annual->amount }}</td>
<td>{{ $annual->currency }}</td>
</tr>
@endif
<tr>
<td>h. Other fringe benefits, if any/td>
<td colspan="3">{{ $nVisabasicInfo->other_benefit }}</td>
</tr>
<tr>
<td>i. Any Particular Comments of remarks</td>
<td colspan="3">{{ $nVisabasicInfo->salary_remarks }}</td>
</tr>
</table>
</div>
</div>

@endif


<!--end compansation -->



            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    F. Manpower of the office
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="3"><b>Local (a)</b></td>
                            <td colspan="3"><b>Foreign  (b)</b></td>
                            <td rowspan="2"><b>Grand Total
                                (a+b)</b></td>
                            <td colspan="2"><b>Ratio</b></td>
                        </tr>
                        <tr>
                            <td>Executive</td>
                            <td>Supporting Staff </td>
                            <td>Total</td>
                            <td>Executive</td>
                            <td>Supporting Staff</td>
                            <td>Total</td>
                            <td>Local </td>
                            <td>Foreign</td>
                        </tr>
                        @if(!$nVisaManPower)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @else
                        <tr>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_executive) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_supporting_staff) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_total) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_executive) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_supporting_staff) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_total) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->gand_total) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_ratio) }}</td>
                            <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_ratio) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    G. Necessary Document for Work Permit (PDF)
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>#</th>
<th>Required Attachment</th>
<th>Action</th>
                            </tr>
                        @if(!$nVisaDocs)

                        {{-- <tr>
                            <td>1</td>
                            <td>Copy of buyer's nomination letter in case of employment of buyer;s representative</td>
                            <td>







                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Copy of registration letter of board of investment, if not submitted earlier</td>
                            <td></td>
                        </tr> --}}
                        <tr>
                            <td>1</td>
                            <td>Copy of service contract/agreement/ appointment letter in case of employee</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
<td>Decision of the board of the directors of the company regarding employment of foreign nationals (In case of limited company) showing salary & other facility only signed by directors present in the meeting</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
<td>	Memorandum & Articles of Association of the company duly signed by shareholders along with certificate of incorporation (In case of limited company), if not sumitted earlier</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4</td>
<td>Photocopy of passport with E-type visa for employees/PI-type visa for Investors</td>
                            <td></td>
                        </tr>

                        @else


                        {{-- <tr>
                            <td>1</td>
                            <td>Copy of buyer's nomination letter in case of employment of buyer;s representative</td>
                            <td>


                               @if(empty($nVisaDocs->nomination_letter_of_buyer))


                               @else

                                <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'nomination','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                @endif


                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Copy of registration letter of board of investment, if not submitted earlier</td>
                            <td>

                                @if(empty($nVisaDocs->registration_letter_of_board_of_investment))


                                @else

                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'investment','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                 @endif

                            </td>
                        </tr> --}}
                        <tr>
                            <td>1</td>
                            <td>Copy of service contract/agreement/ appointment letter in case of employee</td>
                            <td>

                                @if(empty($nVisaDocs->employee_contract_copy))


                                @else

                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'contract','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                 @endif

                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Decision of the board of the directors of the company regarding employment of foreign nationals (In case of limited company) showing salary & other facility only signed by directors present in the meeting</td>
                            <td>

                                @if(empty($nVisaDocs->board_of_the_directors_sign_lette))


                                @else

                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'directors','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                 @endif

                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>	Memorandum & Articles of Association of the company duly signed by shareholders along with certificate of incorporation (In case of limited company), if not sumitted earlier</td>
                            <td>
                                @if(empty($nVisaDocs->share_holder_copy))


                                @else

                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'shareHolder','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                 @endif
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Photocopy of passport with E-type visa for employees/PI-type visa for Investors</td>
                            <td>
                                @if(empty($nVisaDocs->passport_photocopy))


                                @else

                                 <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'passportCopy','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                 @endif
                            </td>
                        </tr>


                        @endif
                        </tbody></table>
                </div>
            </div>
            <div class="card mt-3 ">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    H. Authorized Personal of the organization
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Organization Name: {{ $nVisaAuthPerson->auth_person_org_name }}</td>
                            <td>Organization House No: {{ $nVisaAuthPerson->auth_person_org_house_no }}</td>
                        </tr>
                        <tr>
                            <td>Organization Flat No: {{ $nVisaAuthPerson->auth_person_org_flat_no }}</td>
                            <td>Organization Road No: {{ $nVisaAuthPerson->auth_person_org_road_no }}</td>
                        </tr>
                        <tr>
                            <td>Organization Thana: {{ $nVisaAuthPerson->auth_person_org_thana }}</td>
                            <td>Organization Post Office: {{ $nVisaAuthPerson->auth_person_org_post_office }}</td>
                        </tr>
                        <tr>
                            <td>Organization District: {{ $nVisaAuthPerson->auth_person_org_district }}</td>
                            <td>Organization Mobile: {{ $nVisaAuthPerson->auth_person_org_mobile }}</td>
                        </tr>
                        <tr>
                            <td>Submission Date:  {{ $nVisaAuthPerson->submission_date }}</td>
                            <td>Expatriate Name: {{ $nVisaAuthPerson->expatriate_name }}</td>
                        </tr>
                        <tr>
                            <td>Expatriate Emai: {{ $nVisaAuthPerson->expatriate_email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
