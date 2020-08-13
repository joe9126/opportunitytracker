 $body = $("body");
let opportunitytrailclone = $("#opportunity-trail").clone();

/*
    $(document).ajaxStart(function(){
      $("#loader").show();
  });

  $(document).ajaxComplete(function(){
       $("#loader").hide();
  });

  $(document).on({
      ajaxStart:function(){$body.addClass("loading");},
      ajaxStop: function(){$body.addClass("loading");}
  });
*/
  function invokeMenu(){
      $("#sidenavmenu").show();
  }

  $(document).ready(function(){
      $(opportunitySummary);

  });

 // HIDE SIDE MENU WHEN CLICK OUTSIDE IT
 $(document).mouseup(function(e){
     var container =  $("#sidenavmenu");
     if(!container.is(e.target)&& container.has(e.target).length === 0){
         container.hide();
     }
     $("#sidenavmenu").mouseleave(function(){
         container.hide();
     });
 });

function invokeLogout(){
      window.location.replace("/logout");
  }

//CHANGE URL
 $(document).ready(function(){
     $(".menuitem").click(function(e){
         e.preventDefault(); // prevent browser refresh
         var value = $(this).attr('id');
         window.location.replace(value); // it replaces id to url without refresh
         $(this).addClass('active').siblings().removeClass('active');
         $("#container").load(this.href, function(){
         });
     });

     //show tooltips
     $('[data-toggle="tooltip"]').tooltip();
 });

//HANDLE OPPORTUNITIES
 $(document).ready(function(){
     getCurrentopportunities();
     $(".taskitem").click(function(){
         var task = $(this).text();
         $(".tasktitle").text(task);
         $(".subtitle-underline").show();
     });
 });

 function openTask(event,taskid){
     var i;
  var x = document.getElementsByClassName("task");
  for( i=0; i<x.length;i++){
      x[i].style.display = "none";
      document.getElementById(taskid).style.display ="block";
      if(taskid==="currentopportunitytask"){
          getCurrentopportunities();
        //  alert("Fetching...");
      }
  }
}

 function adminTask(event,taskid){
     var i;
     var x = document.getElementsByClassName("admintask");
     for( i=0; i<x.length;i++){
         x[i].style.display = "none";
         document.getElementById(taskid).style.display ="block";

     }
 }

