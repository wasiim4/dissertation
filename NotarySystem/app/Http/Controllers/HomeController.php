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
        return view('/dashboard');
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
            'meetingStatus' => $status
        ]);        
        
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
        $party_id = Auth::user()->id;
        $party_role = "Client";
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
                    'partyId' => $party_id, 
                    'partyRole' =>  $party_role, 
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
        $uploadsByNotary=DB::table('uploaded_documents')->where('partyRole','Notary')->get();
        $uploads=DB::table('uploaded_documents')->where('partyId',Auth::user()->id)
                                                ->where('partyRole','Client')
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
             'meetingStatus' =>$status
             
             
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
}