<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use App\User;
use Auth;
use Alert;
use App\Memo;
use App\MemoBody;
use App\MemoReceipient;
use DB;
use PDF;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $memos = Auth::user()->memo()->get();
        $received = DB::table('memo_receipients')->where('receipient', Auth::user()->id)->get();
        $allmemos = Memo::all();
        return view('memo.index', compact('memos' , 'received' , 'allmemos'));
       // dd($memos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
        return view('memo.create' );
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

          $this->validate($request, [
            'subject'=> 'required',
            
            ]);
       

        $memo = new Memo();
        $memo->subject = $request->subject;
        $memo->user_id = Auth::user()->id;
        $memo->save();
        $memoid = $memo->id;

        foreach ($request->body as $key => $value) {
            $paragraph = new MemoBody();
            $paragraph->paragraph = $value;
            $paragraph->paragraph_no = $key;
            $paragraph->memo_id = $memo->id;
            $paragraph->save();
        }

        Alert::message("Select receipients");
        return redirect(route('memoreceipient' , $memoid));


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

    public function receipient($memoid){
       
         $departments = Department::all();
        $users = User::all();
       return view('memo.receipients', compact('departments' , 'users' , 'memoid'));
    }

    public function storeReceipient(Request $request){
        //dd($request->all());
        if ($request->type == "dept"){

            $departments = Department::all();
            foreach ($departments as $department) {
                $i = $department->id;
                if($request->$i == "on"){
                    $receipient = new MemoReceipient();
                    $receipient->receipient = $department->HOD;
                     $receipient->memo_id = $request->memo_id;
                    $receipient->save(); 
                }
        }
     return redirect(route('memo.index'));
     }
        elseif ($request->type == "users") {
             $users = User::all();
            foreach ($users as $user) {
                $i = $user->id;
                if($request->$i == "on"){
                    $receipient = new MemoReceipient();
                    $receipient->receipient = $user->id;
                    $receipient->memo_id = $request->memo_id;
                    $receipient->save(); 
                }
        }        
    
     return redirect(route('memo.index'));
    }
    }

   public function pdf($id){

        $memo = Memo::find($id);
        $memobody = $memo->memoBody()->get();
        $memoreceipient = $memo->memoReceipient()->get();
        $users = User::all();
        $pdf = PDF::loadView('memo.pdf', compact( 'memo', 'memobody' , 'memoreceipient' , 'users'));
        return $pdf->download('memo.pdf');
   } 
}