//OPPORTUNITY FORM
$(document).ready(function(){
 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#newopportunityform').parsley();

    $("#newopportunityform").on("submit", function(event){
        event.preventDefault();

        if($('#newopportunityform').parsley().isValid()){
            $.ajax({
                type:"POST",
                url:"/opportunities",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Submitting...');
                },
                success:function(data){
                    $("#opportunitymsg").show();
                    if(data.response>0){
                        $("#opportunitymsg").removeClass("alert-danger");
                        $("#opportunitymsg").addClass("alert-success");

                        $("#errormsq2").text("Opportunity created successfully!");

                      //  $("#opportunitymsg").css("display","block");

                        $('#newopportunityform')[0].reset();
                        $('#newopportunityform').parsley().reset();
                        $('#submit').attr('disabled', false);
                        $('#submit').val('Create');
                    }else{
                        $("#errormsq2").text("Something went wrong!");
                    }
                },error: function(data){
                   // console.log(data);
                }

            });

        }else{
            $(".opportunitymsg").show();
            $("#errormsq").html("Oops! Fill all the required fields");
        }
    });
});

 // GET CURRENT OPPORTUNITIES AJAX FUNCTION

 $(document).ready(function() {
     $('.tooltip').tooltipster();
 });

 function getCurrentopportunities(){

   //  $("#opportunitiestable").DataTable().destroy();

     $.ajax({
         type:"get",
         url:"opportunities/create",
         dataType:"json",
         success:function (data) {
            // console.log(data);
             var i=1;
             $("#opportunitiestable").DataTable({
                processing: true,
                dom:'Bfrtip',
                buttons:[
                         {
                            extend: 'excelHtml5',
                            title: 'Sales Leads'
                        },
                            {
                             extend: 'csvHtml5',
                            title: 'Sales Leads'
                            },
                            {
                             extend: 'copyHtml5',
                             title: 'Sales Leads'
                            },
                         {
                             extend: 'pdfHtml5',
                             title: 'Sales Leads'
                            }
                   // 'copy','csv','excel','pdf','print'
                 ],
                data: data,
                 createdRow: function(row,data,index){
                     $(row).attr('id',data.id).find('td').eq(1).attr('class','td-client');
                     $(row).attr('id',data.id).find('td').eq(2).attr('class','td-title');
                     $(row).attr('id',data.id).find('td').eq(3).attr('class','td-descrip');
                     $(row).attr('id',data.id).find('td').eq(4).attr('class','td-createdon');
                     $(row).attr('id',data.id).find('td').eq(5).attr('class','td-createdby');
                     $(row).attr('id',data.id).find('td').eq(6).attr('class','td-estvalue');
                     $(row).attr('id',data.id).find('td').eq(7).attr('class','td-estclosing');
                    // $(row).attr('id',data.id).find('td').eq(8).attr('class','td-contact');
                   //  $(row).attr('id',data.id).find('td').eq(8).attr('class','td-phone');
                   //  $(row).attr('id',data.id).find('td').eq(9).attr('class','td-email');
                     if(data.status==="Closed"){
                         $(row).attr('class','text-success');
                     }else{
                         $(row).attr('class','text-danger');
                     }
                     $(row).attr('id',data.id).find('td').eq(8).attr('class','td-stage');
                     $(row).attr('id',data.id).find('td').eq(9).attr('class','td-status');
                 },

                 columns:[
                     {mRender:function(){
                             return i++;
                         }},
                     {mRender:function(data,type,row){
                         var td = "<td> <a href='#' data-toggle='tooltip' class='comment' title='Contact Person: "+row.contactperson+" Phone: "+row.phone+" Email: "+row.email+"'>"+row.clientname+"</a> </td>";
                         return td;
                         }},
                     {data:"title"},
                     {data:"description"},
                     {mRender:function(data,type,row){
                             var createddate = row.created_at;
                           //  return moment(createddate).format("ddd Do MMM,YYYY");
                           return moment(createddate).format("YYYY-MM-DD HH:mm:ss");
                         }},
                     {data:"name"},
                     {mRender:function(data,type,row){
                             var opportunityvalue = parseFloat(row.estimatevalue);
                             return row.currency+" "+numeral(opportunityvalue).format("0,0.0");
                         }},
                     {mRender:function(data,type,row){
                             var estimateclosingddate = row.estimateclosuredate;
                             return moment(estimateclosingddate).format("ddd Do MMM,YYYY");
                         }},
                        /*{mRender:function(data,type,row){
                            var stage= row.stage;
                        }},*/
                     {data:"stage"},

                     {mRender:function(data,type,row){
                         var status = row.status;
                         if(status==="Closed"){
                             $("#opportunitiestable tbody tr").addClass('status-closed');

                         }else{
                             $("#opportunitiestable tbody tr").addClass('status-active');
                         }
                         return status;
                         }
                     }
                 ],
                 pageLength:10,
                 bLengthChange:false,
                 bAutoWidth:false,
                 autowidth:false,
                 bDestroy: true
             });

         } ,
         error:function () {      }
     });

 }


 $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip();

     $("#opportunitiestable").on("mouseenter","tbody tr",function(){
       //  alert("alert");
     // $(".CellComment").show();
     });

 });




