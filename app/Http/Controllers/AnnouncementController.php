<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use Auth;
use Mail;
use Alert;
use App\Announcement;
use DB;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $department = Department::find(Auth::user()->department_id);
            //$notices = $department->announcement()->get();
            $notices = DB::table('announcements')->where([['department_id' , Auth::user()->department_id], ['expiry_date', '>', Carbon::today()->toDateString()]] )->get();
            //dd($notices);
            return view('announcement.index' , compact('notices'));

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
        $departments = Department::all();
        return view('announcement.create' , compact('departments'));
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

        //dd($request->all());

       
            $departments = Department::all();
            foreach ($departments as $department) {
                $i = $department->id;
                if($request->$i == "on"){
                    $notice = new Announcement();
                        $notice->title = $request->title;
                        $notice->expiry_date = $request->expiry_date;
                        $notice->body = $request->body; 
                        $notice->department_id = $i;
                        $notice->user_id = Auth::user()->id;
                        $notice->save();
                }

                        
                    }
              $title = "New Notice";
              $url = route('announcement.index');
              $content = "A new notice has been posted on the board. Click the button below to view details";      
              Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                           $message->from('wapneng@gmail.com');
                            $message->to('RGowok@st.vvu.edu.gh');
                    });                
                
             Alert::success('Your notice has been posted');
             return redirect(route('announcement.index'));   
       

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
