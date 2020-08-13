<div class="navbar" id="navbar">
    <div class="menuicon" onclick='invokeMenu();'>
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
    <!--<button id='invokemenu' onclick='invokeMenu();'>Menu</button> -->
    <!-- <a class="menuitem" href="javascript:void(0);" id="home">Home</a>
     <a class="menuitem" id="videos" href="javascript:void(0);">Videos</a>
     <a class="menuitem" href="javascript:void(0);" id="news">News</a>
     <a class="menuitem" id="aboutus" href="javascript:void(0);">About Us </a>-->
    @if(isset(Auth::user()->email))
    <div class="dropdown">
        <button class="adminmenubutton">Admin</button>
        <ul class="adminmenu">
            <li class="adminmenuitem"><a class="menuitem" id="postvideo" href="javascript:void(0);">Post Video</a></li>
            <li class="adminmenuitem"><a class="menuitem" id="authpost" href="javascript:void(0);">Authorise Post</a></li>
            <li class="adminmenuitem"><a class="menuitem" id="settings" href="javascript:void(0);">Settings </a></li>
        </ul>
    </div>
    @endif

    <div class="menusitename">FARMCART</div>
    <div class=" searchbardiv"><input type="text" class="form-control ui-autocomplete-input" placeholder="Search..." id="mainsearchvideos" name="mainsearchvideos" autocomplete="off" autofocus="true"/></div>
    <div class="userlogbtndiv">

        <div class="col-sm-6 userlogdiv">
            <i class='far fa-user' style='font-size:36px'></i>
            <button id='invokelogin' onclick='invokeLogin();'style='display: none'>Login</button>
            <div class="logoutbtndiv">
                <button id='invokelogout'  style='display: none;'>Logout</button>
                <ul class="logoutmenu">
                    <div class="loggeduserdiv" >
                        <div class="userimage"></div>
                        <div class="staffdpname">
                            @if(isset(Auth::user()->email))
                            Auth::user()->email
                            @endif
                        </div>
                        <input type="button" id="userlogoutbtn" value="Signout" onclick='destroySession();'/>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 cartdiv" >
            <div class="cart-items">0</div>
            <i class="fa fa-shopping-cart" style="font-size:36px"></i>
        </div>



    </div>

</div>
