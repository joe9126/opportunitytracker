<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
// protected $table =  'opportunities';
 protected $fillable = [
     'title',
     'description',
     'estimatevalue',
     'currency',
     'estimateclosuredate',
     'accountowner',
     'clientid',
     'contactperson',
     'phone',
     'email',
     'stage',
     'status'
 ];

}
