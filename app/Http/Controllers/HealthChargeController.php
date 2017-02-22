<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\HealthCharge;
use App\HealthService;
use DB;
use Alert;
use Mail;
use PDF;
use Charts;


class HealthChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $healthcharges = HealthCharge::all();
        return view('hospital.index' , compact('healthcharges'));
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
      //  dd($request->all());
        $this->validate($request, [
            'patient_name'=> 'required',
            'folder_no' => 'required',
            'account_type' => 'required',
            'account_code' => 'required',
            'amt1' => 'integer',
            'amt2' => 'integer',
            'amt3' => 'integer',
            'amt4' => 'integer',
            'amt5' => 'integer',

            ]);
        $healthcharge = new HealthCharge();
        $healthcharge->patient_name = $request->patient_name;
        $healthcharge->folder_no = $request->folder_no;
        $healthcharge->account_type = $request->account_type;
        $healthcharge->account_code = $request->account_code;
        
        $healthcharge->save();

        $hid = HealthCharge::latest()->first();
        $healthid = $hid->id;
       // dd($healthid);
        $total = 0;
        if ($request->amt1 > 0) {
            $healthservice  = new HealthService();
            $healthservice->type = "Reg\con";
            $healthservice->ammount = $request->amt1;
            $healthservice->health_charge_id = $healthid;
            
            $healthservice->save();
            $total += $request->amt1;
        }
        if ($request->amt2 > 0) {
            # code...
            $healthservice  = new HealthService();
            $healthservice->type = "Drugs";
            $healthservice->ammount = $request->amt2;
            $healthservice->health_charge_id = $healthid;
            
            $healthservice->save();
            $total += $request->amt2;
        }
        if ($request->amt3 > 0) {
            # code...
            $healthservice  = new HealthService();
            $healthservice->type = "Laboratory";
            $healthservice->ammount = $request->amt3;
            $healthservice->health_charge_id = $healthid;
            
            $healthservice->save();
            $total += $request->amt3;
        }
        if ($request->amt4 > 0) {
            # code...
            $healthservice  = new HealthService();
            $healthservice->type = "Admission";
            $healthservice->ammount = $request->amt4;
            $healthservice->health_charge_id = $healthid;
            
            $healthservice->save();
            $total += $request->amt4;
        }
        if ($request->amt5 > 0) {
            # code...
            $healthservice  = new HealthService();
            $healthservice->type = "Miscalleanous";
            $healthservice->ammount = $request->amt5;
            $healthservice->health_charge_id = $healthid;
            
            $healthservice->save();
            $total += $request->amt5;
        }
        $hid->total = $total;
        $hid->save();

        $title = "New hospital invoice";
        $content = "Please review the contents of this invoice";
        $url = route('healthcharge.show' , $healthid);
        $user = DB::table('users')->where('role' , 'finance officer')->get();
        foreach ($user as $key ) {
            $user_email = $key->email;
        }
        Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
            });
         Alert::success("Invoice sent");
         return redirect(route('healthcharge.show' , $healthid));


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
        $healthcharge = HealthCharge::find($id);
        $healthservices = $healthcharge->healthService()->get();
        return view('hospital.single' , compact('healthcharge' , 'healthservices'));   
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
       // dd($request->request);
        if($request->recieved == "Recieved"){
            $healthcharge = HealthCharge::find($id);
            $healthcharge->recieved = $request->recieved;
            $healthcharge->save();
        Alert::success("Done");
        }
        elseif ($request->recieved == "Deducted") {
            $healthcharge = HealthCharge::find($id);
            $healthcharge->deducted = $request->recieved;
            $healthcharge->save();
            Alert::success("Done");        
                    }
        return redirect(route('healthcharge.show' , $id));
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

    public function invoice($id){
        
        $healthcharge = HealthCharge::find($id);
        $healthservices = $healthcharge->healthService()->get();
       
        $pdf = PDF::loadView('hospital.invoice2', compact('healthcharge' , 'healthservices'));
        return $pdf->download('invoice.pdf');
    }

    //render pdf 
    public function healthpdf(){

        $healthcharges = HealthCharge::all();
        $pdf = PDF::loadView('hospital.pdf', compact('healthcharges' ));
        return $pdf->download('hospital.pdf');

        
    }

    //show statistics
    public function statistics(){
        $chart = Charts::database(DB::table('health_charges')->get(), 'bar', 'highcharts')
        ->setTitle('Health Charges')
        ->setElementLabel("Bills")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('hospital.statistics', ['chart' => $chart]); 
    }
}
