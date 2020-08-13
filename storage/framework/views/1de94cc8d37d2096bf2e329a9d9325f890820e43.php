
<?php $__env->startSection('title'); ?>
    Opportunities - PrimeCRM
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
  <!--  <div class="col-md-1 leftstrip"></div>-->
        <div class="  formcontainer">
            <div class="row pageheading">
                <div class="col-md-4"><h1 class="pagetitle">Opportunities</h1></div>
                <div class="col-md-8">
                    <div class="tab-controller">
                        <button class="btn btn-primary taskitem" id="current_opportunities"  onclick="openTask(event,'currentopportunitytask')">Current Opportunities</button>
                        <button class="btn btn-primary taskitem" id="new_opportunities" onclick="openTask(event,'newopportunitytask')">New Opportunity</button>
                        <button class="btn btn-primary taskitem" id="update_opportunities" onclick="openTask(event,'updateopportunitytask')">Update Opportunity</button>
                        <button class="btn btn-primary  taskitem" id="closed_opportunities" onclick="openTask(event,'closedopportunitytask')">Closed Opportunities</button>
                    </div>
                </div>
                <div class="title-underline"></div>
            </div>

            <div class="row">
                <div class="col-md-12 taskpanel">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="tasktitle">Current Opportunities</h3> <!-- Default Task title, do not change -->
                        </div>
                        <div class="col-md-8">
                            <div id="opportunitymsg" class="alert alert-danger statusmsg" style="display: none" >
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong><span id="errormsq2"></span></strong>
                            </div>
                        </div>
                    </div>
                    <form id="searchbydateForm" action="" method="post">
                    <div class="row">
                       
                        <div class="col-sm-2">
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" placeholder="From Date" id="fromdate" required="true">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar fa-lg" aria-hidden="true"  ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control datepicker date-range-filter" placeholder="To Date" id="todate" required="true">
                                <div class="input-group-addon" >
                                   <i class="fa fa-calendar fa-lg" aria-hidden="true"  ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary" name="searchdate" id="searchdate">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                         <div class="col-sm-2">
                             
                        </div>
                    
                    </div>
                    </form>
                    <div class="subtitle-underline"></div>

                    <!-- Current Opportunity Task pane -->
                    <div class="task" id="currentopportunitytask" style="display: block">
                        <div class="table-container">
                            <table class="table table-striped display nowrap" id="opportunitiestable">
                                <thead>
                                <tr>
                                <th>No</th><th>Client</th><th>Title</th><th>Description</th><th>Created On</th><th>Created By</th>
                                <th>Est. Value</th><th>Est. Closing</th><th>Stage</th><th>Status</th>
                                </tr>
                                </thead>
                                <tbody id="opportunities_crud">
                                </tbody>
                                <tfoot></tfoot>
                            </table>

                        </div>

                    </div>

                    <!-- New Opportunity Task pane -->
                    <div class="task" id="newopportunitytask">
                        <form action="" id="newopportunityform" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" name="client" id="client" class="form-control taskinput" placeholder="" required data-parsley-trigger="keyup" data-parsley-required-message="Client name is required!" autocomplete="off" autofocus="true"/>
                                        <label for="client">Client Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" name="contactperson" id="contactperson" class="form-control taskinput" placeholder="" required data-parsley-trigger="keyup" data-parsley-required-message="Contact person is required!"/>
                                        <label for="contactperson">Contact Person Full Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" name="phone" id="phone" class="form-control taskinput" placeholder="" required data-parsley-type="digits" data-parsley-trigger="keyup" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-required-message="Contact phone is required!"/>
                                        <label for="phone">Contact Phone Number</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" name="email" id="email" class="form-control taskinput" placeholder="" required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-required-message="Contact email is required!"/>
                                        <label for="email">Contact Email</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" name="address" id="address" class="form-control taskinput" placeholder="" required data-parsley-trigger="keyup" data-parsley-required-message="Client address is required!"/>
                                        <label for="address">Client Physical Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" name="opportune_title" id="opportune_title" class="form-control taskinput" placeholder="" required  data-parsley-trigger="keyup" data-parsley-required-message="Opportunity title is required!"/>
                                        <label for="opportune_title">Opportunity Title</label>
                                    </div>

                                    <div class="form-label-group">
                                        <textarea id="opportune_descrip" rows="3" class="form-control" name="opportune_descrip" required placeholder="a brief description of opportunity" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="1000" data-parsley-minlength-message="Come on! You need to enter at least a 20 character description..." data-parsley-validation-threshold="10" data-parsley-required-message="Brief description is required!" ></textarea>
                                        <!--<label for="opportune_descrip">Description (20 chars min, 100 max) </label>-->
                                    </div>

                                    <div class="form-label-group">
                                        <input type="text" name="opportune_value" id="opportune_value" class="form-control taskinput" placeholder="" required data-parsley-type="digits" data-parsley-trigger="keyup" data-parsley-required-message="Estimate value is required!" data-parsley-minlength="4"
                                               data-parsley-maxlength="10"/>
                                        <label for="opportune_value">Estimate Value</label>
                                    </div>

                                    <div class="form-label-group">
                                        <select class="form-control" name="opportun_currency" id="opportun_currency" required data-parsley-required="true" data-parsley-required-message="Currency is required" >
                                            <option value="">Select Currency</option>
                                            <option value="KES">KES</option>
                                            <option value="USD">USD</option>
                                            <option value="EUR">EUR</option>
                                        </select>
                                       <!-- <label for="opportun_currency">Currency</label> -->
                                    </div>

                                    <div class="form-label-group">
                                        <input type='date' class="form-control" name="datetimepicker4" id='datetimepicker4' required data-parsley-type="dateISO" placeholder="Estimated closure date" data-parsley-trigger="keyup" data-parsley-required-message="Estimate closure date is required!" data-parsley-min="<?php echo date('m/d/Y'); ?>"/>
                                        <label for="datetimepicker4">Estimate Closure Date</label>
                                    </div>

                                </div>
                            </div>
                            <div class="form-label-group">
                                <input class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" id="submit" value="Create"/>
                            </div>


                        </form>

                    </div>

                    <div class="task" id="updateopportunitytask" style="background-color: blue;">

                    </div>
                    <div class="task" id="closedopportunitytask" style="background-color: red;">

                    </div>
                </div>
            </div>
        </div>
   <!--  <div class="col-md-1"></div>-->
    </div>

