@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <div id="audit-trial">
        <div class="container-fluid">
            <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxP - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        /* min-width: 100vw; */
        min-height: 100vh;
    }

    .w-10 {
        width: 10%;
    }
  
    .w-20 {
        width: 20%;
    }

    .w-30 {
        width: 30%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .w-70 {
        width: 70%;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 90%;
    }

    .w-100 {
        width: 100%;
    }

    .h-100 {
        height: 100%;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    header .head {
        font-weight: bold;
        text-align: center;
        font-size: 1.2rem;
    }

    @page {
        size: A4;
        margin-top: 160px;
        margin-bottom: 60px;
    }

    header {
        /* position: fixed; */
        top: -140px;
        left: 0;
        width: 100%;
        display: block;
    }

    footer {
        /* position: fixed; */
        bottom: -40px;
        left: 0;
        width: 100%;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block .head {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .inner-block .division {
        margin-bottom: 10px;
    }

    .first-table {
        border-top: 1px solid black;
        margin-bottom: 20px;
    }

    .first-table table td,
    .first-table table th,
    .first-table table {
        border: 0;
    }

    .second-table td:nth-child(1)>div {
        margin-bottom: 10px;
    }

    .second-table td:nth-child(1)>div:nth-last-child(1) {
        margin-bottom: 0px;
    }

    .table_bg {
        background: #4274da57;
    }
    .heading{
        border: 1px solid black;
    padding: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
    background: #e6a226ba;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                Deviation Audit Trail
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://development.vidyagxp.com/public/user/images/logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table style="margin-top: 5px;">
            <tr>
                <td class="w-30">
                    <strong>Deviation Audit No.</strong>
                </td>
                <td class="w-40">
                   
                </td>
                <td class="w-30">
                    <strong>Record No. 000{{$document->record}}</strong> 
                </td>
            </tr>
        </table>
        <table>
        <div class="heading">
       <div style="margin-bottom: 5px;  font-weight: bold;"> Originator :{{ Auth::user()->name }}</div>
       <div style="margin-bottom: 5px; font-weight: bold;">Short Description : {{$document->short_description}}</div>
       <div style="margin-bottom: 5px;  font-weight: bold;">Due Status :  {{$document->due_date}}</div>
      
       </div>
        </div>
        </table>
        
    </header>

    <div class="inner-block">

        <!-- <div class="head">Extension Audit Trial Report</div> -->

        <div class="division">
        </div>

        
        <div class="second-table">
            <table>
                <tr class="table_bg">
                    <th>S.No</th>
                    <th>Changed From</th>
                    <th>Changed To</th>
                    <th>Data Field</th>
                    <th>Action Type</th>
                    <th>Performer</th>
                </tr>
                
                    <tr>
                        @foreach ($audit as $audits)
                        <td>1</td>
                        <!-- --------- -->
                        <td>
                       
                         <div><strong>Changed From :</strong>{{$audits->origin_state}}</div>
                       
                 </td>
                 <!-- ----------------------- -->
                        <td>
                         <div><strong>Changed To :</strong>{{$audits->current}}</div>
                         <div style="margin-top: 5px;"><strong>Comments :</strong> {{$audits->comment}}</div>   <!--Record Is send by Hod Review--->

                        </td>
                        <!-- ------Record Is send by Hod Review----------- -->
                        <td>
                        <div>
                     <strong> Data Field Name :</strong><a href="{{ url('DeviationAuditTrialDetails', $audits->id) }}">{{ $audits->activity_type }}</a> </div>
                      <div style="margin-top: 5px;">
                      <strong>Change From :</strong>{{$audits->origin_state}}</div>
                            <br>
                            <!--  -->
                      <div ><strong>Changed To :</strong>{{$audits->current}}</div> 
                            <div style="margin-top: 5px;"><strong>Change Type :</strong>{{$audits->action_name}}
                            </div>
                            <div style="margin-top: 5px;"><strong>Comments :</strong>{{$audits->comment}}</div>
                        </td>
                        <!--  -->
                        <td>
                        <div>
                       <strong> Action Name :</strong>{{$audits->action_name}}

                        </div>

                        </td>
                        <td>
                       <div ><strong> Peformed By :</strong>{{$audits->user_name}}</div>
                      <div style="margin-top: 5px;">  <strong>Performed On :</strong>{{$audits->created_at}}</div>
                       <div style="margin-top: 5px;"><strong> Comments :</strong>{{$audits->comment}}</div>

                        </td>
                    </tr>
                    @endforeach
<!-- ------------------------------------------------- -->
                    {{-- <tr>
                       
                        <td>2</td>
                        <td>
                       
                        <div><strong>Changed From :</strong>{{$audits->origin_state}}</div>

                 </td>
                        <td>
                        <div ><strong>Changed To :</strong>{{$audits->current}}</div>
                         <div style="margin-top: 5px;"><strong>Comments : {{$audits->comment}}</strong> Not Applicable</div>
                        </td>
                        <td>
                        <div style="margin-top: 5px;"><strong>Data Field Name :</strong>{{$audits->activity_type}}</div>
                       <div style="margin-top: 5px;"> <strong>Change From :</strong>{{$audits->origin_state}}</div>
                       <div style="margin-top: 5px;"> <strong>Changed To : </strong>{{$audits->current}}</div>
                        <div ><strong>Change Type :</strong>{{$audits->action_name}}</div>


                        </td>
                        <td>
                          <div><strong>Action Name :</strong>{{$audits->action_name}}</div> 
                        </td>
                        <td>
                        <div style="margin-top: 5px;"><strong> Peformed By :</strong>{{$audits->user_name}}</div>
                      <div style="margin-top: 5px;">  <strong>Performed On :</strong>{{$audits->created_at}}</div>
                       <div style="margin-top: 5px;"><strong> Comments :</strong>{{$audits->comment}}</div>

                        </td>
                    </tr>
               <!-- ---------------------------------------- -->
               <tr>
                       
                        <td>3</td>
                        <td>
                       
                        <div style="margin-top: 5px;"><strong>Changed From :</strong> HOD Review</div>
                        <div  style="margin-top: 5px;"><strong>Changed To :</strong> Hod REVIEW</div>
                        <div  style="margin-top: 5px;"><strong>Comments :</strong> Not Applicable</div>

                 </td>
                        <td>
                          <!-- <div><strong>Changed To :</strong> HOD Review</div> -->
                         
                        </td>
                        <td>
                        <div style="margin-top: 5px;"><strong>Data Field Name :</strong> Description</div>
                       <div style="margin-top: 5px;"> <strong>Change From :</strong> This is a test record</div>
                       <div style="margin-top: 5px;"> <strong>Changed To : </strong>This is a test record</div>
                        <div style="margin-top: 5px;"><strong>Change Type :</strong> Update</div>


                        </td>
                        <td>
                          <div><strong>Action Name :</strong> Remove </div> 
                        </td>
                        <td>
                        <div style="margin-top: 5px;"><strong> Peformed By :</strong> David</div>
                      <div style="margin-top: 5px;">  <strong>Performed On :</strong>16-Mar-2024</div>
                       <div style="margin-top: 5px;"><strong> Comments :</strong> Record sent for QA Review</div>

                        </td>
                    </tr> --}}
              
            </table>
        </div>

    </div>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> 
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> 
                </td>
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

</body>

</html>

        </div>
    </div>

    <div class="modal fade" id="activity-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">SOP-000{{ $document->id }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="info-list">
                        <div class="list-item">
                            <div class="head">Site/Division/Process</div>
                            <div>:</div>
                            <div>{{ $document->division }}/{{ $document->process }}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Document Stage</div>
                            <div>:</div>
                            <div>{{ $document->status }}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Originator</div>
                            <div>:</div>
                            <div>{{ $document->initiator }}</div>
                        </div>
                    </div>
                    <div id="auditTableinfo"></div>

                </div>

            </div>
        </div>
    </div>
    <script type='text/javascript'>
        $(document).ready(function() {

            $('#auditTable').on('click', '.viewdetails', function() {
                var auditid = $(this).attr('data-id');

                if (auditid > 0) {

                    // AJAX request
                    var url = "{{ route('audit-details', [':auditid']) }}";
                    url = url.replace(':auditid', auditid);

                    // Empty modal data
                    $('#auditTableinfo').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#auditTableinfo').append(response.html);

                            // Display Modal
                            $('#activity-modal').modal('show');
                        }
                    });
                }
            });

        });
    </script>
@endsection
