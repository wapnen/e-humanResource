<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transport;
use Auth;
use Mail;
use Alert;
use App\User;
use PDF;
use App\Department;
use Charts;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role == "director of transport" || Auth::user()->role == "HOD"){
            $transport = Transport::all();
            $users = User::all();
            $departments = Department::all();
            return view('transport.index' , compact('transport' , 'users', 'departments'));
        }
        else{
            $transport = Auth::user()->transport()->get();
            return view('transport.index' , compact('transport'));
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
        return view('transport.create');
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
            'purpose'=> 'required',
            'destination' => 'required',
            
            'vehicle' => 'required',
            'country' => 'string',
            'no_of_passengers' => 'required|integer',
            'qty_goods' => 'integer',
            'departure_date' =>'required|date|after:today',
            'departure_time' =>'required',
            'return_date' =>'required|date|after:today',
            'return_time' =>'required',
            'type_of_service' => 'required',    
            ]);

        //save request
           // dd($request->all());
        $transport = new Transport();
        $transport->purpose = $request->purpose;
        $transport->destination = $request->destination;
        $transport->flight_no = $request->flight_no;
        $transport->vehicle = $request->vehicle;
        $transport->country = $request->country;
        $transport->no_of_passengers = $request->no_of_passengers;
        $transport->departure_date = $request->departure_date;
        $transport->departure_time = $request->departure_time;
        $transport->return_date = $request->return_date;
        $transport->return_time = $request->return_time;
        $transport->type_of_service = $request->type_of_service;
        $transport->user_id = Auth::user()->id;
        $transport->department_id = Auth::user()->department_id;
        $transport->save();
        $transport = Transport::latest()->first();
        $tid = $transport->id;

        //send email notification to director of transport
        $title = "Transport service request";
        $url = route('transport.show' , $tid);
        $content = "A transport request from your department needs approval. Click on the button below to review the details of the request or login to docman";
        Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });
        Alert::success("Transport request sent");
        return redirect(route('transport.show' , $tid));
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
        $transport = Transport::find($id);
        $uid= $transport->user_id;
        $user = User::find($uid);
        return view('transport.single' , compact('transport' , 'user'));
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

        if (Auth::user()->role == "HOD"){
            $transport = Transport::find($id);
            $transport->authorized = $request->authorized;
            $transport->approved = $request->approved;
            $transport->save();
            $uid = $transport->user_id;
            $user = User::find($uid);
            $email = $user->email;
            $title = "Update on your transport request";
            $content ="Click the button below to check the status of your transport request";
            $url = route('transport.show' , $id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });

            if($request->authorized == "Authorized"){
                $user = DB::table('users')->where('role' , 'director of transport')->get();
                foreach ($user as $key) {
                    $email = $user->email;
                }
                $title = "Transport request";
                $content = "A new transport request needs your approval, Click the button below to review details";

                 Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('wapneng@gmail.com');
            });
            }
            Alert::success("Done!");
            return redirect(route('transport.show' , $id));

        }
        elseif (Auth::user()->role == "director of transport") {
             $transport = Transport::find($id);
            $transport->authorized = $request->authorized;
            $transport->approved = $request->approved;
            $transport->save();
            $uid = $transport->user_id;
            $user = User::find($uid);
            $email = $user->email;
            $title = "Update on your transport request";
            $content ="Click the button below to check the status of your transport request";
            $url = route('transport.show' , $id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });
            Alert::success("Done!");
            return redirect(route('transport.show' , $id));
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

    public function official(Request $request , $id){
        //dd($request->all());
        $this->validate($request, [
            'driver'=> 'required',
            'perdiem' => 'required|integer',
            'vehicle_charge' => 'required|integer',
            'km_covered' => 'required|integer',
            'qty_fuel' => 'required|integer',
            'cost' => 'required|integer',


                        ]);
        $transport = Transport::find($id);
        $transport->driver = $request->driver;
        $transport->perdiem = $request->perdiem;
        $transport->vehicle_charge = $request->vehicle_charge;
        $transport->km_covered = $request->km_covered;
        $transport->qty_fuel = $request->qty_fuel;
        $transport->cost = $request->cost;
        $transport->save();

        $title ="Transport request charges";
        $content = "Your transport request charges have been updated. You are required to pay the stipulated ammount at the accounts office and upload a scanned copy of your reciept. Click the button below";
        $url = route('transport.show' , $id);
        Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });
        Alert::success("Done");
        return redirect(route('transport.show' , $id));

    }

    public function invoice($id){
        $transport = Transport::find($id);
        $uid = $transport->user_id;
        $user = User::find($uid);
        $pdf = PDF::loadView('transport.invoice', compact('transport' , 'user' ));
        return $pdf->download('invoice.pdf');
    }
    public function report(){
        if (Auth::user()->role == "director of transport"){
            $transport = Transport::all();
            $users = User::all();
            $departments = Department::all();
           
            $pdf = PDF::loadView('transport.pdf', compact('transport' , 'users', 'departments' ));
        return $pdf->download('transport.pdf');

        }
         else{
            $department_id = Auth::user()->department_id;
            $department = Department::find($department_id);
            $transport = $department->transport()->get();
            $users = User::all();
            $departments = Department::all();
            $pdf = PDF::loadView('transport.pdf', compact('transport' , 'users', 'departments' ));
        return $pdf->download('transport.pdf');
         }
        



    }
     public function home(){
        return view('transport.home');
    }   

    public function statistics(){
      
             $chart = Charts::database(Transport::all(), 'bar', 'highcharts')
        ->setTitle('Transport requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('transport.statistics', ['chart' => $chart]);  
         }   

         
    
    
}