<?php $__env->stopSection(); ?>
<div id="postdialogoverlay"></div>
<div id="dialogoverlay">

</div>

<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>

<!-- OPPORTUNITY TRAIL DIV-->
<div class="opportunity-trail" id="opportunity-trail" style="display: none; overflow-y: hidden;" >
    
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"> <h3 id="opportunity_title"></h3>  </div>
        <div class="col-md-1">
         
          <button class="btn btn-danger closebtn" onclick="closeButton()"><i class="fa fa-times" aria-hidden="true"></i></button>
        
        </div>
    </div>

    <div id="trailupdatemsg" class="alert alert-danger alert-block statusmsg" style="display: none">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> <span id="errormsq" class="text-success"></span></strong>
    </div>

    <div style="width:80%;height: 2px;border-radius: 4px;background-color: #0c0c0c;margin-left: auto;margin-right: auto "></div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5"><label>Client: </label> <label id="opport_client"></label></div>
        <div class="col-md-5"> <label>Created: </label> <span id="opport_createdon"></span></div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5"><label>Value: </label> <span id="opport_value"></span></div>
        <div class="col-md-5"> <label>Created By: </label> <span id="opport_createdby"></span></div>
        <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">  <label>Opportunity ID: </label> <span id="opportunityid"></span></div>
        <div class="col-md-5">  <label>Status: </label> <span id="opport_status"></span><br></div>
        <div class="col-md-1"></div>
    </div>

    <form action="" method="post" id="opportunitytrailform">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <label for="descript_area" style="display: inline-block; vertical-align: top;">Description: </label>
            <h5 name="descript_area" id="descript_area" class="form-control form-control-sm" style="display: inline-block; width: 380px;"  >

            </h5>
            <div style="width:100%;height: 1px;border-radius: 4px;background-color: lightgray;margin: 10px auto;"></div>
            <div class="row">
                <div class="col-md-3">
                    <label for="trailupdate" style="vertical-align: top;">Trail Event: </label>
                </div>
                <div class="col-md-9">
                   <textarea name="trailupdate" id="trailupdate" placeholder="Status Update" style="display: inline-block; width:380px;"class="form-control" cols="10" rows="3" required data-parsley-trigger="keyup" data-parsley-required-message="Status event is required!" data-parsley-minlength="20">
                        </textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="statusdate">Event Date:</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="date" name="statusdate" id="statusdate" required data-parsley-required-message="Event date is required!" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="stage" >Stage: </label>
                </div>
                <div class="col-md-9">
                    <select class="form-control form-control-sm" id="stage" name="stage" style=" display: inline-block; width: 380px;">
                        <option value=''>Select Stage --Optional--</option>
                        <option value='Future Requirement'>Future Requirement</option>
                        <option value='Met Stake Holders'>Met Stake Holders</option>
                        <option value='Sizing Done'>Sizing Done</option>
                        <option value='RFQ/RFP/Tendered'>RFQ/RFP/Tendered</option>
                        <option value='Tender/Quote Submitted'>Tender/Quote Submitted</option>
                        <option value='RFQ Follow-up'>RFQ Follow-up</option>
                        <option value='Negotiations'>Negotiations</option>
                        <option value='Awarded'>Awarded</option>
                        <option value='PO Received'>PO Received</option>
                        <option value='Material Purchase'>Material Purchase</option>
                        <option value='Implementation in Process'>Implementation in Process</option>
                        <option value='Sign-Off & Hand Over'>Sign-Off & Hand Over</option>
                        <option value='Invoiced'>Invoiced</option>
                        <option value='Payment Received'>Payment Received</option>
                        <option value='Reference Letter Received'>Reference Letter Received</option>
                        <option value='Lost'>Lost</option>
                        <option value='Cancelled/Dropped'>Cancelled/Dropped</option>
                    </select>
                    <div class="alert alert-success stage_msg" style="display:none; width: 97%;">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <span id="errormsq4" class="text-success"></span>
                    </div>
                </div>
                </div>

        </div>
        <div class="col-md-1"></div>
    </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <input type="submit" id="addtrailbtn" class="btn btn-primary" value="Add Trail"/>
                <input type="button" name="closeopportunitybtn" id="closeopportunitybtn" class="btn btn-success" value="Mark Closed" onclick="closeOpportunity()"/>
                <input type="button" id="viewhistory" class="btn btn-dark" value="View Trails" onclick="viewTrails()"/>
                <input type="button" class="btn btn-danger" id="deleteopport" name="deleteopport" onclick="deleteOpport()" value="Delete">
            </div>
            <div class="col-md-2"></div>
        </div>
    </form>
