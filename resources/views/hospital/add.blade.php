@extends('layouts.app')
@section('content')
<div class="section">
<div class="container">
  <div class="row">
  <div class="col s9 offset-s3">  
    <div class="card">
    <div class="card-content">
      <span class= "card-title blue-text">Hospital Bill</span>
    
    <form method="post" action="{{route('healthcharge.store')}}" >
  	{{csrf_field()}}
    <div class="row">
        <div class="input-field col s6">
          <input  type="text" name="patient_name" class="validate" >
          <label  for "patient_name">Patient's  Name</label>
       	<span class="red-text">{{$errors->first('patient_name',':message')}}</span>	
       	 </div>

        <div class="input-field col s6">
          <input  type="text" name="folder_no" class="validate" >
          <label  for "folder_no">Folder No.</label>
          <span class="red-text">{{$errors->first('folder_no',':message')}}</span>
        </div>
    
        
    </div>
    <div class="row">
        <div class="input-field col s6">
    
    <select class="browser-default" name="account_type">
      <option value="" disabled selected>Debit account of</option>
      <option value="student">Student</option>
      <option value="staff">Staff</option>
    </select>
    <span class="red-text">{{$errors->first('account_type',':message')}}</span>
  </div>
  <div class="input-field col s6">
      <input type="text" name = "account_code" class="validate" >
      <label for "account_code" >Student/Staff Account Code</label>
      <span class="red-text">{{$errors->first('account_code',':message')}}</span>
    </div>
    </div>
    <div class="row">
      <h5 class="center">Services</h5>
      <table>
        <thead>
          <th>Service</th>
          <th>Ammount</th>
          
        </thead>
        <tbody>
          <tr>
            <td>
              <input type="checkbox" class="filled-in" id="reg_con"  />
              <label for="reg_con">Reg/Con.</label>
            </td>
            <td>
                  <div class="input-field ">
              <input class="amt" type="text" placeholder = "0.00"   name="amt1"   / >
              <span class="red-text">{{$errors->first('amt1',':message')}}</span>
            </div>

            </td>
           

          </tr>
          <tr>
            <td>
              <input type="checkbox" class="filled-in" id="drug"  />
              <label for="drug">Drug</label>
            </td>
            <td>
                  <div class="input-field ">
              <input class="amt" type="text" placeholder = "0.00"  name="amt2"   />
              <span class="red-text">{{$errors->first('amt2',':message')}}</span>
            </div>

            </td>
            
          </tr>
          <tr>
            <td>
              <input type="checkbox" class="filled-in" id="lab"  />
              <label for="lab">Laboratory</label>
            </td>
            <td>
                  <div class="input-field ">
              <input class="amt" type="text" placeholder = "0.00"  name="amt3"   / >
              <span class="red-text">{{$errors->first('amt3',':message')}}</span>
            </div>

            </td>
           
          </tr>
          <tr>
            <td>
              <input type="checkbox" class="filled-in" id="admission"  />
              <label for="admission">Admission</label>
            </td>
            <td>
                  <div class="input-field ">
              <input class="amt" type="text" placeholder = "0.00"  name="amt4" />
              <span class="red-text">{{$errors->first('amt4',':message')}}</span>
            </div>

            </td>
           

          </tr>
          <tr>
            <td>
              <input type="checkbox" class="filled-in" id="others"  />
              <label for="others">Others</label>
            </td>
            <td>
                  <div class="input-field ">
              <input class="amt" type="text" placeholder = "0.00"  name="amt5"   />
              <span class="red-text">{{$errors->first('amt5',':message')}}</span>
            </div>

            </td>
           
          </tr>
        </tbody>
      </table>
      	<div class="input-field col s6 offset-s5">
      		<button class="btn btn-primary" type="submit" name="submit">Submit</button>
      	</div>
    </div>
  </form>
</div>
	</div>
</div>
</div>
</div>


@endsection