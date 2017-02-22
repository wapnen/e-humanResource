<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;
use App\Purchase;
use Auth;
use Mail;
use Alert;
use Charts;
use PDF;
use App\User;
use App\Department;
use DB;
use App\PurchaseCheque;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role == 'HOD'){
            $department_id = Auth::user()->department_id;
            $department = Department::find($department_id);
            $purchase = $department->purchase()->get();
            $users = User::all();
            $items = Item::all();
            return view('purchase.index',  compact('purchase' , 'users' , 'items'));
        }
        elseif (Auth::user()->role == 'finance officer' || Auth::user()->role == 'procurement officer' ) {
             
            $department = Department::all();
            $purchase = Purchase::all();
            $users = User::all();
            $items = Item::all();
            return view('purchase.index',  compact('purchase' , 'users' , 'items', 'department'));
        }
        else{

           $user = Auth::user();
            $purchase = $user->purchase()->get();
            
            $items = Item::all();
            return view('purchase.index',  compact('purchase' , 'users' , 'items'));
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

        return view('purchase.create');
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
        $count = count($request->quantity);
         $this->validate($request, [
            'delivery_site'=> 'required',
            
            ]);
            // for ($i=0; $i < $count; $i++) { 
            //         $this->validate($request, [
            //     'quantity'.$i => 'required|integer',
            //     'unit'.$i => 'required|integer',
            //     'unit_price'.$i => 'required|integer',
            //     'description'.$i => 'required',
                
            //     ]);
                
        //dd($request->all());
        $purchase = new Purchase();
        $purchase->delivery_site = $request->delivery_site;
        $purchase->user_id = Auth::user()->id;
        $purchase->department_id = Auth::user()->department_id;
        $purchase->save();
        $purchaseid = $purchase->id; 
        $total =0;
            for ($i=0; $i < $count; $i++) { 
            
                $item = new Item();
                $item->quantity = $request->quantity[$i];
                $item->unit = $request->unit[$i];
                $item->unit_price = $request->unit_price[$i];
                $item->description = $request->description[$i];
                $item->purchase_id = $purchaseid;
                $item->save();
                $totality= $item->unit_price * $item->quantity;
                $total += $totality;
            }
            $purchase->total = $total;
            $purchase->save();
            //notify HOD
            $title = "New Purchase request";
            $content = "Purchase request from your department needs your approval. Click the button below to review.";
            $url = route('purchase.show' , $purchase->id);
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('RGowok@st.vvu.edu.gh');
                    
            });

            Alert::success("Your request has been submitted");
            return redirect(route('purchase.index'));

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
        $purchase = Purchase::find($id);
        $items = DB::table('items')->where('purchase_id' , $purchase->id)->get();
        $user = User::find($purchase->user_id);
        $department = Department::find($purchase->department_id);
        $ravail = 0;
            $cheque = DB::table("purchase_cheques")->where('purchase_id' , $purchase->id)->get();
           foreach ($cheque as $key ) {
               if($key->reciept == ""){
                $ravail = 0;
               }
               else{
                $ravail = 1;
                $reciept= $key->reciept;
               }
           }
        return view('purchase.show' , compact('purchase' , 'items' , 'user' , 'department' , 'cheque' , 'ravail', 'reciept' ));
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
        $purchase = Purchase::find($id);
        if (Auth::user()->role == 'HOD'){
            $purchase->authorized = $request->authorized;
            $purchase->approved = $request->approved;
            $purchase->save();
             $title = "New purchase request";
            $url = route('purchase.show', $id);
            $content = "A new purchase request needs your approval. Click the button below to review";
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('board.surely4u@gmail.com');
                    
            });
            Alert::success('done');
            return redirect(route('purchase.show' , $id));
        }

        if (Auth::user()->role == 'finance officer'){
            $purchase->authorized = $request->authorized;
            $purchase->approved = $request->approved;
            $purchase->save();
             $title = "New purchase request";
            $url = route('purchase.show', $id);
            $content = "Set up a team to vet this request. Click on the button below to view details";
            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('wapneng@gmail.com');
                    
            });
            Alert::success('done');
            return redirect(route('purchase.show' , $id));
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

    public function vet(Request $request ){
         $purchase = Purchase::find($request->purchaseid);
        //dd($request->all());
        $count = count($request->quantity);
          $total = 0;
          for ($i=0; $i < $count; $i++) { 
            
                $item = Item::find($request->itemid[$i]);
                $item->quantity = $request->quantity[$i];
                $item->unit = $request->unit[$i];
                $item->unit_price = $request->unit_price[$i];
                $item->save();
                $totality= $item->unit_price * $item->quantity;
                $total += $totality;
                
            }
        
         $purchase->total = $total;
         $purchase->vetted = "Vetted"; 
         $purchase->save();  
        $title = "Vetting Details";
            $url = route('purchase.show' , $request->purchaseid);
            $content = "Vetting results for purchase request. Click on the button below to view details";

            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('board.surely4u@gmail.com');
                    
            });
    Alert::success('done');
    return redirect(route('purchase.show' , $request->purchaseid));
        
    }

    public function cheque(Request $request, $id){
        $purchasecheque = new PurchaseCheque();
        $purchasecheque->name = $request->name;
        $purchasecheque->ammount = $request->ammount;
        $purchasecheque->purchase_id =$id;
        $purchasecheque->save();
        $title = "New Cheque";
            $url = route('purchase.show' , $id);
            $content = "The cheque for purchase of requested items has been prepared. Please pick it up at the finance office";

            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('wapneng@gmail.com');
                    
            });
        Alert::success("done");
        return redirect(route('purchase.show', $id));    

    }

    public function reciept(Request $request){
        $purchaseid = $request->purchase_id;
        $cheque = DB::table('purchase_cheques')->where('purchase_id' , $purchaseid)->get();
        foreach ($cheque as $key) {
            $id = $key->id;
        }
        $chequeobj = PurchaseCheque::find($id);
          $file = $request->file('reciept') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/reciepts/' ;
            $file->move($destinationPath,$fileName);
            $chequeobj->reciept = $fileName ;
            $chequeobj->save();
            $purchase = Purchase::find($request->purchase_id);
            $purchase->purchased = "Purchased";

             $title = "Reciept";
            $url = route('purchase.show' , $request->purchase_id);
            $content = "The items requested have been bought. Click the button below to view reciept";

            Mail::send('emails.notify2', ['title' => $title, 'url' =>$url , 'content' => $content] , function($message){
                    $message->from('wapneng@gmail.com');
                    $message->to('wapneng@gmail.com');
                    
            });
        Alert::success("done");
        return redirect(route('purchase.show', $request->purchase_id)); 

    }

    public function report(){

        $department_id = Auth::user()->department_id;
            $department = Department::find($department_id);
            $purchase = $department->purchase()->get();
            $users = User::all();
        $pdf = PDF::loadView('purchase.pdf', compact('dept' , 'users' ,'purchase' ));
        return $pdf->download('purchase.pdf');
    }

    public function statistics(){
        if (Auth::user()->department_id != 10){
                $user_id =  Auth::User()->department_id;
         
        $chart = Charts::database(DB::table('purchases')->where('department_id', $user_id)->get(), 'bar', 'highcharts')
        ->setTitle('Purchase requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('purchase.statistics', ['chart' => $chart]);   
        }
         else{
             $chart = Charts::database(Purchase::all(), 'bar', 'highcharts')
        ->setTitle('Purchase requests')
        ->setElementLabel("Requests")
        ->setDimensions(1000, 300)
        ->setResponsive(false)
        ->groupByDay();
        return view('purchase.statistics', ['chart' => $chart]);  
         }   
    }
        
}