//SHOW CONTACT PERSON DETAILS
 $(document).ready(function(){
     $(".CellWithComment").on("mouseover",function(){
         $(".CellComment").show();
         alert("pop");
     })
 })

 //LOAD OPPORTUNITIES ON THE DASHBOARD

 $(document).ready(function(){
     $.ajax({
         type:"get",
         url:"opportunities/create",
         dataType:"json",
         success:function(data){
             let i=1;
             $("#opport_general").DataTable({
                 data:data,
                 createdRow:function (row, data, index) {
                     $(row).attr('id',data.id).find('td').eq(1).attr('class','td-client');
                     $(row).attr('id',data.id).find('td').eq(2).attr('class','td-title');
                     $(row).attr('id',data.id).find('td').eq(3).attr('class','td-descrip');
                     $(row).attr('id',data.id).find('td').eq(4).attr('class','td-createdon');
                 },
                 columns:[
                     {mRender:function(data,type,row){
                         return i++;
                         }},
                     {mRender:function(data,type,row){
                             var createddate = row.created_at;
                             return moment(createddate).format("ddd Do MMM,YYYY");
                         }},
                     {data:"clientname"},
                     {data:"title"},
                     {mRender:function(data,type,row){
                             var opportunityvalue = parseFloat(row.estimatevalue);
                             return row.currency+" "+numeral(opportunityvalue).format("0,0.0");
                         }},
                     {data:"status"}
                 ],
                 pageLength:7,
                 bLengthChange:false,
                 bAutoWidth:false,
                 autowidth:false,
                 bDestroy: true,
                 bFilter:false

             });
         }
     });
 });




 $(document).on("click","table#opportunitiestable >tbody >tr",function(e){

     var winW = window.innerWidth;
     var winH = window.innerHeight;
     var dialogoverlay =  document.getElementById("dialogoverlay");
     var opportunity_trail =  document.getElementById("opportunity-trail");
   // style the dialog overlay window
     dialogoverlay.style.display = "block";
     dialogoverlay.style.height = winH+"px";
     dialogoverlay.style.width = winW+"px";
     opportunity_trail.style.display = "block";
     const opportunitytitle = $(this).closest('tr').find('td.td-title').text();
     const opportunityclient = $(this).closest('tr').find('td.td-client').text();
     const opportunitycreatedon = $(this).closest('tr').find('td.td-createdon').text();
     const opportunityvalue = $(this).closest('tr').find('td.td-estvalue').text();
     let opportunitycreatedby =  $(this).closest('tr').find('td.td-createdby').text();
    let opportunity_id = $(this).attr('id');
    let description =  $(this).closest('tr').find('td.td-descrip').text();
     let status =  $(this).closest('tr').find('td.td-status').text();
     $("#opportunity_title").text(opportunitytitle) ;
     $("#opport_client").text(opportunityclient) ;
     $("#opport_createdon").text(opportunitycreatedon) ;
     $("#opport_value").text(opportunityvalue) ;
     $("#opport_createdby").text(opportunitycreatedby) ;
     $("#opportunityid").text(opportunity_id);
       $("#opport_status").text(status);
     $("#descript_area").text(description);
 });


 $(document).on("click","#dialogoverlay",function(e){
     let dialogoverlay =  document.getElementById("dialogoverlay");
     let opportunity_trail =  document.getElementById("opportunity-trail");
     let trailsview =  document.getElementById("trailsview");
     trailsview.style.display = "none";
     dialogoverlay.style.display = "none";
     opportunity_trail.style.display = "none";
    $("#opportunity_trail").replaceWith(opportunitytrailclone);
    $(".statusmsg").hide();
    $("#stage").val(""); $(".stage_msg").hide();
 });


 //ADD OPPORTUNITY TRAIL
 $(document).ready(function(){
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $("#opportunitytrailform").parsley();
     $("#opportunitytrailform").on("submit",function(event){
         event.preventDefault();
         let opport_id =  $("#opportunityid").text();
         var eventdate = $("#statusdate").val();
         var trailupdate = $("#trailupdate").val();
         var opportunity_stage = $("#stage").val();

         if( $("#opportunitytrailform").parsley().isValid()){
             $.ajax({
                type:"post",
                url:"opportunities/addtrail",
                dataType:"json",
                data:{"opportunityid":opport_id,"event_trail":trailupdate,"trail_date":eventdate,"stage":opportunity_stage},
                success:function(response){
                    $("#trailupdatemsg").show();
                    if(response>0){
                        $("#trailupdatemsg").removeClass("alert-danger");
                        $("#trailupdatemsg").addClass("alert-success");
                        $("#errormsq").css({"color":"#20860C "});
                        $("#errormsq").html("Opportunity status event added successfully!");
                        $('#opportunitytrailform')[0].reset();
                        $('#opportunitytrailform').parsley().reset();
                        $('#addtrailbtn').attr('disabled', false);
                        $('#addtrailbtn').val('Add Trail');
                    }else{
                        $("#errormsq").addClass(".text-danger");
                        $("#errormsq").html("Something went wrong!");
                    }
                },
                 error: function(data){
                   // console.log(data);
                 }
             });
         }
     });
 });

 function viewTrails(){
     var opportunity_trail =  document.getElementById("opportunity-trail");
     opportunity_trail.style.display = "none";

     var trailsview =  document.getElementById("trailsview");
     trailsview.style.display = "block";
     $("#opportunity_title2").text($("#opportunity_title").text()+" | "+$("#opport_client").text());

     var opportunity_id = $("#opportunityid").text();

     $.ajax({
         type:"get",
         url:"opportunities/show/"+opportunity_id+"",
         dataType:"json",
         data:opportunity_id,
         success:function(data){
             let i=1;
             let opportunity_title =  $("#opportunity_title2").text();
            $("#trailstable").DataTable({
                processing: true,
                dom:'Bfrtip',
                buttons:[
                         {
                            extend: 'excelHtml5',
                            title: opportunity_title
                        },
                            {
                             extend: 'csvHtml5',
                            title: opportunity_title
                            },
                            {
                             extend: 'copyHtml5',
                             title: opportunity_title
                            },
                         {
                             extend: 'pdfHtml5',
                             title: opportunity_title
                            }
                   // 'copy','csv','excel','pdf','print'
                 ],
                data:data,
                createdRow: function(row,data,index){
                    $(row).attr('id',data.id).find('td').eq(0).attr('class','td-deletetrail');
                    $(row).attr('id',data.id).find('td').eq(1).attr('class','td-counter');
                    $(row).attr('id',data.id).find('td').eq(2).attr('class','td-statusevent');
                    $(row).attr('id',data.id).find('td').eq(3).attr('class','td-eventdate');
                    $(row).attr('id',data.id).find('td').eq(4).attr('class','td-updatedby');
                    },
                columns:[
                    {mRender:function (data,type,row) {
                        var deletebtn = "<button class='deletetrailbtn' onclick='deleteTrail($(this))'></button>"
                            return deletebtn;
                        }},
                    {mRender:function () {return i++; }},
                    {data:"event_trail"},
                    {mRender:function(data,type,row){
                            var createddate = row.trail_date;
                            return moment(createddate).format("ddd Do MMM,YYYY");
                        }},
                    {data:"name"}
                ],
                pageLength: 5,
                bLengthChange: false,
                bAutoWidth: false,
                bDestroy: true
            })
         }
     });
 }

 //DELETING OPPORTUNITY EVENT TRAIL
 function deleteTrail(row) {
    var commentid = row.closest('tr').attr('id');
    $.ajax({
        type:"post",
        url:"trail/destroy/"+commentid+"",
        dataType:"json",
        success:function(response){
            $("#trailmsg").show();
            $("#errormsq3").text(response.msg);
            if(response.status>0){
                $("#trailmsg").removeClass("alert-danger");
                row.closest('tr').remove();
            }else{
                $("#trailmsg").removeClass("alert-success");
                $("#errormsq3").removeClass("text-success");
                $("#errormsq3").addClass("text-danger");
            }
        },
        error:function(){}
    })
 }


 function getMessages(){
     let msgs = $("#unread_msg").text();
     if(msgs<1){
         alert("No new Messages for  now");
     }else{
         alert("Messages underway");
     }
 }
 function getReminders() {
     let msgs = $("#unread_msg").text();
     if(msgs<1){
         alert("No new Messages for  now");
     }else{
         alert("Messages underway");
     }
 }

 function opportunitySummary(){
     $.ajax({
         type:"get",
         url:"opportunities/summary",
         dataType:"json",
         success:function(data){
             //console.log(data);
             let tbody = "<tr><td>Total Opportunities</td> <td>"+numeral(data[0].total_opport).format('0,000')+"</td></tr>" +
                 "<tr><td> New This Week</td> <td>"+numeral(data[0].New_This_Week).format('0,000')+"</td></tr>" +
                 " <tr><td> Ongoing</td> <td>"+data[0].Ongoing+"</td></tr>" +
                 "<tr><td>  Closed</td> <td>"+data[0].All_Closed+"</td></tr>" +
                 "<tr><td>  Top Value</td> <td>"+data[0].max_currency+' '+ numeral(data[0].max_value).format('0,000.00')+"</td></tr>";
             $("#summarytbody").append(tbody);
         },
         error:function(data){
            // console.log(data);
         }
     });
 }




 function closeOpportunity(){

     let opportunity_id = $("#opportunityid").text();
     $.ajax({
         type:"post",
         url:"opportunities/update/"+opportunity_id+"",
         dataType:"text",
         beforeSend:function () {
            $('#closebtn').attr('disabled', 'disabled');
           $('#closebtn').val('Submitting...');
         },
         data:{"opportunity_id":opportunity_id},
         success:function(response){
           //  console.log("response is "+response);
             $("#trailupdatemsg").show();
             if(response ==="1"){
                 $("#trailupdatemsg").removeClass("alert-danger");
                 $("#trailupdatemsg").addClass("alert-success");
                 $("#errormsq").css({"color":"#20860C "});
                 $("#errormsq").html("Opportunity closed successfully!");

                 $('#closebtn').attr('disabled', false);
                 $('#closebtn').val('Mark Closed');
             }else{
                 $("#trailupdatemsg").removeClass("alert-success");
                 $("#trailupdatemsg").addClass("alert-danger");
               //  $("#errormsq").css({"color":"");
                 $("#errormsq").addClass(".text-danger");
                 $("#errormsq").html("Opportunity is already closed!");
             }
         }
     });
 }

 //CREATE USER FORM SUBMISSION

 $(document).ready(function(){
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     $("#createuserform").parsley();
     $("#createuserform").on("submit",function(event){
         event.preventDefault();
         if($("#createuserform").parsley().isValid()){
            $.ajax({
                type:"post",
                url:"createuser",
                dataType:"json",
                data:$(this).serialize(),
                beforeSend:function(){
                    $('#createuserbtn').attr('disabled', 'disabled');
                    $('#createuserbtn').val('Creating User...');
                },
                success:function(data){
                    $("#createusermsg").show();
                   // console.log(data);
                    $('#createuserbtn').attr('disabled', false);
                    $('#createuserbtn').val('Save');
                    if(data.status>0){
                        $("#createusermsg").removeClass("alert-danger");
                        $("#createusermsg").addClass("alert-success");
                        $("#errormsq").removeClass("text-danger");
                        $("#errormsq").addClass("text-success");
                        $("#errormsq").html(data.msg);
                        $("#createuserform").parsley().reset();
                        $("#createuserform")[0].reset();
                    }else{

                        $("#createusermsg").removeClass("alert-success");
                        $("#createusermsg").addClass("alert-danger");
                        $("#errormsq").removeClass("text-success");
                        $("#errormsq").addClass(".text-danger");
                        $("#errormsq").html(data.msg);
                    }
                },
                error:function(data){
                    $('#createuserbtn').attr('disabled', false);
                    $('#createuserbtn').val('Create User');
                    $("#createusermsg").show();
                    $("#createusermsg").removeClass("alert-success");
                    $("#createusermsg").addClass("alert-danger");
                    $("#errormsq").html("An error occured! Try again");
                }
            });
         }
     })
 });

