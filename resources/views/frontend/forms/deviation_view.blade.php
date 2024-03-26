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
 <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }

        .sub-main-head {
        display: flex;
        justify-content: space-evenly;
    } 

    .Activity-type {
        margin-bottom: 7px;
    }

    /* .sub-head {
        margin-left: 280px;
        margin-right: 280px;
        color: #4274da;
        border-bottom: 2px solid #4274da;
        padding-bottom: 5px;
        margin-bottom: 20px;
        font-weight: bold;
        font-size: 1.2rem;

    } */

    .create-entity {
        background: #323c50;
        padding: 10px 15px;
        color: white;
        margin-bottom: 20px;

    }

    .bottom-buttons {
        display: flex;
        justify-content: flex-end;
        margin-right: 300px;
        margin-top: 50px;
        gap: 20px;
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
                            $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                            $cftUsers = DB::table('deviationcfts')->where(['deviation_id' => $data->id])->first();

                            // Define the column names
                            $columns = ['Production_person', 'Warehouse_notification', 'Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Analytical_Development_person', 'Kilo_Lab_person', 'Technology_transfer_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Project_management_person'];

                            // Initialize an array to store the values
                            $valuesArray = [];

                            // Iterate over the columns and retrieve the values
                            foreach ($columns as $column) {
                                $value = $cftUsers->$column;
                                // Check if the value is not null and not equal to 0
                                if ($value !== null && $value != 0) {
                                    $valuesArray[] = $value;
                                }
                            }
                            $cftCompleteUser = DB::table('deviationcfts_response')
                            ->whereIn('status', ['In-progress', 'Completed'])
                                ->where('deviation_id',$data->id)
                                ->where('cft_user_id', Auth::user()->id)
                                ->whereNull('deleted_at')
                                ->first();
                            // dd($cftCompleteUser);
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
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cft-not-reqired">
                                CFT Review Not Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                        @elseif($data->stage == 4 && (in_array(5, $userRoleIds) || in_array(18, $userRoleIds) || in_array(Auth::user()->id, $valuesArray)))
                        @if(!$cftCompleteUser)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                            </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    CFT Review Complete
                                </button>
                            @endif 
                        @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                                Send to Initiator
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                                Send to HOD
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                                Send to QA Initial Review
                            </button>
                             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Final Review Complete
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

    <div style="background: #e0903230;" id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div  class="cctab">
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
                                            value="{{ $divisionName }}">
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
                                <div class="col-lg-6 new-date-data-field ">
                                    <div class="group-input input-date">
                                        <label for="Short Description required">Nature of Repeat?</label>
                                        <select name="short_description_required" id="short_description_required" value="{{ $data->short_description_required }}">
                                            <option value="0">-- Select --</option>
                                            <option value="Recurring"
                                            @if ($data->short_description_required == 'Recurring') selected @endif>Recurring</option>
                                            <option value="Non_Recurring"
                                            @if ($data->short_description_required == 'Non_Recurring') selected @endif>Non Recurring</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="nature_of_repeat">
                                        <label for="nature_of_repeat">Repeat Nature<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="nature_of_repeat" class="nature_of_repeat">{{ $data->nature_of_repeat }}</textarea>
                                    </div>
                                </div>
                             <div class="col-6" >
                                    <div class="group-input">
                                        <label for="severity-level">Deviation Observed On</label>
                                        <!-- <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span> -->
                                       <input type="date" id="Deviation_date" name="Deviation_date" value="{{ $data->Deviation_date }}">
                                    </div>
                                </div>
                              {{--  <div class="col-lg-6">
                                    <div class="group-input">
                                        @php
                                            $users = DB::table('users')->get();
                                            $facilities = $data->Facility;
                                        @endphp
                                        <label for="If Other">Deviation Observed By<span class="text-danger d-none">*</span></label>
                                        <select multiple name="Facility[]" placeholder="Select Facility Name"
                                            data-search="false" data-silent-initial-value-set="true" id="Facility">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @if (in_array($user->id, explode(',', $data->Facility))) selected @endif>{{ $user->name }}</option>
                                            @endforeach                                           
                                        </select>
                                    </div>
                                </div> --}}
                                 {{-- <div class="col-lg-6">
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
                                                                                        <option @if ($data->audit_type == 'SOP Instruction') selected @endif
                                                                                            value="SOP Instruction">SOP Instruction</option>
                                                                                            <option @if ($data->audit_type == 'BMR/ECR Instruction') selected @endif
                                                                                                value="BMR/ECR Instruction">BMR/ECR Instruction</option>
                                                                                        <option @if ($data->audit_type == 'Anyother(specify)') selected @endif
                                                                                            value="Anyother(specify)">Anyother(specify)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="others">Others</label>
                                        <input type="text" id="others" name="others">
                                    </div>
                                </div> 
                               <div>  --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        @php
                                            $users = DB::table('users')->get();
                                            $selectedFacilities = explode(',', $data->Facility); // Convert to array if it's not already
                                        @endphp
                                        <label for="If Other">Deviation Observed By<span class="text-danger d-none">*</span></label>
                                        <select multiple name="Facility[]" placeholder="Select Facility Name" data-search="false" data-silent-initial-value-set="true" id="Facility">
                                            @foreach ($users as $user)
                                                <option {{ in_array($user->id, $selectedFacilities) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach                                           
                                        </select>
                                    </div>
                                </div> 
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
                                                data-bs-target="#document-details-field-instruction-modal"
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
                                  
                                <div class="col-lg-12">
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
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Description Deviation">Description of Deviation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">{{ $data->Description_Deviation }}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Production feedback">Production Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Production_feedback" id="summernote-18">{{ $data1->Production_feedback }}
                                    </textarea>
                                    </div>
                                </div> -->
                                {{-- <div class="col-6">
                                <div class="group-input">
                                        <label for="Initial Comments">Immediate Action (if any)</label>
                                        <textarea class="summernote" name="Immediate_Action[]" value="{{$data->Immediate_Action}}"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
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
                                <div class="col-md-12">
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
                                

                                
                                
                                {{-- <div class="group-input">
                                        <label for="audit-agenda-grid">
                                       Product Details 
                                            <button type="button" name="audit-agenda-grid"
                                                id="ProductDetails">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#product-details-field-instruction-modal"
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
                                    </div> --}}
                                
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
                                <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
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
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Justification for  categorization">Justification for  categorization</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Justification_for_categorization" id="summernote-5">{{ $data->Justification_for_categorization }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Investigation required">Investigation  Required ?</label>
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
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Details">Investigation Details</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote Investigation_Details" name="Investigation_Details" id="summernote-6">{{ $data->Investigation_Details }}</textarea>
                                        <span class="error-message" style="color: red; display: none;">Please fill out this field.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Customer Notification Required ? </label>
                                        <select name="Customer_notification" id="Customer_notification" value="{{ $data->Customer_notification }}" >
                                            <option value="0">-- Select --</option>
                                            <option  @if ($data->Customer_notification == 'yes') selected @endif
                                             value="yes">Yes</option>
                                            <option  @if ($data->Customer_notification == 'no') selected @endif 
                                            value="no">No</option>
                                            <option  @if ($data->Customer_notification == 'na') selected @endif 
                                                value="na">Na</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="group-input">
                                        @php
                                            $customers = DB::table('customer-details')->get();
                                            // dd($data->customer);
                                        @endphp
                                        <label for="customers">Customers</label>
                                        <select name="customers" id="customers">
                                            <option value="0"> -- Select --</option>
                                            @foreach ($customers as $data1)
                                            <option  @if ($data->customers == 'yes') selected @endif
                                                value="{{ $data1->id }}">{{ $data1->customer_name }}</option>
                                            {{-- <option {{ $data->customers != null && $data->customers == $data->id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->customer_name }}</option> --}}
                                        @endforeach
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
                                            <label for="related_records">Related Records<span class="text-danger d-none"></span></label>
                                            <select  multiple name="related_records[]" placeholder="Select Facility Name"
                                                data-search="false" data-silent-initial-value-set="true" id="related_records">
                                                @foreach ($pre as $prix)
                                                    <option value="{{ $prix->id }}">
                                                        {{ Helpers::getDivisionName($prix->division_id) }}/Deviation/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                    </option>
                                                @endforeach                                         
                                            </select>
                                        </div>
                                </div>

                                {{-- <div class="col-12">
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
                                </div> --}}
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
                                        <label for="QA Initial Attachments">QA Initial Attachments</label>
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
                    <script>
                        $(document).ready(function () {
                            $('#Deviation_category').change(function () {
                                if ($(this).val() === 'major') {
                                    $('#Investigation_required').val('yes').prop('disabled', true);
                                    $('#Customer_notification').val('yes').prop('disabled', true);
                                } else {
                                    $('#Customer_notification').prop('disabled', false);
                                    $('#Investigation_required').prop('disabled', false);
                                }
                                // if ($(this).val() === 'major') {
                                //     $('#Investigation_required').val('yes');
                                //     $('#Customer_notification').val('yes');
                                // }
                            });
                        });
                    </script>
                    {{-- <script>
                        $(document).ready(function () {
                            // Event listener for Investigation_required dropdown
                            $('#Investigation_required').change(function () {
                                if ($(this).val() === 'yes') {
                                    // If "Yes" is selected, make Investigation_Details field required
                                    $('.Investigation_Details').prop('required', true);
                                } else {
                                    // If "No" or any other option is selected, remove the required attribute
                                    $('.Investigation_Details').prop('required', false);
                                    // Hide error message when not required
                                    $('.error-message').hide();
                                }
                            });
                    
                            // Event listener for Investigation_Details field
                            $('.Investigation_Details').blur(function () {
                                // Check if the field is empty and required
                                if ($(this).prop('required') && $(this).val().trim() === '') {
                                    // Show error message if empty
                                    $('.error-message').show();
                                } else {
                                    // Hide error message if not empty
                                    $('.error-message').hide();
                                }
                            });
                    
                            // Initial check when page loads
                            if ($('#Investigation_required').val() === 'yes') {
                                $('.Investigation_Details').prop('required', true);
                            }
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                            // Event listener for Customer_notification dropdown
                            $('#Customer_notification').change(function () {
                                if ($(this).val() === 'yes') {
                                    // If "Yes" is selected, make Investigation_Details field required
                                    $('#customers').prop('required', true);
                                } else {
                                    // If "No" or any other option is selected, remove the required attribute
                                    $('#customers').prop('required', false);
                                    // Hide error message when not required
                                    $('.error-message').hide();
                                }
                            });
                    
                            // Event listener for Investigation_Details field
                            $('#customers').blur(function () {
                                // Check if the field is empty and required
                                if ($(this).prop('required') && $(this).val().trim() === '') {
                                    // Show error message if empty
                                    $('.error-message').show();
                                } else {
                                    // Hide error message if not empty
                                    $('.error-message').hide();
                                }
                            });
                    
                            // Initial check when page loads
                            if ($('#Customer_notification').val() === 'yes') {
                                $('#customers').prop('required', true);
                            }
                        });
                    </script> --}}
                    
                    <!-- CFT -->
                    {{-- @php
                    $deviationsCFTs = DB::table('deviationcfts')->where('deviation_id', $id)->first();
                    @endphp --}}
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                            <div class="sub-head">
                            Production
                           </div>
                           <div class="col-lg-6">
                            @php
                                    $data1 = DB::table('deviationcfts')->where('deviation_id', $data->id)->first();
                            @endphp
                                    <div class="group-input">
                                        <label for="Production Review">Production Review Required ?</label>
                                        <select name="Production_Review" id="Production_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Production_Review == 'yes') selected @endif
                                             value="yes">Yes</option>
                                            <option  @if ($data1->Production_Review == 'no') selected @endif 
                                            value="no">No</option>
                                            <option  @if ($data1->Production_Review == 'na') selected @endif 
                                                value="na">NA</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production notification">Production Person</label>
                                        <select name="Production_person" id="Production_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @if ($user->id == $data1->Production_person) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Production assessment">Impact Assessment (By Production)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Production_assessment" id="summernote-17">{{ $data1->Production_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Production feedback">Production Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Production_feedback" id="summernote-18">{{ $data1->Production_feedback }}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="production attachment">Production Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="production_attachment">
                                                @if ($data1->production_attachment)
                                                @foreach(json_decode($data1->production_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="production_attachment[]"
                                                    oninput="addMultipleFiles(this, 'production_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Production Review Completed By">Production Review Completed By</label>
                                        <input type="text" name="production_by" id="production_by" value={{ $data1->Production_by }} disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Review Completed On">Production Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="production_on" name="production_on" value="{{ $data1->production_on }}" >
                                    </div>
                                </div>
                                <div class="sub-head">
                                Warehouse
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Warehouse Review Required">Warehouse Review Required ?</label>
                                        <select name="Warehouse_review" id="Warehouse_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Warehouse_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Warehouse_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Warehouse_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 23, 'q_m_s_divisions_id' => $data->division_id])->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Warehouse Person">Warehouse Person</label>
                                        <select name="Warehouse_notification" id="Warehouse_notification" value="{{ $data1->Warehouse_notification}}">
                                            <option value=""> -- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Warehouse_notification == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment1">Impact Assessment (By Warehouse)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Warehouse_assessment" id="summernote-19">{{ $data1->Warehouse_assessment }}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Warehouse Feedback">Warehouse Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Warehouse_feedback" id="summernote-20">{{ $data1->Warehouse_feedback }}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Warehouse attachment">Warehouse Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Warehouse_attachment">
                                                @if ($data1->Warehouse_attachment)
                                                @foreach(json_decode($data1->Warehouse_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Warehouse_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Warehouse_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Warehouse Review Completed By">Warehouse Review Completed By</label>
                                        <input type="text" name="Warehouse_by" id="Warehouse_by" value={{ $data1->Warehouse_by }} disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Warehouse Review Completed On">Warehouse Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Warehouse_on" name="Warehouse_on" value="{{ $data1->Warehouse_on }}" >
                                    </div>
                                </div>
                                <div class="sub-head">
                                Quality Control
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review Required?</label>
                                        <select name="Quality_review" id="Quality_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Quality_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Quality_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $data->division_id])->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person</label>
                                        <select name="Quality_Control_Person" id="Quality_Control_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Quality_Control_Person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment2">Impact Assessment (By Quality Control)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Quality_Control_assessment" id="summernote-21">{{ $data1->Quality_Control_assessment }}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Control Feedback">Quality Control Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Quality_Control_feedback" id="summernote-22">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Quality Control Attachments">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                @if ($data1->Quality_Control_attachment)
                                                @foreach(json_decode($data1->Quality_Control_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Quality_Control_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed By">Quality Control Review Completed By</label>
                                        <input type="text" name="Quality_Control_by" id="Quality_Control_by" value="{{ $data1->Quality_Control_by }}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed On">Quality Control Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Quality_Control_on" name="Quality_Control_on" value="{{ $data1->Quality_Control_on }}" >
                                    </div>
                                </div>
                                  <div class="sub-head">
                                  Quality Assurance
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Required">Quality Assurance Review Required ?</label>
                                        <select name="Quality_Assurance_Review" id="Quality_Assurance_Review">
                                            <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Quality_Assurance_Review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Quality_Assurance_Review == 'na') selected @endif 
                                                   value="na">NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person</label>
                                        <select name="QualityAssurance_person" id="QualityAssurance_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->QualityAssurance_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="QualityAssurance_assessment" id="summernote-23">{{ $data1->QualityAssurance_assessment }}
                                    </textarea>
                                    </div>
                                </div>   
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="QualityAssurance_feedback" id="summernote-24">{{ $data1->QualityAssurance_feedback }}
                                    </textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance  Attachments</label>
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
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Assurance_attachment">
                                                @if ($data1->Quality_Assurance_attachment)
                                                @foreach(json_decode($data1->Quality_Assurance_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed By">Quality Assurance Review Completed By</label>
                                        <input type="text" name="QualityAssurance_by" id="QualityAssurance_by" value="{{$data1->QualityAssurance_by}}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="QualityAssurance_on" name="QualityAssurance_on" value="{{ $data1->QualityAssurance_on }}" >
                                    </div>
                                </div>
                                <div class="sub-head">
                                Engineering
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Review Required ?</label>
                                        <select name="Engineering_review" id="Engineering_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Engineering_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Engineering_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Engineering_review == 'na') selected @endif 
                                                   value="na">NA</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering  Person</label>
                                        <select name="Engineering_person" id="Engineering_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Engineering_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment4">Impact Assessment (By Engineering)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Engineering_assessment" id="summernote-25" >{{$data1->Engineering_assessment}}
                                    </textarea>
                                    </div>
                                </div>  
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Engineering Feedback">Engineering  Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" name="Engineering_feedback" id="summernote-26" >{{$data1->Engineering_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering  Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                @if ($data1->Engineering_attachment)
                                                @foreach(json_decode($data1->Engineering_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed By">Engineering Review Completed By</label>
                                        <input type="text" name="Engineering_by" id="Engineering_by" value="Engineering_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed On">Engineering Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date" id="Engineering_on" name="Engineering_on" value="{{ $data1->Engineering_on }}" >
                                    </div>
                                </div>
                                <div class="sub-head">
                                Analytical Development Laboratory
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Required">Analytical Development Laboratory Review Required ?</label>
                                        <select name="Analytical_Development_review" id="Analytical_Development_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Analytical_Development_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Analytical_Development_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Analytical_Development_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 27, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Person"> Analytical Development Laboratory Person</label>
                                        <select name="Analytical_Development_person" id="Analytical_Development_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Analytical_Development_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment5">Impact Assessment (By Analytical Development Laboratory)</label>
                                        <textarea class="summernote" name="Analytical_Development_assessment" id="summernote-27">{{$data1->Analytical_Development_assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Feedback"> Analytical Development Laboratory Feedback</label>
                                        <textarea class="summernote" name="Analytical_Development_feedback" id="summernote-28">{{$data1->Analytical_Development_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
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
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Analytical Development Laboratory Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Analytical_Development_attachment">
                                                @if ($data1->Analytical_Development_attachment)
                                                @foreach(json_decode($data1->Analytical_Development_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Analytical_Development_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Analytical_Development_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed By">Analytical Development Laboratory Review Completed By</label>
                                        <input type="text" name="Analytical_Development_by" id="Analytical_Development_by" value="Analytical_Development_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical Development Laboratory Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date" id="Analytical_Development_on" name="Analytical_Development_on" value="{{ $data1->Analytical_Development_on }}" >
                                    </div>
                                </div>
                                <div class="sub-head">
                                Process Development Laboratory / Kilo Lab
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo Lab Review Required ?</label>
                                        <select name="Kilo_Lab_review" id="Kilo_Lab_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Kilo_Lab_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Kilo_Lab_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Kilo_Lab_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 28, 'q_m_s_divisions_id' => $data->division_id])->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo Lab  Person</label>
                                        <select name="Kilo_Lab_person" id="Kilo_Lab_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Kilo_Lab_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment6">Impact Assessment (By Process Development Laboratory / Kilo Lab)</label>
                                        <textarea class="summernote" name="Kilo_Lab_assessment" id="summernote-29">{{$data1->Kilo_Lab_assessment}}
                                    </textarea>
                                    </div>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Feedback"> Process Development Laboratory / Kilo Lab  Feedback</label>
                                        <textarea class="summernote" name="Kilo_Lab_feedback" id="summernote-30">{{$data1->Kilo_Lab_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
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
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Kilo_Lab_attachment">
                                                @if ($data1->Kilo_Lab_attachment)
                                                @foreach(json_decode($data1->Kilo_Lab_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Kilo_Lab_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Kilo_Lab_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed By">Process Development Laboratory / Kilo Lab Review Completed By</label>
                                        <input type="text" name="Kilo_Lab_attachment_by" id="Kilo_Lab_attachment_by" value="Kilo_Lab_attachment_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed On">Process Development Laboratory / Kilo Lab Review Completed On</label>
                                        <input type="date" id="Kilo_Lab_attachment_on" name="Kilo_Lab_attachment_on" value="{{ $data1->Kilo_Lab_attachment_on }}" >
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Technology Transfer / Design
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Review Required">Technology Transfer / Design Review Required ?</label>
                                        <select name="Technology_transfer_review" id="Technology_transfer_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Technology_transfer_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Technology_transfer_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Technology_transfer_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 29, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Person"> Technology Transfer / Design  Person</label>
                                        <select name="Technology_transfer_person" id="Technology_transfer_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Technology_transfer_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment7">Impact Assessment (By Technology Transfer / Design)</label>
                                        <textarea class="summernote" name="Technology_transfer_assessment" id="summernote-31">{{$data1->Technology_transfer_assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Design Feedback"> Technology Transfer / Design  Feedback</label>
                                        <textarea class="summernote" name="Technology_transfer_feedback" id="summernote-32">{{$data1->Technology_transfer_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Technology_transfer_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Technology_transfer_attachment">
                                                @if ($data1->Technology_transfer_attachment)
                                                @foreach(json_decode($data1->Technology_transfer_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Technology_transfer_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Technology_transfer_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed By</label>
                                        <input type="text" name="Technology_transfer_by" id="Technology_transfer_by" value="Technology_transfer_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed On</label>
                                        <input type="date" id="Technology_transfer_on" name="Technology_transfer_on" value="{{ $data1->Technology_transfer_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                Environment, Health & Safety
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Environment, Health & Safety Review Required ?</label>
                                        <select name="Environment_Health_review" id="Environment_Health_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Environment_Health_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Environment_Health_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Environment_Health_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Person"> Environment, Health & Safety  Person</label>
                                        <select name="Environment_Health_Safety_person" id="Environment_Health_Safety_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Environment_Health_Safety_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment8">Impact Assessment (By Environment, Health & Safety)</label>
                                        <textarea class="summernote" name="Health_Safety_assessment" id="summernote-33">{{$data1->Health_Safety_assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Feedback">Environment, Health & Safety  Feedback</label>
                                        <textarea class="summernote" name="Health_Safety_feedback" id="summernote-34">{{$data1->Health_Safety_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">  Environment, Health & Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                                @if ($data1->Environment_Health_Safety_attachment)
                                                @foreach(json_decode($data1->Environment_Health_Safety_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Review Completed By">Environment, Health & Safety Review Completed By</label>
                                        <input type="text" name="Environment_Health_Safety_by" id="Environment_Health_Safety_by" value="Environment_Health_Safety_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Review Completed On">Environment, Health & Safety Review Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on" name="Environment_Health_Safety_on" value="{{ $data1->Environment_Health_Safety_on }}">
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Human Resource & Administration
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Human Resource & Administration Review Required ?</label>
                                        <select name="Human_Resource_review" id="Human_Resource_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Human_Resource_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Human_Resource_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Human_Resource_review == 'na') selected @endif 
                                                   value="na">NA</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Human Resource & Administration  Person</label>
                                        <select name="Human_Resource_person" id="Human_Resource_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Human_Resource_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Human Resource & Administration )</label>
                                        <textarea class="summernote" name="Human_Resource_assessment" id="summernote-35">{{$data1->Human_Resource_assessment}}
                                    </textarea>
                                    </div>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration  Feedback</label>
                                        <textarea class="summernote" name="Human_Resource_feedback" id="summernote-36">{{$data1->Human_Resource_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Human Resource & Administration Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                @if ($data1->Human_Resource_attachment)
                                                @foreach(json_decode($data1->Human_Resource_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource & Administration Review Completed By</label>
                                        <input type="text" name="Human_Resource_by" id="Human_Resource_by" value="Human_Resource_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Administration Review Completed On"> Human Resource & Administration Review Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on" name="Environment_Health_Safety_on" value="{{ $data1->Environment_Health_Safety_on }}">
                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Information Technology
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review Required ?</label>
                                        <select name=" Information_Technology_review" id=" Information_Technology_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Information_Technology_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Information_Technology_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Information_Technology_review == 'na') selected @endif 
                                                   value="na">NA</option>
                                        </select>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $data->division_id])->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology  Person</label>
                                        <select name=" Information_Technology_person" id=" Information_Technology_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Information_Technology_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment10">Impact Assessment (By Information Technology)</label>
                                        <textarea class="summernote" name="Information_Technology_assessment" id="summernote-37">{{$data1->Information_Technology_assessment}}
                                    </textarea>
                                    </div>
                                </div>  
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Feedback">Information Technology Feedback</label>
                                        <textarea class="summernote" name="Information_Technology_feedback" id="summernote-38">{{$data1->Information_Technology_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Information_Technology_attachment">
                                                @if ($data1->Information_Technology_attachment)
                                                @foreach(json_decode($data1->Information_Technology_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Information_Technology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Information_Technology_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed By"> Information Technology Review Completed By</label>
                                        <input type="text" name="Information_Technology_by" id="Information_Technology_by" value="Information_Technology_by" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed On">Information Technology Review Completed On</label>
                                        <input type="text" name="Information_Technology_on" id="Information_Technology_on" value={{$data1->Information_Technology_on}}>
                                    </div>
                                </div>
                                <div class="sub-head">
                                Project Management
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Review Required"> Project management Review Required ?</label>
                                        <select name="Project_management_review" id="Project_management_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Project_management_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Project_management_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Project_management_review == 'na') selected @endif 
                                                   value="na">NA</option>
                                        </select>
                                    </div>
                           </div>
                                    @php
                                    $userRoles = DB::table('user_roles')->where(['q_m_s_roles_id' => 33, 'q_m_s_divisions_id' => $data->division_id])->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Person"> Project management Person</label>
                                        <select name="Project_management_person" id="Project_management_person">
                                            @foreach ($users as $user)
                                            <option {{ $data1->Project_management_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment11">Impact Assessment (By  Project management )</label>
                                        <textarea class="summernote" name="Project_management_assessment" id="summernote-39">{{$data1->Project_management_assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Feedback"> Project management  Feedback</label>
                                        <textarea class="summernote" name="Project_management_feedback" id="summernote-40">{{$data1->Project_management_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Project_management_attachment">
                                                @if ($data1->Project_management_attachment)
                                                @foreach(json_decode($data1->Project_management_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Project_management_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Project_management_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Review Completed By"> Project management Review Completed By</label>
                                        <input type="text" name="Project_management_by" id="Project_management_by" value="Project_management_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Review Completed On">Project management Review Completed On</label>
                                        <input type="date" name="Project_management_on" id="Project_management_on" value={{$data1->Project_management_on}} >

                                    
                                    </div>
                                </div>
                                <div class="sub-head">
                                Other's 1 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1"> Other's 1 Review Required ?</label>
                                        <select name="Other1_review" id="Other1_review" value="{{ $data1->Other1_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Other1_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Other1_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->whereBetween('q_m_s_roles_id', [22, 33])->where('q_m_s_divisions_id', $data->division_id)->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person1"> Other's 1 Person</label>
                                        <select name="Other1_person" id="Other1_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Other1_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department1"> Other's 1 Department</label>
                                        <select name="Other1_Department_person" id="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data->Other1_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option  @if ($data->Other1_Department_person == 'Warehouse') selected @endif 
                                               value="Warehouse"> Warehouse</option>
                                            <option  @if ($data->Other1_Department_person == 'Quality_Control') selected @endif 
                                                value="Quality_Control">Quality Control</option>  
                                                <option @if ($data->Other1_Department_person == 'Quality_Assurance') selected @endif
                                                    value="Quality_Assurance">Quality Assurance</option>
                                                <option  @if ($data->Other1_Department_person == 'Engineering') selected @endif 
                                                   value="Engineering">Engineering</option>
                                                <option  @if ($data->Other1_Department_person == 'Analytical_Development_Laboratory') selected @endif 
                                                    value="Analytical_Development_Laboratory">Analytical Development Laboratory</option> 
                                                    <option @if ($data->Other1_Department_person == 'Process_Development_Lab') selected @endif
                                                        value="Process_Development_Lab">Process Development Laboratory / Kilo Lab</option>
                                                    <option  @if ($data->Other1_Department_person == 'Technology transfer/Design') selected @endif 
                                                       value="Technology transfer/Design"> Technology Transfer/Design</option>
                                                    <option  @if ($data->Other1_Department_person == 'Environment, Health & Safety') selected @endif 
                                                        value="Environment, Health & Safety">Environment, Health & Safety</option>   
                                                        <option @if ($data->Other1_Department_person == 'Human Resource & Administration') selected @endif
                                                            value="Human Resource & Administration">Human Resource & Administration</option>
                                                        <option  @if ($data->Other1_Department_person == 'Information Technology') selected @endif 
                                                           value="Information Technology">Information Technology</option>
                                                        <option  @if ($data->Other1_Department_person == 'Project management') selected @endif 
                                                            value="Project management">Project management</option>  

                                            {{-- <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option> --}}
                                            {{-- <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development Laboratory</option> --}}
                                            {{-- <option value="Process_Development_Lab">Process Development Laboratory / Kilo Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety</option> --}}
                                            {{-- <option value="Human Resource & Administration">Human Resource & Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option> --}}
                                            


                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Impact Assessment (By  Other's 1)</label>
                                        <textarea class="summernote" name="Other1_assessment" id="summernote-41">{{$data1->Other1_assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback1"> Other's 1 Feedback</label>
                                        <textarea class="summernote" name="Other1_feedback" id="summernote-42">{{$data1->Other1_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other1_attachment">
                                                @if ($data1->Other1_attachment)
                                                @foreach(json_decode($data1->Other1_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other1_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other1_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By1"> Other's 1 Review Completed By</label>
                                        <input type="text" name="Other1_by" id="Other1_by" value="Other1_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                        <input type="date" name="Other1_on" id="Other1_on" value={{$data1->Other1_on}}  disabled>
                                    
                                    </div>
                                </div>

                                <div class="sub-head">
                                Other's 2 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review2"> Other's 2 Review Required ?</label>
                                        <select name="Other2_review" id="Other2_review" value="{{ $data1->Other2_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Other2_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Other2_review == 'na') selected @endif 
                                                   value="na">NA</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->whereBetween('q_m_s_roles_id', [22, 33])->where('q_m_s_divisions_id', $data->division_id)->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person2"> Other's 2 Person</label>
                                        <select name="Other2_person" id="Other2_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Other2_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department2"> Other's 2 Department</label>
                                        <select name="Other2_Department_person" id="Other2_Department_person">
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
                                        <label for="Impact Assessment13">Impact Assessment (By  Other's 2)</label>
                                        <textarea class="summernote" name="Other2_Assessment" id="summernote-43">{{$data1->Other2_Assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback</label>
                                        <textarea class="summernote" name="Other2_feedback" id="summernote-44">{{$data1->Other2_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other2_attachment">
                                                @if ($data1->Other2_attachment)
                                                @foreach(json_decode($data1->Other2_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other2_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other2_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" id="Other2_by" value="Other2_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                        <input type="date" name="Other2_on" id="Other2_on" value="{{$data1->Other2_on}}">
                                    </div>
                                </div>

                                <div class="sub-head">
                                Other's 3 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review3"> Other's 3 Review Required ?</label>
                                        <select name="Other3_review" id="Other3_review" value="{{ $data1->Other3_review }}">
                                                <option value="0">-- Select --</option>
                                                <option @if ($data1->Other3_review == 'yes') selected @endif
                                                    value="yes">Yes</option>
                                                   <option  @if ($data1->Other3_review == 'no') selected @endif 
                                                   value="no">No</option>
                                                   <option  @if ($data1->Other3_review == 'na') selected @endif 
                                                       value="na">NA</option>
                                            </select>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->whereBetween('q_m_s_roles_id', [22, 33])->where('q_m_s_divisions_id', $data->division_id)->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person3">Other's 3 Person</label>
                                        <select name="Other3_person" id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Other3_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department3">Other's 3 Department</label>
                                        <select name="Other3_Department_person" id="Other3_Department_person">
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
                                        <label for="Impact Assessment14">Impact Assessment (By  Other's 3)</label>
                                        <textarea class="summernote" name="Other3_Assessment" id="summernote-45">{{$data1->Other3_Assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="feedback3"> Other's 3 Feedback</label>
                                        <textarea class="summernote" name="Other3_feedback" id="summernote-46">{{$data1->Other3_Assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other3_attachment">
                                                @if ($data1->Other3_attachment)
                                                @foreach(json_decode($data1->Other3_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other3_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other3_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" id="Other3_by" value="{{ $data1->Other3_by }}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 3 Review Completed On</label>
                                        <input type="date" name="Other3_on" id="Other3_on" value="{{$data1->Other3_on}}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                Other's 4 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4">Other's 4 Review Required ?</label>
                                        <select name="Other4_review" id="Other4_review" value="{{ $data1->Other4_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Other4_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Other4_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->whereBetween('q_m_s_roles_id', [22, 33])->where('q_m_s_divisions_id', $data->division_id)->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person4"> Other's 4 Person</label>
                                        <select name="Other4_person" id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Other4_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department4"> Other's 4 Department</label>
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
                                        <label for="Impact Assessment15">Impact Assessment (By  Other's 4)</label>
                                        <textarea class="summernote" name="Other4_Assessment" id="summernote-47">{{$data1->Other4_Assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="feedback4"> Other's 4 Feedback</label>
                                        <textarea class="summernote" name="Other4_feedback" id="summernote-48">{{$data1->Other4_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other4_attachment">
                                                @if ($data1->Other4_attachment)
                                                @foreach(json_decode($data1->Other4_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other4_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other4_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" id="Other4_by" value="{{$data1->Other4_by}}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                        <input type="date" name="Other4_on" id="Other4_on" value="{{$data1->Other4_on}}">
                                    
                                    </div>
                                </div>



                                <div class="sub-head">
                                Other's 5 ( Additional Person Review From Departments If Required)
                           </div>
                           <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5">Other's 5 Review Required ?</label>
                                        <select name="Other5_review" id="Other5_review" value="{{ $data1->Other5_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_review == 'yes') selected @endif
                                                value="yes">Yes</option>
                                               <option  @if ($data1->Other5_review == 'no') selected @endif 
                                               value="no">No</option>
                                               <option  @if ($data1->Other5_review == 'na') selected @endif 
                                                   value="na">NA</option>

                                        </select>
                                  
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')->whereBetween('q_m_s_roles_id', [22, 33])->where('q_m_s_divisions_id', $data->division_id)->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person</label>
                                        <select name="Other5_person" id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                            <option {{ $data1->Other5_person == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department5"> Other's 5 Department</label>
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
                                        <label for="Impact Assessment16">Impact Assessment (By  Other's 5)</label>
                                        <textarea class="summernote" name="Other5_Assessment" id="summernote-49">{{$data1->Other5_Assessment}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback</label>
                                        <textarea class="summernote" name="Other5_feedback" id="summernote-50">{{$data1->Other5_feedback}}
                                    </textarea>
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other5_attachment">
                                                @if ($data1->Other5_attachment)
                                                @foreach(json_decode($data1->Other5_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other5_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other5_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" id="Other5_by" value="Other5_by" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                        <input type="date" name="Other5_on" id="Other5_on" value="{{$data1->Other5_on}}">
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
                                        <option value="0"> -- Select --</option>
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
                                        <div><small class="text-primary">Please Refer Intial deviation category before updating.</small></div>
                                        <select name="Post_Categorization" id="Post_Categorization" value="Post_Categorization">
                                        <option value=""> -- Select --</option>
                                        <option @if ($data->Post_Categorization == 'major') selected @endif
                                            value="major">Major</option>
                                        <option  @if ($data->Post_Categorization == 'minor') selected @endif 
                                           value="minor">Minor</option>
                                           <option  @if ($data->Post_Categorization == 'critical') selected @endif 
                                            value="critical">Critical</option>
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
                                        <label for="Investigation Of Revised Categorization">Justification for Revised Category</label>
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
                                        <div class="static">{{ $data->Approved_On }}</div>
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
{{-- <div class="modal" id="myModal">
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
</div> --}}
<!-- Modal body -->
{{-- <div class="modal-body">
    <!-- Customer creation form -->
    <form id="customerForm">
        <!-- Input fields for customer details -->
        <div class="form-group">
            <label for="customer_id">Customer ID:</label>
            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
        </div>
        <div class="form-group">
            <label for="email">Customer Name:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="email">Customer Type:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="email">Status:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="email">Contact No:</label>
            <input type="number" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="email">Industry:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="email">Region:</label>
            <input type="text" class="form-control" id="region" name="region" required>
        </div>
        <div class="form-group">
            <label for="email">Remarks:</label>
            <textarea cols="30" class="form-control" id="remarks" name="remarks" required>
        </div>

        <!-- Add more input fields for other customer details -->

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Create Customer</button>
    </form>
</div> --}}

<!-- JavaScript to handle form submission -->
{{-- <script>
    $(document).ready(function(){
        $('#customerForm').submit(function(e){
            e.preventDefault(); // Prevent default form submission
            
            // Create data object from form fields
            var formData = {
                customer_id: $('#customer_id').val(),
                email: $('#email').val(),
                // Add more fields here
            };

            // AJAX request to store customer details
            $.ajax({
                url: '{{ url('/customer/store') }}', // URL for storing customer details
                type: 'POST',
                data: formData, // Send form data
                success: function(response){
                    // Handle success
                    console.log(response); // Log success response for debugging
                    $('#myModal').modal('hide'); // Close the modal
                },
                error: function(xhr, status, error){
                    // Handle error
                    console.error(xhr.responseText); // Log error response
                }
            });
        });
    });
</script> --}}

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

    
    <div class="modal fade" id="deviationIsCFTRequired">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"> 
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
    
                <form action="{{ url('deviationIsCFTRequired', $data->id) }}" method="POST">
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
    <div class="modal fade" id="sendToInitiator">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"> 
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
    
                <form action="{{ route('check', $data->id) }}" method="POST">
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
    <div class="modal fade" id="hodsend">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"> 
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
    
                <form action="{{ route('check2', $data->id) }}" method="POST">
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
    <div class="modal fade" id="qasend">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"> 
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
    
                <form action="{{ route('check3', $data->id) }}" method="POST">
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
    <div class="modal fade" id="cft-not-reqired">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('cftnotreqired', $data->id) }}" method="POST">
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
