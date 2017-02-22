<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\FacilityDay;
use App\Applications;
use App\Http\Requests;
use Alert;
use Mail;
use Auth;


class FacilityDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
             return redirect(route('applications.index' ));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administration.days');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store requests
      //   $facilitydays = new FacilityDay($request->all());
        //dd(session('duration'));
        $abc = session('duration');
        for ($i=0; $i <$abc ; $i++) { 
            $this->validate($request, [
                'date'.$i => 'required|date|after:today',
                'time'.$i => 'required',
                ]);
            $facilitydays = new FacilityDay();
            $facilitydays->date = $request->input('date'.$i);
            $facilitydays->time = $request->input('time'.$i);
            $facilitydays->facility_id = session('fid');
            $facilitydays->save();
            $requestId = 1;
            session(['requestId' => $requestId]);
                
        }
        $url = route('facility.show',session('fid'));
            $content = "Facility request from your department needs your approval. Click on the button below to view";
            $title = 'New Facility Request' ;
         Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });
         Alert::message('Sent!');
           return redirect(route('facility.index' ));

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
}
