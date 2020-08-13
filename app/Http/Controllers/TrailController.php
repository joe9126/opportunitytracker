<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OpportunityTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Opportunity;

class TrailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(!Auth::check()){
           return view('user.login');
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $trail_data = new OpportunityTrail([
            "opportunity_id"=> $request->get("opportunityid"),
            "event_trail"=>$request->get("event_trail"),
            "trail_date"=>$request->get("trail_date"),
            "updated_by"=>ucfirst(Auth()->user()->id)
        ]);
          $status = $trail_data->save();

            return response($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opportunity_trail = DB::table("opportunitytrail")
            ->select("opportunitytrail.*","users.name")
            ->join("opportunities","opportunities.id","=","opportunitytrail.opportunity_id")
            ->join("users","users.id","=","opportunitytrail.updated_by")
            ->where("opportunitytrail.opportunity_id","=",$id)
            ->get();
        return response()->json($opportunity_trail);
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
        $response = OpportunityTrail::destroy($id);
        if($response>0){
            $msg = "Event trail deleted successfully";
        }else{
            $msg = "Something went wrong! Try again!";
        }
        return response()->json(["status"=>$response,"msg"=>$msg]);
    }
}