// UPDATE USER DETAILS
 $(document).ready(function(){
     $("#updateuserbtn").on("click",function(){
        // alert("upcoming");
        let fullname = $("#name").val();
        let email =$("#email").val();
        let password = $("#password").val();
        let usertype = $("#usertype").val();
         $.ajax({
             type:"post",
             url:"edituser",
             dataType:"json",
             data:{fullname:fullname,email:email, password:password,usertype:usertype},
             beforeSend:function(){
                 $('#updateuserbtn').val('Updating...');
                 $('#updateuserbtn').attr('disabled', 'disabled');
             },
             success:function(response){
                 $('#updateuserbtn').attr('disabled', false);
                 $('#updateuserbtn').val('Edit');
                 $("#createusermsg").addClass("alert-success");
                 $("#errormsq").addClass("text-success");
                 $("#createusermsg").show();
               //  console.log(response);
                 if(response.status>0){
                     $("#createusermsg").removeClass("alert-danger");

                     $("#errormsq").removeClass("text-danger");
                     $("#errormsq").removeClass("text-danger");
                     $("#errormsq").html(response.msg);
                     $("#createuserform").parsley().reset();
                     $("#createuserform")[0].reset();
                 }else{
                     $("#createusermsg").removeClass("alert-success");
                     $("#errormsq").removeClass("text-success");
                     $("#errormsq").text("No update done!");
                 }
             }
         })
     });
 })

