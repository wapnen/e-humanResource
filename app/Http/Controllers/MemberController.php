<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Meeting;
use App\User;
use App\Department;
use App\Member;
use Illuminate\Support\Facades\Session;
use Alert;
use Mail;

class MemberController extends Controller
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
        $users = User::all();
        $count = count($users);
        $dept = Department::all();
       //dd($count);
        return view('meeting.addmember' , compact('users' , 'count' , 'dept'));
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
//        dd($request->all());
        foreach ($request->all() as $key => $value) {
            if($value == "on"){
                $member = new Member();
                $member->user_id = $key;
                $member->meeting_id = session('mid');
                $member->save();
            }
        }
         $title = "You have been invited to a meeting";
            $url = route('meeting.show', session('mid'));
            $content = "check it out";
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });
        Alert::success("Invitation sent");
        return redirect(route('meeting.show', session('mid')));
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

    //take attendance
    public function attendance(Request $request){
         foreach ($request->all() as $key => $value) {
            if($value == "on"){
                $member = Member::find($key);
                $member->attendance = 'Present';
                
                $member->save();
            }
            
                
            
        }
        $members = DB::table('members')->where('id' , $request->meeting_id)->get();
                foreach ($members as $member) {
                    if($member->attendance != "Present"){
                        $new = Member::find($member->id);

                        $new->attendance = 'Absent';
                        $new->save();
                    }
                }
        Alert::success("Attendance updated");
        return redirect(route('meeting.show' , $request->meeting_id));
    }


}
