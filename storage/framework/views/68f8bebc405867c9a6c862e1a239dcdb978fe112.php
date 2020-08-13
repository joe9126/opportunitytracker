<div class="navbar" id="navbar">
    <div class="menuicon" onclick='invokeMenu();'>
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
    <!--<button id='invokemenu' onclick='invokeMenu();'>Menu</button> -->
    <a class="menuitem" href="javascript:void(0);" id="dashboard">Dashboard</a>
    <a class="menuitem" id="opportunities" href="javascript:void(0);">Sales Leads</a>
    <a class="menuitem" href="javascript:void(0);" id="news">SLAs</a>
    <a class="menuitem" id="aboutus" href="javascript:void(0);">CSRs </a>

    <div class="menusitename"><span id="sitenamelabel">Symphony CRM </span> </div>
    <div class="searchbardiv"><input type="text" class="form-control ui-autocomplete-input" placeholder="Search..." id="mainsearchvideos" name="mainsearchvideos" autocomplete="off" autofocus="true"/></div>

    <div class="userlogbtndiv">
        <?php if(Auth::check()): ?>
           <div class="usericon"> <a id="logoutlink" href="<?php echo e(url('/logout')); ?>"><i class="far fa-user"> Logout</i></a> </div>
                <ul class="logoutmenu">
                    <div class="loggeduserdiv" >
                        <div class="userimage"><i class="far fa-user"></i></div>
                        <div class="staffdpname"><?php echo e(ucfirst(Auth()->user()->email)); ?></div>
                        <input type="button" id="userlogoutbtn" value="Signout" onclick='destroySession();'/>
                    </div>
                </ul>
            </div>
        <?php else: ?>
            <button id='invokelogin' onclick='invokeLogin();'style='display: none'>Login</button>
        <?php endif; ?>
    </div>

</div>
<?php echo $__env->make('partials.sidenavmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/symphon3/symphonycrm/resources/views/partials/header.blade.php ENDPATH**/ ?>