$(document).ready(function(){
    $("#stage").change(function(){
     // alert($(this).val()+" ID: "+$("#opportunityid").text()) ;
        $.ajax({
            type:"post",
            url:"updatestage/"+$("#opportunityid").text(),
            dataType:"text",
            data:{"stage":$(this).val()},
            success:function(status){
                $(".stage_msg").show();
                if(status>0){
                    $("#errormsq4").text("Opportunity stage updated!");
                }
            }
        });
    })
})

$(document).ready(function(){
    $("#searchbydateForm").on("submit", function(event){
        event.preventDefault();
        if($("#searchbydateForm").parsley().isValid()){
          // Extend dataTables search
 
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
            var min = moment(new Date($('#fromdate').val()).toISOString()).format("YYYY-MM-DD");
             //min = min+" 00:00:00";
            var max =  moment($('#todate').val()).format("YYYY-MM-DD");
            //max = max+" 23:59:59";

            console.log("max date:"+max+" min date "+min);
  //   //////console.log("min date: "+min+" max date "+max);
            var createdAt = data[4] || 0; //  date column in the table
   // //////console.log("table date: "+createdAt);
  
             if (
                 (min === "" || max === "")||(moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
                 ) {
                        return true;
                    }
            return false;
            }
            );

          $("#opportunitiestable").DataTable().draw();

// Re-draw the table when a date range filter changes
/*$('#searchdate').click(function() {
  $("#opportunitiestable").DataTable().draw();
});*/

$('#opportunitiestable_filter').hide(); 


     }

    });
});


