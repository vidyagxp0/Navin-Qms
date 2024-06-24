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
                    Deviation Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://navin.mydemosoftware.com/public/user/images/logo.png" alt=""
                            class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong> Deviation No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/DEV/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>
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
                    <strong>Page :</strong> 
                </td> --}}
            </tr>
        </table>
    </footer>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30"> {{ Helpers::getDivisionName($data->division_id) }}</td>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Date of Initiation</th>
                        {{-- <td class="w-30">@if{{ Helpers::getdateFormat($data->intiation_date) }} @else Not Applicable @endif</td> --}}
                        {{-- <td class="w-30">@if (Helpers::getdateFormat($data->intiation_date)) {{ Helpers::getdateFormat($data->intiation_date) }} @else Not Applicable @endif</td> --}}
                        <td class="w-30">{{ $data->created_at ? $data->created_at->format('d-m-Y') : '' }} </td>

                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                            {{ \Carbon\Carbon::parse($data->due_date)->format('d-m-Y') }}
                        @else
                            Not Applicable
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ Helpers::getFullDepartmentName($data->Initiator_Group) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        {{-- <th class="w-20">Department Code</th> --}}
                        {{-- <td class="w-30">@if ($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td> --}}
                    </tr>
                   
                    <tr>
                        <th class="w-20"> Deviation Observed On</th>
                        <td class="w-30">
                            @if ($data->Deviation_date)
                            {{ \Carbon\Carbon::parse($data->Deviation_date)->format('d-m-Y') }}
                        @else
                            Not Applicable
                        @endif
                        </td>
                        <th class="w-20"> Deviation Observed On (Time)</th>
                        <td class="w-30">
                            @if ($data->deviation_time)
                                {{ $data->deviation_time }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20"> Delay Justification</th>
                        <td class="w-30"> @if ($data->Delay_Justification)
                            {{ $data->Delay_Justification }}
                        @else
                            Not Applicable
                        @endif</td>
                        <th class="w-20">Deviation Observed by</th>
                        @php
                            $facilityIds = explode(',', $data->Facility);
                            $users = $facilityIds ? DB::table('users')->whereIn('id', $facilityIds)->get() : [];
                        @endphp

                        <td>
                            @if ($data->Facility)
                            {{ $data->Facility }}
                        @else
                            Not Applicable
                        @endif
                        </td>


                        {{-- <td class="w-30">@if ($data->Facility){{ $data->Facility }} @else Not Applicable @endif</td> --}}

                    </tr>

                    <tr>
                        <th class="w-20">Deviation Reported On </th>
                        <td class="w-30">
                            @if ($data->Deviation_reported_date)
                            {{ \Carbon\Carbon::parse($data->Deviation_reported_date)->format('d-m-Y') }}
                        @else
                            Not Applicable
                        @endif
                        </td>
                        <th class="w-20">Deviation Related To</th>
                        <td class="w-30">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20"> Others</th>
                        <td class="w-30">
                            @if ($data->others)
                                {{ $data->others }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Facility/ Equipment/ Instrument/ System Details Required?</th>
                        <td class="w-30">
                            @if ($data->Facility_Equipment)
                                {{ $data->Facility_Equipment }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>

                        <th class="w-20">Document Details Required?</th>
                        <td class="w-30">
                            @if ($data->Document_Details_Required)
                                {{ $data->Document_Details_Required }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Product/Batch Required?</th>
                        <td class="w-30">
                            @if ($data->Product_Details_Required)
                                {{ $data->Product_Details_Required }}
                            @else
                                Not Applicable
                            @endif
                        </td>


                    </tr>


                    {{-- <tr> --}}
                    {{-- <th class="w-20">Name of Product & Batch No</th> --}}
                    {{-- <td class="w-30">@if ($data->Product_Batch){{ ($data->Product_Batch) }} @else Not Applicable @endif</td> --}}
                    {{-- </tr> --}}
                 

                </table>
                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Description of Deviation</th>
                            <td class="w-80">
                                @if ($data->Description_Deviation)
                                    {{ strip_tags($data->Description_Deviation) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                           </tr>
                            <tr>
                                <th class="w-20">Immediate Action (if any)</th>
                                <td class="w-80">
                                    @if ($data->Immediate_Action)
                                        {{ strip_tags($data->Immediate_Action) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Preliminary Impact of Deviation</th>
                                <td class="w-80">
                                    @if ($data->Preliminary_Impact)
                                        {{strip_tags($data->Preliminary_Impact) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                    </table>
                </div>
                <div class="block">
                    <div class="block-head">
                        Facility/ Equipment/ Instrument/ System Details
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-10">Sr. No.</th>
                                <th class="w-25">Name</th>
                                <th class="w-25">ID Number</th>
                                <th class="w-25">Remarks</th>

                            </tr>
                            @if (!empty($grid_data->IDnumber))
                                @foreach (unserialize($grid_data->IDnumber) as $key => $dataDemo)
                                    <tr>
                                        <td class="w-15">{{ $loop->index + 1 }}</td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data->facility_name)[$key] ? unserialize($grid_data->facility_name)[$key] : 'Not Applicable' }}
                                        </td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data->IDnumber)[$key] ? unserialize($grid_data->IDnumber)[$key] : 'Not Applicable' }}
                                        </td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data->Remarks)[$key] ? unserialize($grid_data->Remarks)[$key] : 'Not Applicable' }}
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>

                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">
                        Document Details
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-10">Sr. No.</th>
                                <th class="w-25">Number</th>
                                <th class="w-25">Reference Document Name</th>
                                <th class="w-25">Remarks</th>

                            </tr>
                            @if (!empty($grid_data1->Number))
                                @foreach (unserialize($grid_data1->Number) as $key => $dataDemo)
                                    <tr>
                                        <td class="w-15">{{ $loop->index + 1 }}</td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data1->Number)[$key] ? unserialize($grid_data1->Number)[$key] : 'Not Applicable' }}
                                        </td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data1->ReferenceDocumentName)[$key] ? unserialize($grid_data1->ReferenceDocumentName)[$key] : 'Not Applicable' }}
                                        </td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data1->Document_Remarks)[$key] ? unserialize($grid_data1->Document_Remarks)[$key] : 'Not Applicable' }}
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>

                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                {{-- ==================================new Added=================== --}}
                <div class="block">
                    <div class="block-head">
                        Product/Batch Details
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-10">Sr. No.</th>
                                <th class="w-25">Product</th>
                                <th class="w-25">Stage</th>
                                <th class="w-25">Batch No.</th>

                            </tr>
                            @if (!empty($grid_data1->Number))
                                @foreach (unserialize($grid_data1->Number) as $key => $dataDemo)
                                    <tr>
                                        <td class="w-15">{{ $loop->index + 1 }}</td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data1->Number)[$key] ? unserialize($grid_data1->Number)[$key] : 'Not Applicable' }}
                                        </td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data1->ReferenceDocumentName)[$key] ? unserialize($grid_data1->ReferenceDocumentName)[$key] : 'Not Applicable' }}
                                        </td>
                                        <td class="w-15">
                                            {{ unserialize($grid_data1->Document_Remarks)[$key] ? unserialize($grid_data1->Document_Remarks)[$key] : 'Not Applicable' }}
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>

                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <div class="border-table">
                    <div class="block-head">
                        Initial Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->Audit_file)
                            @foreach (json_decode($data->Audit_file) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
                <!-- {{-- ==================================      --}} -->

                <div class="block">
                    <div class="block-head">
                        HOD Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">HOD Remarks</th>
                            <td class="w-80">
                                @if ($data->HOD_Remarks)
                                    {{ strip_tags($data->HOD_Remarks) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="border-table">
                        <div class="block-head">
                            HOD Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->Audit_file)
                                @foreach (json_decode($data->Audit_file) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                    QA Initial  Review
                </div>
                <table>
                    <tr>
                        <th class="w-20"> Repeat Deviation?</th>
                        <td class="w-80">
                            @if ($data->short_description_required)
                                {{ $data->short_description_required }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20"> Repeat Nature</th>
                        <td class="w-80">
                            @if ($data->nature_of_repeat)
                                {{ $data->nature_of_repeat }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Customer Notification Required?</th>
                        <td class="w-80">
                            @if ($data->Customer_notification)
                                {{ $data->Customer_notification }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Initial Remarks  </th>
                        <td class="w-80">
                            @if ($data->QAInitialRemark)
                                {{ strip_tags($data->QAInitialRemark) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  
                    <tr>
                        {{-- <th class="w-20">Customer Notification Required ?</th> --}}
                        {{-- <td class="w-30">@if ($data->Customer_notification){{$data->Customer_notification}}@else Not Applicable @endif</td> --}}
                        {{-- <th class="w-20">Customers</th> --}}
                        {{-- <td class="w-30">@if ($data->customers){{ $data->customers }}@else Not Applicable @endif</td> --}}
                        {{-- @php
                            $customer = DB::table('customer-details')->where('id', $data->customers)->first();
                            $customer_name = $customer ? $customer->customer_name : 'Not Applicable';
                        @endphp --}}

                        {{-- <td>
                        @if ($data->customers)
                            {{ $customer_name }}
                        @else
                            Not Applicable
                        @endif
                    </td> --}}
                    </tr>

                   
                   
                </table>
                <div class="border-table">
                    <div class="block-head">
                        QA Initial Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->Initial_attachment)
                            @foreach (json_decode($data->Initial_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
                                        @if ($data1->Production_Review)
                                            {{ $data1->Production_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_person)
                                        {{ DB::table('users')->where('id', $data1->Production_person)->value('name') }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                        </table>
                        <table>
                            <tr>

                                <th class="w-20">Impact Assessment (By Production)</th>
                                <td class="w-80">
                                    <div>
                                        @if ($data1->Production_assessment)
                                            {{ $data1->Production_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                               
                            </tr>
                        </table>
                        <table>
                            <tr>
{{-- {{ dd($data1); }} --}}
                                <th class="w-20">Production Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_by)
                                            {{ $data1->Production_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>

                                <th class="w-20">Production Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->production_on)
                                        {{ \Carbon\Carbon::parse($data->production_on)->format('d-m-Y') }}
                                    @else
                                        Not Applicable
                                    @endif
                                    </div>
                                </td>
                            </tr>

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
                                            @if ($data1->Warehouse_review)
                                                {{ $data1->Warehouse_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Warehouse Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Warehouse_notification)
                                            {{ DB::table('users')->where('id', $data1->Warehouse_notification)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Warehouse)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Warehouse_assessment)
                                                {{ $data1->Warehouse_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                   
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Warehouse Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Warehouse_by)
                                                {{ $data1->Warehouse_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Warehouse Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Warehouse_on)
                                            {{ \Carbon\Carbon::parse($data->Warehouse_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Quality_review)
                                                {{ $data1->Quality_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Control Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Control_Person)
                                            {{ DB::table('users')->where('id', $data1->Quality_Control_Person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Quality Control)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Quality_Control_assessment)
                                                {{ $data1->Quality_Control_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                   
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Quality Control Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Control_by)
                                                {{ $data1->Quality_Control_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Control Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Control_on)
                                                {{ $data1->Quality_Control_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                       
                    </div>


                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Quality Assurance
                            </div>
                            <table>
{{-- {{ dd($data1); }} --}}

                                <tr>

                                    <th class="w-20">Quality Assurance Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Assurance_Review)
                                                {{ $data1->Quality_Assurance_Review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Assurance Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->QualityAssurance_person)
                                            {{ DB::table('users')->where('id', $data1->QualityAssurance_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Quality Assurance)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->QualityAssurance_assessment)
                                                {{ $data1->QualityAssurance_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                   
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Quality Assurance Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->QualityAssurance_by)
                                                {{ $data1->QualityAssurance_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Assurance Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->QualityAssurance_on)
                                            {{ \Carbon\Carbon::parse($data->QualityAssurance_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Engineering_review)
                                                {{ $data1->Engineering_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Engineering Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_person)
                                            {{ DB::table('users')->where('id', $data1->Engineering_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Engineering)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Engineering_assessment)
                                                {{ $data1->Engineering_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Engineering Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_by)
                                                {{ $data1->Engineering_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Engineering Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_on)
                                            {{ \Carbon\Carbon::parse($data->Engineering_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Analytical_Development_review)
                                                {{ $data1->Analytical_Development_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Analytical Development Laboratory Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Analytical_Development_person)
                                            {{ DB::table('users')->where('id', $data1->Analytical_Development_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Analytical Development Laboratory)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Analytical_Development_assessment)
                                                {{ $data1->Analytical_Development_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                  
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Analytical Development Laboratory Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Analytical_Development_by)
                                                {{ $data1->Analytical_Development_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Analytical Development Laboratory Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Analytical_Development_on)
                                            {{ \Carbon\Carbon::parse($data->Analytical_Development_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Kilo_Lab_review)
                                                {{ $data1->Kilo_Lab_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Process Development Laboratory / Kilo Lab Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Kilo_Lab_person)
                                            {{ DB::table('users')->where('id', $data1->Kilo_Lab_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Process Development Laboratory / Kilo Lab)
                                        </th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Kilo_Lab_assessment)
                                                {{ $data1->Kilo_Lab_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                  
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Process Development Laboratory / Kilo Lab Review Completed By
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Kilo_Lab_attachment_by)
                                                {{ $data1->Kilo_Lab_attachment_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Process Development Laboratory / Kilo Lab Review Completed On
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Kilo_Lab_attachment_on )
                                            {{ \Carbon\Carbon::parse($data->Kilo_Lab_attachment_on )->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Technology_transfer_review)
                                                {{ $data1->Technology_transfer_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Technology Transfer / Design Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Technology_transfer_person)
                                            {{ DB::table('users')->where('id', $data1->Technology_transfer_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Technology Transfer / Design)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Technology_transfer_assessment)
                                                {{ $data1->Technology_transfer_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Technology Transfer / Design Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Technology_transfer_by)
                                                {{ $data1->Technology_transfer_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Technology Transfer / Design Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Technology_transfer_on)
                                            {{ \Carbon\Carbon::parse($data->Technology_transfer_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Environment_Health_review)
                                                {{ $data1->Environment_Health_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Environment, Health & Safety Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Environment_Health_Safety_person)
                                            {{ DB::table('users')->where('id', $data1->Environment_Health_Safety_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Environment, Health & Safety)</th>
                                    <td class="w-80">
                                        <div>
                                            {!!$data1->Health_Safety_assessment ? $data1->Health_Safety_assessment  : "Not Applicable"!!}
                                        </div>
                                    </td>
                                   
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Environment, Health & Safety Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Environment_Health_Safety_by)
                                                {{ $data1->Environment_Health_Safety_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Environment, Health & Safety Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Environment_Health_Safety_on)
                                            {{ \Carbon\Carbon::parse($data->Environment_Health_Safety_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Human_Resource_review)
                                                {{ $data1->Human_Resource_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Human Resource & Administration Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Human_Resource_person)
                                            {{ DB::table('users')->where('id', $data1->Human_Resource_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Human Resource & Administration)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Human_Resource_assessment)
                                                {{ $data1->Human_Resource_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Human Resource & Administration Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Human_Resource_by)
                                                {{ $data1->Human_Resource_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Human Resource & Administration Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->production_on)
                                            {{ \Carbon\Carbon::parse($data->production_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                       
                    </div>
                   
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
                                            @if ($data1->Information_Technology_review)
                                                {{ $data1->Information_Technology_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Information Technology Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Information_Technology_person)
                                            {{ DB::table('users')->where('id', $data1->Information_Technology_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Information Technology)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Information_Technology_assessment)
                                                {{ $data1->Information_Technology_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Information Technology Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Information_Technology_by)
                                                {{ $data1->Information_Technology_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Information Technology Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Information_Technology_on)
                                            {{ \Carbon\Carbon::parse($data->Information_Technology_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Project_management_review)
                                                {{ $data1->Project_management_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Project Management Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Project_management_person)
                                            {{ DB::table('users')->where('id', $data1->Project_management_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Project Management)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Project_management_assessment)
                                                {{ $data1->Project_management_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Project Management Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Project_management_by)
                                                {{ $data1->Project_management_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Project Management Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Project_management_on)
                                            {{ \Carbon\Carbon::parse($data->Project_management_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Other1_review)
                                                {{ $data1->Other1_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_person)
                                            {{ DB::table('users')->where('id', $data1->Other1_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_Department_person)
                                            {{ DB::table('c_f_t_departments')->where('id', $data1->Other1_Department_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 1)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other1_assessment)
                                                {{ $data1->Other1_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 1 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_by)
                                                {{ $data1->Other1_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 1 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_on)
                                            {{ \Carbon\Carbon::parse($data->Other1_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Other2_review)
                                                {{ $data1->Other2_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 2 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_person)
                                            {{ DB::table('users')->where('id', $data1->Other2_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 2 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_Department_person)
                                            {{ DB::table('c_f_t_departments')->where('id', $data1->Other2_Department_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 2)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other2_assessment)
                                                {{ $data1->Other2_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                   
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 2 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_by)
                                                {{ $data1->Other2_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 2 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_on)
                                            {{ \Carbon\Carbon::parse($data->Other2_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Other3_review)
                                                {{ $data1->Other3_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 3 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_person)
                                            {{ DB::table('users')->where('id', $data1->Other3_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 3 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_Department_person)
                                            {{ DB::table('c_f_t_departments')->where('id', $data1->Other3_Department_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 3)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other3_assessment)
                                                {{ $data1->Other3_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                  
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 3 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_by)
                                                {{ $data1->Other3_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 3 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_on)
                                            {{ \Carbon\Carbon::parse($data->Other3_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Other4_review)
                                                {{ $data1->Other4_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_person)
                                            {{ DB::table('users')->where('id', $data1->Other4_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_Department_person)
                                            {{ DB::table('c_f_t_departments')->where('id', $data1->Other4_Department_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 4)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other4_assessment)
                                                {{ $data1->Other4_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                   
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 4 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_by)
                                                {{ $data1->Other4_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 4 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_on)
                                            {{ \Carbon\Carbon::parse($data->Other4_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
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
                                            @if ($data1->Other5_review)
                                                {{ $data1->Other5_review }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 5 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_person)
                                            {{ DB::table('users')->where('id', $data1->Other5_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 5 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_Department_person)
                                            {{ DB::table('c_f_t_departments')->where('id', $data1->Other5_Department_person)->value('name') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 5)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other5_assessment)
                                                {{ $data1->Other5_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                   
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 5 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_by)
                                                {{ $data1->Other5_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 5 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_on)
                                            {{ \Carbon\Carbon::parse($data->Other5_on)->format('d-m-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div class="border-table">
                                <div class="block-head">
                                    CFT Attachments
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data1->QA_attachments)
                                        @foreach (json_decode($data1->QA_attachments) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
                            QA Secondary  Review
                        </div>
                        <table>
        
                            <tr>
                                <th class="w-20">Initial Deviation category</th>
                                <td class="w-30">
                                    @if ($data->Deviation_category)
                                        {{ $data->Deviation_category }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Justification for categorization</th>
                                <td class="w-30">
                                    @if ($data->Justification_for_categorization)
                                        {{ strip_tags($data->Justification_for_categorization) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Investigation Required?</th>
                                <td class="w-30">
                                    @if ($data->Investigation_required)
                                        {{ $data->Investigation_required }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Investigation Details</th>
                                <td class="w-30">
                                    @if ($data->Investigation_Details)
                                        {{ $data->Investigation_Details }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                {{-- <th class="w-20">Customer Notification Required ?</th> --}}
                                {{-- <td class="w-30">@if ($data->Customer_notification){{$data->Customer_notification}}@else Not Applicable @endif</td> --}}
                                {{-- <th class="w-20">Customers</th> --}}
                                {{-- <td class="w-30">@if ($data->customers){{ $data->customers }}@else Not Applicable @endif</td> --}}
                                {{-- @php
                                    $customer = DB::table('customer-details')->where('id', $data->customers)->first();
                                    $customer_name = $customer ? $customer->customer_name : 'Not Applicable';
                                @endphp --}}
        
                                {{-- <td>
                                @if ($data->customers)
                                    {{ $customer_name }}
                                @else
                                    Not Applicable
                                @endif
                            </td> --}}
                            </tr>
        
                            <tr>
                                {{-- <th class="w-20">Related Records</th> --}}
                                {{-- <td class="w-30">@if ($data->related_records){{$data->related_records }}@else Not Applicable @endif</td> --}}
                                <th class="w-20">QA Feedbacks</th>
                                <td class="w-30">
                                    @if ($data->QA_Feedbacks)
                                        {{ strip_tags($data->QA_Feedbacks) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
        
                            </tr>
        
                        </table>
                    </div>
        
                    <div class="border-table">
                        <div class="block-head">
                            QA Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->QA_attachments)
                                @foreach (json_decode($data->QA_attachments) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                    <!-- **************************INVESTIGATION TAB START******************************* -->

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Investigation
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Investigation summary
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Discription_Event) {{ strip_tags($data->Discription_Event) }} @else Not Applicable @endif

                                            {{-- @if ($investigationExtension && $investigationExtension->investigation_proposed_due_date) {{  Helpers::getdateFormat($investigationExtension->investigation_proposed_due_date)  }} @else Not Applicable @endif --}}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Impact Assessment
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->objective) {{ strip_tags($data->objective) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Corrective & Preventive Actions</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->scope) {{ strip_tags($data->scope) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Investigation HOD remarks</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->imidiate_action) {{ strip_tags($data->imidiate_action) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Investigation QA remarks</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->imidiate_action1) {{ strip_tags($data->imidiate_action1) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- {{-- <tr> --}} -->


                                <!-- {{-- <th class="w-20">CAPA Type?</th> --}}
                                {{-- <td class="w-30">
                            <div>
                                @if ($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif
                            </div>
                        </td> --}} -->
                                <!-- {{-- </tr> --}} -->
                                <tr>

                                 
                            </table>

                            {{-- <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-" style="margin-bottom:5px; font-weight:bold;">
                                    Investigation team and Responsibilities
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Investigation Team</th>
                                        <th class="w-60">Responsibility</th>
                                        <th class="w-60">Remarks</th>
                                    </tr>
                                    <tbody>
                                        @if($investigation_data && is_array($investigation_data->data))
                                        @php
                                            $serialNumber = 1;
                                            $users = DB::table('users')->select('id', 'name')->get();
                                        @endphp
                                            @foreach($investigation_data->data as $investigation_item)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    @foreach ($users as $user)
                                                        <td {{ $investigation_data['investioncation_team'] == $user->id ? 'selected' : '' }}>{{ $user->name }}</td>
                                                    @endforeach
                                                    <td class="w-20">{{$investigation_item['responsibility']}}</td>
                                                    <td class="w-20">{{$investigation_item['remarks']}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td class="w-20">1</td>
                                                    <td class="w-20">Not Applicable</td>
                                                    <td class="w-20">Not Applicable</td>
                                                    <td class="w-20">Not Applicable</td>
                                                </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div> --}}

                            <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-" style="margin-bottom:5px; font-weight:bold;">
                                    Root Cause
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Root Cause Category</th>
                                        <th class="w-60">Root Cause Sub-Category</th>
                                        <th class="w-60">Others</th>
                                        <th class="w-60">Probability</th>
                                        <th class="w-60">Remark</th>
                                    </tr>

                                    <tbody>
                                    @if($root_cause_data && is_array($root_cause_data->data))
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                        @foreach($root_cause_data->data as $rootCause_data)
                                            <tr>
                                                <td class="w-20">{{ $serialNumber++ }}</td>
                                                <td class="w-20">{{ $rootCause_data['Root_Cause_Category'] }}</td>
                                                <td class="w-20">{{ $rootCause_data['Root_Cause_Sub_Category'] }}</td>
                                                <td class="w-20">{{ $rootCause_data['ifother'] }}</td>
                                                <td class="w-20">{{ $rootCause_data['probability'] }}</td>
                                                <td class="w-20">{{ $rootCause_data['remarks'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                    @endif
                                </tbody>
                                </table>
                            </div>

                            {{-- <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-head">
                                    Why Why Chart
                                </div>

                                <!-- *********************** WHY 1 *********************** -->
                                <div class="block-" style="margin-bottom:5px; font-weight:bold;">
                                    Why 1
                                </div>

                                <table>
                                    <tr>
                                        <th class="w-20">Problem Statement</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($why_data && is_array($why_data->data) && isset($why_data->data['problem_statement']))
                                                    {{ $why_data->data['problem_statement'] }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">Root Cause</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($why_data && is_array($why_data->data) && isset($why_data->data['root-cause']))
                                                    {{ $why_data->data['root-cause'] }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if($why_data && is_array($why_data->data) && isset($why_data->data['why_1']))
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                            @foreach($why_data->data['why_1'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif                                        
                                    </tbody>
                                </table>


                                <!-- *********************** WHY 2 *********************** -->
                                <div class="block-" style="margin-bottom:5px;  font-weight:bold;">
                                    Why 2
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if($why_data && is_array($why_data->data) && isset($why_data->data['why_2']))
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                            @foreach($why_data->data['why_2'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif                                        
                                    </tbody>
                                </table>


                                <!-- *********************** WHY 3 *********************** -->
                                <div class="block-" style="margin-bottom:5px;  font-weight:bold;">
                                    Why 3
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if($why_data && is_array($why_data->data) && isset($why_data->data['why_3']))
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                            @foreach($why_data->data['why_3'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif                                        
                                    </tbody>
                                </table>


                                <!-- *********************** WHY 4 *********************** -->
                                <div class="block-" style="margin-bottom:5px; font-weight:bold;">
                                    Why 4
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if($why_data && is_array($why_data->data) && isset($why_data->data['why_4']))
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                            @foreach($why_data->data['why_4'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif                                        
                                    </tbody>
                                </table>


                                <!-- *********************** WHY 5 *********************** -->
                                <div class="block-" style="margin-bottom:5px; font-weight:bold;">
                                    Why 5
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if($why_data && is_array($why_data->data) && isset($why_data->data['why_5']))
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                            @foreach($why_data->data['why_5'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif                                        
                                    </tbody>
                                </table>
                            </div>

                            <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-" style="margin-bottom: 5px; font-weight:bold;">
                                    Category of Human Error
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Gap Category</th>
                                        <th class="w-60">Issues</th>
                                        <th class="w-60">Actions</th>
                                        <th class="w-60">Remark</th>
                                    </tr>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Attention</td>
                                            <td>{{ $data->attention_issues}}</td>
                                            <td>{{ $data->attention_actions}}</td>
                                            <td>{{ $data->attention_remarks}}</td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>Understanding</td>
                                            <td>{{ $data->understanding_issues}}</td>
                                            <td>{{ $data->understanding_actions}}</td>
                                            <td>{{ $data->understanding_remarks}}</td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>Procedural</td>
                                            <td>{{ $data->procedural_issues}}</td>
                                            <td>{{ $data->procedural_actions}}</td>
                                            <td>{{ $data->procedural_remarks}}</td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td>Behavioral</td>
                                            <td>{{ $data->behavioiral_issues}}</td>
                                            <td>{{ $data->behavioiral_actions}}</td>
                                            <td>{{ $data->behavioiral_remarks}}</td>
                                        </tr>

                                        <tr>
                                            <td>5</td>
                                            <td>Skill</td>
                                            <td>{{ $data->skill_issues}}</td>
                                            <td>{{ $data->skill_actions}}</td>
                                            <td>{{ $data->skill_remarks}}</td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </div>

                            <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-" style="margin-bottom: 5px; font-weight:bold;">
                                    Is/Is Not Analysis
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">&nbsp;</th>
                                        <th class="w-60">Will Be</th>
                                        <th class="w-60">Will Not Be</th>
                                        <th class="w-60">Rationale</th>
                                    </tr>

                                    <tbody>
                                        <tr>
                                            <td>What</td>
                                            <td>{{ $data->what_will_be }}</td>
                                            <td>{{ $data->what_will_not_be}}</td>
                                            <td>{{ $data->what_rationable}}</td>
                                        </tr>

                                        <tr>
                                            <td>Where</td>
                                            <td>{{ $data->where_will_be}}</td>
                                            <td>{{ $data->where_will_not_be}}</td>
                                            <td>{{ $data->where_rationable}}</td>
                                        </tr>

                                        <tr>
                                            <td>When</td>
                                            <td>{{ $data->when_will_be}}</td>
                                            <td>{{ $data->when_will_not_be}}</td>
                                            <td>{{ $data->when_rationable}}</td>
                                        </tr>

                                        <tr>
                                            <td>Coverage</td>
                                            <td>{{ $data->coverage_will_be}}</td>
                                            <td>{{ $data->coverage_will_not_be}}</td>
                                            <td>{{ $data->coverage_rationable}}</td>
                                        </tr>

                                        <tr>
                                            <td>Who</td>
                                            <td>{{ $data->who_will_be}}</td>
                                            <td>{{ $data->who_will_not_be}}</td>
                                            <td>{{ $data->who_rationable}}</td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Investigation Attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->Investigation_attachment)
                                    @foreach (json_decode($data->Investigation_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->Capa_attachment)
                                    @foreach (json_decode($data->Capa_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-20">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div> --}}

                        <div class="block">
                            <div class="block-head">
                                QA Final Review
                            </div>
                            <table>

                                <tr>
                                    <th class="w-20">QA Feedbacks</th>
                                    <td class="w-30">
                                        @if ($data->QA_Feedbacks)
                                            {{ strip_tags($data->QA_Feedbacks) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                QA Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->QA_attachments)
                                    @foreach (json_decode($data->QA_attachments) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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

                    <!-- **************************INVESTIGATION TAB ENDS******************************** -->



                    <!-- **************************QRM TAB START******************************* -->

                    {{-- <div class="block">
                        <div class="head">
                            <div class="block-head">
                                QRM
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Proposed Due Date
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($qrmExtension && $qrmExtension->qrm_proposed_due_date) {{ Helpers::getdateFormat($qrmExtension->qrm_proposed_due_date) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Conclusion</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Conclusion) {{ strip_tags($data->Conclusion) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Identified Risk</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Identified_Risk) {{ strip_tags($data->Identified_Risk) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Severity Rate</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->severity_rate) {{ $data->severity_rate }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Occurrence</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Occurrence) {{ $data->Occurrence }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Detection</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->detection) {{ $data->detection }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">RPN</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->rpn) {{ $data->rpn }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div class="border-table">
                                <div class="block-" style="margin:bottom:5px;">
                                    Failure Mode and Effect Analysis
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th>Row #</th>
                                        <th>Risk Factor</th>
                                        <th>Risk element </th>
                                        <th>Probable cause of risk element</th>
                                        <th>Existing Risk Controls</th>
                                        <th>Initial Severity- H(3)/M(2)/L(1)</th>
                                    </tr>

                                    <tbody>
                                        @if ($grid_data_qrms && is_array($grid_data_qrms->data))
                                             @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($grid_data_qrms->data as $grid_item)
                                            <tr>
                                                <td>{{$serialNumber++}}</td>
                                                <td>{{$grid_item['risk_factor']}}</td>
                                                <td>{{$grid_item['risk_element']}}</td>
                                                <td>{{$grid_item['probale_of_risk_element']}}</td>
                                                <td>{{$grid_item['existing_risk_control']}}</td>
                                                <td>{{$grid_item['initial_severity']}}</td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>`
                                        @endif
                                    </tbody>
                                </table>


                                <table style="margin-top:10px;">
                                    <tr class="table_bg">
                                        <th>Row #</th>
                                        <th>Initial Probability- H(3)/M(2)/L(1)</th>
                                        <th>Initial Detectability- H(1)/M(2)/L(3)</th>
                                        <th>Initial RPN</th>
                                        <th>Risk Acceptance (Y/N)</th>
                                        <th>Proposed Additional Risk control measure</th>
                                    </tr>
                                    <tbody>
                                        @if ($grid_data_qrms && is_array($grid_data_qrms->data))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($grid_data_qrms->data as $grid_item)
                                                <tr>
                                                    <td>{{$serialNumber++}}</td>
                                                    <td>{{$grid_item['initial_probability']}}</td>
                                                    <td>{{$grid_item['initial_detectability']}}</td>
                                                    <td>{{$grid_item['initial_rpn']}}</td>
                                                    <td>{{$grid_item['risk_acceptance']}}</td>
                                                    <td>{{$grid_item['proposed_additional_risk_control']}}</td>
                                                </tr>                                                
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <table style="margin-top:10px;">
                                    <tr class="table_bg">
                                        <th>Row #</th>
                                        <th>Residual Severity- H(3)/M(2)/L(1)</th>
                                        <th>Residual Probability- H(3)/M(2)/L(1)</th>
                                        <th>Residual Detectability- H(1)/M(2)/L(3)</th>
                                        <th>Residual RPN</th>
                                        <th>Risk Acceptance (Y/N)</th>
                                        <th>Mitigation proposal</th>
                                    </tr> 

                                    <tbody>
                                        @if ($grid_data_qrms && is_array($grid_data_qrms->data))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($grid_data_qrms->data as $grid_item)
                                                <tr>
                                                    <td>{{$serialNumber++}}</td>
                                                    <td>{{$grid_item['residual_severity']}}</td>
                                                    <td>{{$grid_item['residual_probability']}}</td>
                                                    <td>{{$grid_item['residual_detectability']}}</td>
                                                    <td>{{$grid_item['residual_rpn']}}</td>
                                                    <td>{{$grid_item['risk_acceptance']}}</td>
                                                    <td>{{$grid_item['mitigation_proposal']}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>`
                                        @endif
                                    </tbody>
                                </table>

                               
                            </div>

                            <div class="border-table">
                                <div class="block-" style=" font-weight:bold; margin-bottom:5px;">
                                    Risk Matrix
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Risk Assessment</th>
                                        <th class="w-60">Review Schedule</th>
                                        <th class="w-60">Actual Reviewed On</th>
                                        <th class="w-60">Recorded By Sign and Date</th>
                                        <th class="w-60">Remark</th>
                                    </tr>
                                    <tbody>
                                        @if($grid_data_matrix_qrms && is_array($grid_data_matrix_qrms->data))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach($grid_data_matrix_qrms->data as $matrix_grid_data)
                                                <tr>
                                                    <td>{{ $serialNumber }}</td>
                                                    <td>{{ $matrix_grid_data['risk_Assesment'] }}</td>
                                                    <td>{{ $matrix_grid_data['review_schedule'] }}</td>
                                                    <td>{{ $matrix_grid_data['actual_reviewed'] }}</td>
                                                    <td>{{ $matrix_grid_data['recorded_by'] }}</td>
                                                    <td>{{ $matrix_grid_data['remark'] }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}

                    <!-- **************************QRM TAB ENDS******************************** -->


                    <!-- **************************CAAP TAB START******************************* -->

                    {{-- <div class="block">
                        <div class="head">
                            <div class="block-head">
                                CAPA
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Proposed Due Date
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($capaExtension && $capaExtension->capa_proposed_due_date) {{ $capaExtension->capa_proposed_due_date }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Name of the Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->department_capa) {{ $data->department_capa }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Source of CAPA</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->source_of_capa) {{ $data->source_of_capa }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Description of Discrepancy</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Description_of_Discrepancy) {{ strip_tags($data->Description_of_Discrepancy) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Root Cause</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->capa_root_cause) {{ strip_tags($data->capa_root_cause) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Immediate Action Taken</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Immediate_Action_Take) {{ strip_tags($data->Immediate_Action_Take) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Corrective Action Details</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Corrective_Action_Details) {{ strip_tags($data->Corrective_Action_Details) }} @else Not Applicable @endif
                                        </div>
                                    </td>

                                    <th class="w-20">Preventive Action Details</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Preventive_Action_Details) {{ strip_tags($data->Preventive_Action_Details) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Target Completion Date</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->capa_completed_date) {{ $data->capa_completed_date }} @else Not Applicable @endif
                                        </div>
                                    </td>

                                    <th class="w-20">Interim Control</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Interim_Control) {{ strip_tags($data->Interim_Control) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Corrective Action Taken</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Corrective_Action_Taken) {{ strip_tags($data->Corrective_Action_Taken) }} @else Not Applicable @endif
                                        </div>
                                    </td>

                                    <th class="w-20">Preventive Action Taken</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Preventive_action_Taken) {{ strip_tags($data->Preventive_action_Taken) }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">CAPA Closure Comments</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->CAPA_Closure_Comments) {{ strip_tags($data->CAPA_Closure_Comments) }} @else Not Applicable @endif
                                        </div>
                                    </td>

                                    <th class="w-20">CAPA Closure Attachment</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->CAPA_Closure_attachment) {{ $data->CAPA_Closure_attachment }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Source Document</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->source_doc) {{ $data->source_doc }} @else Not Applicable @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> --}}


                    {{-- Hod final review  --}}
                    <div class="block">
                        <div class="block-head">
                            HOD final Review
                        </div>
                        <table>

                            <tr>
                                <th class="w-20">HOD Final Remarks</th>
                                <td class="w-30">
                                    @if ($data->hod_final_remarks)
                                        {{ strip_tags($data->hod_final_remarks) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            HOD Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->hod_final_attachments)
                                @foreach (json_decode($data->hod_final_attachments) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                    {{-- QA final Review  --}}
                    <div class="block">
                        <div class="block-head">
                            QA Final Review
                        </div>
                        <table>

                            <tr>
                                <th class="w-20">QA Final Remarks</th>
                                <td class="w-30">
                                    @if ($data->qa_final_remarks)
                                        {{ strip_tags($data->qa_final_remarks) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            QA Final Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->qa_final_attachments)
                                @foreach (json_decode($data->qa_final_attachments) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                            QAH/Designee Approval
                        </div>

                        <table>

                            <tr>
                                <th class="w-20">Post Categorization Of Deviation</th>
                                <td class="w-30">
                                    @if ($data->qa_final_remarks)
                                        {{ strip_tags($data->Post_Categorization) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Justification for Revised Category</th>
                                <td class="w-30">
                                    @if ($data->qa_final_remarks)
                                        {{ strip_tags($data->Investigation_Of_Review) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <table>

                            <tr>
                                <th class="w-20">Closure Comments</th>
                                <td class="w-30">
                                    @if ($data->Closure_Comments)
                                        {{ strip_tags($data->Closure_Comments) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Disposition of Batch</th>
                                <td class="w-30">
                                    @if ($data->Disposition_Batch)
                                        {{ strip_tags($data->Disposition_Batch) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Closure Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->closure_attachment)
                                @foreach (json_decode($data->closure_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                        <td class="w-30">{{ $data->submit_by }}</td>
                        <th class="w-20">Submit On</th>
                        <td class="w-30"> {{ \Carbon\Carbon::parse($data->submit_on)->format('d-m-Y') }}</td>
                        <th class="w-20">Submit Comments</th>
                        <td class="w-30">{{ $data->submit_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Review Complete By</th>
                        <td class="w-30">{{ $data->HOD_Review_Complete_By }}</td>
                        <th class="w-20">HOD Review Complete On</th>
                        <td class="w-30">{{ $data->HOD_Review_Complete_On }}</td>
                        <th class="w-20">HOD Review Comments</th>
                        <td class="w-30">{{ $data->HOD_Review_Comments }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Initial Review Complete by</th>
                        <td class="w-30">{{ $data->QA_Initial_Review_Complete_By }}</td>
                        <th class="w-20">QA Initial Review Complete On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->QA_Initial_Review_Complete_On) }}</td>
                        <th class="w-20">QA Initial Review Comments</th>
                        <td class="w-30">{{ $data->QA_Initial_Review_Comments }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CFT Review Complete By</th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_By }}</td>
                        <th class="w-20">CFT Review Complete On</th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_On }}</td>
                        <th class="w-20">CFT Review Comments</th>
                        <td class="w-30">{{ $data->CFT_Review_Comments }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Secondary Review Complete By</th>
                        <td class="w-30"></td>
                        <th class="w-20">QA Secondary Review Complete On</th>
                        <td class="w-30"></td>
                        <th class="w-20">QA Secondary Review Complete Comments</th>
                        <td class="w-30"></td>
                    </tr>
                    <tr>
                        <th class="w-20">QAH Primary Approved Completed By</th>
                        <td class="w-30"></td>
                        <th class="w-20">QAH Primary Approved Completed On</th>
                        <td class="w-30"></td>
                        <th class="w-20">QAH Primary Approved Completed Comments</th>
                        <td class="w-30"></td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Update By</th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_By }}</td>
                        <th class="w-20">Initiator Update On </th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_On }}</td>
                        <th class="w-20">Initiator Update Comments</th>
                        <td class="w-30">{{ $data->CFT_Review_Comments }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Final Review By </th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_By }}</td>
                        <th class="w-20">HOD Final Review On </th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_On }}</td>
                        <th class="w-20">HOD Final Review Comments</th>
                        <td class="w-30">{{ $data->CFT_Review_Comments }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">QA Final Review Complete By</th>
                        <td class="w-30">{{ $data->QA_Final_Review_Complete_By }}</td>
                        <th class="w-20">QA Final Review Complete On</th>
                        <td class="w-30">{{ $data->QA_Final_Review_Complete_On }}</td>
                        <th class="w-20">QA Final Review Comments</th>
                        <td class="w-30">{{ $data->QA_Final_Review_Comments }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $data->Approved_By }}</td>
                        <th class="w-20">Approved ON</th>
                        <td class="w-30">{{ $data->Approved_On }}</td>
                        <th class="w-20">Approved Comments</th>
                        <td class="w-30">{{ $data->Approved_Comments }}</td>



                </table>
            </div>
        </div>

    </div>

  

</body>

</html>
