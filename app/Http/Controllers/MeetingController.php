<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Meeting;
use App\User;
use App\Department;
use App\Member;
use Alert;
use Auth;
use Mail;
use DB;


class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = DB::table('members')->where('user_id' , Auth::user()->id)->get();
        $items = array();
        foreach ($members as $key ) {
            $meetingid = $key->meeting_id;
            $items[] = $meetingid;
        }
        $meetings = Meeting::find($items);
        //dd($meetings);
        return view('meeting.index' , compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('meeting.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'title'=> 'required',
            'type' => 'required',
            'venue' => 'required',
            'date' => 'required|date|after:today',
            'time' =>'required',
            ]);
        $meeting = new Meeting($request->all());
        $meeting->organizer = Auth::user()->id;
        $meeting->save();
        $meetingid = $meeting->id;
         session(['mid' => $meetingid]);

        Alert::success("Meeting created!");
        
        return redirect(route('member.create'));

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
         $meeting = Meeting::find($id);

        $members = $meeting->member()->get();
        $users = User::all();
        $dept = Department::all();
        $minute = $meeting->minute()->get();
        return view('meeting.single' , compact('meeting' , 'members' , 'users' , 'dept' , 'minute'));
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
        $meeting = Meeting::find($id);
        $meeting->date = $request->date;
        $meeting->time = $request->time;
        $meeting->save();
        Alert::success("Meeting has been postponed");
        return redirect(route('meeting.show' , $id));
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

    public function secretary(Request $request, $id){
        $meeting = Meeting::find($id);
        $meeting->secretary = $request->secretary;
        $meeting->save();
        $user = User::find($request->secretary);
        $to = $user->email;
         $title = "You have been appointed the secretary for a meeting";
            $url = route('meeting.show', $id);
            $content = "check it out";
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
                    
            });
        Alert::success("secretary assigned");
        return redirect(route('meeting.show' , $id) );
    }
}
