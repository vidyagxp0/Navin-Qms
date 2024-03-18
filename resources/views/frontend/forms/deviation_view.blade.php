@extends('frontend.layout.main')
@section('container')
    @php
$users = DB::table('users')
    ->select('id', 'name')
    ->get();

    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    <script>
        function otherController(value, checkValue, blockID) {
            let block = document.getElementById(blockID)
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');
            if (value === checkValue) {
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }
    </script>
    <script>
        function addAuditAgenda(tableId) {
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = "<input type='date'>";

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='time'>";

            var cell5 = newRow.insertCell(4);
            cell5.innerHTML = "<input type='date'>";

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='time'>";

            var cell7 = newRow.insertCell(6);
            cell7.innerHTML =
                // '<select name="auditor"><option value="">-- Select --</option><option value="1">Amit Guru</option></select>'

            var cell8 = newRow.insertCell(7);
            cell8.innerHTML =
                // '<select name="auditee"><option value="">-- Select --</option><option value="1">Amit Guru</option></select>'

            var cell9 = newRow.insertCell(8);
            cell9.innerHTML = "<input type='text'>";
            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#internalaudit-table').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="audit[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_start_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_start_date[]" id="scheduled_start_date' + serialNumber +'_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `scheduled_start_date' + serialNumber +'`);checkDate(`scheduled_start_date' + serialNumber +'_checkdate`,`scheduled_end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +

                        '<td><input type="time" name="scheduled_start_time[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date'+ serialNumber +'_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, `scheduled_end_date' + serialNumber +'`);checkDate(`scheduled_start_date' + serialNumber +'_checkdate`,`scheduled_end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +
                        '<td><input type="time" name="scheduled_end_time[]"></td>' +


                        '<td><select name="auditor[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><select name="auditee[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
                    html += '</select></td>' +
                        '<td><input type="text" name="remarks[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#internalaudit tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ObservationAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td> <select name="name" id="">  <option value="">-- Select --</option>  <option value="">Facility</option>  <option value=""> Equipment</option> <option value="">Instrument</option></select> </td>'+
                        '<td><input type="number" name="IDnumber[]"></td>'+
                        '<td><input type="text" name="Remarks[]"></td>'+
                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' + 
                  
                        '</tr>';

                    return html;
                }

                var tableBody = $('#onservation-field-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    
<script>
        $(document).ready(function() {
            $('#ReferenceDocument').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td><input type="text" name="Number[]"></td>'+
                        '<td><input type="text" name="ReferenceDocumentName[]"></td>'+
                        '<td><input type="text" name="Remarks[]"></td>'+
                        
                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' + 
                  
                        '</tr>';

                    return html;
                }

                var tableBody = $('#ReferenceDocument_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ProductDetails').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td><input type="text" name="Product_Name[]"></td>'+
                        '<td><input type="text" name=" Batch_No[]"></td>'+
                        '<td><input type="text" name="Remarks[]"></td>'+
                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' + 
                  
                        '</tr>';

                    return html;
                }

                var tableBody = $('#ProductDetails_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / Deviation
        </div>
    </div>



    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}


    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center"> 
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                            $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                         <button class="button_theme1"> <a class="text-white" href="{{ url('DeviationAuditTrial', $data->id) }}"> {{-- add here url for auditTrail i.e. href="{{ url('CapaAuditTrial', $data->id) }}" --}}
                                Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                               <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                              More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Initial Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                        @elseif($data->stage == 4 && (in_array(5, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CFT Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CFT Review Not Required
                            </button>
                        @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                Send to Initiator
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                Send to HOD
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                Send to QA Initial Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Initial Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                        @elseif($data->stage == 6 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                                </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approved
                            </button>
                        @endif 
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">HOD Review </div>
                            @else
                                <div class="">HOD Review</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">QA Initial Review</div>
                            @else
                                <div class="">QA Initial Review</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">CFT Review</div>
                            @else
                                <div class="">CFT Review</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">QA Final Review</div>
                            @else
                                <div class="">QA Final Review</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">QA Head/Manager Designee</div>
                            @else
                                <div class="">Approval</div>
                            @endif
                            @if ($data->stage >= 7)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">QA Initial Review</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm7')">CFT</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Investigation & CAPA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Final Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QAH/Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
            </div>

            <form  action="{{ route('deviationupdate', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div id="step-form">

                    <!-- General information content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                @if (!empty($parent_id))
                                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                                @endif
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                        value="{{ Helpers::getDivisionName($data->division_id) }}/DEV/{{ Helpers::year($data->created_at) }}/{{ $data->record }}"> 
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" value="{{ $data->initiator_name }}">

                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="group-input ">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input readonly type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                         <select id="select-state" placeholder="Select..." name="assign_to"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}} >
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option {{ $data->assign_to == $value->id ? 'selected' : '' }}
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select> 
                                     
                                            <p class="text-danger"></p>
                                      
                                    </div>
                                </div> --}}
                                
                                <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Due Date</label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small>
                                        </div>
                                        <input readonly type="text"
                                            value="{{ Helpers::getdateFormat($data->due_date) }}"
                                            name="due_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}>
                                        {{-- <input type="text" value="{{ $data->due_date }}" name="due_date"> --}}
                                        {{-- <div class="static"> {{ $due_date }}</div> --}}

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Department</b></label>
                                        <select name="Initiator_Group" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                             id="initiator_group">
                                             <option value="">Enter Your Selection Here</option>
                                            <option value="CQA"
                                                @if ($data->Initiator_Group == 'CQA') selected @endif>Corporate
                                                Quality Assurance</option>
                                            <option value="QAB"
                                                @if ($data->Initiator_Group == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC"
                                                @if ($data->Initiator_Group == 'CQC') selected @endif>Central
                                                Quality Control</option>
                                            <option value="MANU"
                                                @if ($data->Initiator_Group == 'MANU') selected @endif>Manufacturing
                                            </option>
                                            <option value="PSG"
                                                @if ($data->Initiator_Group == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS"
                                                @if ($data->Initiator_Group == 'CS') selected @endif>Central
                                                Stores</option>
                                            <option value="ITG"
                                                @if ($data->Initiator_Group == 'ITG') selected @endif>Information
                                                Technology Group</option>
                                            <option value="MM"
                                                @if ($data->Initiator_Group == 'MM') selected @endif>Molecular
                                                Medicine</option>
                                            <option value="CL"
                                                @if ($data->Initiator_Group == 'CL') selected @endif>Central
                                                Laboratory</option>
                                            <option value="TT"
                                                @if ($data->Initiator_Group == 'TT') selected @endif>Tech
                                                team</option>
                                            <option value="QA"
                                                @if ($data->Initiator_Group == 'QA') selected @endif>Quality
                                                Assurance</option>
                                            <option value="QM"
                                                @if ($data->Initiator_Group == 'QM') selected @endif>Quality
                                                Management</option>
                                            <option value="IA"
                                                @if ($data->Initiator_Group == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC"
                                                @if ($data->Initiator_Group == 'ACC') selected @endif>Accounting
                                            </option>
                                            <option value="LOG"
                                                @if ($data->Initiator_Group == 'LOG') selected @endif>Logistics
                                            </option>
                                            <option value="SM"
                                                @if ($data->Initiator_Group == 'SM') selected @endif>Senior
                                                Management</option>
                                            <option value="BA"
                                                @if ($data->Initiator_Group == 'BA') selected @endif>Business
                                                Administration</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Department Code</label>
                                        <input type="text" name="initiator_group_code"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                            value="{{ $data->Initiator_Group }}" id="initiator_group_code"
                                            readonly>

                                    </div>
                                </div>
                            
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                            class="text-danger">*</span></label><span id="rchars">255</span>characters remaining
                                    <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->short_description }}</textarea>
                                 </div>
                                </div>  
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="severity-level">Deviation Observed</label>
                                        <!-- <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span> -->
                                       <input type="date" id="Deviation_date" name="Deviation_date" value="{{ $data->Deviation_date }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        @php
                                            $users = DB::table('users')->get();
                                        @endphp
                                        <label for="If Other">Observed by<span class="text-danger d-none">*</span></label>
                                        <select  multiple name="Facility[]" placeholder="Select Facility Name"
                                            data-search="false" data-silent-initial-value-set="true" id="Facility" value="{{ $data->Facility }}">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach                                           
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="severity-level">Deviation Observed</label>
                                        <!-- <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span> -->
                                       <input type="date" id="Deviation_date" name="Deviation_date" value="{{ $data->Deviation_date }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    {{-- <div class="group-input">
                                        <label for="If Other">Observed by<span class="text-danger d-none">*</span></label>
                                        <select  multiple name="Facility[]" placeholder="Select Facility Name"
                                            data-search="false" data-silent-initial-value-set="true" id="Facility" value="{{ $data->Facility }}">
                                            <option value="1"> 1</option>
                                            <option value="2"> 2</option>
                                            <option value="3"> 3</option>
                                           
                                        </select>
                                    </div> --}}
                                    <div class="group-input">
                                        @php
                                            $users = DB::table('users')->get();
                                            $selectedFacilities = explode(',', $data->Facility); // Convert to array if it's not already
                                        @endphp
                                        <label for="If Other">Observed by<span class="text-danger d-none">*</span></label>
                                        <select multiple name="Facility[]" placeholder="Select Facility Name" data-search="false" data-silent-initial-value-set="true" id="Facility">
                                            @foreach ($users as $user)
                                                <option {{ in_array($user->id, $selectedFacilities) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach                                           
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Deviation Reported On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Deviation_reported_date" name="Deviation_reported_date" value="{{ $data->Deviation_reported_date }}" >
                                    </div>
                                </div>
                                
                             
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit type">Deviation Related To </label>
                                        <select  name="audit_type" id="audit_type"  value="{{ $data->audit_type }}">
                                            <option value="">Enter Your Selection Here</option>
                                            <option @if ($data->audit_type == 'Facility') selected @endif
                                                value="Facility">Facility</option>
                                                <option @if ($data->audit_type == 'Equipment/Instrument') selected @endif
                                                    value="Equipment/Instrument">Equipment/Instrument</option>
                                                    <option @if ($data->audit_type == 'Documentationerror') selected @endif
                                                        value="Documentationerror">Documentation error</option>
                                                        <option @if ($data->audit_type == 'STP/ADS_instruction') selected @endif
                                                            value="STP/ADS_instruction">STP/ADS instruction</option>
                                                            <option @if ($data->audit_type == 'Packaging&Labelling') selected @endif
                                                                value="Packaging&Labelling">Packaging & Labelling</option>
                                                                <option @if ($data->audit_type == 'Material_System') selected @endif
                                                                    value="Material_System">Material System</option>
                                                                    <option @if ($data->audit_type == 'Laboratory_Instrument/System') selected @endif
                                                                        value="Laboratory_Instrument/System">Laboratory_Instrument/System</option>
                                                                        <option @if ($data->audit_type == 'Utility_System') selected @endif
                                                                            value="Utility_System">Utility System</option>
                                                                            <option @if ($data->audit_type == 'Computer_System') selected @endif
                                                                                value="Computer_System">Computer System</option>
                                                                                <option @if ($data->audit_type == 'Document') selected @endif
                                                                                    value="Document">Document</option>
                                                                                    <option @if ($data->audit_type == 'Data integrity') selected @endif
                                                                                        value="Data integrity">Data integrity</option>
                                                                                        <option @if ($data->audit_type == 'Anyother(specify)') selected @endif
                                                                                            value="Anyother(specify)">Anyother(specify)</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="others">Others </label>
                                        <input type="text" name="others" id="others" value="{{ $data->others }}">
                                    </div>
                                </div>

                                
                                <div class="group-input">
                                        <label for="audit-agenda-grid">
                                            Facility/ Equipment/ Instrument/ System Details
                                            <button type="button" name="audit-agenda-grid" value="audit-agenda-grid"
                                                id="ObservationAdd">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="onservation-field-table"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">Row#</th>
                                                        <th style="width: 12%">Name</th>
                                                        <th style="width: 16%"> ID Number</th>
                                                         <th style="width: 15%">Remarks</th>                                                  
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="serial[]" value="1"></td>
                                                    <td> <select name="name" id="">  <option value="">-- Select --</option>  <option value="">Facility</option>  <option value=""> Equipment</option> <option value="">Instrument</option></select> </td>
                                                    <td><input type="text" name="IDnumber[]"></td>
                                                    <td><input type="text" name="Remarks[]"></td>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="group-input">
                                        <label for="audit-agenda-grid">
                                         Document Details
                                            <button type="button" name="audit-agenda-grid" value="audit-agenda-grid"
                                                id="ReferenceDocument">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="ReferenceDocument_details"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 4%">Row#</th>
                                                        <th style="width: 12%">Number</th>
                                                        
                                                        <th style="width: 16%"> Reference Document Name</th>
                                                        <th style="width: 16%"> Remarks</th>
                                                                                                         
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        <td><input disabled type="text" name="serial[]" value="1"></td>
                                        <td><input type="text" name="Number[]"></td>
                                        <td><input type="text" name="ReferenceDocumentName[]"></td>
                                        <td><input type="text" name="Remarks[]"></td>
                                                  
                                              
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                  
                                <div class="col-lg-6">
                                    <div class="group-input" id="external_agencies_req">
                                        <label for="others">Name of Product & Batch No<span class="text-danger d-none">*</span></label>
                                        <input type="text" value="{{$data->Product_Batch}}" name="Product_Batch">
                                        
                                            <!-- <p class="text-danger">this field is required</p> -->
                                    
                                    </div>
                      </div>
                               
                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="Description Deviation">Description of Deviation</label>
                                        <textarea class="summernote"  name="Description_Deviation[]" value="{{$data->Description_Deviation}}"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Description Deviation">Description of Deviation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">{{ $data->Description_Deviation }}</textarea>
                                    </div>
                                </div>
                               
                                {{-- <div class="col-6">
                                <div class="group-input">
                                        <label for="Initial Comments">Immediate Action (if any)</label>
                                        <textarea class="summernote" name="Immediate_Action[]" value="{{$data->Immediate_Action}}"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Immediate Action">Immediate Action (if any)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Immediate_Action[]" id="summernote-2">{{ $data->Immediate_Action }}</textarea>
                                    </div>
                                </div>
                               
                                {{-- <div class="col-6">
                                <div class="group-input">
                                        <label for="Initial Comments">Preliminary Impact of Deviation</label>
                                        <textarea class="summernote" name="Preliminary_Impact[]" value="{{$data->Preliminary_Impact}}"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Preliminary Impact">Preliminary Impact of Deviation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Preliminary_Impact[]" id="summernote-3">{{ $data->Preliminary_Impact }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <!-- ----------hod Review-------- -->
                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                

                                
                                
                                <div class="group-input">
                                        <label for="audit-agenda-grid">
                                       Product Details 
                                            <button type="button" name="audit-agenda-grid"
                                                id="ProductDetails">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="ProductDetails_details"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                    <th style="width: 4%">Row#</th>
                                                        <th style="width: 12%"> Product Name</th>
                                                        
                                                        <th style="width: 16%"> Batch No</th>
                                                        <th style="width: 16%"> Remarks</th>
                                                                                                         
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               <td><input disabled type="text" name="serial[]" value="1"></td>
                                              <td><input type="text" name="Product_Name[]"></td>
                                                    <td><input type="text" name=" Batch_No[]"></td>
                                                    <td><input type="text" name="Remarks[]"></td>
                       
                                                  
                                              
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="HOD Remarks">HOD Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="HOD_Remarks" id="summernote-4">{{ $data->HOD_Remarks }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">HOD Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Audit_file">
                                                @if ($data->Audit_file)
                                                @foreach(json_decode($data->Audit_file) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="HOD_Attachments" name="Audit_file[]"
                                                    oninput="addMultipleFiles(this, 'Audit_file')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                               
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>
                       <!-- QA Initial reVIEW -->
                       <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                

                                
                                <div style="margin-bottom: 0px;" class="col-lg-6 new-date-data-field ">
                                    <div class="group-input input-date">
                                        <label for="Deviation category">Initial Deviation category</label>
                                        <select id="Deviation_category" name="Deviation_category"  value="{{ $data->Deviation_category }}" >
                                            <option value="0">-- Select --</option>
                                            <option @if ($data->Deviation_category == 'minor') selected @endif
                                             value="minor">Minor</option>
                                            <option  @if ($data->Deviation_category == 'major') selected @endif 
                                            value="major">Major</option>
                                            <option @if ($data->Deviation_category == 'critical') selected @endif
                                            value="critical">Critical</option>
                                        </select>

                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Justification for  categorization</label>
                                        <textarea class="summernote" name="Justification_for_categorization" value="Justification_for_categorization" id="" cols="30" ></textarea>

                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Justification for  categorization">Justification for  categorization</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Justification_for_categorization" id="summernote-5">{{ $data->Justification_for_categorization }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Investigation required">Investigation Is required ?</label>
                                        <select name="Investigation_required" id="Investigation_required"  value="{{ $data->Investigation_required }}" >
                                            <option value="0">-- Select --</option>
                                            <option @if ($data->Investigation_required == 'yes') selected @endif
                                             value="yes">Yes</option>
                                            <option  @if ($data->Investigation_required == 'no') selected @endif 
                                            value="no">No</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Product/Material Name">Investigation Details </label>
                                        <textarea name="Investigation_Details" value="Investigation_Details" id="" cols="30" ></textarea>                
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Investigation Details">Investigation Details</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Investigation_Details" id="summernote-6">{{ $data->Investigation_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Customer Notification Required ? </label>
                                        <select name="Customer_notification" id="Customer_notification" value="{{ $data->Customer_notification }}" >
                                            <option value="0">-- Select --</option>
                                            <option @if ($data->Customer_notification == 'yes') selected @endif
                                             value="yes">Yes</option>
                                            <option  @if ($data->Customer_notification == 'no') selected @endif 
                                            value="no">No</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="group-input">
                                        <label for="customers">Customers</label>
                                        <select name="customers" id="customers" value="{{ $data->customers }}">
                                            <option value="0"> -- Select --</option>
                                            <option @if ($data->customers == 'person1') selected @endif
                                                value="person1">Person 1</option>
                                            <option  @if ($data->customers == 'person2') selected @endif 
                                               value="person2">Person 2</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="group-input">
                                        <!-- <label for="Comments(If Any)">Customers</label> -->
                                        <button style="margin-top: 21px; border: 1px solid gray; background: #6f81dd; color: #fff;" type="button" class="btn b" data-bs-toggle="modal" data-bs-target="#myModal">
                                              Customer
                                    </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input"> 
                                        <label for="related_records">Related Records</label>

                                        <select multiple name="related_records[]" placeholder="Select Reference Records"
                                            data-search="false" data-silent-initial-value-set="true"
                                            id="related_records">
                                            @foreach ($pre as $prix)
                                                <option value="{{ $prix->id }}">
                                                    {{ Helpers::getDivisionName($prix->division_id) }}/Change-Control/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments(If Any)">QA Initial Remarks</label>
                                      <textarea name="QAInitialRemark" value="QAInitialRemark" id="" cols="30" ></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="QAInitialRemark">QA Initial Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="QAInitialRemark" id="summernote-6">{{ $data->QAInitialRemark }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">QA Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="audit_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Audit_file[]"
                                                    oninput="addMultipleFiles(this, 'audit_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">QA Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Initial_attachment">
                                                @if ($data->Initial_attachment)
                                                @foreach(json_decode($data->Initial_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>
   <!-- CFT -->
   <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                            
                            <div class="sub-head">
                            Production
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Production Review Required ?</label>
                                        <select name="Production_Review" id="Customer_notification">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Production Person</label>
                                        <select name="Production_person" id="Customer_notification">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Production)</label>
                                        <textarea class="summernote" name="Production_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Production Feedback</label>
                                        <textarea class="summernote" name="Production_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Production Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="production_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Production Review Completed By</label>
                                        <input type="text" name="production_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Production Review Completed On</label>
                                        <input type="date" name="production_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Warehouse
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Warehouse Review Required ?</label>
                                        <select name="Warehouse_notification" id="Warehouse_review">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Warehouse Person</label>
                                        <select name="Warehouse_notification" id="Warehouse_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Warehouse)</label>
                                        <textarea class="summernote" name="Warehouse_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Warehouse Feedback</label>
                                        <textarea class="summernote" name="Warehouse_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Warehouse Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Warehouse_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Warehouse Review Completed By</label>
                                        <input type="text" name="production_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Warehouse Review Completed On</label>
                                        <input type="date" name="production_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Quality Control
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Quality Control Review Required ?</label>
                                        <select name="Warehouse_notification" id="Warehouse_review">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Quality Control Person</label>
                                        <select name="Quality Control_notification" id="Warehouse_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Quality Control)</label>
                                        <textarea class="summernote" name="Quality_Control_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Control Feedback</label>
                                        <textarea class="summernote" name="Quality Control_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Quality Control_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Control Review Completed By</label>
                                        <input type="text" name="Quality_Control__by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Control Review Completed On</label>
                                        <input type="date" name="Quality_Control__on" disabled>
                                    
                                    </div>
                                </div>
                                  <div class="sub-head">
                                  Quality Assurance
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Quality Assurance Review Required ?</label>
                                        <select name="Quality_Assurance" id="">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Quality Assurance  Person</label>
                                        <select name="QualityAssurance_person" id="QualityAssurance_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Quality Assurance)</label>
                                        <textarea class="summernote" name="QualityAssurance_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>   
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Assurance  Feedback</label>
                                        <textarea class="summernote" name="QualityAssurance_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Quality Assurance  Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Quality_Assurance_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Assurance Review Completed By</label>
                                        <input type="text" name="QualityAssurance_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Assurance Review Completed On</label>
                                        <input type="date" name="QualityAssurance_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Engineering
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Review Required ?</label>
                                        <select name="Engineering_required" id="Engineering_review">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering  Person</label>
                                        <select name="Engineering_person" id="Engineering_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Engineering)</label>
                                        <textarea class="summernote" name="Engineering_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>  
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Engineering  Feedback</label>
                                        <textarea class="summernote" name="Engineering_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering  Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Engineering_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Engineering Review Completed By</label>
                                        <input type="text" name="Engineering_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Engineering Review Completed On</label>
                                        <input type="date" name="Engineering_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Analytical Development Laboratory
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Analytical Development Laboratory Review Required ?</label>
                                        <select name="Analytical_Development" id="Analytical_Development_review">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Analytical Development Laboratory  Person</label>
                                        <select name="Engineering_person" id="Analytical_Development_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Analytical Development Laboratory)</label>
                                        <textarea class="summernote" name="Analytical_Development_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Analytical Development Laboratory  Feedback</label>
                                        <textarea class="summernote" name="Analytical_Development_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Analytical Development Laboratory Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Analytical_Development_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Analytical Development Laboratory Review Completed By</label>
                                        <input type="text" name="Analytical_Development_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Analytical Development Laboratory Review Completed On</label>
                                        <input type="date" name="Analytical_Development_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Process Development Laboratory / Kilo Lab
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Process Development Laboratory / Kilo Lab Review Required ?</label>
                                        <select name="Kilo_Lab" id="Kilo_Lab_review">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Process Development Laboratory / Kilo Lab  Person</label>
                                        <select name="Kilo_Lab_person" id="Kilo_Lab_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Process Development Laboratory / Kilo Lab)</label>
                                        <textarea class="summernote" name="Kilo_Lab_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Process Development Laboratory / Kilo Lab  Feedback</label>
                                        <textarea class="summernote" name="Kilo_Lab_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Kilo_Lab_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Process Development Laboratory / Kilo Lab Review Completed By</label>
                                        <input type="text" name="Kilo_Lab_attachment_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Process Development Laboratory / Kilo Lab Review Completed On</label>
                                        <input type="date" name="Kilo_Lab_attachment_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Technology Transfer / Design
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Technology Transfer / Design Review Required ?</label>
                                        <select name="Kilo_Lab" id="Technology_transfer/Design">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Technology Transfer / Design  Person</label>
                                        <select name="Kilo_Lab_person" id="Technology_transfer/Design">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Technology Transfer / Design)</label>
                                        <textarea class="summernote" name="Technology_transfer_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Technology Transfer / Design  Feedback</label>
                                        <textarea class="summernote" name="Technology_transfer/Design" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Technology_transfer/Design_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed By</label>
                                        <input type="text" name="Technology_transfer/Design_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed On</label>
                                        <input type="date" name="Technology_transfer/Design_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Environment, Health & Safety
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Environment, Health & Safety Review Required ?</label>
                                        <select name="Environment_Health_required" id="Environment_Health_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Environment, Health & Safety  Person</label>
                                        <select name="Kilo_Lab_person" id="Environment_Health_Safety_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Environment, Health & Safety)</label>
                                        <textarea class="summernote" name="Health_Safety_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Environment, Health & Safety  Feedback</label>
                                        <textarea class="summernote" name="Health_Safety_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Environment, Health & Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Environment_Health_Safety_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Environment, Health & Safety Review Completed By</label>
                                        <input type="text" name="Environment_Health_Safety_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Environment, Health & Safety Review Completed On</label>
                                        <input type="date" name="Environment_Health_Safety_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Human Resource & Administration
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Human Resource & Administration Review Required ?</label>
                                        <select name="Human_Resource_required" id="Human_Resource_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Human Resource & Administration  Person</label>
                                        <select name="Human_Resource_person" id="Human_Resource_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Human Resource & Administration )</label>
                                        <textarea class="summernote" name="Human_Resource_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration  Feedback</label>
                                        <textarea class="summernote" name="Human_Resource_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Human Resource & Administration Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Human_Resource_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Human Resource & Administration Review Completed By</label>
                                        <input type="text" name="Human_Resource_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Human Resource & Administration Review Completed On</label>
                                        <input type="date" name="Human_Resource_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Information Technology
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Information Technology Review Required ?</label>
                                        <select name=" Information_Technology_required" id=" Information_Technology_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Information Technology  Person</label>
                                        <select name=" Information_Technology_person" id=" Information_Technology_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Information Technology)</label>
                                        <textarea class="summernote" name="Information_Technology_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>  
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Information Technology  Feedback</label>
                                        <textarea class="summernote" name=" Information_Technology_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">  Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id=" Information_Technology_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Information Technology Review Completed By</label>
                                        <input type="text" name="Information_Technology_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Information Technology Review Completed On</label>
                                        <input type="date" name="Information_Technology_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Project Management
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Project management Review Required ?</label>
                                        <select name="Project_management_required" id="Project_management_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Project management Person</label>
                                        <select name="Project_management_person" id="Project_management_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By  Project management )</label>
                                        <textarea class="summernote" name="Project_management_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Project management  Feedback</label>
                                        <textarea class="summernote" name="Project_management_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Project_management_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Project management Review Completed By</label>
                                        <input type="text" name="Project_management_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Project management Review Completed On</label>
                                        <input type="date" name="Project_management_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Other's 1 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Review Required ?</label>
                                        <select name="Other1_required" id="Project_management_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Person</label>
                                        <select name="Other1_person" id="Project_management_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Department</label>
                                        <select name="Other1_person" id="Other1_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option value="Human Resource & Administration">Human Resource & Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>
                                            


                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By  Other's 1)</label>
                                        <textarea class="summernote" name="Other1_assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 1 Feedback</label>
                                        <textarea class="summernote" name="Other1_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other1_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 1 Review Completed By</label>
                                        <input type="text" name="Other1_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 1 Review Completed On</label>
                                        <input type="date" name="Other1_on" disabled>
                                    
                                    </div>
                                </div>

                                <div class="sub-head">
                                Other's 2 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Review Required ?</label>
                                        <select name="Other2_required" id="Project_management_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Person</label>
                                        <select name="Other2_person" id="Project_management_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Department</label>
                                        <select name="Other2_person" id="Other1_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option value="Human Resource & Administration">Human Resource & Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>
                                            


                                        </select>
                                  
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By  Other's 2)</label>
                                        <textarea class="summernote" name="Other2_Assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 2 Feedback</label>
                                        <textarea class="summernote" name="Other2_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other2_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 2 Review Completed On</label>
                                        <input type="date" name="Other2_on" disabled>
                                    
                                    </div>
                                </div>

                                <div class="sub-head">
                                Other's 3 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Review Required ?</label>
                                        <select name="Other3_required" id="Other3_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Person</label>
                                        <select name="Other3_person" id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Department</label>
                                        <select name="Project_management_person" id="Other1_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option value="Human Resource & Administration">Human Resource & Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>
                                            


                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By  Other's 3)</label>
                                        <textarea class="summernote" name="Other3_Assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Feedback</label>
                                        <textarea class="summernote" name="Other3_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other3_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 3 Review Completed On</label>
                                        <input type="date" name="Other3_on" disabled>
                                    
                                    </div>
                                </div>


                                <div class="sub-head">
                                Other's 4 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 4 Review Required ?</label>
                                        <select name="Other4_required" id="Other4_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 4 Person</label>
                                        <select name="Other4_person" id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 4 Department</label>
                                        <select name="Other4_Department_person" id="Other4_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option value="Human Resource & Administration">Human Resource & Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>
                                            


                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By  Other's 4)</label>
                                        <textarea class="summernote" name="Other4_Assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 4 Feedback</label>
                                        <textarea class="summernote" name="Other4_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other4_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 4 Review Completed On</label>
                                        <input type="date" name="Other4_on" disabled>
                                    
                                    </div>
                                </div>



                                <div class="sub-head">
                                Other's 5 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 5 Review Required ?</label>
                                        <select name="Other4_required" id="Other5_required">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 5 Person</label>
                                        <select name="Other5_person" id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            <option value="person1">Person 1</option>
                                           

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 5 Department</label>
                                        <select name="Other5_Department_person" id="Other5_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option value="Human Resource & Administration">Human Resource & Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>
                                            


                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By  Other's 5)</label>
                                        <textarea class="summernote" name="Other5_Assessment" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback</label>
                                        <textarea class="summernote" name="Other5_feedback" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other5_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 5 Review Completed On</label>
                                        <input type="date" name="Other5_on" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-12">
                            
        </div>
    </div>
 </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <!-- investigation and capa -->
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Investigation Summary</label>
                                        <textarea id="Investigation_Summary" name="Investigation_Summary" value="{{ $data->Investigation_Summary }}"  cols="30" ></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Investigation Summary</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Investigation_Summary" id="summernote-8">{{ $data->Investigation_Summary }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Impect assessment">Impact Assessment</label>
                                        <textarea id="Impect_assessment" name="Impect_assessment" value="{{ $data->Impect_assessment }}"  cols="30" ></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Impact_assessment" id="summernote-9">{{ $data->Impact_assessment }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause</label>
                                        <textarea id="Root_cause" name="Root_cause" value="{{ $data->Root_cause }}"  cols="30" ></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Root_cause" id="summernote-10">{{ $data->Root_cause }}</textarea>
                                    </div>
                                </div>
                                
                                
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="CAPA Rquired">CAPA Required ? </label>
                                      <select name="CAPA_Rquired"  id="CAPA_Rquired" value="{{ $data->CAPA_Rquired }}">
                                        <option value=""> -- Select --</option>
                                        <option @if ($data->CAPA_Rquired == 'yes') selected @endif
                                            value="yes">Yes</option>
                                        <option  @if ($data->CAPA_Rquired == 'no') selected @endif 
                                           value="no">No</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="capa type">CAPA Type?</label>
                                      <select name="capa_type"  id="capa_type" value="{{ $data->capa_type }}">
                                        <option value="0"> -- Select --</option>
                                        <option @if ($data->capa_type == 'Corrective_Action') selected @endif
                                            value="Corrective_Action">Corrective Action</option>
                                        <option  @if ($data->capa_type == 'Preventive_Action') selected @endif 
                                           value="Preventive_Action"> Preventive Action</option>
                                        <option  @if ($data->capa_type == 'Corrective&Preventive') selected @endif 
                                            value="Corrective&Preventive">Corrective & Preventive Action both</option>   
                                      </select>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="External Auditing Agency">CAPA Description</label>
                                        <textarea  name="CAPA_Description" value="CAPA_Description"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="CAPA Description">CAPA Description</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="CAPA_Description" id="summernote-11">{{ $data->CAPA_Description }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="External Auditing Agency ">Post Categorization Of Deviation</label>
                                        <textarea class="summernote" name="Post_Categorization"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Post Categorization Of Deviation">Post Categorization Of Deviation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <select name="Post_Categorization" id="Post_Categorization" value="Post_Categorization">
                                        <option value=""> -- Select --</option>
                                        <option @if ($data->Post_Categorization == 'yes') selected @endif
                                            value="yes">Yes</option>
                                        <option  @if ($data->Post_Categorization == 'no') selected @endif 
                                           value="no">No</option>
                                      </select>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="External Auditing Agency">Investigation Of Revised Categorization</label>
                                        <textarea class="summernote" name="Investigation_Of_Review"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Of Revised Categorization">Investigation Of Revised Categorization</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Investigation_Of_Review" id="summernote-13">{{ $data->Investigation_Of_Review }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigatiom Attachment">Investigatiom Attachment </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                            
                                            
                                            </div>
                                       
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attachment[]"
                                                    oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigatiom Attachment">Investigatiom Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Investigation_attachment">
                                                @if ($data->Investigation_attachment)
                                                @foreach(json_decode($data->Investigation_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Investigation_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Investigation_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa_Attachments">CAPA Attachment </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                            
                                            
                                            </div>
                                       
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attachment[]"
                                                    oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa_Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Capa_attachment">
                                                @if ($data->Capa_attachment)
                                                @foreach(json_decode($data->Capa_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Capa_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Capa_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- QA Final Review -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                
                                
                            {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Feedbacks">QA Feedbacks</label>
                                        <textarea class="summernote"  name="QA_Feedbacks" value="QA_Feedbacks"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="QA Feedbacks">QA Feedbacks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="QA_Feedbacks" id="summernote-14">{{ $data->QA_Feedbacks }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">QA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="audit_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Audit_file[]"
                                                    oninput="addMultipleFiles(this, 'audit_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA attachments">QA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="QA_attachments">
                                                @if ($data->QA_attachments)
                                                @foreach(json_decode($data->QA_attachments) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="QA_attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_attachments')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- QAH-->
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                
                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="Remarks">Closure Comments</label>
                                        <textarea class="summernote" name="Closure_Comments" value="Closure_Comments"></textarea>
                                    </div>
                                </div> --}}
                                
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Closure Comments">Closure Comments</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Closure_Comments" id="summernote-15">{{ $data->Closure_Comments }}</textarea>
                                    </div>
                                </div>

                                
                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="Audit Comments">Disposition of Batch</label>
                                        <textarea class="summernote"  name="Disposition_Batch" value="Disposition_Batch"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Disposition of Batch">Disposition of Batch</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16">{{ $data->Disposition_Batch }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="QAH assessment ">Closure Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>                                        
                                            </div>                                   
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attachment[]"
                                                    oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Closure Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="closure_attachment">
                                                @if ($data->closure_attachment)
                                                @foreach(json_decode($data->closure_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="closure_attachment[]"
                                                    oninput="addMultipleFiles(this, 'closure_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Log content -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Submission</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit by">Submit By :-</label>
                                        <div class="static">{{ $data->submit_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">Submit On :-</label>
                                        <div class="static">{{ $data->submit_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="group-input" style="width:1620px; height:100px; line-height:3em; overflow:scroll; `padding:5px;">
                                    <label for="submit comment">Submit Comments :-</label>
                                    <div class="">{{ $data->submit_comment }}</div> 
                                </div>    
                                </div>
                                    
                                <div class="sub-head">HOD Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By">HOD Review Complete By :-</label>
                                        <div class="static">{{ $data->HOD_Review_Complete_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete On">HOD Review Complete On :-</label>
                                        <div class="static">{{ $data->HOD_Review_Complete_On }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input" style="width:1620px; height:100px; line-height:3em; overflow:scroll; `padding:5px; ">
                                        <label for="HOD Review Comments">HOD Review Comments :-</label>
                                        <div class="">{{ $data->HOD_Review_Comments }}</div>
                                    </div>
                                </div>
                                

                                <div class="sub-head">QA Initial Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete By">QA Initial Review Complete By :-</label>
                                        <div class="static">{{ $data->QA_Initial_Review_Complete_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete On">QA Initial Review Complete On :-</label>
                                        <div class="static">{{ $data->QA_Initial_Review_Complete_On }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input" style="width:1620px; height:100px; line-height:3em; overflow:scroll; `padding:5px; ">
                                        <label for="QA Initial Review Comments">QA Initial Review Comments:-</label>
                                        <div class="">{{ $data->QA_Initial_Review_Comments }}</div>
                                    </div>
                                </div>
                                <div class="sub-head">CFT Review Complete</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CFT Review Complete By">CFT Review Complete By :-</label>
                                        <div class="static">{{ $data->CFT_Review_Complete_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CFT Review Complete On">CFT Review Complete On :-</label>
                                        <div class="static">{{ $data->CFT_Review_Complete_On }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input" style="width:1620px; height:100px; line-height:3em; overflow:scroll; `padding:5px; ">
                                        <label for="CFT Review Comments">CFT Review Comments :-</label>
                                        <div class="">{{ $data->CFT_Review_Comments }}</div>
                                    </div>
                                </div>
                                <div class="sub-head"> QA Final Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete By"> QA Final Review Complete By :-</label>
                                        <div class="static">{{ $data->QA_Final_Review_Complete_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete On"> QA Final Review Complete On :-</label>
                                        <div class="static">{{ $data->QA_Final_Review_Complete_On }}</div>
                                    </div>
                                </div> <div class="col-lg-12">
                                    <div class="group-input" style="width:1620px; height:100px; line-height:3em; overflow:scroll; `padding:5px; ">
                                        <label for="QA Final Review Comments"> QA Final Review Comments :-</label>
                                        <div class="">{{ $data->QA_Final_Review_Comments }}</div>
                                    </div>
                                </div>
                                <div class="sub-head">Approved</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved By">Approved By :-</label>
                                        <div class="static">{{ $data->Approved_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved On">Approved On :-</label>
                                        <div class="static">{{ $data->Approved_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input" style="width:1620px; height:100px; line-height:3em; overflow:scroll; `padding:5px; ">
                                        <label for="Approved Comments">Approved Comments :-</label>
                                        <div class="">{{ $data->Approved_Comments }}</div>
                                    </div>
                                </div>
                                
                                
                                
                               
                                

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit">Submit</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

<!-- -----------------------------------------------------------modal body---------------------- -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div style="background: #f7f2f" class="modal-header">
        <h4 class="modal-title">Customers</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div  class="modal-body">
        <div style="backgorund: #e9e2e2;" class="modal-sub-head">
<div class="sub-main-head">

 <div  class="left-box">

    <div class="Activity-type">
        <label style="font-weight: bold;" for="">Customer ID :</label>
         
        <input type="text">
    </div>
    <div class="Activity-type ">
        <label style="font-weight: bold;     margin-left: 30px;" for=""> Email ID :</label>
        
        <input type="text">
    </div>
    <div class="Activity-type ">
        <label style="font-weight: bold;     margin-left: -20px;" for=""> Customer Type :</label>
       
        <input type="text">
    </div>
    <div class="Activity-type ">
        <label style="font-weight: bold;     margin-left: 42px;" for=""> Status :</label>
        
        <input type="text">
    </div>
 </div>


 <div class="right-box">
    
    <div class="Activity-type">
        <label style="font-weight: bold; " for="">Customer Name :</label>
        
        <input type="text">
        
    </div>
    
    <div class="Activity-type">
        <label style="font-weight: bold;  margin-left: 36px;" for="">Contact No :</label>
        
        <input type="text">
        
    </div>
    <div class="Activity-type">
        <label style="font-weight: bold;     margin-left: 57px;" for="">Industry :</label>
        
        <input type="text">
        
    </div>
    <div class="Activity-type">
        <label style="font-weight: bold;     margin-left: 66px; " for="">Region :</label>
        
        <input type="text">
        
    </div>
 </div>
 
</div>
</div>
<div class="Activity-type">

       
        
       <textarea style="margin-left: 126px; margin-top: 15px; width: 79%;" placeholder="Remarks" name="" id="" cols="30" ></textarea>
        
    </div>
      </div>
      
      

    </div>
  </div>
</div>
<!-- -----------------------------------------------------end---------------------- -->
   
    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>
    <script>
        document.getElementById('myfile').addEventListener('change', function() {
            var fileListDiv = document.querySelector('.file-list');
            fileListDiv.innerHTML = ''; // Clear previous entries

            for (var i = 0; i < this.files.length; i++) {
                var file = this.files[i];
                var listItem = document.createElement('div');
                listItem.textContent = file.name;
                fileListDiv.appendChild(listItem);
            }
        });
    </script>

<script>
        VirtualSelect.init({
            ele: '#reference_record, #notify_to'
        });

        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        let referenceCount = 1;

        function addReference() {
            referenceCount++;
            let newReference = document.createElement('div');
            newReference.classList.add('row', 'reference-data-' + referenceCount);
            newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
            let referenceContainer = document.querySelector('.reference-data');
            referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
        }
    </script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record'
        });

        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }



        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";

            // Find the index of the clicked tab button
            const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

            // Update the currentStep to the index of the clicked tab
            currentStep = index;
        }

        const saveButtons = document.querySelectorAll(".saveButton");
        const nextButtons = document.querySelectorAll(".nextButton");
        const form = document.getElementById("step-form");
        const stepButtons = document.querySelectorAll(".cctablinks");
        const steps = document.querySelectorAll(".cctabcontent");
        let currentStep = 0;

        function nextStep() {
            // Check if there is a next step
            if (currentStep < steps.length - 1) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show next step
                steps[currentStep + 1].style.display = "block";

                // Add active class to next button
                stepButtons[currentStep + 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep++;
            }
        }

        function previousStep() {
            // Check if there is a previous step
            if (currentStep > 0) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show previous step
                steps[currentStep - 1].style.display = "block";

                // Add active class to previous button
                stepButtons[currentStep - 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep--;
            }
        }
    </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addRowButton = document.getElementById('new-button-icon');
    addRowButton.addEventListener('click', function() {
        const department = this.parentNode.innerText.trim(); // Get the department name
            
        // Create a new row and insert it after the current row
        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td style="background: #e1d8d8">${department}</td>
                            <td><textarea name="Person"></textarea></td>
                            <td><textarea name="Impect_Assessment"></textarea></td>
                            <td><textarea name="Comments"></textarea></td>
                            <td><textarea name="sign&date"></textarea></td>
                            <td><textarea name="Remarks"></textarea></td>`;
                
        // Insert the new row after the current row
        const currentRow = this.parentNode.parentNode;
        currentRow.parentNode.insertBefore(newRow, currentRow.nextSibling);
    });
});
</script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     document.getElementById('type_of_audit').addEventListener('change', function() {
        //         var typeOfAuditReqInput = document.getElementById('type_of_audit_req');
        //         if (typeOfAuditReqInput) {
        //             var selectedValue = this.value;
        //             if (selectedValue == 'others') {
        //                 typeOfAuditReqInput.setAttribute('required', 'required');
        //             } else {
        //                 typeOfAuditReqInput.removeAttribute('required');
        //             }
        //         } else {
        //             console.error("Element with id 'type_of_audit_req' not found");
        //         }
        //     });
        // });
    </script>
    <script>
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>
     <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);});
    </script>

<script>
        function addWhyField(con_class, name) {
            let mainBlock = document.querySelector('.why-why-chart')
            let container = mainBlock.querySelector(`.${con_class}`)
            let textarea = document.createElement('textarea')
            textarea.setAttribute('name', name);
            container.append(textarea)
        }
    </script>
    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('deviation_child_1', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            @if ($data->stage == 3)
                                <label for="major">
                                    <input type="radio" name="child_type" id="major"
                                        value="rca">
                                        RCA
                                </label>
                                <br>
                                <label for="major">
                                    <input type="radio" name="child_type" id="major"
                                        value="extension">
                                        Extension
                                </label>
                            @endif
                            
                            @if ($data->stage == 5)
                                <label for="major">
                                    <input type="radio" name="child_type" id="major"
                                        value="capa">
                                        CAPA
                                </label>
                                <br>
                                <label for="major">
                                    <input type="radio" name="child_type" id="major"
                                        value="extension">
                                        Extension
                                </label>
                            @endif
                        </div>
    
                    </div>
    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Continue</button>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="child-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form  method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="major">
                                <input type="radio" name="rsa" id="major"
                                    value="rsa">
                                    RSA
                            </label>
                            <br>
                            <label for="major1">
                                <input type="radio" name="extension" id="major1"
                                    value="extension">
                                    Extension
                            </label>
                        </div>
    
                    </div>
    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Continue</button>
                    </div>
                </form>
    
            </div>
        </div>
    </div> --}}
    
    <div class="modal fade" id="more-info-required-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"> 
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
    
                <form action="{{ route('deviation_reject', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" name="comment" required>
                        </div>
                    </div>
    
                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div> -->
                    <div class="modal-footer">
                      <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
    
                <form action="{{ route('deviationCancel', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" name="comment" required>
                        </div>
                    </div>
    
                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div> -->
                    <div class="modal-footer">
                      <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('deviation_send_stage', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
                        </div>
                    </div>
    
                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div> -->
                    <div class="modal-footer">
                      <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('deviation_qa_more_info', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
                        </div>
                    </div>
    
                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div> -->
                    <div class="modal-footer">
                      <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <style>
        #step-form>div {
            display: none
        }
    
        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>
    
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record'
        });
    
        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    
    
    
        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
    
            // Find the index of the clicked tab button
            const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);
    
            // Update the currentStep to the index of the clicked tab
            currentStep = index;
        }
    
        const saveButtons = document.querySelectorAll(".saveButton");
        const nextButtons = document.querySelectorAll(".nextButton");
        const form = document.getElementById("step-form");
        const stepButtons = document.querySelectorAll(".cctablinks");
        const steps = document.querySelectorAll(".cctabcontent");
        let currentStep = 0;
    
        function nextStep() {
            // Check if there is a next step
            if (currentStep < steps.length - 1) {
                // Hide current step
                steps[currentStep].style.display = "none";
    
                // Show next step
                steps[currentStep + 1].style.display = "block";
    
                // Add active class to next button
                stepButtons[currentStep + 1].classList.add("active");
    
                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");
    
                // Update current step
                currentStep++;
            }
        }
    
        function previousStep() {
            // Check if there is a previous step
            if (currentStep > 0) {
                // Hide current step
                steps[currentStep].style.display = "none";
    
                // Show previous step
                steps[currentStep - 1].style.display = "block";
    
                // Add active class to previous button
                stepButtons[currentStep - 1].classList.add("active");
    
                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");
    
                // Update current step
                currentStep--;
            }
        }
    </script>
        <script>
            document.getElementById('initiator_group').addEventListener('change', function() {
                var selectedValue = this.value;
                document.getElementById('initiator_group_code').value = selectedValue;
            });
        </script>
         <script>
            document.addEventListener('DOMContentLoaded', function () {
                const removeButtons = document.querySelectorAll('.remove-file');
    
                removeButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const fileName = this.getAttribute('data-file-name');
                        const fileContainer = this.closest('.file-container');
    
                        // Hide the file container
                        if (fileContainer) {
                            fileContainer.style.display = 'none';
                        }
                    });
                });
            });
        </script> 
        <script>
            var maxLength = 255;
            $('#docname').keyup(function() {
                var textlen = maxLength - $(this).val().length;
                $('#rchars').text(textlen);});
        </script>
@endsection
