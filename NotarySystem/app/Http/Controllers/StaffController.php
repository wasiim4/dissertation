<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\user;
use App\Meeting;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Mail\sendMail;
use Mail;
use Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Calendar;
use App\Rules\validateOldPassword;

class StaffController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();
        return view('staff')->with('users',$users);
    
    }

    public function newRegisterPage(){
        return view('auth.registernew');
    }

    public function add_user(Request $request){
        //validating inputs
        $this->validate($request,
        [
            'inputFirstName' => 'required|alpha|max:255',
            'inputLastName' => 'required|alpha|max:255',
            'inputContactNum' => 'required|regex:/^[5][0-9]{7}+$/u|integer|unique:users,contactnum',
            'inputEmail' => 'required|string|email|max:255|unique:users,email',
            'inputDob' => 'required|date',
            'inputGender' => 'required|alpha|max:255',
            'inputAddress' => 'required|string|max:255',
            'inputMarriageStatus' => 'required',
            'inputRoles' =>'required',
            'inputNIC1' => 'required|alpha_num|max:14|unique:users,nic',
            'inputBcNum' => 'required|numeric|unique:users,birthCertificateNumber',
            'inputDistrict' =>'required',
            'inputPlaceOfBirth' =>'required',
            'inputProfession' =>'required',
            'inputTitle' =>'required',
             ]       
        );

        //fetching inputs
        $fname = Input::get('inputFirstName');
        $lname = Input::get('inputLastName');
        $email = Input::get('inputEmail');
        $dob = Input::get('inputDob');
        $contactnum = Input::get('inputContactNum');
        $gender = Input::get('inputGender');
        $address= Input::get('inputAddress');
        $marriageStatus=Input::get('inputMarriageStatus');
        $roles=Input::get('inputRoles');
        $nic=Input::get('inputNIC1');
        $title=Input::get('inputTitle');
        $profession=Input::get('inputProfession');
        $bcNum=Input::get('inputBcNum');
        $districtIssued=Input::get('inputDistrict');
        $placeOfBirth=Input::get('inputPlaceOfBirth');
      
        $commonLawMarriage=Input::get('lawMarriage');

        //sending generated mail with password
        $generatedPassword=str_random(8);
        self::sendEmail($generatedPassword,$email,$fname,$lname);
        
        //adding data to database
        $data = array(
            'firstname' => $fname, 
            'lastname' => $lname, 
            'email' => $email, 
            'password' => Hash::make($generatedPassword),
            'dob' => $dob, 
            'contactnum' => $contactnum,
            'gender' => $gender,
            'address' =>$address,
            'nic' => $nic,
            'roles' => $roles,
            'marriageStatus' => $marriageStatus,
            'birthCertificateNumber' =>$bcNum,
            'districtIssued' => $districtIssued,
            'placeOfBirth' =>$placeOfBirth,
            'profession'=>$profession,
            'title'=> $title         
        );

         DB::table('users')->insert($data);
        
        if($commonLawMarriage=="Yes" && $marriageStatus=='Mariés'){
            // Session::flash('message', 'Client successfully added and email successfully sent!'); 
            return redirect('staff/registerSpouse');
        }
        else{
            Session::flash('message', 'Client successfully added and email successfully sent!'); 
            return redirect('staff/registernew');
        }
    }

        public function sendEmail($genPass,$email,$fname,$lname)
        {
            \Mail::send(new sendMail($genPass,$email,$fname,$lname));
        }

        public function newRegisterSpousePage(){
            $users = DB::table('users')->get();
            return view('auth.registrationSpouse')->with('users',$users);
            
        }

        public function add_spouse(Request $request){
            //validating inputs
            $this->validate($request,
            [
                'inputClientID' => 'required',
                'inputSpouseFirstName'=> 'required|string|max:255',
                'inputSpouseLastName'=> 'required|string|max:255',
                'inputSpouseTitle' =>'required',
                'inputSpouseNIC' => 'required|alpha_num|max:14|unique:users,spouseNic',
                'inputSpouseDob' =>'required|date',
                'inputSpouseBcNum' => 'required|numeric|unique:users,spouseBCNum',
                'inputSpouseDistrict' =>'required',
                'inputSpouseMarriageDate' =>'required|date',
                'inputMcNum' => 'required|numeric|unique:users,MCnumber',
                'inputMcDistrict' =>'required',
                'inputSpouseProfession' =>'required|alpha|max:255',
                'inputSpouseGender' =>'required',
                'inputSpousePlaceOfBirth' =>'required',
                ]       
            );

            //retrieving inputs
            $clientId=Input::get('inputClientID');
            $fname=Input::get('inputSpouseFirstName');
            $lname=Input::get('inputSpouseLastName');
            $title=Input::get('inputSpouseTitle');
            $nic=Input::get('inputSpouseNIC');
            $spouseid=Input::get('inputID');
            $dob=Input::get('inputSpouseDob');
            $bcNum=Input::get('inputSpouseBcNum');
            $bcDistrict=Input::get('inputSpouseDistrict');
            $marriageDate=Input::get('inputSpouseMarriageDate');
            $mcNum=Input::get('inputMcNum');
            $mcDistrict=Input::get('inputMcDistrict');
            $profession=Input::get('inputSpouseProfession');
            $gender=Input::get('inputSpouseGender');
            $placeOfBirth=Input::get('inputSpousePlaceOfBirth');
        
            //updating database
            $query= DB::table('users')
                        ->where("id", $clientId)
                        ->update([
                            'spouseTitle' =>$title,
                            'spouseFirstname' =>$fname,
                            'spouseLastname' =>$lname,
                            'spouseDob' =>$dob,
                            'spouseBCNum' =>$bcNum,
                            'spouseBCdistrictIssued' =>$bcDistrict,
                            'spousePlaceOfBirth' =>$placeOfBirth,
                            'spouseGender' => $gender,
                            'spouseNic' =>$nic,
                            'marriageDate' =>$marriageDate,
                            'MCNumber' => $mcNum,
                            'MCdistrictIssued' => $mcDistrict,
                            'spouseProfession' =>$profession     
                        ]); 

                        Session::flash('message', 'Spouse successfully added!'); 
                        return redirect('staff/registernew');
        }

        //function to return the view of the property registration form
        public function propertyRegistration(){  
            $users = DB::table('users')->get();
            return view('auth.propertyRegistration')->with('users',$users);
        }

        //fuction to register an immovable property
        public function add_property(Request $request){
             //validating inputs
             $this->validate($request,
             [
                 'inputClientID' => 'required',
                 'inputAddress'=> 'required|string|max:255',
                 'inputPreviousNotaryFN'=> 'required|string|max:255',
                 'inputPreviousNotaryLN'=> 'required|string|max:255',
                 'inputSizeMsF' =>'required|numeric',
                 'inputTranscriptionVolume' => 'required|string|max:255',
                 'inputPinNum' =>'required|alpha_num',
                 'inputRegNum' =>'required|string|max:255',
                 'inputLsFn'=> 'required|alpha|max:255',
                 'inputLsLn'=> 'required|alpha|max:255',
                 'inputSizeInPerch' => 'required|numeric',
                 'inputPrice' => 'required|numeric',
                 'inputSurveyingDate' =>'required|date',
                 'inputFirstDeedReg' =>'required|date',
                 'inputFirstDeedGeneration' =>'required|date',
                 
                 ]);
                 
            //getting input 
            $propertyType=Input::get('inputPropertyType');
            $clientId=Input::get('inputClientID');
            $propertyAdd=Input::get('inputAddress');
            $sizeMsFigures=Input::get('inputSizeMsF');        
            $sizeInPerch=Input::get('inputSizeInPerch');
            $transcriptionVol=Input::get('inputTranscriptionVolume');
            $pinNum=Input::get('inputPinNum');
            $regNumInLsReport=Input::get('inputRegNum');
            $surveyorFirstName=Input::get('inputLsFn');
            $surveyorLastName=Input::get('inputLsLn');
            $surveyingDate=Input::get('inputSurveyingDate');
            $priceFigures=Input::get('inputPrice');            
            $firstDeedReg=Input::get('inputFirstDeedReg');
            $firstDeedGeneration=Input::get('inputFirstDeedGeneration');
            $previousNotaryTitle=Input::get('inputPreviousNotaryTitle');
            $previousNotaryFN=Input::get('inputPreviousNotaryFN');
            $previousNotaryLN=Input::get('inputPreviousNotaryLN');
            $districtSituated=Input::get('inputDistrict');
            $checkBuyer=Input::get('checkBuyer');

            //check if the client is a firstime buyer or not
            if($checkBuyer=="No"){
                //if yes then taxduty is calculated
                $taxduty=(0.05*$priceFigures);
            }
            else{
                //if no then no taxduty 
                $taxduty=0;
            }


        
            //inserting into db
            $data = array(
                'clientId' =>  $clientId, 
                'address' => $propertyAdd, 
                'priceInFigures' =>  $priceFigures,            
                'propertyType' => $propertyType, 
                'sizeInMSFigures' =>   $sizeMsFigures,
                'sizeInPerchFigures' => $sizeInPerch,
                'taxDuty' => $taxduty,
                'transcriptionVol' => $transcriptionVol,
                'pinNum' =>  $pinNum,
                'regNumLSReport' =>$regNumInLsReport,
                'surveyorFN' => $surveyorFirstName,
                'surveyorLN' =>$surveyorLastName,
                'surveyorDate'=>$surveyingDate,
                'firstDeedRegistration'=>$firstDeedReg,
                'firstDeedGeneration'=>$firstDeedGeneration,
                'previousNotaryFN'=>$previousNotaryFN,
                'previousNotaryLN'=>$previousNotaryLN,
                'previousNotaryTitle'=>$previousNotaryTitle,
                'districtSituated'=>$districtSituated
            );

            DB::table('immovableproperty')->insert($data);
            Session::flash('message', 'Property successfully added with a taxduty of RS'.$taxduty); 
            return Redirect::to('staff/propertyRegistration');
        }

        //function to generate contract
        public function generateContract(){
            $users = DB::table('users')->get();
            $properties= DB::table('immovableproperty')->get();
            return view('auth.generateContract')->with('users',$users)->with('properties',$properties);
        }

        //function for staff to view his/her own profile as well as editing his/her details
        public function myProfile(){
            $staff_id = Auth::user()->id;  
            $staff_get=DB::table('staff') 
            ->where(['id'=>$staff_id])
            ->get();

            $staff_get =  $staff_get[0];
            return view('Staff.staffProfile')->with('staff_detail',  $staff_get);

        
        }

        public function profileupdate(Request $request)
        {
            $staff_id = Auth::user()->id;
            $image=$request->file('fpropic');

            $title=Input::get('txtTitle');
            $fname = Input::get('txtfname');
            $lname = Input::get('txtlname');
            $email=Input::get('txtemail');
            $cnum = Input::get('txtcnum');
            $dob = Input::get('txtdob');
            $nic = Input::get('txtnic');
            $gender=Input::get('txtgender');

            $this->validate($request,
                [
                    'txtfname' => 'required',
                    'txtlname' => 'required',
                    'txtcnum' => 'required',
                    'txtemail' => 'required',
                    'txtdob' => 'required',
                    'txtnic' => 'required',
                    'txtTitle' => 'required',
                    'txtgender'=>'required'
                ]);

                // Handle File Upload
            if(isset($image)) { //to check if user has selected an image
                if($request->hasFile('fpropic')){

                    // $this->validate($request,
                    // [
                    //     'fpropic' => 'mimes:jpeg,jpg,png '      
                    // ]);
                    
                    // Get filename with the extension
                    $filenameWithExt = $request->file('fpropic')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just the file extension
                    $extension = $request->file('fpropic')->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $request->file('fpropic')->storeAs('public/images', $fileNameToStore);

                    DB::table('staff')
                    ->where('id', $staff_id)
                    ->update(['img_path' => $fileNameToStore
                    ]);
                }
            }
            DB::table('staff')
            ->where('id', $staff_id)
            ->update([
                        'title'=>$title,
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'email' => $email,
                    'dob' =>$dob,
                    'nic'=>$nic,
                    'contactnum' => $cnum,
                    'gender' => $gender
                    
            ]);
        
            return redirect('/staff/profile/view');
            
        }

        //function to show the calendar with all meetings
        public function meeting(){
            // $meetings = Meeting::get();
            $meetings=DB::table('meetings') ->where('MeetingStatus','Confirmed')->get();
            $meeting_list = [];
            foreach ($meetings as $key => $meeting) {
                $meeting_list[] = Calendar::event(
                    $meeting->meetingReason,
                    false, //to enable the user to view the date and time as well on the calendar
                    new \DateTime($meeting->startTime),
                    new \DateTime($meeting->endTime.' +1 day')
                );
            }
            $users=DB::table('users')->get();
            $calendar_details = Calendar::addEvents($meeting_list);     
            return view('meetings', compact('calendar_details','users'));
        }

        public function addMeeting(Request $request){

            $this->validate($request,
                [
                    'meetingReason'=>'required',
                    'startTime'=>'required|date',
                    'endTime'=>'required|date|after:startTime'
                    
                ]);


            //retrieving inputs
            $status="Pending";
            $party=Input::get('party');
            $id=Input::get('partyId');
            $reason=Input::get('meetingReason');
            $start=Input::get('startTime');
            $end=Input::get('endTime');

            //calculating meeting durations
            $date1=date_create($start);
            $date2=date_create($end);

            $data = array(
                'partyId' =>  $id, 
                'reqFrom'=>Auth::user()->roles,
                'requestorId'=>Auth::user()->id,
                'partyRole' =>  $party,
                'meetingReason' => $reason, 
                'startTime'=>$start,
                'endTime' =>  $end ,
                'meetingStatus' =>$status
                
                
            );

            // DB::table('meetings')->insert($data);
            //inserting into database
            $meeting_id = DB::table('meetings')->insertGetId($data);
            $meet=(DB::table('meetings')->where('id',$meeting_id)->get())[0];

            if($party=="Client"){
                $user=DB::table('users')
                ->where('id', $id)
                ->get();
                
                foreach ($user as $users) {
                
                        $data = [
                            'firstname'      => $users->firstname,
                            'lastname'       => $users->lastname,
                            'meetingReason' =>$reason,
                            'startTime'     =>$start,
                            'endTime'       =>$end,
                            'duration'      =>date_diff($date1,$date2)->format("%dd %hh %im"),
                            'pid'           =>$users->id,
                            'mid'           =>$meeting_id,
                            'party'         =>$party
                            
                        ];
        
                        Mail::send('emails.email_invitation', $data, function($m) use ($users){
                        $m->to($users->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject('Meeting');
                        });
        
                        Session::flash('message', 'Meeting successfully added and mail successfully sent!'); 
                        return Redirect::to('staff/meeting/add/del/up');
                    
                }
            }

            if($party=="RGD"){
                $rgd=DB::table('rgds')
                ->where('id', $id)
                ->get();
                
                foreach ($rgd as $rgds) {
                
                        $data = [
                            'name'          =>$rgds->name,
                            'meetingReason' =>$reason,
                            'startTime'     =>$start,
                            'endTime'       =>$end,
                            'duration'      =>date_diff($date1,$date2)->format("%dd %hh %im"),
                            'pid'           =>$rgds->id,
                            'mid'           =>$meeting_id,
                            'party'         =>$party
                            
                        ];
        
                        Mail::send('emails.email_invitation', $data, function($m) use ($rgds){
                        $m->to($rgds->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject('Meeting');
                        });
        
                        Session::flash('message', 'Meeting successfully added and mail successfully sent!'); 
                        return Redirect::to('staff/meeting/add/del/up');
                    
                }
            }

            if($party=="Bank"){
                $bank=DB::table('banks')
                ->where('id', $id)
                ->get();
                
                foreach ($bank as $banks) {
                
                        $data = [
                            'name'          =>$banks->name,
                            'meetingReason' =>$reason,
                            'startTime'     =>$start,
                            'endTime'       =>$end,
                            'duration'      =>date_diff($date1,$date2)->format("%dd %hh %im"),
                            'pid'           =>$banks->id,
                            'mid'           =>$meeting_id,
                            'party'         =>$party
                            
                        ];
        
                        Mail::send('emails.email_invitation', $data, function($m) use ($banks){
                        $m->to($banks->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject('Meeting');
                        });
        
                        Session::flash('message', 'Meeting successfully added and mail successfully sent!'); 
                        return Redirect::to('staff/meeting/add/del/up');
                    
                }
            }

            if($party=="Land Surveyor"){
                $landSurveyor=DB::table('land_surveyors')
                ->where('id', $id)
                ->get();
                
                foreach ($landSurveyor as $landSurveyors) {
                
                        $data = [
                            'name'          =>$landSurveyors->name,
                            'meetingReason' =>$reason,
                            'startTime'     =>$start,
                            'endTime'       =>$end,
                            'duration'      =>date_diff($date1,$date2)->format("%dd %hh %im"),
                            'pid'           =>$landSurveyors->id,
                            'mid'           =>$meeting_id,
                            'party'         =>$party
                            
                        ];
        
                        Mail::send('emails.email_invitation', $data, function($m) use ($landSurveyors){
                        $m->to($landSurveyors->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject('Meeting');
                        });
        
                        Session::flash('message', 'Meeting successfully added and mail successfully sent!'); 
                        return Redirect::to('staff/meeting/add/del/up');
                    
                }
            }

            // return "success";
            
        }

        public function meetingForm(){
            $users=DB::table('users')->get();
            $rgds=DB::table('rgds')->get();
            $banks=DB::table('banks')->get();
            $landSurveyors=DB::table('land_surveyors')->get();
            $meetings=DB::table('meetings')->where('requestorId',Auth::user()->id)
                                        ->where('reqFrom',Auth::user()->roles)
                                        ->get();

            $meetingsByClient=DB::table('meetings')->where('reqFrom','Client')->get();
            $meetingsBank=DB::table('meetings')->where('reqFrom','Bank')->get();
            $meetingsByRGD=DB::table('meetings')->where('reqFrom','RGD')->get();
            $meetingsByLS=DB::table('meetings')->where('reqFrom','Land Surveyor')->get();
            return view('meetingsConfig')->with('users',$users)
                                        ->with('meetings',$meetings)
                                        ->with('rgds',$rgds)
                                        ->with('banks',$banks)
                                        ->with('meetingsByClient',$meetingsByClient)
                                        ->with('meetingsBank',$meetingsBank)
                                        ->with('meetingsByRGD',$meetingsByRGD)
                                        ->with('meetingsByLS',$meetingsByLS)
                                        ->with('landSurveyors',$landSurveyors);

        }

        //upload contract form
        public function showUploadForm(){
            $transactions=DB::table('transaction')->get();
            $properties=DB::table('immovableproperty')->get();
            $users=DB::table('users')->get();
            return view('Staff.uploadContract')->with('users',$users)->with('transactions',$transactions)
            ->with('properties',$properties);
        }

       

        public function uploadContract(Request $request){

            $upload=$request->file('contract');
            $clientName=Input::get('inputClientName');
            $property=Input::get('inputProperty');
            $transactionType=Input::get('inputTransaction');
            $stampDuty=Input::get('inputStampDuty');
            $administrativeFees=Input::get('inputAdministrativeFees');

            $this->validate($request,
                [
                    'inputClientName'=>'required',
                    'inputProperty'=>'required',
                    'inputTransaction'=>'required',
                    'contract' => 'required|mimes:pdf',                  
                    'inputStampDuty'=>'required|numeric',
                    'inputAdministrativeFees'=>'required|numeric'
                ]);


            if(isset($upload)) { //to check if user has selected an image

                if($request->hasFile('contract')){

                    // Get filename with the extension
                    $filenameWithExt = $request->file('contract')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just the file extension
                    $extension = $request->file('contract')->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $request->file('contract')->storeAs('public/images', $fileNameToStore);

                    //fetching the price of the selected property
                    $propertyPrice=DB::table('immovableproperty')->where('propertyId',$property)->get();

                    $fees=0;
                    $totalFees=0;

                    if($transactionType=='SOIP1'){
                        foreach ($propertyPrice as $propertyPRICE) {
                            $price=$propertyPRICE->priceInFigures;
                        }

                        if($price <= 250000){
                            //2% on the first 250,000
                            $fees=(0.02*$price);
                        }

                        elseif (($price > 250000)&&($price <= 750000)) {

                             //2% on the first 250,000 
                             $payment1=0.02*250000;
                             $remainings=$price-250000;
                             $fees=$fees+$payment1;

                             //1.5% on the next 500,000
                             $payment2=0.015*($remainings);
                             $fees=$fees+$payment2;
                        }

                        elseif (($price > 750000)&&($price <= 1750000)) {

                            //2% on the first 250,000 
                            $payment1=0.02*250000;
                            $fees=$fees+$payment1;

                            //1.5% on the next 500,000
                            $payment2=0.015*(500000);
                            $remainings=($price-750000);
                            $fees=$fees+$payment2;

                            //1% on the next 1,000,000
                            $payment3=0.01*$remainings;
                            $fees=$fees+$payment3;
                            
                        }

                        elseif ($price > 1750000) {

                             //2% on the first 250,000 
                             $payment1=0.02*250000;
                             $fees=$fees+$payment1;
 
                             //1.5% on the next 500,000
                             $payment2=0.015*(500000);
                             $fees=$fees+$payment2;

                             //1% on the next 1,000,000
                             $payment3=0.01*1000000;
                             $fees=$fees+$payment3;

                             //0.5% on the remainder
                             $payment4=(0.005*($price-1750000));
                             $fees=$fees+$payment4;
                        }

                    }

                    $VAT=(0.15*$fees);
                    $totalFees=$totalFees+$fees+$VAT+$stampDuty+$administrativeFees;
                    }

                    elseif ($transactionType=='ALOT02') {

                        foreach ($propertyPrice as $propertyPRICE) {
                            $price=$propertyPRICE->priceInFigures;
                        }

                        if($price <= 100000){
                            //2% on the first 100,000
                            $fees=(0.02*$price);
                        }

                        elseif (($price > 100000)&&($price <= 350000)) {

                             //2% on the first 100,000 
                             $payment1=0.02*100000;
                             $remainings=$price-100000;
                             $fees=$fees+$payment1;

                             //1.5% on the next 250,000
                             $payment2=0.015*($remainings);
                             $fees=$fees+$payment2;
                        }

                        elseif (($price > 350000)&&($price <= 850000)) {

                            //2% on the first 100,000 
                            $payment1=0.02*100000;
                            $fees=$fees+$payment1;

                            //1.5% on the next 250,000
                            $payment2=0.015*(250000);
                            $remainings=($price-350000);
                            $fees=$fees+$payment2;

                            //1% on the next 500,000
                            $payment3=0.01*$remainings;
                            $fees=$fees+$payment3;
                            
                        }

                        elseif ($price > 850000) {

                             //2% on the first 100,000 
                             $payment1=0.02*100000;
                             $fees=$fees+$payment1;
 
                             //1.5% on the next 250,000
                             $payment2=0.015*(250000);
                             $fees=$fees+$payment2;

                             //1% on the next 500,000
                             $payment3=0.01*500000;
                             $fees=$fees+$payment3;

                             //0.5% on the remainder
                             $payment4=(0.005*($price-850000));
                             $fees=$fees+$payment4;
                        }
                        
                        $VAT=(0.15*$fees);
                        $totalFees=$totalFees+$fees+$VAT+$stampDuty+$administrativeFees;
                    }
                
                    $data = array(
                        'clientId' =>  $clientName, 
                        'contractName' => $fileNameToStore, 
                        'staffId'=>Auth::user()->id,
                        'propertyId' =>  $property,
                        'fees'=>$totalFees,
                        'transactionType'=> $transactionType
                    );
            
                    DB::table('transaction')->insert($data);
                    $client= DB::table('users')->where('id', $clientName)->get();

                    foreach ($client as $clients) {

                        $data = [
                            'firstname'          =>$clients->firstname,
                            'lastname'          =>$clients->lastname,
                            'Fees'     =>$totalFees               
                        ];
                        
                        Mail::send('emails.notifyUploadContract', $data, function($m) use ($clients){
                            $m->to($clients->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Contract Copy and Payment");
                        });
                    }

                    DB::table('task_progress')->where('clientId',$clientName)->update([
                        'SignedUpload'=>true                       
                    ]);
                    Session::flash('message', 'Contract successfully uploaded and mail successfully sent! Fees to paid=RS '.$totalFees); 
                    return Redirect::to('/staff/upload/contract');
                }

            }
        //view final contract uploaded by notary/notary assistant directly on browser in PDF Format
        public function viewContract($id){
            $transactions=DB::table('transaction')->where('id', $id)->get();
            return view('Staff.viewContract')->with('transactions',$transactions);
        }

        //view client profile
        public function clientDetails($id){
            $user = user::find($id);
            return view('Staff.viewClientProfile')->with('users', $user);
        }

        //delete a client
        public function deleteClient($id){
            DB::table('users')
                ->where('id', $id)
                ->delete();
            return "successfully deleted";
        }

        //get list of transactions by client ID in 'transaction' table
        public function getListTransactions($id){
            $transactions=DB::table('transaction')
                            ->where('clientId',$id)
                            ->get();
            return view('Staff.viewClientTransactions')->with('transaction',$transactions);
        }

        //add client's children form
        public function showChildrenForm(){
            $users=DB::table('users')->get();
            return view('Staff.addChildren')->with('users',$users);
        }

        //add children into db
        public function addChildren(Request $request){
            $users=DB::table('users')->get();
            // $this->validate($request,
            // [
            //     'inputChildrenFirstName' => 'required|alpha|max:255',
            //     'inputChildrenLastName' => 'required|alpha|max:255',
            //     'inputChildrenContactNum' => 'required|regex:/^[5][0-9]{7}+$/u|integer|unique:users,contactnum',
            //     'inputChildrenEmail' => 'required|string|email|max:255|unique:users,email',
            //     'inputChildrenDob' => 'required|date',
            //     'inputChildrenGender' => 'required|alpha|max:255',
            //     'inputChildrenAddress' => 'required',
            //     'inputChildrenMarriageStatus' => 'required',
            //     'inputChildrenRoles' =>'required',
            //     'inputChildrenNIC1' => 'required|alpha_num|unique:users,nic',
            //     'inputChildrenBcNum' => 'required|numeric',
            //     'inputChildrenDistrict' =>'required',
            //     'inputChildrenPlaceOfBirth' =>'required',
            //     'inputChildrenProfession' =>'required',
            //     'inputChildrenTitle' =>'required',
            //      ]       
            // );

            
            $parentId=Input::get('inputParentId');
            $fname = Input::get('inputChildrenFirstName');
            $lname = Input::get('inputChildrenLastName');
            $email = Input::get('inputChildrenEmail');
            $dob = Input::get('inputChildrenDob');
            $contactnum = Input::get('inputChildrenContactNum');
            $gender = Input::get('inputChildrenGender');
            $address= Input::get('inputChildrenAddress');
            $marriageStatus=Input::get('inputChildrenMarriageStatus');
            $roles=Input::get('inputChildrenRoles');
            $nic=Input::get('inputChildrenNIC1');
            $title=Input::get('inputChildrenTitle');
            $profession=Input::get('inputChildrenProfession');
            $bcNum=Input::get('inputChildrenBcNum');
            $districtIssued=Input::get('inputChildrenDistrict');
            $placeOfBirth=Input::get('inputChildrenPlaceOfBirth');

            $generatedPassword=str_random(8);
            $data = array(
                'firstname' => $fname, 
                'lastname' => $lname, 
                'email' => $email, 
                'password' => Hash::make($generatedPassword),
                'dob' => $dob, 
                'contactnum' => $contactnum,
                'gender' => $gender,
                'address' =>$address,
                'nic' => $nic,
                'roles' => $roles,
                'marriageStatus' => $marriageStatus,
                'birthCertificateNumber' =>$bcNum,
                'districtIssued' => $districtIssued,
                'placeOfBirth' =>$placeOfBirth,
                'profession'=>$profession,
                'title'=> $title,
                'parentId'=>$parentId

                
            );

            DB::table('users')->insert($data);
        }

        // add number of children in database
        // public function addNumberChildren(){
        //     $parentId=Input::get('inputParentId');
        //     $numberOfChildren=Input::get('numOfChildren');

        //     $query= DB::table('users')
        //     ->where("id", $parentId)
        //     ->update([
        //             'noOfChildren'=>$numberOfChildren
        //         ]); 

        //         return "successfull";
            
        // }
        //get number of children
        // public function showChildrenConfirmation(){
        //     $users=DB::table('users')->get();
        //     return view('Staff.numOfChildren')->with('users',$users);
        // }

        //get the partage title deed generation form
        public function partageGeneration(){
            $users=DB::table('users')->where("roles", 'Partegeant')->get();
            $coPartageants=DB::table('users')->where("roles", 'co_partageants')->get();
            return view('Staff.partageContract')->with('users',$users)->with('children',$coPartageants);
        }

        public function showMailCompose(){
            $rgds=DB::table('rgds')->get();
            $users=DB::table('users')->get();
            return view('Staff.composeEmail')->with('users',$users)->with('rgds',$rgds);
        }

        public function sendMailToParty(Request $request){
            $sender=Input::get('inputSender');
            $recipient=Input::get('inputRecipient');
            $subjectInfo=Input::get('inputSubject');
            $body=Input::get('inputBody');
            $upload=$request->file('inputAttachment');
            
            $user=DB::table('users')->where('id',$recipient)->get();

            foreach ($user as $users) {
                
                $data = [
                    'firstname'      => $users->firstname,
                    'lastname'       => $users->lastname,
                    'body'          =>$body
                    
                ];

                //check if there is an attachment
                if(isset($upload)){

                    $attachment = $request->file('inputAttachment')->getClientOriginalName();
                    $extension= $request->file('inputAttachment')->getClientOriginalExtension();
                    $attachmentPath = $request->file('inputAttachment')->getRealPath();
        
                    $mime= $request->file('inputAttachment')->getMimeType();
                    // Get just filename
                    $filename = pathinfo($attachment, PATHINFO_FILENAME);
                    // Get just the file extension
                    $extension = $request->file('inputAttachment')->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $request->file('inputAttachment')->storeAs('public/images', $fileNameToStore);

                    Mail::send('emails.email_party', $data, function($m) use ($users,$mime,$path,$extension,
                                                                              $request,$filename, $attachmentPath){
                    $m->to($users->email, 'Notary Team')->from('hi@example.com', 'Notary Team')
                                                        ->subject(Input::get('inputSubject'))
                                                        ->attach( $attachmentPath,array('as'=>$filename.$extension,
                                                                                        'mime'=>$mime));
                
                    });
                }

                else{
                    Mail::send('emails.email_party', $data, function($m) use ($users){
                    $m->to($users->email, 'Notary Team')->from('hi@example.com', 'Notary Team')
                                                        ->subject(Input::get('inputSubject'));
                    });
                }

                Session::flash('message', 'Mail successfully sent!'); 
                return Redirect::to('staff/compose/email');
            }    
        }

        public function showUploadDoc()
        {
            $users=DB::table('users')->get();
            $banks=DB::table('banks')->get();
            $rgds=DB::table('rgds')->get();
            $landSurveyors=DB::table('land_surveyors')->get();
            return view('Staff.uploadDocStaff')->with('users',$users)
                                                ->with('banks',$banks)
                                                ->with('rgds',$rgds)
                                                ->with('landSurveyors',$landSurveyors);
        }

        public function viewUploadedDocuments(){
            $documentsByNotary=DB::table('uploaded_documents')->where('senderRole','Notary')
          ->get();
                                              
            $documents=DB::table('uploaded_documents')->where('senderRole','Client')
                                                      ->orwhere('senderRole','BANK')
                                                      ->orwhere('senderRole','RGD')
                                                      ->orwhere('senderRole','Land Surveyor')
                                                      ->get();
            return view('Staff.uploadedDocuments')->with('documents',$documents) 
                                                  ->with('documentsByNotary', $documentsByNotary);
        }

        public function uploadDoc(Request $request){
            $sender_id = Auth::user()->id;
            $sender_role = "Notary";
            $receiver_id = Input::get('inputClientName');
            $receiver_role=Input::get('party');
            $docType=Input::get('inputDocType');
            $image=$request->file('document');

            //to check if user has selected a file
            if(isset($image)) { 
                if($request->hasFile('document')){
                    // Get filename with the extension
                    $filenameWithExt = $request->file('document')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just the file extension
                    $extension = $request->file('document')->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $request->file('document')->storeAs('public/images', $fileNameToStore);
                
                    $data = array(
                        'senderId' => $sender_id, 
                        'senderRole' =>  $sender_role, 
                        'receiverId' => $receiver_id, 
                        'receiverRole' =>  $receiver_role, 
                        'docType' => $docType, 
                        'docName' => $fileNameToStore 
                    );
            
                    DB::table('uploaded_documents')->insert($data);
                    Session::flash('message', 'Successfully uploaded!'); 
                    return Redirect::to('/staff/upload/documents');
                }
            }        
        }

        public function confirmMeeting($mid,$pid,Request $request){
        
            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Confirmed",
                'seen'=>1
            ]);        
            $client= DB::table('users')->where('id',$pid)->get();

            foreach ($client as $clients) {

                $data = [
                    'firstname'          =>$clients->firstname,
                    'lastname'          =>$clients->lastname,
                    'meetingStatus'     =>"Available"               
                ];
                
                Mail::send('emails.meetingReqToNotary', $data, function($m) use ($clients){
                    $m->to($clients->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Available for requested meeting");
                });
            }
        
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }

        public function rejectMeetingRequest($mid,$pid,$reqFrom,Request $request){

            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Unavailable",
                'seen'=>1
            ]);
            
        $client= DB::table('users')->where('id',$pid)->get();

        foreach ($client as $clients) {

            $data = [
                'firstname'          =>$clients->firstname,
                'lastname'          =>$clients->lastname,
                'meetingStatus'     =>"Unavailable"
                
                
            ];
            Mail::send('emails.meetingReqToNotary', $data, function($m) use ($clients){
                $m->to($clients->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Unavailable for requested meeting");
                });
        }
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }

        public function confirmMeetingLs($mid,$pid,Request $request){
        
            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Confirmed",
                'seen'=>1
            ]);        
            $landSurveyor= DB::table('land_surveyors')->where('id',$pid)->get();

            foreach ($landSurveyor as $landSurveyors) {

                $data = [
                    'name'          => $landSurveyors->name,
                    'requestFrom'=> "Land Surveyor",
                    'meetingStatus'     =>"Available"               
                ];
                
                Mail::send('emails.meetingReqToNotary', $data, function($m) use ($landSurveyors){
                    $m->to($landSurveyors->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Available for requested meeting");
                });
            }
        
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }

        public function rejectMeetingRequestLs($mid,$pid,Request $request){

            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Unavailable",
                'seen'=>1
            ]);
            
        $landSurveyor= DB::table('land_Surveyors')->where('id',$pid)->get();

        foreach ($landSurveyor as $landSurveyors) {

            $data = [
                'name'          => $landSurveyors->name,
                'requestFrom'=> "Land Surveyor",
                'meetingStatus'     =>"Unavailable"
                
                
            ];
            Mail::send('emails.meetingReqToNotary', $data, function($m) use ($landSurveyors){
                $m->to($landSurveyors->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Unavailable for requested meeting");
                });
        }
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }
        
        //confirm/reject meeting fom bank request
        public function confirmMeetingBank($mid,$pid,Request $request){
        
            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Confirmed",
                'seen'=>1
            ]);        
            $bank= DB::table('banks')->where('id',$pid)->get();

            foreach ($bank as $banks) {

                $data = [
                    'name'          => $banks->name,
                    'requestFrom'=> "Bank",
                    'meetingStatus'     =>"Available"               
                ];
                
                Mail::send('emails.meetingReqToNotary', $data, function($m) use ($banks){
                    $m->to($banks->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Available for requested meeting");
                });
            }
        
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }

        public function rejectMeetingRequestBank($mid,$pid,Request $request){

            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Unavailable",
                'seen'=>1
            ]);
            
            $bank= DB::table('banks')->where('id',$pid)->get();

            foreach ($bank as $banks) {

                $data = [
                    'name'          => $banks->name,
                    'requestFrom'=> "Bank",
                'meetingStatus'     =>"Unavailable"
                
                
            ];
            Mail::send('emails.meetingReqToNotary', $data, function($m) use ($banks){
                $m->to($banks->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Unavailable for requested meeting");
                });
        }
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }

        //confirm/reject meetings from registrar general department

        public function confirmMeetingRGD($mid,$pid,Request $request){
        
            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Confirmed",
                'seen'=>1
            ]);        
            $rgd= DB::table('rgds')->where('id',$pid)->get();

            foreach ($rgd as $rgds) {

                $data = [
                    'name'          => $banks->name,
                    'requestFrom'=> "RGD",
                    'meetingStatus'     =>"Available"               
                ];
                
                Mail::send('emails.meetingReqToNotary', $data, function($m) use ($rgds){
                    $m->to($rgds->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Available for requested meeting");
                });
            }
        
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }

        public function rejectMeetingRequestRGD($mid,$pid,Request $request){

            DB::table('meetings')
            ->where('id', $mid)
            ->update([
                'meetingStatus' => "Unavailable",
                'seen'=>1
            ]);
            
            $rgd= DB::table('rgds')->where('id',$pid)->get();

            foreach ($rgd as $rgds) {

                $data = [
                    'name'          => $rgds->name,
                    'requestFrom'=> "RGD",
                'meetingStatus'     =>"Unavailable"
                
                
            ];
            Mail::send('emails.meetingReqToNotary', $data, function($m) use ($rgds){
                $m->to($rgds->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject("Unavailable for requested meeting");
                });
        }
            
            return redirect('/staff/meeting/add/del/up');            
            // }        
        }


        //delete a client
        public function deleteMeeting($id){
            DB::table('meetings')
                ->where('id', $id)
                ->delete();

                $message="alert alert-danger";
                Session::flash($message, 'Meeting Successfully deleted'); 
                return Redirect::to('/staff/meeting/add/del/up');
        
        }

        public function showChangePassword(){
            return view('Staff.changePassword');
        }

        public function changePassword(Request $request){
            //validations
            $this->validate($request,
            [
                'txtpassword' => 'required|string|min:6|confirmed',
                'txtOldpassword' => ['required', new validateOldPassword(auth()->user())]
            ]       
            );


            //retrieve the email address of the user logged in
            $email= Auth::user()->email;

            //retrieve the input of password
            $NewPassword = Input::get('txtpassword');
            
            //validating old password
            $result = DB::table('staff')
                        ->where('email', $email)->get()
                        ->pluck('password');

            $password=$result[0];
            if (!(Hash::check($NewPassword, $password))) {
                //SQL update for updating the db
                DB::table('staff')
                ->where(['email'=> $email])
                ->where(['password' => $password])
                ->update(['password' => Hash::make($NewPassword)]);
                Auth::logout();
                return redirect('/staff/login');
                
            }else{            
                return back();
            }
            //end of validation    
        }

    public function getAllTransaction(){
        $transactions=DB::table('transaction')->get();
        return view('staff.transactionList')->with('transactions',$transactions);
    }

    public function getClientTransactions($id){
        $transactions=DB::table('transaction')->where('clientId',$id)->get();
        return view('staff.viewClientTransactions')->with('transactions',$transactions);
    }

    public function getDashboard(){
        
        $numClients = DB::table('users') ->count();
        $numTransactions=DB::table('transaction')->count();
        $numProperties=DB::table('immovableproperty')->count();
        $numMeetings=DB::table('meetings')->count();
        $numDocuments=DB::table('uploaded_documents')->count();
        $pendingMeetings=DB::table('meetings')->where('meetingStatus','Pending')->count();
        $confirmedMeetings=DB::table('meetings')->where('meetingStatus','Confirmed')->count();

        return view('staff.staffDashboard')->with('numClients',$numClients)
                                            ->with('numTransactions',$numTransactions)
                                            ->with('numProperties',$numProperties)
                                            ->with('numMeetings',$numMeetings)
                                            ->with('numDocuments',$numDocuments)
                                            ->with('pendingMeetings',$pendingMeetings)
                                            ->with('confirmedMeetings', $confirmedMeetings);
                                        
    }

    public function updatePayment($id){
        DB::table('transaction')->where('clientId',$id)
                                ->update(['feeStatus'=>"PAID"]);
        return redirect('/staff/transactions/list');
    }

    public function propertyList(){
        $properties=DB::table('immovableproperty')->get();
        return view('Staff.propertyList')->with('properties',$properties);
    }
}
?>