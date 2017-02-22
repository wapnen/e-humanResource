<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Minute;
use Alert;
use Mail;



class MinuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $minute = new Minute();

        // if($file = $request->hasFile('minutes')) {
        //     dd($file);
            
            $file = $request->file('minutes') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/minutes/' ;
            $file->move($destinationPath,$fileName);
            $minute->filename = $fileName ;
            $minute->meeting_id = $request->meeting_id;
            $minute->save();
        // }

            $title = "Minutes have been added";
            $url = route('meeting.show', $request->meeting_id);
            $content = "check it out";
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });
        Alert::success("Minute added");
        return redirect(route('meeting.show', $request->meeting_id));
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
