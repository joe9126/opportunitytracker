<?php $__env->startSection('title'); ?>
    Dashboard - Prime CRM
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class=" container container-fluid userdashboard">
        <div class="row" style="height: 50px; padding-top: 5px; border-radius: 8px;">
            <div class="col-md-3 dashitem" style="border-left: 1px solid whitesmoke">
                <label>Unread Messages</label>
                <div class="messageholder" onclick="getMessages()"><label id="unread_msg">10</label></div>
            </div>
            <div class="col-md-3 dashitem">
                <label>Reminders</label>
                <div class="messageholder" onclick="getReminders()"><label id="reminder_msg">5</label></div>
            </div>
            <div class="col-md-3 dashitem">
                <label>Upcoming Event</label>
            </div>
            <div class="col-md-3 dashitem">
                <?php if(isset(Auth::user()->email)): ?>
                    <strong> Howdy, <?php echo e(ucfirst(Auth()->user()->name)); ?></strong>
                <?php else: ?>
                    <script>window.location="/";</script>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 tablets panel" style="border-right: 1px solid lightgray;">
                <div class="panel-heading" >
                     <?php if(Auth::user()->usertype ==="admin"): ?>
                        Opportunities Summary
                        <?php else: ?>
                        My Leads
                        <?php endif; ?>
                    </div>
                <div class="liner"></div>
                <table id="opport_summary" class="table table-striped">
                    <thead></thead>
                    <tbody id="summarytbody">
                    </tbody>
                </table>

            </div>
            <div class="col-md-8 tablets">
                  <div class="panel-heading" >Leads Preview</div>
                <div class="liner"></div>
                <table id="opport_general" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th><th>Created</th><th>Client</th><th>Title</th><th>Value</th><th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="generalopport_tbody">
                    </tbody>
                </table>
            </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<script>

</script>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/symphon3/symphonycrm/resources/views/user/dashboard.blade.php ENDPATH**/ ?>