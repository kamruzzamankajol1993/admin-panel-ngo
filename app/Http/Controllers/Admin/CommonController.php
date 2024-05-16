<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use DB;
use Image;
use Session;
class CommonController extends Controller
{

    public static  function profileImageUpload($request,$file,$filePath){


        $path = public_path('uploads/'.$filePath);

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }


        $imageName = date('Y-d-m').time().mt_rand(1000000000, 9999999999).".".$file->getClientOriginalExtension();
        $directory = 'public/uploads/';
        $imageUrl = $directory.$imageName;

        $img=Image::make($productImage)->resize(200,200);
        //$img=Image::make($imageName);
        $img->save($imageUrl);


        // $extension = date('Y-d-m').time().mt_rand(1000000000, 9999999999).".".$file->getClientOriginalExtension();
        // $filename = $extension;
        // $file->move('public/uploads/'.$filePath.'/', $filename);
        // $imageUrl =  'public/uploads/'.$filePath.'/'.$filename;


    return $imageUrl;
    //$imageUrl = $this->imageUpload($request);

    }

    public static  function imageUpload($request,$file,$filePath){


        $path = public_path('uploads/'.$filePath);

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }


        $extension = date('Y-d-m').time().mt_rand(1000000000, 9999999999).".".$file->getClientOriginalExtension();
        $filename = $extension;
        $file->move('public/uploads/'.$filePath.'/', $filename);
        $imageUrl =  'public/uploads/'.$filePath.'/'.$filename;


    return $imageUrl;
    //$imageUrl = $this->imageUpload($request);

    }


    public static  function pdfUpload($request,$file,$filePath){


        $path = public_path('uploads/'.$filePath);

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }


        $extension = date('Y-d-m').time().mt_rand(1000000000, 9999999999).".".$file->getClientOriginalExtension();
        $filename = $extension;
        $file->move('public/uploads/'.$filePath.'/', $filename);
        $imageUrl =  'uploads/'.$filePath.'/'.$filename;


    return $imageUrl;
    //$imageUrl = $this->imageUpload($request);

    }


    public static function englishToBangla($data){


        $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
        'May','June','July','August','September','October','November','December','Saturday','Sunday',
        'Monday','Tuesday','Wednesday','Thursday','Friday');



        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
        'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
        বুধবার','বৃহস্পতিবার','শুক্রবার'
        );


        $finalResult = str_replace($engDATE,$bangDATE,$data);

        return $finalResult;
    }

    public static function  generateRandomString($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function  generateRandomInteger($length = 6) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function apiData($fd9FormId){

        $dataFromNVisaFd9Fd1 =DB::table('fd9_one_forms')
        ->join('n_visas', 'n_visas.fd9_one_form_id', '=', 'fd9_one_forms.id')
        ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd9_one_forms.fd_one_form_id')
        ->select('fd_one_forms.*','fd9_one_forms.*','n_visas.*','n_visas.id as nVisaId')
        ->where('fd9_one_forms.id',$fd9FormId)
        ->first();
        //first step
        $randomString =CommonController::generateRandomString();
        $wpTrackingNo = 'WPN-'.date('d').date('F').date('Y').'-'.time().CommonController::generateRandomInteger();
        $systemUrl = DB::table('system_information')->first();
        //dd($systemUrl->system_url.$dataFromNVisaFd9Fd1->applicant_photo);

        //first step end


        //all n visa data





        $ngoStatus = DB::table('ngo_statuses')
        ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();



   $nVisaAuthPerson = DB::table('n_visa_authorized_personal_of_the_orgs')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();

   $nVisaCompensationAndBenifits = DB::table('n_visa_compensation_and_benifits')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();

      //dd($nVisaCompensationAndBenifits);

   $nVisaEmploye = DB::table('n_visa_employment_information')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();

   $nVisaManPower = DB::table('n_visa_manpower_of_the_offices')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();

      if(!$nVisaManPower){

        $com1 = [
           "local_manpower" => [
                                                   "executive" => '',
                                                   "supporting_staff" =>'',
                                                   "total" =>''
                                                ],
                                                "foreign_manpower" => [
                                                      "executive" =>'',
                                                      "supporting_staff" =>'',
                                                      "total" =>''
                                                   ],
                                                "grand_total" =>'',
                                                "locRatio" =>'',
                                                "forRatio" =>''
                                             ];

      }else{

         $com1 =  [
           "local_manpower" => [
                                                   "executive" => $nVisaManPower->local_executive,
                                                   "supporting_staff" => $nVisaManPower->local_supporting_staff,
                                                   "total" => $nVisaManPower->local_total
                                                ],
                                                "foreign_manpower" => [
                                                      "executive" => $nVisaManPower->foreign_executive,
                                                      "supporting_staff" => $nVisaManPower->foreign_supporting_staff,
                                                      "total" => $nVisaManPower->foreign_total
                                                   ],
                                                "grand_total" => $nVisaManPower->gand_total,
                                                "locRatio" =>$nVisaManPower->local_ratio,
                                                "forRatio" => $nVisaManPower->foreign_ratio
                                             ];
      }

   $nVisaDocs = DB::table('n_visa_necessary_document_for_work_permits')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();

   $nVisaForeignerInfo = DB::table('n_visa_particulars_of_foreign_incumbnets')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();



    $nVisaSponSor = DB::table('n_visa_particular_of_sponsor_or_employers')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();

   $nVisaWorkPlace = DB::table('n_visa_work_place_addresses')
                      ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();


//end all n visa data


//document

if(!$nVisaDocs){

    $mainDoc = [

    ];

}else{


    $firstCopy = DB::table('n_visa_necessary_document_for_work_permits')
    ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->value('nomination_letter_of_buyer');

       if(empty($firstCopy)){

        $firstCopyFinal = [
            "doc_name" => "",
            "file_public_path" => ""
        ];
       }else{

        $firstCopyFinal = [
            "doc_name" => "nomination_letter_of_buyer",
            "file_public_path" => $systemUrl->system_url.'public/'.$firstCopy
         ];

       }


    $secondCopy = DB::table('n_visa_necessary_document_for_work_permits')
    ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->value('registration_letter_of_board_of_investment');


    if(empty($secondCopy)){

        $secondCopyFinal = [
            "doc_name" => "",
            "file_public_path" => ""
        ];
       }else{

        $secondCopyFinal = [
            "doc_name" => "registration_letter_of_board_of_investment",
            "file_public_path" => $systemUrl->system_url.'public/'.$secondCopy
         ];

       }


    $thirdCopy = DB::table('n_visa_necessary_document_for_work_permits')
    ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->value('employee_contract_copy');

    if(empty($thirdCopy)){

        $thirdCopyFinal = [
            "doc_name" => "",
            "file_public_path" => ""
        ];
       }else{

        $thirdCopyFinal = [
            "doc_name" => "employee_contract_copy",
            "file_public_path" => $systemUrl->system_url.'public/'.$thirdCopy
         ];

       }


    $fourthCopy = DB::table('n_visa_necessary_document_for_work_permits')
    ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->value('board_of_the_directors_sign_letter');

    if(empty($fourthCopy)){

        $fourthCopyFinal = [
            "doc_name" => "",
            "file_public_path" => ""
        ];
       }else{

        $fourthCopyFinal = [
            "doc_name" => "board_of_the_directors_sign_letter",
            "file_public_path" => $systemUrl->system_url.'public/'.$fourthCopy
         ];

       }


    $fifthCopy = DB::table('n_visa_necessary_document_for_work_permits')
    ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->value('share_holder_copy');

    if(empty($fifthCopy)){

        $fifthCopyFinal = [
            "doc_name" => "",
            "file_public_path" => ""
        ];
       }else{

        $fifthCopyFinal = [
            "doc_name" => "share_holder_copy",
            "file_public_path" => $systemUrl->system_url.'public/'.$fifthCopy
         ];

       }


    $sixthCopy = DB::table('n_visa_necessary_document_for_work_permits')
    ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->value('passport_photocopy');


    if(empty($sixthCopy)){

        $sixthCopyFinal = [
            "doc_name" => "",
            "file_public_path" => ""
        ];
       }else{

        $sixthCopyFinal = [
            "doc_name" => "passport_photocopy",
            "file_public_path" => $systemUrl->system_url.'public/'.$sixthCopy
         ];

       }
////

$dataNew = DB::table('n_visa_necessary_document_for_work_permits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();



/////



    $mainDoc = [

        $firstCopyFinal,
        $secondCopyFinal,
        $thirdCopyFinal,
        $fourthCopyFinal,
        $fifthCopyFinal,
        $sixthCopyFinal

        ];





}
//end document

       //compansation;
       $annual =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Annual Bonus')->value('amount');


       $annual1 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Annual Bonus')->value('payment_type');


       $annual2 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Annual Bonus')->value('currency');

       $medical =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Medical Allowance')->value('amount');

       $medical1 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Medical Allowance')->value('payment_type');

       $medical2 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Medical Allowance')->value('currency');

       $entertainment =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Entertainment Allowance')->value('amount');


       $entertainment1 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Entertainment Allowance')->value('payment_type');


       $entertainment2 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Entertainment Allowance')->value('currency');


       $convoy =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Conveyance')->value('amount');


       $convoy1 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Conveyance')->value('payment_type');

       $convoy2 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Conveyance')->value('currency');

       $house =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','House Rent')->value('amount');


       $house1 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','House Rent')->value('payment_type');


       $house2 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','House Rent')->value('currency');



       $overseas =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Overseas Allowance')->value('amount');


       $overseas1 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Overseas Allowance')->value('payment_type');

       $overseas2 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Overseas Allowance')->value('currency');


//dd($overseas);

       $basic =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Basic Salary')->value('amount');

       $basic1 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Basic Salary')->value('payment_type');

       $basic2 =DB::table('n_visa_compensation_and_benifits')
       ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)
       ->where('salary_category','Basic Salary')->value('currency');



       //condition

       if(!$nVisaCompensationAndBenifits){

        $com = [ "basic_salary" => [
           "amount" =>'',
           "payment_type" =>'',
           "currency" =>''
        ],
        "overseas_allowance" => [
           "amount" =>'',
           "payment_type" =>'',
           "currency" =>''
           ],
        "house_rent" => [
       "amount" =>'',
           "payment_type" =>'',
           "currency" =>''
              ],
        "conveyance_allowance" => [
         "amount" =>'',
           "payment_type" =>'',
           "currency" =>''
                 ],
        "medical_allowance" => [
          "amount" =>'',
           "payment_type" =>'',
           "currency" =>''
                    ],
        "entertainment_allowance" => [
             "amount" =>'',
           "payment_type" =>'',
           "currency" =>''
                       ],
        "annual_bonus" => [
          "amount" =>'',
           "payment_type" =>'',
           "currency" =>''
                          ],
        "other_benefit" =>$dataFromNVisaFd9Fd1->other_benefit,
        "salary_remarks" =>$dataFromNVisaFd9Fd1->salary_remarks
                        ];

         //dd($com);

       }else{




     $com = [
        "basic_salary" => [

           "amount" =>$basic,
           "payment_type" =>$basic1,
           "currency" =>$basic2

        ],

        "overseas_allowance" => [
           "amount" =>$overseas,
           "payment_type" =>$overseas1,
           "currency" =>$overseas2
           ],
        "house_rent" => [
           "amount" =>$house,
           "payment_type" =>$house1,
           "currency" =>$house2
              ],
        "conveyance_allowance" => [
           "amount" =>$convoy,
           "payment_type" =>$convoy1,
           "currency" =>$convoy2
                 ],
        "medical_allowance" => [
           "amount" =>$medical,
           "payment_type" =>$medical1,
           "currency" =>$medical2
                    ],
        "entertainment_allowance" => [
           "amount" =>$entertainment,
           "payment_type" =>$entertainment1,
           "currency" =>$entertainment2
                       ],
        "annual_bonus" => [
           "amount" =>$annual,
           "payment_type" =>$annual1,
           "currency" =>$annual2
                          ],
        "other_benefit" =>$dataFromNVisaFd9Fd1->other_benefit,
        "salary_remarks" =>$dataFromNVisaFd9Fd1->salary_remarks
                        ];
                    }
       //end condition

       //end compansation

       Session::put('request_id',$randomString);

    $data = [
      "project_code" => "ngo-oss",
      "request_id" =>$randomString,
      "depertment_name" => "Registration & Incentives-I (Commercial)",
      "wp_tracking_no" => $wpTrackingNo,
      "basic_info" => [
            "period_validity" =>$dataFromNVisaFd9Fd1->period_validity,
            "visa_ref_no" => $dataFromNVisaFd9Fd1->visa_ref_no,
            "visa_category" => $dataFromNVisaFd9Fd1->visa_category,
            "permit_efct_date" =>$dataFromNVisaFd9Fd1->permit_efct_date,
            "applicant_photo" => $systemUrl->system_url.$dataFromNVisaFd9Fd1->applicant_photo,
            "forwarding_letter" =>$systemUrl->system_url.'public/'.$dataFromNVisaFd9Fd1->forwarding_letter
         ],
      "a_particular_of_sponsor" => [
               "org_name" =>$nVisaSponSor->org_name,
               "org_house_no" =>$nVisaSponSor->org_house_no,
               "org_flat_no" =>$nVisaSponSor->org_flat_no,
               "org_fax_no" =>$nVisaSponSor->org_fax_no,
               "org_district" =>$nVisaSponSor->org_district,
               "org_thana" =>$nVisaSponSor->org_thana,
               "org_road_no" =>$nVisaSponSor->org_road_no,
               "org_post_code" =>$nVisaSponSor->org_post_code,
               "org_phone" =>$nVisaSponSor->org_phone,
               "org_email" =>$nVisaSponSor->org_email,
               "nature_of_business" =>$nVisaSponSor->nature_of_business,
               "authorized_capital" =>$nVisaSponSor->authorized_capital,
               "paid_up_capital" =>$nVisaSponSor->paid_up_capital,
               "remittance_received" =>$nVisaSponSor->remittance_received,
               "org_type" =>$nVisaSponSor->org_type,
               "industry_type" =>$nVisaSponSor->industry_type
            ],
      "b_particular_of_foreign_incumbent" => [
                  "name_of_the_foreign_national" =>$nVisaForeignerInfo->name_of_the_foreign_national,
                  "date_of_birth" =>$nVisaForeignerInfo->date_of_birth,
                  "marital_status" =>$nVisaForeignerInfo->martial_status,
                  "date_of_arrival" =>$nVisaEmploye->date_of_arrival_in_bangladesh,
                  "country" =>$nVisaForeignerInfo->home_country,
                  "nationality" =>$nVisaForeignerInfo->nationality,
                  "passport_no" =>$nVisaForeignerInfo->passport_no,
                  "passport_issue_date" =>$nVisaForeignerInfo->passport_issue_date,
                  "passport_issue_place" =>$nVisaForeignerInfo->passport_issue_place,
                  "passport_exiry_date" =>$nVisaForeignerInfo->passport_expiry_date,
                  "house_no" =>$nVisaForeignerInfo->house_no,
                  "home_country" =>$nVisaForeignerInfo->home_country,
                  "flat_no" =>$nVisaForeignerInfo->flat_no,
                  "road_no" =>$nVisaForeignerInfo->road_no,
                  "post_code" =>$nVisaForeignerInfo->post_code,
                  "state" =>$nVisaForeignerInfo->state,
                  "phone" =>$nVisaForeignerInfo->phone,
                  "fax_no" =>$nVisaForeignerInfo->fax_no,
                  "email" =>$nVisaForeignerInfo->email,
               ],
      "c_employment_information" => [
                     "employed_designation" =>$nVisaEmploye->employed_designation,
                     "first_appointment_date" =>$nVisaEmploye->first_appoinment_date,
                     "desired_effective_date" =>$nVisaEmploye->desired_effective_date,
                     "desired_end_date" =>$nVisaEmploye->desired_end_date,
                     "visa_type" =>$nVisaEmploye->visa_type,
                     "travel_visa_cate" => "2",
                     "visa_validity" => $nVisaEmploye->visa_validity,
                     "brief_job_description" => $nVisaEmploye->brief_job_description,
                     "employee_justification" => $nVisaEmploye->employee_justification,
                  ],

                  "compensation_and_benefits" =>  $com,


      "manpower_of_the_office" =>$com1,
      "d_workplace_address" => [
                                                         "wp_org_house_no" =>$nVisaWorkPlace->work_house_no,
                                                         "wp_org_flat_no" => $nVisaWorkPlace->work_flat_no,
                                                         "wp_org_road_no" => $nVisaWorkPlace->work_road_no,
                                                         "wp_org_district" => $nVisaWorkPlace->work_district,
                                                         "wp_org_thana" => $nVisaWorkPlace->work_thana,
                                                         "wp_org_email" => $nVisaWorkPlace->work_email,
                                                         "wp_org_type" => $nVisaWorkPlace->work_org_type,
                                                         "wp_contact_person_mobile" => $nVisaWorkPlace->contact_person_mobile_number
                                                      ],
      "authorized_personnel_of_the_organization" => [
                                                            "org_name" =>$nVisaAuthPerson->auth_person_org_name,
                                                            "org_house_no" =>$nVisaAuthPerson->auth_person_org_house_no,
                                                            "org_flat_no" =>$nVisaAuthPerson->auth_person_org_flat_no,
                                                            "org_road_no" =>$nVisaAuthPerson->auth_person_org_road_no,
                                                            "org_thana" =>$nVisaAuthPerson->auth_person_org_thana,
                                                            "org_district" =>$nVisaAuthPerson->auth_person_org_district,
                                                            "org_post_office" =>$nVisaAuthPerson->auth_person_org_post_office,
                                                            "org_mobile" =>$nVisaAuthPerson->auth_person_org_mobile,
                                                            "submission_date" =>$nVisaAuthPerson->submission_date,
                                                            "expatriate_name" =>$nVisaAuthPerson->expatriate_name,
                                                            "expatriate_email" =>$nVisaAuthPerson->expatriate_email
                                                         ],
      "document_list" => $mainDoc
   ];

//dd($data);
   return $data;


    }
}
