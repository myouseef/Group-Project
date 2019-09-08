<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patients;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $user = Auth::user();
        return view('patient.register_patient',['title'=>$user->name]);
    }

    public function register_patient(Request $request)
    {
        //dd($request->all());
       

        try{
            $patient=new Patients;
            $patient->name=$request->reg_pname;
            $patient->address=$request->reg_paddress;
            $patient->occupation=$request->reg_poccupation;
            $patient->sex=$request->reg_psex;
            $patient->age=$request->reg_page;
            $patient->telephone=$request->reg_ptel;
            $patient->nic=$request->reg_pnic;
            $patient->save();
            session()->flash('regpsuccess','Patient '.$request->reg_pname.' Registered Successfully !');
            return redirect()->back();
         }
         catch(\Exception $e){
            // do task when error
            $error=$e->getCode();
            if($error=='23000'){
                session()->flash('regpfail','Patient '.$request->reg_pname.' Is Already Registered..');
                return redirect()->back();
            }
         }

       
    }

    public function check_patient_view()
    {
        $user = Auth::user();
        return view('patient.check_patient_view',['title'=>$user->name]);
    }

    public function create_channel_view()
    {
        $user = Auth::user();
        return view('patient.create_channel_view',['title'=>$user->name]);
    }

    public function regcard(){
        return view('patient.patient_reg_card');
    }

}
