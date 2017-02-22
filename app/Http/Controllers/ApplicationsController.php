<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Facility;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  dd(session('requestId'));
        $application = new Application();
        $application->request_id = 1;
        $application->user_id = Auth::User()->id;
        $application->requestRow = session('fid');
        $application->save();
        return redirect(route('applications.create'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
        return view('applications' );   
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $requestId)
    {
        //
       // dd('i am store');
        $application = new Application();
        $application->request_id = 1;
        $application->user_id = Auth::User()->id;
        $application->requestRow = $requestId;
        $application->save();
        return redirect(route('applications.create'));
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

    public function showall(Request $request){
            if( $request->type ==1){
                return redirect(route('facility.index'));
            }
            elseif ($request->type ==2) {
                return redirect(route('food.index'));
                
            }
            elseif ($request->type == 3) {
                return redirect(route('maintenance.index'));
            }
            elseif ($request->type == 4) {
                return redirect(route('transport.index'));
            }
            elseif ($request->type == 5) {
                return redirect(route('purchase.index'));
            }
            elseif ($request->type == 6) {
                return redirect(route('leave.index'));
            }

            else{
                return view('applications');
            }
    }
}
