<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexo - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
    }

    .w-25 {
        width: 25%;
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

    header table,
    header th,
    header td,
    footer table,
    footer th,
    footer td,
    .border-table table,
    .border-table th,
    .border-table td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    footer .head,
    header .head {
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    @page {
        size: A4;
        margin-top: 160px;
        margin-bottom: 60px;
    }

    header {
        position: fixed;
        top: -140px;
        left: 0;
        width: 100%;
        display: block;
    }

    footer {
        width: 100%;
        position: fixed;
        display: block;
        bottom: -40px;
        left: 0;
        font-size: 0.9rem;
    }

    footer td {
        text-align: center;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block tr {
        font-size: 0.8rem;
    }

    .inner-block .block {
        margin-bottom: 30px;
    }

    .inner-block .block-head {
        font-weight: bold;
        font-size: 1.1rem;
        padding-bottom: 5px;
        border-bottom: 2px solid #4274da;
        margin-bottom: 10px;
        color: #4274da;
    }

    .inner-block th,
    .inner-block td {
        vertical-align: baseline;
    }

    .table_bg {
        background: #4274da57;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                   Deviation Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://development.vidyagxp.com/public/user/images/logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong> Audit No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                    <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Department</th>
                        <td class="w-30">  @if($data->Initiator_Group){{ \Helpers::getInitiatorGroupFullName($data->Initiator_Group) }} @else Not Applicable @endif</td>
                        <th class="w-20">Department Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_code){{ $data->division_code }} @else Not Applicable @endif</td>
                        <th class="w-20"> Deviation Observed<</th>
                        <td class="w-30">@if($data->Deviation_date){{ $data->Deviation_date }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Observed by</th>
                        <td class="w-30">@if($data->Facility){{ $data->Facility }} @else Not Applicable @endif</td>
                        <th class="w-20">Deviation Reported On </th>
                        <td class="w-30">@if($data->Deviation_reported_date){{ $data->Deviation_reported_date }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Deviation Related To</th>
                        <td class="w-30">@if($data->audit_type){{ $data->audit_type }} @else Not Applicable @endif</td>
                        <th class="w-20"> Others</th>
                        <td class="w-30">@if($data->others){{ $data->others }}@else Not Applicable @endif</td>                       
                    </tr>
                    <tr>
                        <th class="w-20">Name of Product & Batch No</th>
                        <td class="w-30">@if($data->Product_Batch){{ ($data->Product_Batch) }} @else Not Applicable @endif</td>
                        <th class="w-20">Description of Deviation</th>
                        <td class="w-30">@if($data->Description_Deviation){{ $data->Description_Deviation }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30"> @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Immediate Action (if any)</th>
                        <td class="w-30">@if($data->Immediate_Action){{ $data->Immediate_Action }}@else Not Applicable @endif</td>
                        <th class="w-20">Preliminary Impact of Deviation</th>
                        <td class="w-30">@if($data->Preliminary_Impact){{ $data->Preliminary_Impact }}@else Not Applicable @endif</td>
                    </tr>
        

                </table>
               
            </div>


            <div class="block">
                <div class="head">
                    <div class="block-head">
                        HOD Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-30">HOD Remarks</th>
                            <td class="w-20">@if($data->HOD_Remarks){{ $data->HOD_Remarks }}@else Not Applicable @endif</td>
                        </tr>
                        <div class="border-table">
                            <div class="block-head">
                                HOD Attachments
                            </div>
                            <table>
            
                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Batch No</th>
                                </tr>
                                    @if($data->QA_attachments)
                                    @foreach(json_decode($data->Audit_file) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-20">Not Applicable</td>
                                </tr>
                                @endif
            
                            </table>
                        </div>
                             </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    QA Initial Review
                </div>
                <table>
                   
                    <tr>
                        <th class="w-20">Initial Deviation category</th>
                        <td class="w-30">@if($data->Deviation_category){{ ($data->Deviation_category) }}@else Not Applicable @endif</td>
                        <th class="w-20">Justification for categorization</th>
                        <td class="w-30">@if($data->Justification_for_categorization){{ $data->Justification_for_categorization }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Investigation Is required ?</th>
                        <td class="w-30">@if($data->Investigation_required){{ $data->Investigation_required }}@else Not Applicable @endif</td>
                        <th class="w-20">Relevant Guidelines / Industry Standards</th>
                        <td class="w-30">@if($data->Investigation_Details){{ $data->Investigation_Details }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Customer Notification Required ?</th>
                        <td class="w-30">@if($data->Customer_notification){{$data->Customer_notification}}@else Not Applicable @endif</td>
                        <th class="w-20">Customers</th>
                        <td class="w-30">@if($data->customers){{ $data->customers }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">QA Initial Remarks</th>
                        <td class="w-30">@if($data->QAInitialRemark){{$data->QAInitialRemark }}@else Not Applicable @endif</td>
                        
                    </tr>

                </table>
            </div>
            <div class="border-table">
                <div class="block-head">
                   File Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                        @if($data->Initial_attachment)
                        @foreach(json_decode($data->Initial_attachment) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                        @else
                    <tr>
                        <td class="w-20">1</td>
                        <td class="w-20">Not Applicable</td>
                    </tr>
                    @endif

                </table>
            </div>
            
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Investigation & CAPA
                    </div>
                    <table>

                                <tr>
                            
                                    <th class="w-20">Investigation Summary
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Investigation_Summary){{ $data->Investigation_Summary }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Impact Assessment</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Impact_assessment){{ $data->Impact_assessment }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Impact_assessment
                                    </th>
                                    <td class="w-80">
                                        <div>
                                            @if($data->Root_cause){{ $data->Root_cause }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                            
                                    <th class="w-20">CAPA Required ?</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->CAPA_Rquired){{ $data->CAPA_Rquired }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">CAPA Type?</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                            
                                    <th class="w-20">CAPA Description</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->CAPA_Description){{ $data->CAPA_Description }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Post Categorization Of Deviationt</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Post_Categorization){{ $data->Post_Categorization }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                            
                                    <th class="w-20">Revised Categorization Justification
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Investigation_Of_Review){{ $data->Investigation_Of_Review }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                 </table>
            </div>  
            <div class="border-table">
                <div class="block-head">
                    Investigation Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                        @if($data->Investigation_attachment)
                        @foreach(json_decode($data->Investigation_attachment) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                        @else
                    <tr>
                        <td class="w-20">1</td>
                        <td class="w-20">Not Applicable</td>
                    </tr>
                    @endif

                </table>
            </div>
            <div class="border-table">
                <div class="block-head">
                    CAPA Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                        @if($data->Capa_attachment)
                        @foreach(json_decode($data->Capa_attachment) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                        @else
                    <tr>
                        <td class="w-20">1</td>
                        <td class="w-20">Not Applicable</td>
                    </tr>
                    @endif

                </table>
            </div>
                
            <div class="block">
                <div class="block-head">
                    QA Final Review
                </div>
                <table>

                        <tr>
                        <th class="w-20">QA Feedbacks</th>
                        <td class="w-30">@if($data->QA_Feedbacks){{ $data->QA_Feedbacks }}@else Not Applicable @endif</td>
                        
                    </table>
                </div>
                <div class="border-table">
                    <div class="block-head">
                        QA Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File </th>
                        </tr>
                            @if($data->QA_attachments)
                            @foreach(json_decode($data->QA_attachments) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                        @endif

                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    QAH/Designee Approval
                </div>
                <table>

                        <tr>
                        <th class="w-20">Closure Comments</th>
                        <td class="w-30">@if($data->Closure_Comments){{ $data->Closure_Comments }}@else Not Applicable @endif</td>
                        <th class="w-20">Disposition of Batch</th>
                        <td class="w-30">@if($data->Disposition_Batch){{ $data->Disposition_Batch }}@else Not Applicable @endif</td>
                        
                    </table>
                </div>
                <div class="border-table">
                    <div class="block-head">
                        Closure Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File </th>
                        </tr>
                            @if($data->closure_attachment)
                            @foreach(json_decode($data->closure_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                        @endif

                    </table>
                </div>
            </div>        
                

            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">{{ $data->audit_schedule_by }}</td>
                        <th class="w-20">Submit On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        <th class="w-20">Submit Comments</th>
                        {{-- <td class="w-30">{{ $data }}</td> --}}
                    </tr>
                    <tr>
                        <th class="w-20">HOD Review Complete By</th>
                        <td class="w-30">{{ $data->cancelled_by}}</td>
                        <th class="w-20">HOD Review Complete On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_on) }}</td>
                        <th class="w-20">HOD Review Comments</th>
                        {{-- <td class="w-30">{{ $data-> }}</td> --}}
                    </tr>
                    <tr>
                        <th class="w-20">QA Initial Review Complete by</th>
                        <td class="w-30">{{ $data->audit_preparation_completed_by }}</td>
                        <th class="w-20">QA Initial Review Complete On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_preparation_completed_on) }}</td>
                        <th class="w-20">QA Initial Review Comments</th>
                        {{-- <td class="w-30">{{ $data-> }}</td> --}}
                    </tr>
                    <tr>
                        <th class="w-20">QA Final Review Complete By</th>
                        <td class="w-30">{{ $data->audit_mgr_more_info_reqd_by }}</td>
                        <th class="w-20">QA Final Review Complete On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_mgr_more_info_reqd_on) }}</td>
                        <th class="w-20">QA Final Review Comments</th>
                        {{-- <td class="w-30">{{ $data-> }}</td> --}}
                    </tr>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $data->audit_observation_submitted_by }}</td>
                        <th class="w-20">Approved ON</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_observation_submitted_on) }}</td>
                        <th class="w-20">Approved Comments</th>
                        {{-- <td class="w-30">{{ $data-> }}</td> --}}
                   


                </table>
            </div>
        </div>
    </div>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

</body>

</html>
