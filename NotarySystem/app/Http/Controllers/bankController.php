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
class bankController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth:bank');
     }
 
     /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
         $users = DB::table('users')->get();
         return view('bank.bankDashboard')->with('users',$users);
     
     }

     public function showMailCompose(){
        $staffs=DB::table('staff')->get();
        $clients=DB::table('users')->get();
        $rgds=DB::table('rgds')->get();
        return view('bank.bankEmail')->with('staffs',$staffs)->with('clients',$clients)->with('rgds',$rgds);
    }

    public function sendMailToParty(Request $request){
        $sender=Input::get('inputSender');
        $recipientRole=Input::get('party');
        $recipient=Input::get('inputRecipient');
        $subjectInfo=Input::get('inputSubject');
        $body=Input::get('inputBody');
        
        
        $upload=$request->file('inputAttachment');
        
       if($recipientRole=="Notary/Notary Assistant"){
        $staff=DB::table('staff')->where('id',$recipient)->get();
        
        foreach ($staff as $staffs) {
            
            $data = [
                'firstname'      =>$staffs->firstname,
                'lastname'       => $staffs->lastname,
                'body'          =>$body
                
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

                Mail::send('emails.email_party', $data, function($m) use ($staffs,$mime,$path,$extension,$request,$filename, $attachmentPath){
                $m->to($staffs->email, 'Notary Team')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'))
                ->attach( $attachmentPath,array('as'=>$filename.$extension,
                                                'mime'=>$mime));
              
                });
            }

            else{
                Mail::send('emails.email_party', $data, function($m) use ($staffs){
                $m->to($staffs->email, 'Notary Team')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'));
                });
            }

            Session::flash('message', 'Mail successfully sent!'); 
            return Redirect::to('bank/compose/email');
        } 
       }

       if($recipientRole=="Client"){
        $user=DB::table('users')->where('id',$recipient)->get();

        foreach ($user as $users) {
            
            $data = [
                'firstname' =>$users->firstname,
                'lastname'      => $users->lastname,                
                'body'          =>$body
                
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

                Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($users,$mime,$path,$extension,$request,$filename, $attachmentPath){
                $m->to($users->email, 'Notary Team')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'))
                ->attach( $attachmentPath,array('as'=>$filename.$extension,
                                                'mime'=>$mime));
              
                });
            }

            else{
                Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($users){
                $m->to($users->email, 'Bank')->from(Auth::user()->email, 'RGD')->subject(Input::get('inputSubject'));
                });
            }

            Session::flash('message', 'Mail successfully sent!'); 
            return Redirect::to('bank/compose/email');
        }  
    }
    

        if($recipientRole=="RGD"){
            $rgd=DB::table('rgds')->where('id',$recipient)->get();
    
            foreach ($rgd as $rgds) {
                
                $data = [
                    'name'      => $rgds->name,                
                    'body'          =>$body
                    
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
    
                    Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($rgds,$mime,$path,$extension,$request,$filename, $attachmentPath){
                    $m->to($rgds->email, 'Land Surveyor')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'))
                    ->attach( $attachmentPath,array('as'=>$filename.$extension,
                                                    'mime'=>$mime));
                  
                    });
                }
    
                else{
                    Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($rgds){
                    $m->to($rgds->email, 'Notary Team')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'));
                    });
                }
    
                Session::flash('message', 'Mail successfully sent!'); 
                return Redirect::to('bank/compose/email');
            }  
        
            }  
    }

    public function showUploadDoc()
    {
        return view('bank.uploadDocBank');
    }

    public function uploadDoc(Request $request){
        $sender_id = Auth::user()->id;
        $sender_role = "Bank";
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
                return Redirect::to('bank/upload/documents');
            }
        }
    
    }
    
    public function viewMyUploadedDoc()
    {
        $uploads=DB::table('uploaded_documents')->where('partyRole',Auth::user()->roles)->get();
        return view('bank.uploadedDocBank')->with('uploads',$uploads);
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
        
        return redirect('/bank/login');            
        // }        
    }

    public function myProfile(){
        $bank_id = Auth::user()->id;  
        $bank_get=DB::table('banks') 
        ->where(['id'=>$bank_id])
        ->get();

        $bank_get =  $bank_get[0];
        return view('bank.bankProfile')->with('bank_detail',  $bank_get);

    
    }

    public function profileupdate(Request $request)
    {
        $bank_id = Auth::user()->id;
        $image=$request->file('fpropic');

       
        $name = Input::get('txtname');
        $branch = Input::get('txtbranch');
        $email=Input::get('txtemail');
        $cnum = Input::get('txtcnum');
       

        $this->validate($request,
            [
                'txtname' => 'required',
                'txtbranch' => 'required',
                'txtcnum' => 'required',
                'txtemail' => 'required'
                
            ]);

             // Handle File Upload
        if(isset($image)) { //to check if user has selected an image
            if($request->hasFile('fpropic')){

                // $this->validate($request,
                // [
                //     'fpropic' => 'mimes:jpeg,jpg,png | max:1999'      
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

                DB::table('banks')
                ->where('id', $bank_id)
                ->update(['img_path' => $fileNameToStore
                ]);
            }
        }
        DB::table('banks')
           ->where('id', $bank_id)
           ->update([
                    
                   'name' => $name,
                   'branch' => $branch,
                   'email' => $email,
                   'contactnum' => $cnum
                   
                   
        ]);
       
        return redirect('/bank/profile/view');
        
    }

        //function to show the calendar with all meetings
        public function meeting(){
            // $meetings = Meeting::get();
             $meetings=DB::table('meetings')->where('partyId',Auth::user()->id)
                                            ->where('partyRole','Bank')
                                            ->where('MeetingStatus','Confirmed')                                    
                                            ->get();

             $meetingReqFromClient=DB::table('meetings')->where('requestorId',Auth::user()->id)
                                                        ->where('reqFrom','Bank')
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

             $banks=DB::table('banks')->get();
             $calendar_details = Calendar::addEvents($meeting_list); 
             $calendar_details2 = Calendar::addEvents($meeting_list2);  
      
             return view('bank.bankMeetings', compact('calendar_details','banks','calendar_details2') );
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
                 'reqFrom'=>"Bank",
                 'requestorId'=>Auth::user()->id,
                 'partyRole' =>  $party,
                 'meetingReason' => $reason, 
                 'startTime'=>$start,
                 'endTime' =>  $end ,
                 'meetingStatus' =>$status
                 
                 
             );
     
             // DB::table('meetings')->insert($data);
             
             $meeting_id = DB::table('meetings')->insertGetId($data);
             $meet=(DB::table('meetings')->where('id',$meeting_id)->get())[0];
     
             
             $staff=DB::table('staff')
                    ->where('id', $id)
                    ->get();
    
            Session::flash('message', 'Meeting successfully added'); 
            return Redirect::to('/bank/meeting/add/del/up');
                     
               
             
     
             
         }
     
         public function meetingForm(){
             $staffs=DB::table('staff')->get();
             $users=DB::table('users')->get();
             $rgds=DB::table('rgds')->get();
             $banks=DB::table('banks')->get();
             $landSurveyors=DB::table('land_surveyors')->get();
             $meetings=DB::table('meetings')->where('reqFrom',"Bank")
                                            ->where('requestorId',Auth::user()->id)
                                            ->get();
             $meetingByNotary=DB::table('meetings')->where('reqFrom',"Notary")
                                                   ->where('partyId',Auth::user()->id)
                                                   ->where('partyRole',"Bank")
                                                   ->get();                                
             return view('bank.bankMeetingConf')->with('users',$users)
                                          ->with('meetings',$meetings)
                                          ->with('rgds',$rgds)
                                          ->with('banks',$banks)
                                          ->with('staffs',$staffs)
                                          ->with('meetingByNotary', $meetingByNotary)
                                          ->with('landSurveyors',$landSurveyors);
     
         }

}
