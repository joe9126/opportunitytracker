<div id="sidenavmenu" style="display: none;">
    <div class="menulinerdiv"></div>
    <h3 id="systemname">Prime CRM</h3>
  <!--  <ul class="ul-sidemenu">
        <li class="li-sidemenu">Home</li>
        <li class="li-sidemenu">Videos</li>
        <li class="li-sidemenu">News</li>
        <li class="li-sidemenu">About Us</li>
    </ul>-->

    <div class="newusersignup">
        @if(Auth::user()->usertype ==="admin")
            <h3 style="color: white;">Admin Roles</h3> <br>
            <a class="menuitem" id="manageaccounts" href="javascript:void(0)"><i class="fas fa-user"></i> Manage Users</a>&nbsp;&nbsp;
            @else
            <h5 style="color: white;">Manage Your Account</h5> <br>
            <span class="textspan" onclick="invokeLogin()">Change Password</span>&nbsp;&nbsp;

            @endif
    </div>

    <div class="loggedinuser">
        <div id="usericondiv"></div>
        <div class="staffnamediv">
            @if(isset(Auth::user()->email))
                <div class="row">
                    <div class="col-lg-4 col-md-3">
                        <span class="textspan" onclick="invokeLogout()"><i class="fas fa-user"></i> Logout</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-lg-8 col-md-9">
                       <h5> {{ucfirst(Auth()->user()->name)}}</h5>
                    </div>
                </div>
              @else
                <span class="textspan" onclick="invokeLogin()"> Login</span>&nbsp;&nbsp;
                <span class="textspan"><a class="textspan" href="{{url('signup')}}}">Signup</a></span>
            @endif
        </div>
    </div>
</div>
