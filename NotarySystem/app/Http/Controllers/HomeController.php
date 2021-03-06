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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['userlogout','rgdlogout','logout']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $progressData=DB::table('task_progress')->where('clientId',Auth::user()->id)->get();
       
        $numTransactions=DB::table('transaction')->where('clientId',Auth::user()->id)->count();

        $numProperties=DB::table('immovableproperty')->where('clientId',Auth::user()->id)->count();

        $numMeetings=DB::table('meetings')->where('reqFrom','Client')
                                          ->where('requestorId',Auth::user()->id)
                                          ->orwhere('partyRole','Client')
                                          ->where('partyId',Auth::user()->id)
                                          ->count();

        $numDocuments=DB::table('uploaded_documents')->where('senderRole','Client')
                                                     ->where('senderId',Auth::user()->id)
                                                     ->orwhere('receiverRole','Client')
                                                     ->where('receiverId',Auth::user()->id)
                                                     ->count();

        $rejectedMeetings=DB::table('meetings')->where('reqFrom','Client')
                                                ->where('requestorId',Auth::user()->id)
                                                ->where('meetingStatus','Unavailable')
                                               ->orwhere('meetingStatus','Cancelled')
                                               ->orwhere('meetingStatus','not_going')                                           
                                               ->count();

        $pendingMeetings=DB::table('meetings')->where('reqFrom','Client')
                                              ->where('requestorId',Auth::user()->id)
                                              ->where('meetingStatus','Pending')
                                              ->count();

        $confirmedMeetings=DB::table('meetings')->where('reqFrom','Client')
                                                ->where('requestorId',Auth::user()->id)
                                                ->where('meetingStatus','Confirmed')->count();

         return view('/dashboard')->with('progressData',$progressData)
                                  ->with('numTransactions',$numTransactions)
                                  ->with('numProperties',$numProperties)
                                  ->with('numMeetings',$numMeetings)
                                  ->with('numDocuments',$numDocuments)
                                  ->with('rejectedMeetings',$rejectedMeetings)
                                  ->with('pendingMeetings',$pendingMeetings)
                                  ->with('confirmedMeetings', $confirmedMeetings);                                       
    }

    // public function returnHome()
    // {
    //     return view('home');
    // }

    public function userlogout()
    {
        Auth::guard('web')->logout();        
        return redirect('/login');
    }
   
    public function confirmMeeting($pid,$mid,Request $request){
        //check which link was clicked (coming or not coming) in mail
        if ($request->has('status')) {
            $status = $request->input('status');
        }
        

        $party = $pid;
        $meeting_id = $mid;
        
        DB::table('meetings')
        ->where('partyId', $party)
        ->where('id', $meeting_id)
        ->update([
            'meetingStatus' => $status,
            'seen'=>1
        ]);     
        // echo $mid;   
        // echo $status;
        return redirect('/login');            
        // }        
    }

    public function showMailCompose(){
        $rgds=DB::table('rgds')->get();
        $users=DB::table('users')->where('id',Auth::user()->id)->get();
        return view('users.clientEmail')->with('users',$users)->with('rgds',$rgds);
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
                'firstname' => $users->firstname,
                'lastname' => $users->lastname,
                'body' => $body                
            ];

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

                Mail::send('emails.email_party', $data, function($m) use ($users,$mime,$path,$extension,$request,$filename, $attachmentPath){
                $m->to($users->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject(Input::get('inputSubject'))
                ->attach( $attachmentPath,array('as'=>$filename.$extension, 'mime'=>$mime));
                });
            }

            else{
                Mail::send('emails.email_party', $data, function($m) use ($users){
                $m->to($users->email, 'Notary Team')->from('hi@example.com', 'Notary Team')->subject(Input::get('inputSubject'));
                });
            }

            Session::flash('message', 'Mail successfully sent!'); 
            return Redirect::to('staff/compose/email');
        }    
    }

    public function showUploadDoc()
    {
        return view('users.uploadDoc');
    }

    public function uploadDoc(Request $request){
        $sender_id = Auth::user()->id;
        $sender_role = "Client";
        $receiver_id = 1;
        $receiver_role = "Notary";
        $docType=Input::get('inputDocType');
        $image=$request->file('document');
        if(isset($image)) { //to check if user has selected an image
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
                return Redirect::to('/upload/documents');
            }
        }
    
    }
    
    public function viewUploadedDoc()
    {
        $uploadsByNotary=DB::table('uploaded_documents')->where('senderRole','Notary')
        ->where('receiverId',Auth::user()->id)->where('receiverRole','Client')->get();
        $uploads=DB::table('uploaded_documents')->where('senderId',Auth::user()->id)
                                                ->where('senderRole','Client')
                                                ->get();
        return view('users.uploadedDoc')->with('uploads',$uploads)->with('uploadsByNotary', $uploadsByNotary);
    }

     //function to show the calendar with all meetings
     public function meeting(){
        // $meetings = Meeting::get();
         $meetings=DB::table('meetings')->where('partyId',Auth::user()->id)
                                        ->where('partyRole','Client')
                                        ->where('MeetingStatus','Confirmed')                                    
                                        ->get();

         $meetingReqFromClient=DB::table('meetings')->where('requestorId',Auth::user()->id)
                                        ->where('reqFrom','Client')
                                        ->where('MeetingStatus','Confirmed')                                    
                                        ->get();
         $meeting_list = [];
         foreach ($meetings as $key => $meeting) {
             
             $meeting_list[] = Calendar::event(
                 $meeting->meetingReason,
                 false, //to enable the user to view the date and time as well on the calendar
                 new \DateTime($meeting->startTime),
                 new \DateTime($meeting->endTime.' +1 day')
             );
         }

         $meeting_list2 = [];
         foreach ( $meetingReqFromClient as $key =>  $meetingReqFromClients) {
             
            $meeting_list2[] = Calendar::event(
                $meetingReqFromClients->meetingReason,
                false, //to enable the user to view the date and time as well on the calendar
                new \DateTime($meetingReqFromClients->startTime),
                new \DateTime($meetingReqFromClients->endTime.' +1 day')
            );
        }
         $users=DB::table('users')->get();
         $calendar_details = Calendar::addEvents($meeting_list); 
         $calendar_details2 = Calendar::addEvents($meeting_list2); 
  
         return view('users.meetingClient', compact('calendar_details','users','calendar_details2') );
 }
    public function addMeeting(Request $request){
         $status="Pending";
         $party="Notary";
         $id=Input::get('partyId');
         $reason=Input::get('meetingReason');
         $start=Input::get('startTime');
         $end=Input::get('endTime');
 
 
         $data = array(
             'partyId' =>  $id, 
             'reqFrom'=>"Client",
             'requestorId'=>Auth::user()->id,
             'partyRole' =>  $party,
             'meetingReason' => $reason, 
             'startTime'=>$start,
             'endTime' =>  $end ,
             'meetingStatus' =>$status,
             'seen'=>0
             
             
         );
 
         // DB::table('meetings')->insert($data);
         
         $meeting_id = DB::table('meetings')->insertGetId($data);
         $meet=(DB::table('meetings')->where('id',$meeting_id)->get())[0];
 
         
         $staff=DB::table('staff')
                ->where('id', $id)
                ->get();

        Session::flash('message', 'Meeting successfully added'); 
        return Redirect::to('/meeting/add/del/up');
                 
           
         
 
         
     }
 
     public function meetingForm(){
         $staffs=DB::table('staff')->get();
         $users=DB::table('users')->get();
         $rgds=DB::table('rgds')->get();
         $banks=DB::table('banks')->get();
         $landSurveyors=DB::table('land_surveyors')->get();
         $meetings=DB::table('meetings')->where('reqFrom',"Client")
                                        ->where('requestorId',Auth::user()->id)
                                        ->get();
         $meetingByNotary=DB::table('meetings')->where('reqFrom',"Notary")
                                               ->where('partyId',Auth::user()->id)
                                               ->where('partyRole',"Client")
                                               ->get();                                
         return view('users.meetingsUserConfig')->with('users',$users)
                                      ->with('meetings',$meetings)
                                      ->with('rgds',$rgds)
                                      ->with('banks',$banks)
                                      ->with('staffs',$staffs)
                                      ->with('meetingByNotary', $meetingByNotary)
                                      ->with('landSurveyors',$landSurveyors);
 
     }

      //function for client to view his/her own profile as well as editing his/her details
    public function myProfile(){
        $client_id = Auth::user()->id;  
        $client_get=DB::table('users') 
        ->where(['id'=>$client_id])
        ->get();

        $client_get =  $client_get[0];
        return view('users.userProfile')->with('client_detail',  $client_get);

    
    }

    public function profileupdate(Request $request)
    {
        $client_id = Auth::user()->id;
        $image=$request->file('fpropic');

        $title=Input::get('txtTitle');
        $fname = Input::get('txtfname');
        $lname = Input::get('txtlname');
        $email=Input::get('txtemail');
        $cnum = Input::get('txtcnum');
        $dob = Input::get('txtdob');
        $nic = Input::get('txtnic');
        $gender=Input::get('txtgender');
        $status=Input::get('inputStatus');
        $address=Input::get('txtaddress');
        $BcNum=Input::get('txtBcNum');
        $profession=Input::get('txtprofession');
        $BcDistrict=Input::get('inputDistrict');
        $PlaceOfBirth=Input::get('inputPlaceOfBirth');
        $spouseFname=Input::get('txtspousefn');
        $spouseLname=Input::get('txtspouseln');
        $spouseTitle=Input::get('txtspouseTitle');
        $spouseNic=Input::get('txtSpousenic');
        $spouseDob=Input::get('txtSpousedob');
        $spouseBcNum=Input::get('txtSpouseBcNum');
        $spouseBcDistrict=Input::get('inputSpouseDistrict');
        $marriageDate=Input::get('txtMarriageDate');
        $mcNum=Input::get('txtMcNum');
        $mcDistrict=Input::get('inputMDistrict');
        $spouseProfession=Input::get('txtSpouseProfession');
        $spouseGender=Input::get('txtSpousegender');
        $spousePlaceOfBirth=Input::get('inputSpousePlaceOfBirth');
        $divorceDate=Input::get('txtDivDate');
        $divCertificateNum=Input::get('txtDivCNum');
        $DivDistrict=Input::get('inputDivDistrict');
        $DeathDate=Input::get('inputSpouseMarriageDate');
        $DeathCertificateNum=Input::get('txtDeathCNum');
        $DeathDistrict=Input::get('inputDeathDistrict');

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
                    'fpropic' => 'mimes:jpeg,jpg,png'      
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

                DB::table('users')
                ->where('id', $client_id)
                ->update(['img_path' => $fileNameToStore
                ]);
            }
        }
        DB::table('users')
           ->where('id', $client_id)
           ->update([
                    'title'=>$title,
                   'firstname' => $fname,
                   'lastname' => $lname,
                   'email' => $email,
                   'dob' =>$dob,
                   'nic'=>$nic,
                   'contactnum' => $cnum,
                   'gender' => $gender,
                   'birthCertificateNumber'=>$BcNum,
                   'districtIssued'=>$BcDistrict,
                   'placeOfBirth'=>$PlaceOfBirth,
                   'address'=>$address,
                   'marriageStatus'=> $status,
                   'profession'=>$profession,
                   'spouseTitle'=> $spouseTitle,
                   'spouseFirstname'=>$spouseFname,
                   'spouseLastname'=> $spouseLname,
                   'spouseDob'=>$spouseDob,
                   'spouseBCNum'=> $spouseBcNum,
                   'spouseBCdistrictIssued'=> $spouseBcDistrict,
                   'spousePlaceOfBirth'=>$spousePlaceOfBirth,
                   'spouseGender'=> $spouseGender,
                   'spouseNic'=>$spouseNic,
                   'marriageDate'=> $marriageDate,
                   'MCNumber'=>$mcNum,
                   'MCdistrictIssued'=>$mcDistrict,
                   'spouseProfession'=> $spouseProfession,
                   'spouseDCNum'=> $DeathCertificateNum,
                   'DeathDate'=>$DeathDate,
                   'DCdistrictIssued'=>$DeathDistrict,
                   'DivCNum'=>$divCertificateNum,
                   'DivDate'=>$divorceDate,
                   'DivCdistrictIssued'=>$DivDistrict

        ]);
       
        return redirect('/profile/view');
        
    }
    public function home()
    {
        return view('home');
    }

    public function getTransactions(Request $request){
        $transactions=DB::table('transaction')->where('clientId',(Auth::user()->id))->get();
        return view('users.myTransactions')->with('transactions',$transactions);
    }

    //cancel meeting
    public function cancelMeeting($id){
        DB::table('meetings')
            ->where('id', $id)
            ->update([
                'meetingStatus' => "Cancelled",
                'seen'=>1
            ]);        

       
        Session::flash('message', 'Meeting Cancelled'); 
        return Redirect::to('/meeting/add/del/up');

    }

    //delete meeting
    public function deleteMeeting($id){
        DB::table('meetings')
            ->where('id', $id)
            ->delete();

          
            Session::flash('message', 'Meeting Successfully deleted'); 
            return Redirect::to('/meeting/add/del/up');
    
    }
}