</div>

<div class="trailsview" id="trailsview" style="display: none; width: 1200px;height: auto; min-height: 400px; overflow-y: scroll">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"> <h3 id="opportunity_title2"></h3></div>
        <div class="col-md-1">
            <button class="btn btn-danger closebtn" onclick="closeButton()"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
    </div>
    <div style="width:80%;height: 2px;border-radius: 4px;background-color: #0c0c0c;margin-left: auto;margin-right: auto "></div>
    <div id="trailmsg" class="alert alert-danger alert-success statusmsg" style="display: none" >
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong><span id="errormsq3" class="text-success"></span></strong>
    </div>
    <div class="row">
       <!-- <div class="col-md-10"></div> -->
        <div class="trailstablediv">
            <table id="trailstable" class="table table-striped">
                <thead style="height: 10px; ">
                <tr>
                    <th></th><th>No</th><th>Status Event</th><th>Event Date</th><th>Updated By</th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>

</div>

<!--
<a href="#" class="tooltip">
    Tooltip
    <span>
       <strong>Most Light-weight Tooltip</strong><br />
        This is the easy-to-use Tooltip driven purely by CSS.
    </span>
</a>-->
<!--
  <div class="contact-data" id="talkbubble" style="display: none; z-index: 20;">
        <p>SOme data</p>
    </div>
-->

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/symphon3/symphonycrm/resources/views/shop/opportunities.blade.php ENDPATH**/ ?>