<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Application;
use App\Facility;
use App\Http\Requests;
use DB;
use Auth;
use PDF;
use Charts;



class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('department.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    //render pdf view for facility reports
    public function facility(){
       if (Auth::user()->department_id != 4){
        $user_id =  Auth::User()->department_id;
        $dept = Department::find($user_id);
        $users = $dept->user()->get();
        
        $facilities = DB::table('facilities')->where('department_id', $user_id)->get();
      
       $pdf = PDF::loadView('department.pdf', compact('facilities' , 'users' , 'dept'));
        return $pdf->stream('facility.pdf');

       }
       else{
        $facilities = Facility::all();
        $users = User::all();
        $dept = Department::all();
                $pdf = PDF::loadView('department.pdf', compact('facilities' , 'users' ,'dept'));
        return $pdf->stream('facility.pdf');
       } 

       
           
    }
    //render page for actions to be taking on facility requests
    public function facilityAction(){
        if (Auth::user()->department_id != 4){

         $user_id =  Auth::User()->department_id;

         $facilities = DB::table('facilities')->where('department_id', $user_id)->get();
        return view('department.allfacility' , compact('facilities'));   
        }
        else{
            $facilities = Facility::all();
                return view('department.allfacility' , compact('facilities'));   
        }

    }



    public function statistics(){
        if (Auth::user()->department_id != 4){
                $user_id =  Auth::User()->department_id;
         
        $chart = Charts::database(DB::table('facilities')->where('department_id', $user_id)->get(), 'bar', 'highcharts')
        ->setTitle('Facility requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('department.facilitystats', ['chart' => $chart]);   
        }
         else{
             $chart = Charts::database(Facility::all(), 'bar', 'highcharts')
        ->setTitle('Facility requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('department.facilitystats', ['chart' => $chart]);  
         }   

         
    }
}
