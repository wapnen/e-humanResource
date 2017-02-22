<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;
use App\FacilityDay;
use App\Applications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Alert;
use App\Http\Requests;
use Mail;
use DB;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role == "HOD" && Auth::user()->department_id == 4){
                $facilities = Facility::all();
                 return view('administration.allfacility' , compact('facilities'));   
        
        }
        elseif (Auth::user()->role == "HOD" && Auth::user()->department_id != 4 ) {
            $facilities = DB::table('facilities')->where('department_id' , Auth::user()->department_id)->get();
             return view('administration.allfacility' , compact('facilities'));  
        }
        else{

        $user = Auth::user();
        $facilities = $user->facilities()->get();
        // $allfacilities = Facility::user()->department()->all();
        return view('administration.allfacility' , compact('facilities'));   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administration.facility');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'venue'=> 'required',
            'duration' =>'required|integer',
            ]);

        $facility = new Facility($request->all());
        $duration = $request->duration;
        $facility->department_id = Auth::user()->department_id;
        $facility->save();
        $facility->user_id = Auth::user()->id;
        if (Auth::user()->role == 'HOD'){
            $facility->submition_status = "authorized by the department and pending approval from Administration";
        }
        $facility->update();    
        $user = Auth::user()->id;

        $facilities = Auth::user()->facilities()->latest()->first();
        $fid = $facilities->id; 
         // Store the duration in the session...
        session(['duration' => $duration]);
        session(['fid' => $fid]);
        //Session::flash('duration', $duration);
        
         return redirect(route('facilityDays.create', ['duration' => $duration]));
        Alert::message('Enter date(s) and time(s)!');
      //  return redirect(route('facility.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $fid = Facility::find($id);
      //dd($fid);
       $fidays = $fid->facilityDays()->get();
       $dept = Auth::user()->department()->get();

           return view('administration.single', compact('fid' , 'fidays'));
     

            return view('administration.pdf', compact('fid' , 'fidays' , 'dept'));    
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        if(Auth::user()->department_id !=4){
            $facility = Facility::find($id);
                $facility->submition_status = $request->status;
                $facility->approval_status = $request->approval_status;
                $facility->save();
                $url = route('facility.show', $facility->id);
                //notify2 user
                Mail::send('emails.notify2', ["title" =>" Your request to use a facility has been ".$request->status , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("wapneng@gmail.com");
                } );

                //notify2 general administration
                Mail::send('emails.notify2', ["title" =>" New facility request " , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("board.surely4u@gmail.com");
                } );
                Alert::success('done'); 
                return redirect(route('facility.show' , $id));
            }
        else{
                $facility = Facility::find($id);
                $facility->submition_status = $request->status;
                $facility->approval_status = $request->approval_status;
                $facility->save();
                $url = route('facility.show', $facility->id);
                //notify2 user
                Mail::send('emails.notify2', ["title" =>" Your request to use a facility has been ".$request->status , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("wapneng@gmail.com");
                } );
                Alert::success('done');
            return redirect(route('facility.show' , $id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $id = Facility::find($id);
        $id->delete();
        Alert::message('Hope you meant that');
        return redirect(route('applications.create'));
    }



}
