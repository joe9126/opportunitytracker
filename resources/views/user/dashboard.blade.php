@extends('layout.master')
@section('title')
    Dashboard - Prime CRM
@endsection
@section('content')

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
                @if(isset(Auth::user()->email))
                    <strong> Howdy, {{ ucfirst(Auth()->user()->name) }}</strong>
                @else
                    <script>window.location="/";</script>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 tablets panel" style="border-right: 1px solid lightgray;">
                <div class="panel-heading" >
                     @if(Auth::user()->usertype ==="admin")
                        Opportunities Summary
                        @else
                        My Leads
                        @endif
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

@endsection
<script>

</script>
