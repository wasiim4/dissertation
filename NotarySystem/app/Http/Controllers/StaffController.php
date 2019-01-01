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
        
        $this->validate($request,
        [
            'inputFirstName' => 'required|alpha|max:255',
            'inputLastName' => 'required|alpha|max:255',
            'inputContactNum' => 'required|regex:/^[5][0-9]{7}+$/u|integer|unique:users,contactnum',
            'inputEmail' => 'required|string|email|max:255|unique:users,email',
            'inputDob' => 'required|date',
            'inputGender' => 'required|alpha|max:255',
            'inputAddress' => 'required',
            'inputMarriageStatus' => 'required',
            'inputRoles' =>'required',
            'inputNIC1' => 'required|alpha_num|unique:users,nic',
            'inputBcNum' => 'required|numeric',
            'inputDistrict' =>'required',
            'inputPlaceOfBirth' =>'required',
            'inputProfession' =>'required',
            'inputTitle' =>'required',
             ]       
        );

        

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

        $generatedPassword=str_random(8);
        self::sendEmail($generatedPassword,$email,$fname,$lname);

        
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
        //  $user_id = DB::table('users')->insertGetId($data);
        //  $user=(DB::table('users')->where('id',$user_id)->get())[0];
        //  Mail::send('emails.email_invitation', $data, function($m) use ($user){
        //     $m->to($user->email, 'Notary System')->from('hi@example.com', 'Notary System')->subject('Login Credentials');
        //     });

        
        // return redirect('/dashboard');

        if($marriageStatus=="Married"){
            flashy()->success($fname.' '.$lname. ' successfully added!.');
            return redirect('staff/registerSpouse');
        }
        else{
            flashy()->success($fname.' '.$lname. ' successfully added!.');
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
        $this->validate($request,
        [
            'inputClientID' => 'required',
            'inputSpouseFirstName'=> 'required|alpha|max:255',
            'inputSpouseLastName'=> 'required',
            'inputSpouseTitle' =>'required',
            'inputSpouseNIC' => 'required|alpha_num|unique:users,spouseNic',
            'inputSpouseDob' =>'required|date',
            'inputSpouseBcNum' => 'required|numeric',
            'inputSpouseDistrict' =>'required',
            'inputSpouseMarriageDate' =>'required|date',
            'inputMcNum' => 'required|numeric',
            'inputMcDistrict' =>'required',
            'inputSpouseProfession' =>'required',
            'inputSpouseGender' =>'required',
            'inputSpousePlaceOfBirth' =>'required',
             ]       
        );

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
        flashy()->success($fname.' '.$lname. ' successfully added!.');
            return redirect('staff/registernew');
    }

    //function to return the view of the property registration form
    public function propertyRegistration(){  
        $users = DB::table('users')->get();
        return view('auth.propertyRegistration')->with('users',$users);
    }

    //fuction to register an immovable property
    public function add_property(Request $request){

        //getting input 
        $propertyType=Input::get('inputPropertyType');
        $clientId=Input::get('inputClientID');
        $propertyAdd=Input::get('inputAddress');
        $sizeMsFigures=Input::get('inputSizeMsF');
        $sizeMsWords=Input::get('inputSizeMsW');
        $sizeInPerch=Input::get('inputSizeInPerch');
        $transcriptionVol=Input::get('inputTranscriptionVolume');
        $pinNum=Input::get('inputPinNum');
        $regNumInLsReport=Input::get('inputRegNum');
        $surveyorFirstName=Input::get('inputLsFn');
        $surveyorLastName=Input::get('inputLsLn');
        $surveyingDate=Input::get('inputSurveyingDate');
        $priceFigures=Input::get('inputPriceFigures');
        $priceWords=Input::get('inputPriceWords');
        $firstDeedReg=Input::get('inputFirstDeedReg');
        $firstDeedGeneration=Input::get('inputFirstDeedGeneration');
        $previousNotaryTitle=Input::get('inputPreviousNotaryTitle');
        $previousNotaryFN=Input::get('inputPreviousNotaryFN');
        $previousNotaryLN=Input::get('inputPreviousNotaryLN');
        $districtSituated=Input::get('inputDistrict');
        $taxduty=(0.05*$priceFigures);

        $data = array(
            'clientId' =>  $clientId, 
            'address' => $propertyAdd, 
            'priceInFigures' =>  $priceFigures, 
            'priceInWords' =>  $priceWords,
            'propertyType' => $propertyType, 
            'sizeInMSFigures' =>   $sizeMsFigures,
            'sizeInMSWords' => $sizeMsWords,
            'sizeInPerchWords' => $sizeInPerch,
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
         return $taxduty;

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

                $this->validate($request,
                [
                    'fpropic' => 'mimes:jpeg,jpg,png | max:1999'      
                ]);
                
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
            }

         DB::table('staff')
        ->where('id', $staff_id)
        ->update(['img_path' => $fileNameToStore
        ]);
       
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
        flashy()->success( ' successfully updated!.');

        return redirect('/staff/profile/view');
        
    }

     //function to show the calendar with all meetings
    public function meeting(){
       // $meetings = Meeting::get();
        $meetings=DB::table('meetings')->get();
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
 
        return view('meetings', compact('calendar_details','users') );
}
public function addMeeting(Request $request)
    {
        $status="Pending";
        $party=Input::get('party');
        $id=Input::get('partyId');
        $reason=Input::get('meetingReason');
        $start=Input::get('startTime');
        $end=Input::get('endTime');

        $date1=date_create($start);
        $date2=date_create($end);

        $data = array(
            'partyId' =>  $id, 
            'meetingReason' => $reason, 
            'startTime'=>$start,
            'endTime' =>  $end ,
            'meetingStatus' =>$status
            
        );

        // DB::table('meetings')->insert($data);
        
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
                        'mid'           =>$meeting_id
                        
                    ];
    
                    Mail::send('emails.email_invitation', $data, function($m) use ($users){
                    $m->to($users->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject('Meeting');
                    });
    
                    Session::flash('message', 'Meeting successfully added and mail successfully sent!'); 
                 return Redirect::to('staff/meeting/add/del/up');
                
            }
        }

        // return "success";
        
    }

    public function meetingForm(){
        $users=DB::table('users')->get();
        $meetings=DB::table('meetings')->get();
        return view('meetingsConfig')->with('users',$users)->with('meetings',$meetings);
    }
    
    public function showUploadForm(){
        $transactions=DB::table('transaction')->get();
        $users=DB::table('users')->get();
        return view('Staff.uploadContract')->with('users',$users)->with('transactions',$transactions);
    }

    public function uploadContract(Request $request){
        $upload=$request->file('contract');
        $clientName=Input::get('inputClientName');

        if(isset($upload)){
            $name = $_FILES['contract']['name'];
            $mime = $_FILES['contract']['type'];
            $datas = file_get_contents($_FILES['contract']['tmp_name']);
            $path = $request->file('contract')->storeAs('public/images', $name);
            $data = array(
                'clientId' =>  $clientName, 
                'name' => $name, 
                'mime'=>$mime,
                'generatedContract' =>  $datas 
                
            );
    
            DB::table('transaction')->insert($data);
            // flashy()->success($fname.' '.$lname. ' successfully added!.');
            return redirect('staff/registernew');
    
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
    public function addNumberChildren(){
        $parentId=Input::get('inputParentId');
        $numberOfChildren=Input::get('numOfChildren');

        $query= DB::table('users')
        ->where("id", $parentId)
        ->update([
                'noOfChildren'=>$numberOfChildren
            ]); 

            return "successfull";
        
    }
    //get number of children
    public function showChildrenConfirmation(){
        $users=DB::table('users')->get();
        return view('Staff.numOfChildren')->with('users',$users);
    }

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
       
        $user=DB::table('users')->where('id',$recipient)->get();

        foreach ($user as $users) {
            
                $data = [
                    'firstname'      => $users->firstname,
                    'lastname'       => $users->lastname,
                    'body'          =>$body
                   
                ];

                Mail::send('emails.email_party', $data, function($m) use ($users,$mime,$path,$extension,$request,$filename, $attachmentPath){
                $m->to($users->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject(Input::get('inputSubject'))
                ->attach( $attachmentPath,array('as'=>$filename.$extension,
                                                'mime'=>$mime));
              
                });

                Session::flash('message', 'Mail successfully sent!'); 
                 return Redirect::to('staff/compose/email');
                
               
            
                }

        
    }
}
?>