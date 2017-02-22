<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Food;
use App\FoodType;
use Auth;
use Alert;
use Mail;
use App\Department;
use App\User;
use PDF;
use Charts;
use DB;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->department_id == 6 && Auth::user()->role == "HOD" || Auth::user()->role == "finance officer"){

        $food = Food::all();
      
        $type = FoodType::all();
        return view('food.index' , compact('food' , 'type'  ));
           
        }
        elseif (Auth::user()->role == "HOD") {
            $dept_id = Auth::user()->department_id;
            $dept = Department::find($dept_id);
            $food = DB::table('foods')->where('department_id' , $dept_id)->get();
           // dd($food);
        $type = FoodType::all();
            return view('food.index' , compact('food' , 'type'  ));
        }
        else{

        $food = Auth::user()->food()->get( );
      // dd( FoodType::all());
                $type = FoodType::all();
        return view('food.index' , compact('food' , 'type'  ));   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('food.addfood');
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
            'purpose'=> 'required',
            'time' => 'required',
            'people' => 'required',
            'phone' => 'required',
            'delivery_date' =>'required|date|after:today',
            ]);
       
       
        $food = new Food();
        $food->purpose = $request->purpose;
        $food->delivery_time = $request->time;
        $food->delivery_date = $request->delivery_date;
        $food->phone = $request->phone;
        $food->people = $request->people;
        $food->user_id = Auth::user()->id;
        $food->department_id = Auth::user()->department_id;
        if (Auth::user()->role == 'HOD'){
            $food->submit_status = 'submitted';
        }
        $food->save();

        $foodid = Auth::user()->food()->latest()->first();
        $food_id = $foodid->id;

        if( $request->lunch == 'on'){
             $foodtype = new FoodType();
            $foodtype->type = 'lunch';
            $foodtype->food_id = $food_id;
            $foodtype->save();
        }
        if( $request->breakfast == 'on'){
             $foodtype = new FoodType();
            $foodtype->type = 'breakfast';
            $foodtype->food_id = $food_id;
            $foodtype->save();
        }
        if( $request->voltic == 'on'){
             $foodtype = new FoodType();
            $foodtype->type = 'voltic';
            $foodtype->food_id = $food_id;
            $foodtype->save();
        }
        if( $request->drink == 'on'){
             $foodtype = new FoodType();
            $foodtype->type = 'drink';
            $foodtype->food_id = $food_id;
            $foodtype->save();
        }
        if( $request->supper == 'on'){
             $foodtype = new FoodType();
            $foodtype->type = 'supper';
            $foodtype->food_id = $food_id;
            $foodtype->save();
        }
        if( $request->pastries == 'on'){
             $foodtype = new FoodType();
            $foodtype->type = 'pastries';
            $foodtype->food_id = $food_id;
            $foodtype->save();
        }


        //send mail notification to HOD 
        $title = "New food request";
        $url = route('food.show', $food_id);
        $username = Auth::user()->name;
        $content = "Food request needs your approval";
        //dd($username);
        //if( Auth::user()->role != 'HOD' ){
                Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                           $message->from('wapneng@gmail.com');
                            $message->to('RGowok@st.vvu.edu.gh');
                    });
          //  }
         // else {
         //   Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $username] , function($message){
         //            $message->from('wapneng@gmail.com');
         //            $message->to(' RGowok@st.vvu.edu.gh');
         //    });
         // }   
        Alert::message("Yumm! Your request has been sent");
         return redirect(route('food.index')) ; 

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
        $fid = Food::find($id);
        $food = Food::find($id);
        $type = FoodType::all();
        $user = $fid->user()->get();
        //dd($user);
        foreach ($user as $key ) {
            $username = $key->department_id;
            
        }
//        echo $username;
        $department_id = $username;
         $dept = Department::find($department_id);
        // if (Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer'){
        //  
           return view('food.single', compact('fid' , 'type' , 'user' , 'dept'));
       // }
       //  else{

       //      return view('food.pdf', compact('food' , 'type', 'user' , 'dept' ));    
       //  }


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
        if(Auth::user()->department_id !=5){
            $food = Food::find($id);
                $food->submit_status = $request->status;
                $food->approval_status = $request->approval_status;
                $food->save();
                $url = route('food.show', $food->id);
                //notify2 user
                Mail::send('emails.notify2', ["title" =>" Your request for food has been ".$request->status , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("rgowok@st.vvu.edu.gh");
                } );

                //notify2 Finance
                Mail::send('emails.notify2', ["title" =>" New food request " , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("board.surely4u@gmail.com");
                } );
                Alert::message('Done!');
                return redirect(route('food.index'));
            }
            elseif (Auth::user()->department_id == 6) {
                    dd($request->ammount);
                $food = Food::find($id);
                $food->ammount_charged = $request->ammount;
                $food->save();
                $content = "Applied charges for food request, view details in link below";
                $url = route('food.show', $food->id);
                Mail::send('emails.notify2', ["title" =>" Food request charge " , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("rgowok@st.vvu.edu.gh");
                } );
                }    
        else{
                $food = food::find($id);
                $food->submit_status = $request->status;
                $food->approval_status = $request->approval_status;
                $food->save();
                $url = route('food.show', $food->id);
                //notify2 user
                Mail::send('emails.notify2', ["title" =>" Your request for food has been ".$request->status , "content" => $request->comment, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("rgowok@st.vvu.edu.gh");
                } );
                Alert::message('Done!');
                return redirect(route('food.index'));
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

    public function ammount(Request $request){
         //dd($request->id);
                $food = Food::find($request->id);
                $food->ammount_charged = $request->ammount;
                $food->save();
                $content = "Applied charges for food request, view details in link below";
                $url = route('food.show', $food->id);
                Mail::send('emails.notify2', ["title" =>" Food request charge " , "content" => $content, "url" => $url], function($message){
                    $message->from("wapneng@gmail.com");
                    $message->to("rgowok@st.vvu.edu.gh");
                } );
                Alert::message('Done');
                return redirect('food.index' );
    }

    //render all the requests for a department in pdf 
     public function food(){
       if (Auth::user()->department_id != 6 || Auth::user()->department_id !=8){
        $user_id =  Auth::User()->department_id;
        $dept = Department::find($user_id);
        $users = $dept->user()->get();
        
        $food = DB::table('foods')->where('department_id', $user_id)->get();
        $type = FoodType::all();

       $pdf = PDF::loadView('food.pdf', compact('food' , 'users' , 'dept' , 'type'));
        return $pdf->download('food.pdf');

       }
       else{
        $food = Food::all();
        $users = User::all();
        $dept = Department::all();
        $type = FoodType::all();
           
                            $pdf = PDF::loadView('food.pdf', compact('food' , 'users' ,'dept' , 'type'));
        return $pdf->download('food.pdf');
       } 
}

//display statistics for food requests
public function statistics(){
        if (Auth::user()->department_id != 4){
                $user_id =  Auth::User()->department_id;
         
        $chart = Charts::database(DB::table('foods')->where('department_id', $user_id)->get(), 'bar', 'highcharts')
        ->setTitle('Food requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('food.statistics', ['chart' => $chart]);   
        }
         else{
             $chart = Charts::database(Food::all(), 'bar', 'highcharts')
        ->setTitle('Food requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('food.statistics', ['chart' => $chart]);  
         }   

         
    }
}
