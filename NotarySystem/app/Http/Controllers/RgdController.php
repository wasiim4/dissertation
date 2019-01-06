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


class RgdController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth:rgd');
     }
 
     /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
         $users = DB::table('users')->get();
         return view('RGD.rgd')->with('users',$users);
     
     }

     public function showMailCompose(){
        $staffs=DB::table('staff')->get();
        $banks=DB::table('banks')->get();
        $landSurveyors=DB::table('land_surveyors')->get();
        return view('RGD.rgdEmail')->with('staffs',$staffs)->with('banks',$banks)->with('landSurveyors',$landSurveyors);
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
            return Redirect::to('rgd/compose/email');
        } 
       }

       if($recipientRole=="Bank"){
        $bank=DB::table('banks')->where('id',$recipient)->get();

        foreach ($bank as $banks) {
            
            $data = [
                'name'      => $banks->name,                
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

                Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($banks,$mime,$path,$extension,$request,$filename, $attachmentPath){
                $m->to($banks->email, 'Notary Team')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'))
                ->attach( $attachmentPath,array('as'=>$filename.$extension,
                                                'mime'=>$mime));
              
                });
            }

            else{
                Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($banks){
                $m->to($banks->email, 'Bank')->from(Auth::user()->email, 'RGD')->subject(Input::get('inputSubject'));
                });
            }

            Session::flash('message', 'Mail successfully sent!'); 
            return Redirect::to('rgd/compose/email');
        }  
    }
    

        if($recipientRole=="Land Surveyor"){
            $landSurveyor=DB::table('land_surveyors')->where('id',$recipient)->get();
    
            foreach ($landSurveyor as $landSurveyors) {
                
                $data = [
                    'name'      => $landSurveyors->name,                
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
    
                    Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($landSurveyors,$mime,$path,$extension,$request,$filename, $attachmentPath){
                    $m->to($landSurveyors->email, 'Land Surveyor')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'))
                    ->attach( $attachmentPath,array('as'=>$filename.$extension,
                                                    'mime'=>$mime));
                  
                    });
                }
    
                else{
                    Mail::send('emails.FromRgdToEXParties', $data, function($m) use ($landSurveyors){
                    $m->to($landSurveyors->email, 'Notary Team')->from(Auth::user()->email, 'Notary Team')->subject(Input::get('inputSubject'));
                    });
                }
    
                Session::flash('message', 'Mail successfully sent!'); 
                return Redirect::to('rgd/compose/email');
            }  
        
            }  
    }

    public function showUploadDoc()
    {
        return view('RGD.uploadDocRgd');
    }

    public function uploadDoc(Request $request){
        $party_id = Auth::user()->id;
        $party_role = Auth::user()->roles;
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
                return Redirect::to('rgd/upload/documents');
            }
        }
    
    }
    
    public function viewMyUploadedDoc()
    {
        $uploads=DB::table('uploaded_documents')->where('partyRole',Auth::user()->roles)->get();
        return view('RGD.uploadedDocRgd')->with('uploads',$uploads);
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
        
        return redirect('/rgd/login');            
        // }        
    }

}
