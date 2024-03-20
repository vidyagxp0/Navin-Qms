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
         <
            <div class="block">
                    <div class="block-head">
                        HOD Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-30">HOD Remarks</th>
                            <td class="w-20">@if($data->HOD_Remarks){{ $data->HOD_Remarks }}@else Not Applicable @endif</td>
                        </tr>
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
                    QA Initial Attachments
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
                      CFT
                    </div>
                    <div class="head">
                        <div class="block-head">
                            Production
                        </div>
                     <table>

                                <tr>
                            
                                    <th class="w-20">Production Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Production_Review){{ $data->Production_Review }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Production Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Production_person){{ $data->Production_person }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                            
                                    <th class="w-20">Impact Assessment (By Production)</</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Production_assessment){{ $data->Production_assessment }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Production Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Production_feedback){{ $data->Production_feedback }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                            
                                    <th class="w-20">Production Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->Production_Review_Completed_By){{ $data->production_by }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Production Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if($data->production_on){{ $data->production_on }}@else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                               
                    </table>
                 </div>  
            <div class="border-table">
                <div class="block-">
                    Production Attachments 
                </div>                                     
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                        @if($data->production_attachment)
                        @foreach(json_decode($data->production_attachment) as $key => $file)
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
                        Warehouse
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Warehouse Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Warehouse_review){{ $data->Warehouse_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Warehouse Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Warehouse_notification){{ $data->Warehouse_notification }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Warehouse)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Warehouse_assessment){{ $data->Warehouse_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Warehouse Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Warehouse_feedback){{ $data->Warehouse_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Warehouse Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Warehouse_by){{ $data->Warehouse_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Warehouse Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Warehouse_Review_Completed_On){{ $data->Warehouse_Review_Completed_On }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Production Attachments 2
                    </div>                                    
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Warehouse_attachment)
                            @foreach(json_decode($data->Warehouse_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Quality Control
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Quality Control Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Quality_review){{ $data->Quality_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Control Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Quality_Control_Person){{ $data->Quality_Control_Person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Quality Control)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Quality_Control_assessment){{ $data->Quality_Control_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality_Control_feedback Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Quality_Control_feedback){{ $data->Quality_Control_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Quality Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->QualityAssurance__by){{ $data->QualityAssurance__by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality_Control_feedback Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Quality_Control_on){{ $data->Quality_Control_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Quality_Control_feedback Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Quality_Control_attachment)
                            @foreach(json_decode($data->Quality_Control_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Quality Assurance
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Quality Assurance Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Quality_Assurance){{ $data->Quality_Assurance }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->QualityAssurance_person){{ $data->QualityAssurance_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Quality Assurance)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->QualityAssurance_assessment){{ $data->QualityAssurance_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality_Assurance_feedback Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Quality_Assurance_feedback){{ $data->Quality_Assurance_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Quality Assurance Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->QualityAssurance_by){{ $data->QualityAssurance_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Review Completed  On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->QualityAssurance_on){{ $data->QualityAssurance_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Quality Assurance Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Quality_Assurance_attachment)
                            @foreach(json_decode($data->Quality_Assurance_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Engineering 
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Engineering Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Engineering_review){{ $data->Engineering_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Engineering Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Engineering_person){{ $data->Engineering_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Engineering)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Engineering_assessment){{ $data->Engineering_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Engineering Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Engineering_feedback){{ $data->Engineering_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Engineering Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Engineering_by){{ $data->Engineering_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Engineering Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Engineering_on){{ $data->Engineering_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Engineering Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Engineering_attachment)
                            @foreach(json_decode($data->Engineering_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Analytical Development Laboratory
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Analytical Development Laboratory Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Analytical_Development_review){{ $data->Analytical_Development_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Analytical Development Laboratory Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Analytical_Development_person){{ $data->Analytical_Development_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Analytical Development Laboratory)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Analytical_Development_assessment){{ $data->Analytical_Development_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Analytical Development Laboratory  Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Analytical_Development_feedback){{ $data->Analytical_Development_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Analytical Development Laboratory Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Analytical_Development_by){{ $data->Analytical_Development_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Analytical Development Laboratory Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Analytical_Development_on){{ $data->Analytical_Development_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Analytical Development Laboratory Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Analytical_Development_attachment)
                            @foreach(json_decode($data->Analytical_Development_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Process Development Laboratory / Kilo Lab
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Process Development Laboratory / Kilo Lab Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Kilo_Lab_review){{ $data->Kilo_Lab_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Process Development Laboratory / Kilo Lab Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Kilo_Lab_person){{ $data->Kilo_Lab_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Process Development Laboratory / Kilo Lab)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Kilo_Lab_assessment){{ $data->Kilo_Lab_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Process Development Laboratory / Kilo Lab  Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Kilo_Lab_feedback){{ $data->Kilo_Lab_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Process Development Laboratory / Kilo Lab Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Kilo_Lab_attachment_by){{ $data->Kilo_Lab_attachment_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Process Development Laboratory / Kilo Lab Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Kilo_Lab_attachment_on){{ $data->Kilo_Lab_attachment_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Process Developmen
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Kilo_Lab_attachment)
                            @foreach(json_decode($data->Kilo_Lab_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Technology Transfer / Design 
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Technology Transfer / Design Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Technology_transfer_review){{ $data->Technology_transfer_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Technology Transfer / Design Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Technology_transfer_person){{ $data->Technology_transfer_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Technology Transfer / Design)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Technology_transfer_assessment){{ $data->Technology_transfer_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Technology Transfer / Design Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Technology_transfer_feedback){{ $data->Technology_transfer_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Technology Transfer / Design Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Technology_transfer_by){{ $data->Technology_transfer_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Technology Transfer / Design Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Technology_transfer_on){{ $data->Technology_transfer_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Technology Transfer / Design Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Technology_transfer_attachment)
                            @foreach(json_decode($data->Technology_transfer_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Environment, Health & Safety 
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Environment, Health & Safety Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Environment_Health_review){{ $data->Environment_Health_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Environment, Health & Safety Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Environment_Health_Safety_person){{ $data->Environment_Health_Safety_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By  Environment, Health & Safety)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Health_Safety_assessment){{ $data->Health_Safety_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Environment, Health & Safety Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Health_Safety_feedback){{ $data->Health_Safety_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Environment, Health & Safety Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->production_by){{ $data->Human_Resource_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Environment, Health & Safety Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Human_Resource_on){{ $data->Human_Resource_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Environment, Health & Safety Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Human_Resource_attachment)
                            @foreach(json_decode($data->Human_Resource_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Human Resource & Administration 
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Human Resource & Administration Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Human_Resource_review){{ $data->Human_Resource_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Human Resource & Administration Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Human_Resource_person){{ $data->Human_Resource_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Human Resource & Administration)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Human_Resource_assessment){{ $data->Human_Resource_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Human Resource & Administration Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Human_Resource_feedback){{ $data->Human_Resource_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Human Resource & Administration Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Human_Resource_by){{ $data->production_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Human Resource & Administration Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->production_on){{ $data->production_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Human Resource & Administration Attachments 
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
            </div> 
            ---
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Information Technology
 
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Information Technology Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Information_Technology_review){{ $data->Information_Technology_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Information Technology Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Information_Technology_person){{ $data->Information_Technology_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Information Technology)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Information_Technology_assessment){{ $data->Information_Technology_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Information Technology Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Information_Technology_feedback){{ $data->Information_Technology_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Information Technology Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Information_Technology_by){{ $data->Information_Technology_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Information Technology Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Information_Technology_on){{ $data->Information_Technology_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Information Technology Attachments 
                     </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Information_Technology_attachment)
                            @foreach(json_decode($data->Information_Technology_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Project Management
 
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Project Management Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Project_management_review){{ $data->Project_management_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Project Management Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Project_management_person){{ $data->Project_management_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Project Management)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Project_management_assessment){{ $data->Project_management_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Project Management Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Project_management_feedback){{ $data->Project_management_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Project Management Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Project_management_by){{ $data->Project_management_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Project Management Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Project_management_on){{ $data->Project_management_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Project Management Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Project_management_attachment)
                            @foreach(json_decode($data->Project_management_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Other's 1 ( Additional Person Review From Departments If Required)
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Other's 1 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other1_review){{ $data->Other1_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 1 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other1_person){{ $data->Other1_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 1 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other1_Department_person){{ $data->Other1_Department_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Other's 1)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other1_assessment){{ $data->Other1_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 1 Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other1_feedback){{ $data->Other1_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Other's 1 Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other1_by){{ $data->Other1_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 1 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other1_on){{ $data->Other1_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Other's 1 Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Other1_attachment)
                            @foreach(json_decode($data->Other1_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Other's 2 ( Additional Person Review From Departments If Required)
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Other's 2 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other2_review){{ $data->Other2_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 2 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other2_person){{ $data->Other2_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 2 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other2_Department_person){{ $data->Other2_Department_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Other's 2)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other2_assessment){{ $data->Other2_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 2 Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other2_feedback){{ $data->Other2_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Other's 2 Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other2_by){{ $data->Other2_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 2 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other2_on){{ $data->Other2_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Other's 2 Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Other2_attachment)
                            @foreach(json_decode($data->Other2_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Other's 3 ( Additional Person Review From Departments If Required)
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Other's 3 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other3_review){{ $data->Other3_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 3 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other3_person){{ $data->Other3_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 3 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other3_Department_person){{ $data->Other3_Department_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Other's 3)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other3_assessment){{ $data->Other3_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 3 Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other3_feedback){{ $data->Other3_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Other's 3 Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other3_by){{ $data->Other3_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 3 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other3_on){{ $data->Other3_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Other's 3 Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Other3_attachment)
                            @foreach(json_decode($data->Other3_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                        <tr>
                            <td class="w-20">4</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                        @endif
    
                    </table>
                </div>
            </div> 
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Other's 4 ( Additional Person Review From Departments If Required)
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Other's 4 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other4_review){{ $data->Other4_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 4 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other4_person){{ $data->Other4_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 4 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other4_Department_person){{ $data->Other4_Department_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Other's 4)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other4_assessment){{ $data->Other4_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 4 Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other4_feedback){{ $data->Other4_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Other's 4 Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other4_by){{ $data->Other4_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 4 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other4_on){{ $data->Other4_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Other's 4 Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Other4_attachment)
                            @foreach(json_decode($data->Other4_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Other's 5 ( Additional Person Review From Departments If Required)
                    </div>
                    <table>

                            <tr>
                        
                                <th class="w-20">Other's 5 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other5_review){{ $data->Other5_review }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 5 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other5_person){{ $data->Other5_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 5 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other5_Department_person){{ $data->Other5_Department_person }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                        
                                <th class="w-20">Impact Assessment (By Other's 5)</</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other5_assessment){{ $data->Other5_assessment }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 5 Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other5_feedback){{ $data->Other5_feedback }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        
                                <th class="w-20">Other's 5 Review Completed  By</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other5_by){{ $data->Other5_by }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 5 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if($data->Other5_on){{ $data->Other5_on }}@else Not Applicable @endif
                                    </div>
                                </td>
                            </tr>
                    </table>
                    </div>  
                  <div class="border-table">
                    <div class="block-">
                        Other's 5 Attachments 
                    </div>                                   
                    <table>
    
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->Other5_attachment)
                            @foreach(json_decode($data->Other5_attachment) as $key => $file)
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
