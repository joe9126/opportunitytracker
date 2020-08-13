  var clientslist=[]; var staffnames=[];

 $(document).ready(function(){
       $.ajax({
            url: 'clients/create',
            type: 'get',
             dataType: 'json',
            success:function(data){
                $.each(data,function(index,value){
                    clientslist.push(value.clientname);
                  //  alert(clientslist);
                });
            }
            });

       $.ajax({
           url:"getstaffs",
           type:"get",
           dataType:'json',
           success:function (data) {
             $.each(data, function (index, value) {
                 staffnames.push(value.name);
             });
           }
       })

 });


 $(function(){

     $("#client").autocomplete({
         source:function(request,response){
             var results = $.ui.autocomplete.filter(clientslist,request.term);
             response(results.slice(0,10));
         }
     });

     $("#fullname").autocomplete({
         source:function(request, response){
             var results = $.ui.autocomplete.filter(staffnames, request.term);
             response(results.slice(0,10));
         }
     });
 });

 $(document).ready(function(){
     $("#client").change(function(){
        // alert("The text has been changed.");
         $.ajax({
             url:"clients/show"+"/"+$(this).val(),
             type:"get",
             dataType: "json",
             data: $(this).val(),
             success:function (data) {
                // console.log(data);
                 if(data.length>0){
                     $("#contactperson").val(data[0].contact);
                     $("#phone").val(data[0].phone);
                     $("#email").val(data[0].email);
                     $("#address").val(data[0].address);
                 }

             },
             error:function (data) {

             }
         })
     });

     $("#fullname").change(function(){
         $.ajax({
             type:"get",
             url:"searchstaff/"+$("#fullname").val(),
             dataType:"json",
            success:function(data){
                 if(data.length>0){
                     $("#email").val(data[0].contact);
                    // $("#password").val(data[0].phone);
                     $("#email").val(data[0].email);
                     $("#usertype").val(data[0].usertype);
                     $("#usertype").change();

                 }
             }
         })
     });
 });


