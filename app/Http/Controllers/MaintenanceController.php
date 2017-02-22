<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Maintenance;
use App\User;
use Auth;
use App\Department;
use Alert;
use Mail;
use Charts;
use DB;
use PDF;


class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->department_id == 7 && Auth::user()->role == "HOD"){

        $maintenance = Maintenance::all();
      
       
        return view('maintenance.index' , compact('maintenance'  ));
           
        }

        else if (Auth::user()->role == "HOD"){
            $dept_id = Auth::user()->department_id;
            $dept = Department::find($dept_id);
            $maintenance = $dept->maintenance()->get();
            return view('maintenance.index', compact('maintenance'));
        }
        else{
        $maintenance = Auth::user()->maintenance()->get( );
       //dd( $maintenance);
                
        return view('maintenance.index' , compact('maintenance'  ));   
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
        return view('maintenance.addnew');
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
         $this->validate($request, [
            'facility_name'=> 'required',
            'location' => 'required',
            'type' => 'required',
            'subtype' => 'required',
            'description' =>'required',
            ]);

         $maintenance = new Maintenance($request->all());
         $maintenance->save();
         $maintenance->user_id = Auth::user()->id;
         $maintenance->department_id = Auth::user()->department_id;
         $maintenance->update();



        //send mail notification to HOD 
        $title = "New maintenance request";
        $url = route('maintenance.show', $maintenance->id);
        $content = "New maintenance request needs your approval";
        if( Auth::user()->role != 'HOD' ){
                Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $username] , function($message){
                            $message->from('wapneng@gmail.com');
                            $message->to('RGowok@st.vvu.edu.gh');
                    });
            }
         else {
           Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('wapneng@gmail.com');
            });
         }  
         Alert::success("Your request has been sent");
        return redirect(route('maintenance.index'));
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
        $maintenance = Maintenance::find($id);
        $user = $maintenance->user()->get();
         return view('maintenance.single' , compact('maintenance' , 'user'));
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
        if(Auth::user()->department_id !=7){
            $maintenance = Maintenance::find($id);
                $maintenance->submit_status = $request->status;
                $maintenance->approval_status = $request->approval_status;
                $maintenance->save();
                $url = route('maintenance.show', $maintenance->id);
                //notify2 user
                Mail::send('emails.notify2', ["title" =>" Your request for maintenance has been ".$request->status , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("RGowok@st.vvu.edu.gh");
                } );

                //notify2 Works department
                if($request->approval_status == "Pending confirmation"){
                Mail::send('emails.notify2', ["title" =>" New maintenance request " , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("RGowok@st.vvu.edu.gh");
                } );
                }
                Alert::message('Done!');
                return redirect(route('maintenance.index'));
            }
        else{
             $maintenance = Maintenance::find($id);
                $maintenance->submit_status = $request->status;
                $maintenance->approval_status = $request->approval_status;
                $maintenance->save();
                $url = route('maintenance.show', $maintenance->id);
                //notify2 user
                Mail::send('emails.notify2', ["title" =>" Your request for maintenance has been ".$request->status , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("RGowok@st.vvu.edu.gh");
                } );
                return redirect(route('maintenance.index'));       
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

        //display statistics for requests
        public function statistics(){
        if (Auth::user()->department_id != 7){
                $user_id =  Auth::User()->department_id;
         
        $chart = Charts::database(DB::table('maintenances')->where('department_id', $user_id)->get(), 'bar', 'highcharts')
        ->setTitle('Maintenance requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('maintenance.statistics', ['chart' => $chart]);   
        }
         else{
             $chart = Charts::database(Maintenance::all(), 'bar', 'highcharts')
        ->setTitle('Maintenance requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('maintenance.statistics', ['chart' => $chart]);  
         }   

         
    }

        // pdf report 
    public function maintenance(){
       if (Auth::user()->department_id != 7){
        $user_id =  Auth::User()->department_id;
        $dept = Department::find($user_id);
        $users = $dept->user()->get();
        
        $maintenance = DB::table('maintenances')->where('department_id', $user_id)->get();
        
       $pdf = PDF::loadView('maintenance.pdf', compact('maintenance' , 'users' , 'dept' ));
        return $pdf->download('maintenance.pdf');

       }
       else{
        $maintenance = Maintenance::all();
        $users = User::all();
        $dept = Department::all();
        $pdf = PDF::loadView('maintenance.pdf', compact('maintenance' , 'users' ,'dept' ));
        return $pdf->download('maintenance.pdf');
       } 
}

}
