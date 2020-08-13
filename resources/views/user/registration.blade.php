@extends('layout.master')
@section('title')
    Administration - PrimeCRM
    @endsection

@section('content')

<div class="container container-fluid userdashboard">
    <div class="row pageheading">
        <div class="col-md-4"><h1 class="pagetitle">ADMINISTRATION</h1></div>
        <div class="col-md-8">
            <div class="tab-controller">
                <button class="btn btn-primary taskitem" id="manage_accounts"  onclick="adminTask(event,'manageaccountstask')">Manage Accounts</button>
                <button class="btn btn-primary taskitem" id="manage_clients" onclick="adminTask(event,'newopportunitytask')">Manage Clients</button>
                <button class="btn btn-primary taskitem" id="update_opportunities" onclick="adminTask(event,'updateopportunitytask')">Manage Opportunities</button>
            </div>
        </div>
        <div class="title-underline"></div>
        <div class="admintask" id="manageaccountstask" style="display: block;">
          <div class="row">
              <div class="col-md-4">
                  <h4>Create Account</h4>
                  <div class="liner"></div>
                  <div id="createusermsg" class="alert alert-danger alert-success statusmsg">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong><span id="errormsq" class="text-success text-danger"></span></strong>
                  </div>

                  <form action="" method="post" id="createuserform">
                      {{ csrf_field() }}
                      <div class="form-label-group">
                          <input type="text" id="fullname" name="fullname" class="form-control signup" placeholder="Full name"  required data-parsley-trigger="keyup" data-parsley-required-message="Full name is required!" autofocus autocomplete="off"/>
                          <label for="fullname">Full Name</label>
                      </div>
                      <div class="form-label-group">
                          <input type="email" name="email" id="email" class="form-control signup" placeholder="Email address" required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-required-message="Email address is required!">
                          <label for="email">Email address</label>
                      </div>

                      <div class="form-label-group">
                          <input type="password" name="password" id="password" class="form-control signup" placeholder="Password" required data-parsley-length="[4,16]" data-parsley-trigger="keyup" data-parsley-required-message="Password is required!">
                          <label for="password">Password</label>
                      </div>
                      <div class="form-label-group">
                          <select class="form-control signup" id="usertype" name="usertype" required data-parsley-required="true" data-parsley-required-message="User role is required">
                              <option value="">Select Role</option>
                              <option value="user">User</option>
                              <option value="admin">Admin</option>
                          </select>
                      </div>
                      <div class="form-label-group">
                         <input class="btn btn-lg btn-success btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" id="createuserbtn" value="Create"/>
                          <input class="btn btn-lg btn-info btn-block btn-login text-uppercase font-weight-bold mb-2" type="button" id="updateuserbtn" value="Edit"/>
                          <input class="btn btn-lg btn-danger btn-block btn-login text-uppercase font-weight-bold mb-2" type="button" id="deleteuserbtn" value="Delete"/>
                      </div>

                  </form>

              </div>
              <div class="col-md-8" >
                  <h4>User Account</h4>
                  <div class="liner"></div>
                  <div class="table-container">
                      <table id="userstable"></table>
                  </div>


              </div>
          </div>
        </div>
        <div class="admintask" id="newopportunitytask" style="background-color: blue"></div>
         <div class="admintask" id="updateopportunitytask" style="background-color: green"></div>

    </div>


</div>
@endsection