$(document).ready(function(){
    $("#printbtn").click(function(){
        alert("comming soon!");
    })
})
 function closeButton(){
        $("#opportunity-trail").hide();
        $("#dialogoverlay").hide();
        $("#trailsview").hide();
        }
 function deleteOpport(){
     var itemid = $("#opportunityid").text();
     Confirm.render("Delete  this sales lead?","itemdelete",itemid);
 }   
 
 

function confirmDialog(){
    this.render = function(dialog,op,data){
        ////console.log("confirmation dialog initiated.");
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay =  document.getElementById("dialogoverlay");
         var postdialogoverlay =  document.getElementById("postdialogoverlay");
        var dialogbox = document.getElementById("dialogbox");
        
        // style the dialog overlay window
        dialogoverlay.style.display = "block";
         dialogoverlay.style.height = winH+"px";
          dialogoverlay.style.width = winW+"px";
          
         postdialogoverlay.style.display = "block";
         postdialogoverlay.style.height = winH+"px";
          postdialogoverlay.style.width = winW+"px";
          
          //Style the dialog box;
           dialogbox.style.left = (winW/2) - (550 * .5)+"px";
           dialogbox.style.top = "200px";
           dialogbox.style.display = "block";
           
     document.getElementById("dialogboxhead").innerHTML = "Confirm";
     document.getElementById("dialogboxbody").innerHTML = dialog;
   document.getElementById('dialogboxfoot').innerHTML = '<button class="okBtn" onclick="Confirm.yes(\''+op+'\',\''+data+'\',)">Yes</button> <button class="noBtn" onclick="Confirm.no()">No</button>';
  $(".okBtn").focus();
    };
    
    this.no = function(){
        document.getElementById("dialogbox").style.display = "none";
        document.getElementById("dialogoverlay").style.display = "none";
          document.getElementById("postdialogoverlay").style.display = "none";
       
    };

this.yes = function(op,data){
     document.getElementById("dialogbox").style.display = "none";
        document.getElementById("dialogoverlay").style.display = "none";
          document.getElementById("postdialogoverlay").style.display = "none";
           //alert(" opportunity id:"+data);
    if(op ==="itemdelete"){
        $.ajax({
            type:"post",
            data:{"opportunityID":data},
            dataType:"text",
            url:"deleteopportunity",
            success:function(response){
                if(response>0){
                $("#trailupdatemsg").show();
                 $("#trailupdatemsg").removeClass("alert-danger");
                  $("#trailupdatemsg").addClass("alert-success");
                $("#errormsq").removeClass("text-danger");
                $("#errormsq").addClass("text-success");
                $("#errormsq").text("Opportnity deleted successfully!");
                getCurrentopportunities();
                }
            }
        })
              
      
    }  

};
}
var Confirm = new confirmDialog();
        