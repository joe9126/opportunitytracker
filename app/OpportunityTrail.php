<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class OpportunityTrail extends Model
{
    protected $table = "opportunitytrail";
    protected $fillable = [
        "opportunity_id",
        "event_trail",
        "trail_date",
        "updated_by"
    ];
}

