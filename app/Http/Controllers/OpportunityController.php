<?php

namespace App\Http\Controllers;

use App\OpportunityTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Opportunity;
use App\Clients;
use DB;

class OpportunityController extends Controller
{
    public function index(){
        if(Auth::check()){
           // $opportunities = \App\Opportunity::all();
            return view('shop.opportunities');
        }else{
            return view('user.login');
        }

    }
    //LOAD OPPORTUNITIES ON THE DASHBOARD

    public function create(Request $request){
      //  if(Auth::user()->usertype==="admin")
        {
            $opportunities = DB::table("opportunities")
                ->select("opportunities.*","clients.clientname","users.name")
                ->join("clients","clients.clientid","=","opportunities.clientid")
                ->join("users","users.id","=","opportunities.accountowner")
                ->orderby("opportunities.created_at","desc")
                ->get();
        }
       /* else{
            $opportunities = DB::table("opportunities")
                ->select("opportunities.*","clients.clientname","users.name")
                ->join("clients","clients.clientid","=","opportunities.clientid")
                ->join("users","users.id","=","opportunities.accountowner")
                ->where("opportunities.accountowner","=",ucfirst(Auth()->user()->id))
                ->orderby("opportunities.created_at","desc")
                ->get();
        }*/

        return response()->json($opportunities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

            if(!isset( Clients::where("clientname",$request->get('client'))->first()->clientid)){
                $newclient = new Clients([
                    'clientid'=>rand(1000,100000),
                    'clientname'=>$request->get('client'),
                    'address'=>$request->get('address'),
                    'contact'=>$request->get('contactperson'),
                    'phone'=>$request->get('phone'),
                    'email'=>$request->get('email'),
                    'email_1'=>$request->get('email'),
                    'email_2'=>$request->get('email'),
                    'status'=>"Active"
                ]);
                $newclient ->save();
            }

                $clientid = Clients::where("clientname",$request->get('client'))->first()->clientid;
                $opportunity = new Opportunity([
                    'title'=>$request->get('opportune_title'),
                    'description'=>$request->get('opportune_descrip'),
                    'estimatevalue'=>$request->get('opportune_value'),
                    'currency'=>$request->get('opportun_currency'),
                    'estimateclosuredate'=>$request->get('datetimepicker4'),
                    'accountowner'=>ucfirst(Auth()->user()->id),
                    'clientid'=>$clientid,
                    'contactperson'=>$request->get('contactperson'),
                    'phone'=>$request->get('phone'),
                    'email'=>$request->get('email'),
                    'stage'=>'New Entry',
                    'status'=>"Active",
                ]);
                if( $opportunity ->save()){
                    return response()->json(['response'=>1]);
                }else{
                    return response()->json(['response'=>0]);
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        $status = DB::table("opportunities")
            ->where("id","=",$id)
            ->update(["stage"=>$request->get("stage")]);
        return response($status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
       $status = DB::table("opportunities")
            ->where("id",$id)
            ->update(["status"=>"Closed"]);
       return response($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

    }


public function getsummary(){
  if(Auth::user()->usertype==="admin"){
        $summary = DB::table("opportunities")
                   ->select(DB::raw("count(*) as total_opport, max(estimatevalue) as max_value,(select currency from opportunities where estimatevalue=(select MAX(estimatevalue) from opportunities)) as max_currency, (select count(id) from opportunities where YEARWEEK(created_at) = YEARWEEK(NOW())) as New_This_Week, (select count(id) from opportunities where status='Closed') as All_Closed, (select count(id) from opportunities where status='Active' ) as Ongoing"))
                       ->get();
  }else{
        $summary = DB::table("opportunities")
         ->select(DB::raw("count(*) as total_opport, max(estimatevalue) as max_value,
         (select currency from opportunities where estimatevalue=(select MAX(estimatevalue) from opportunities where accountowner='".ucfirst(Auth()->user()->id)."')) as max_currency, 
         (select count(id) from opportunities where YEARWEEK(created_at) = YEARWEEK(NOW()) and accountowner='".ucfirst(Auth()->user()->id)."') as New_This_Week, 
         (select count(id) from opportunities where status='Closed' and accountowner='".ucfirst(Auth()->user()->id)."') as All_Closed, 
         (select count(id) from opportunities where status='Active' and accountowner='".ucfirst(Auth()->user()->id)."') as Ongoing"))
          ->where("accountowner","=",ucfirst(Auth()->user()->id))
          ->get();
  }     
            return response($summary);
}

public function delete(Request $request){
        $id = $request->get("opportunityID");
        $status = DB::table("opportunitytrail")
            ->where("opportunity_id","=",$id)
            ->delete();
            
                $status = DB::table("opportunities")
            ->where("id","=",$id)
            ->delete(); 
          
            return response($status);
}


}
