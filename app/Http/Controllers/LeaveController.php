<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Leave;
use App\User;
use App\Department;
use Auth;
use Mail;
use Chart;
use Alert;
use PDF;
use Charts;
use DB;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role == "HOD"){
            $department_id = Auth::user()->department_id;
            $department = Department::find($department_id);
            $leave = DB::table('leaves')->where('department_id', $department_id)->get();
            $users = $department->user()->get();

            return view('leave.index', compact('users', 'leave'));
        }
        elseif(Auth::user()->role == "deputy registrar" ||  Auth::user()->role == 'finance officer'){
            $departments = Department::all();
            $users = User::all();
            $leave = Leave::all();
            
            return view('leave.index', compact( 'users' , 'leave', 'departments'));

        }
        else{
            $leave = Auth::user()->leave()->get();

            return view('leave.index' , compact('leave'));
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
        return view('leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      // dd($request->all());
        $this->validate($request, [
            'days_entitled'=> 'required|integer',
            'days_taken' => 'required|integer',
            'leave_due' => 'required|integer',
            'days_approved' => 'required|integer',
            'from' =>'required|date',
            'to' => 'required|date',
            'resumption_date' => 'required|date',

            ]);

        $leave = new Leave($request->all());
        $leave->days_entitled = $request->days_entitled;
        $leave->days_taken = $request->days_taken;
        $leave->leave_due = $request->leave_due;
        $leave->days_approved = $request->days_approved;
        $leave->from = $request->from;
        $leave->to = $request->to;
        $leave->resumption_date = $request->resumption_date;
        $leave->user_id = Auth::user()->id;
        $leave->department_id = Auth::user()->department_id;
        $leave->outstanding_leave = $leave->days_entitled - $leave->days_taken;
        $leave->save();

        $title = "New Leave Request";
        $content = "A new leave application needs your approval, click the button below to review the application.";
        $url = route('leave.show', $leave->id);
        Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to(' RGowok@st.vvu.edu.gh');
            });
        Alert::success('Sent');
        return redirect(route('leave.show' , $leave->id));

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
        $leave = Leave::find($id);
        $userid = $leave->user_id;
        $user = User::find($userid);
        $department_id = $leave->department_id;
        $department = Department::find($department_id);

        return view('leave.show' , compact('leave', 'user', 'department'));
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
        if(Auth::user()->role == "HOD"){
            $leave = Leave::find($id);
            $leave->authorized = $request->authorized;
            $leave->approved = $request->approved;
            $leave->save();

            //notify requesting officer
            $title = "Leave Application status";
            $content = "Click the button below to see the status of your leave request.";
            $url = route('leave.show', $id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
                    
            });

            //notify deputy registrar
            if($request->authorized == "authorized"){

                 $title = "New Leave application";
            $content = "Hello! Review the details of this application. Click on the button below to view.";
            $url = route('leave.show', $id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('board.surely4u@gmail.com');
                    
            });
            }
            Alert::success('Done');
            return redirect(route('leave.show', $id));
        }

        if(Auth::user()->role == "deputy registrar"){
            $leave = Leave::find($id);
            $leave->authorized = $request->authorized;
            $leave->approved = $request->approved;
            $leave->save();

            //notify requesting officer
            $title = "Leave Application status";
            $content = "Click the button below to see the status of your leave request.";
            $url = route('leave.show', $id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
                    
            });

            //notify treasurer
            if($request->approved == "approved"){

                 $title = "New Leave application";
            $content = "Hello! Review the leave entitlements of this application. Click on the button below to view.";
            $url = route('leave.show', $id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('wapneng@gmail.com');
                    
            });
            }
            Alert::success('Done');
            return redirect(route('leave.show', $id));

        }

        if(Auth::user()->role == 'finance officer'){
            $leave = Leave::find($id);
            $leave->money_entitled = $request->ammount;
            
            $leave->save();

            //notify requesting officer
            $title = "Leave entitlements";
            $content = "Click the button below to view your entitlements.";
            $url = route('leave.show', $id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
                    
            });

            Alert::success('Done');
            return redirect(route('leave.show', $id));
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
    }

    public function report(){
        if(Auth::user()->role == "HOD"){
            $department_id = Auth::user()->department_id;
            $department = Department::find($department_id);
            $leave = DB::table('leaves')->where('department_id', $department_id)->get();
            $users = $department->user()->get();

            $pdf = PDF::loadView('leave.pdf', compact('leave' , 'users'  ));
        return $pdf->download('leave.pdf');
        }
        elseif(Auth::user()->role == "deputy registrar" ||  Auth::user()->role == 'finance officer'){
            $departments = Department::all();
            $users = User::all();
            $leave = Leave::all();
            $pdf = PDF::loadView('leave.pdf', compact('departments' , 'users' ,'leave' ));
        return $pdf->download('leave.pdf');

        }
    }

    public function statistics(){
        if (Auth::user()->department_id != 11 && Auth::user()->department_id != 5 ){
                $user_id =  Auth::User()->department_id;
         
        $chart = Charts::database(DB::table('leaves')->where('department_id', $user_id)->get(), 'bar', 'highcharts')
        ->setTitle('Leave applications')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('leave.statistics', ['chart' => $chart]);   
        }
         else{
             $chart = Charts::database(Leave::all(), 'bar', 'highcharts')
        ->setTitle('Leave applications')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('leave.statistics', ['chart' => $chart]);  
         } 
    }
}
