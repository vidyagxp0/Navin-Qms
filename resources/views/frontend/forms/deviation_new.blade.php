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

        section {
  padding: 15px;
}
footer {
  float: right;
  font-size: 12px;
  padding: 15px;
  color: #aaaaaa;
}
    </style>
    <style>
        .calenderauditee {
            position: relative;
        }

        .new-date-data-field input.hide-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .new-date-data-field input {
            border: 1px solid grey;
            border-radius: 5px;
            padding: 5px 15px;
            display: block;
            width: 100%;
            background: white;
        }

        .calenderauditee input::-webkit-calendar-picker-indicator {
            width: 100%;
        }
    </style>
    <style>
        .calenderauditee {
            position: relative;
        }

        .new-date-data-field input.hide-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .new-date-data-field input {
            border: 1px solid grey;
            border-radius: 5px;
            padding: 5px 15px;
            display: block;
            width: 100%;
            background: white;
        }

        .calenderauditee input::-webkit-calendar-picker-indicator {
            width: 100%;
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
 <!-- <script>
        function addWhyField(con_class, name) {
            let mainBlock = document.querySelector('.why-why-chart')
            let container = mainBlock.querySelector(`.${con_class}`)
            let textarea = document.createElement('textarea')
            textarea.setAttribute('name', name);
            container.append(textarea)
        }
    </script> -->
    
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
                        '<td><input type="number" name="Number[]"></td>'+
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
                        '<td><input type="text" name="nameofproduct[]"></td>'+
                        // '<td><input type="date" name="ExpiryDate[]"></td>'+
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="ExpiryDate' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="ExpiryDate[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `ExpiryDate' + serialNumber +'`)" /></div></div></div></td>' +

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

            <form id="auditform" action="{{ route('deviationstore') }}" method="post" enctype="multipart/form-data">
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
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}/DEV/{{ date('Y') }}/{{ $record_number }}">
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
                                        <input disabled type="text" value="{{ Auth::user()->name }}">

                                    </div>
                                </div>

                                 <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="why-why-chart">
                                            Why-Why Chart
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#why_chart-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr style="background: #f4bb22">
                                                        <th style="width:150px;">Problem Statement :</th>
                                                        <td>
                                                            <textarea name="why_problem_statement"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 1 <span
                                                                onclick="addWhyField('why_1_block', 'why_1[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_1_block">
                                                                <textarea name="why_1[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 2 <span
                                                                onclick="addWhyField('why_2_block', 'why_2[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_2_block">
                                                                <textarea name="why_2[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 3 <span
                                                                onclick="addWhyField('why_3_block', 'why_3[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_3_block">
                                                                <textarea name="why_3[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 4 <span
                                                                onclick="addWhyField('why_4_block', 'why_4[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_4_block">
                                                                <textarea name="why_4[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 5 <span
                                                                onclick="addWhyField('why_5_block', 'why_5[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_5_block">
                                                                <textarea name="why_5[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr style="background: #0080006b;">
                                                        <th style="width:150px;">Root Cause :</th>
                                                        <td>
                                                            <textarea name="why_root_cause"></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-6">
                                    <div class="group-input ">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input readonly type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Due Date</label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'due_date')"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Department</b></label>
                                        <select name="Initiator_Group" id="initiator_group">
                                           <option value="">-- Select --</option>
                                          
                                            <option value="Corporate_Quality" >
                                                Corporate Quality Assurance</option>
                                            <option value="Quality_Assurance" >Quality
                                                Assurance Biopharma</option>
                                            <option value="Central_Quality" >Central Quality Control</option>
                                            <option value="Manufacturing" >
                                                Manufacturing</option>
                                            <option value="Plasma_Sourcing" >Plasma
                                                Sourcing Group</option>
                                            <option value="CentralStores" >Central Stores</option>
                                            <option value="Information_Technology">
                                                Information Technology Group</option>
                                            <option value="Molecular Medicine" >Molecular Medicine</option>
                                            <option value="Central Laboratory" >Central Laboratory</option>
                                            <option value="Tech  team" >Tech  Team</option>
                                            <option value=" Quality Assurance" > Quality Assurance</option>
                                            <option value="QualityManagemen" >Quality Management</option>
                                            <option value="ITAdministration" >IT Administration</option>
                                            <option value="Accounting">Accounting</option>
                                            <option value=" Logistics"> Logistics</option>
                                            <option value="Senior_Management" >  Senior Management</option>
                                            <option value="BusinessAdministration" >Business Administration</option>
                                            <option value="BusinessAdministration" >Warehouse</option>
                                            <option value="BusinessAdministration" >Regulatory Affairs</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Department Code">Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" readonly>
                                    </div>
                                </div>
                            
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>  
                    
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Deviation Observed</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Deviation_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date"  name="Deviation_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Deviation_date')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Facility Name">Observed By</label>
                                        <select multiple name="Facility[]" placeholder="Select Facility Name"
                                            data-search="false" data-silent-initial-value-set="true" id="Facility">
                                            <option value="Plant 1"> 1</option>
                                            <option value="Plant 1"> 1</option>
                                            <option value="Plant 1"> 1</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Deviation Reported on</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Deviation_reported_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date"  name="Deviation_reported_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Deviation_reported_date')" />
                                        </div>
                                    </div>
                                </div>
                                
                             
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit_type">Deviation Related To </label>
                                        <select name="audit_type">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Facility"> Facility</option>
                                            <option value="Equipment/Instrument">Equipment/ Instrument </option>
                                            <option value="Documentationerror">Documentation error </option>
                                            <option value="STP/ADS_instruction">STP/ADS instruction </option>
                                            <option value="Packaging&Labelling">Packaging & Labelling  </option>
                                            <option value="Material_System">Material System  </option>
                                            <option value="Laboratory_Instrument/System"> Laboratory Instrument /System</option>
                                            <option value=" Utility_System"> Utility System</option>
                                            <option value="Computer_System"> Computer System</option>
                                            <option value="Document">Document</option>
                                            <option value="Data integrity">Data integrity</option>
                                            <option value="Anyother(specify)">Any other (specify) </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit_type">Deviation Related To </label>
                                        <input type="text" name="Deviation_Related_To">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">
                                    <div class="group-input" id="type_of_audit_req">
                                        <label for="If Other">Facility/ Equipment/ Instrument/ System Name & ID Number:<span class="text-danger d-none">*</span></label>
                                     <input type="text" name="Facility/ Equipment/ Instrument/ System Name & ID Number:">
                                       
                                           
                                     
                                    </div>
                                </div> -->
                                <div class="group-input">
                                        <label for="audit-agenda-grid">
                                        Facility/ Equipment/ Instrument/ System Details
                                            <button type="button" name="audit-agenda-grid"
                                                id="ObservationAdd">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="onservation-field-table"
                                                >
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
                        <td><input type="number" name="IDnumber[]"></td>
                        <td><input type="text" name="Remarks[]"></td>
                                                  
                                              
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="group-input">
                                        <label for="audit-agenda-grid">
                                         Document Details
                                            <button type="button" name="audit-agenda-grid"
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
                        <td><input type="number" name="Number[]"></td>
                        <td><input type="text" name="ReferenceDocumentName[]"></td>
                        <td><input type="text" name="Remarks[]"></td>
                       
                                                  
                                              
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                  
                                <div class="col-lg-12">
                                    <div class="group-input" id="external_agencies_req">
                                        <label for="others">Name of Product & Batch No<span class="text-danger d-none">*</span></label>
                                        <input type="text" name="Name_No.(if applicable)">
                                        
                                            <!-- <p class="text-danger">this field is required</p> -->
                                    
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Initial Comments">Description of Deviation</label>
                                        <textarea class="summernote" name="Description_Deviation"></textarea>
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                <div class="group-input">
                                        <label for="Initial Comments">Immediate Action (if any)</label>
                                        <textarea class="summernote" name="Immediate_Action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="group-input">
                                        <label for="Initial Comments">Preliminary Impact of Deviation</label>
                                        <textarea class="summernote" name="Preliminary_Impact"></textarea>
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
                                

                                
                                <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">Product Details Required ?</label>
                                        <select name="Product_Details_Required " id="">
                                            <option value="">-- Select -- </option>
                                            <option value="Yes">Yes </option>
                                            <option value="No">No </option>
                                           
                                        </select>

                                    </div>
                                </div>
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
                               
                                <div class="col-12 ">
                                <div class="group-input">
                                <label class="mt-4"  for="annexure-1">Description of Deviation</label>
                                <textarea class="summernote" name="Description_Deviation[]" id="annexure-1"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="group-input">
                                        <label class="mt-4"  for="Initial Comments">Immediate Action (if any)</label>
                                <textarea class="summernote" name="Immediate_Action[]" id="annexure-1"></textarea>
                                       
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="group-input">
                                        <label class="mt-4"  for="Initial Comments">Preliminary Impact of Deviation</label>
                                        <textarea class="summernote" name="Preliminary_Impact[]" id="annexure-1"></textarea>

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
                                

                                
                                
                                
                                
                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Product/Material Name">HOD Remarks </label>
                                        <textarea class="summernote" name="HOD_Remarks[]" id="annexure-1"></textarea>

                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">HOD Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="audit_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments" name="Audit_file[]"
                                                    oninput="addMultipleFiles(this, 'audit_attachment')" multiple>
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
                                        <label for="Audit Schedule Start Date">Initial Deviation Category</label>
                                        <select name="Deviation category" id="">
                                            <option value="">-- Select -- </option>
                                            <option value="">Major </option>
                                            <option value="">Minor </option>
                                            <option value="">Critical </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label class="mt-4"  for="Audit Schedule End Date">Justification for  Categorization</label>
                                        <textarea class="summernote" name="Justification_for_categorization" id="" cols="30" ></textarea>

                                    </div>
                                </div>
                               
                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Product/Material Name">Investigation is required ?</label>
                                        <select name="Investigation_required" id="Investigation_required">
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Product/Material Name">Investigation Details </label>
                                        <textarea class="summernote" name="Investigation_Details" id="" cols="30" ></textarea>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Product/Material Name">Customer Notification Required ? </label>
                                        <select name="Customer_notification" id="">
                                            <option value="">-- Select --</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Comments(If Any)">Customers</label>
                                        <select name="customers" id="">
                                            <option value=""> -- Select --</option>
                                            <option value="1"> person 1</option>
                                            <option value="2"> person 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments(If Any)">QA Initial Remarks</label>
                                      <textarea class="summernote" name="QAInitialRemark" id="" cols="30" ></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Initial_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
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

                            
                                
                                <div class="col-12">
                        <div class="group-input"><label for="why-why-chart">
                                        Impact Assessment by applicable cross functional team:
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#is_is_not-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
              
                      <div class="why-why-chart">
                    <table class="table table-bordered">
                        <thead>
                          
                                <th style="width: 25%;">Department</th>
                                <th style="width: 18%;"> Person</th>
                                <th style="width: 20%;"> Impect Assessment</th>
                                <th>Comments</th>
                                <th>Sign & date</th>
                                <th>Remarks</th>
                              
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td style="background: #e1d8d8">Production  <button style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Production_Person"></textarea></td>
                                <td><textarea name="Production_Impect_Assessment"></textarea></td>
                                <td><textarea name="Production_Comments"></textarea></td>
                                <td><textarea name="Production_sign&date"></textarea></td>
                                <td><textarea name="Production_Remarks"></textarea></td>
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Warehouse <button  style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Warehouse_Person"></textarea></td>
                                <td><textarea name="Warehouse_Impect_Assessment"></textarea></td>
                                <td><textarea name="Warehouse_Comments"></textarea></td>
                                <td><textarea name="Warehouse_sign&date"></textarea></td>
                                <td><textarea name="Warehouse_Remarks"></textarea></td>
                               
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Quality Control <button   style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Quality_Person"></textarea></td>
                                <td><textarea name="Quality_Impect_Assessment"></textarea></td>
                                <td><textarea name="Quality_Comments"></textarea></td>
                                <td><textarea name="Quality_sign&date"></textarea></td>
                                <td><textarea name="Quality_Remarks"></textarea></td>
                               
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Quality Assurance <button  style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Assurance_Person"></textarea></td>
                                <td><textarea name="Assurance_Impect_Assessment"></textarea></td>
                                <td><textarea name="Assurance_Comments"></textarea></td>
                                <td><textarea name="Assurance_sign&date"></textarea></td>
                                <td><textarea name="Assurance_Remarks"></textarea></td>
                               
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Engineering <button  style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Engineering_Person"></textarea></td>
                                <td><textarea name="Engineering_Impect_Assessment"></textarea></td>
                                <td><textarea name="Engineering_Comments"></textarea></td>
                                <td><textarea name="Engineering_sign&date"></textarea></td>
                                <td><textarea name="Engineering_Remarks"></textarea></td>
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Analytical Development Laboratory <button  style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Analytical_Person"></textarea></td>
                                <td><textarea name="Analytical_Impect_Assessment"></textarea></td>
                                <td><textarea name="Analytical_Comments"></textarea></td>
                                <td><textarea name="Analytical_sign&date"></textarea></td>
                                <td><textarea name="Analytical_Remarks"></textarea></td>
                               
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Process Development Laboratory / Kilo Lab <button  style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Process_Person"></textarea></td>
                                <td><textarea name="Process_Impect_Assessment"></textarea></td>
                                <td><textarea name="Process_Comments"></textarea></td>
                                <td><textarea name="Process_sign&date"></textarea></td>
                                <td><textarea name="Process_Remarks"></textarea></td>
                               
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Technology transfer/Design <button style="    margin-left: 220px;"    id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Technology_Person"></textarea></td>
                                <td><textarea name="Technology_Impect_Assessment"></textarea></td>
                                <td><textarea name="Technology_Comments"></textarea></td>
                                <td><textarea name="Technology_sign&date"></textarea></td>
                                <td><textarea name="Technology_Remarks"></textarea></td>
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Environment, Health & Safety <button style="    margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Environment_Person"></textarea></td>
                                <td><textarea name="Environment_Impect_Assessment"></textarea></td>
                                <td><textarea name="Environment_Comments"></textarea></td>
                                <td><textarea name="Environment_sign&date"></textarea></td>
                                <td><textarea name="Environment_Remarks"></textarea></td>
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Human Resource & Administration <button  style="    margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Human_Person"></textarea></td>
                                <td><textarea name="Human_Impect_Assessment"></textarea></td>
                                <td><textarea name="Human_Comments"></textarea></td>
                                <td><textarea name="Human_sign&date"></textarea></td>
                                <td><textarea name="Human_Remarks"></textarea></td>
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Information Technology <button  style="margin-left: 220px;"   id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Information_Person"></textarea></td>
                                <td><textarea name="Information_Impect_Assessment"></textarea></td>
                                <td><textarea name="Information_Comments"></textarea></td>
                                <td><textarea name="Information_sign&date"></textarea></td>
                                <td><textarea name="Information_Remarks"></textarea></td>
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Project management <button  style="margin-left: 220px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Project_Person"></textarea></td>
                                <td><textarea name="Project_Impect_Assessment"></textarea></td>
                                <td><textarea name="Project_Comments"></textarea></td>
                                <td><textarea name="Project_sign&date"></textarea></td>
                                <td><textarea name="Project_Remarks"></textarea></td>
                               
                            </tr>
                            <tr>
                                <td style="background: #e1d8d8">Any Other <button  style="margin-left: 155px;" id="new-button-icon" class="btn btn-primary add-row">+</button></td>
                                <td><textarea name="Any_Person"></textarea></td>
                                <td><textarea name="Any_Impect_Assessment"></textarea></td>
                                <td><textarea name="Any_Comments"></textarea></td>
                                <td><textarea name="Any_sign&date"></textarea></td>
                                <td><textarea name="Any_Remarks"></textarea></td>
                               
                            </tr>
                            
                            <!-- Add more rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
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
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Lead Auditor">Investigation Summary</label>
                                        <textarea class="summernote" name="Investigation_Summary" id="" cols="30" ></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Lead Auditor">Impact Assessment </label>
                                        <textarea class="summernote" name="Impect_assessment" id="" cols="30" ></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Lead Auditor">Root Cause </label>
                                        <textarea class="summernote" name="Root_cause" id="" cols="30" ></textarea>
                                    </div>
                                </div>
                               
                                
                                
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="External Auditor Details">CAPA Required? </label>
                                      <select name="CAPA_Rquired" id="CAPA_Rquired">
                                        <option value=""> -- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no"> No</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="capa_type">CAPA Type? </label>
                                      <select name="capa_type" id="capa_type">
                                        <option value=""> -- Select --</option>
                                        <option value="Corrective_Action">Corrective Action</option>
                                        <option value=" Preventive_Action"> Preventive Action</option>
                                        <option value="Corrective&Preventive"> Corrective & Preventive Action both</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="External Auditing Agency">CAPA Description</label>
                                        <textarea class="summernote" name="CAPA_Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="External Auditing Agency ">Post Categorization Of Deviation</label>
                                        <textarea class="summernote" name="Post_Categorization"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="External Auditing Agency">Investigation Of Revised Categorization</label>
                                        <textarea class="summernote" name="Investigation_Of_Review"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigatiom Attachment">Investigation Attachment </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                            
                                            
                                            </div>
                                       
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Investigation_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Investigation_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Investigation_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa_Attachments">CAPA Attachment </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                            </div>
                                       
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Capa_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Capa_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Capa_attachment')" multiple>
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
                                
                                
                            <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Feedbacks">QA Feedbacks</label>
                                        <textarea class="summernote" name="QA_Feedbacks"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">QA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_attachment[]"
                                                    oninput="addMultipleFiles(this, 'QA_attachment')" multiple>
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
                                
                                <div class="col-12">
                                    <div class="group-input">
                                        <label  class="mt-4" for="Remarks">Closure Comments</label>
                                        <textarea class="summernote" name="Closure_Comments"></textarea>
                                    </div>
                                </div>
                                
                               

                                
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Audit Comments">Disposition of Batch</label>
                                        <textarea class="summernote" name="Disposition_Batch"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QAH assessment ">Closure Attachments </label>
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
                                        <label for="Audit Schedule On">Submit By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit Schedule On">Submit On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Schedule On">Submit Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="sub-head">HOD Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled By">HOD Review Complete By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled On">HOD Review Complete On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Cancelled On">HOD Review Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                

                                <div class="sub-head">QA Initial Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit Preparation Completed On">QA Initial Review Complete
                                            By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit Preparation Completed On">QA Initial Review Complete
                                            On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Preparation Completed On">QA Initial Review Comments
                                            :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="sub-head"> QA Final Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit Mgr.more Info Reqd By"> QA Final Review Complete By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit Mgr.more Info Reqd On"> QA Final Review Complete On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div> <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Mgr.more Info Reqd On"> QA Final Review Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="sub-head"> Approved</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit Observation Submitted By">Approved
                                            By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit Observation Submitted On">Approved
                                            On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Lead More Info Reqd By">Approved Comments :-</label>
                                        <div class="static"></div>
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
    const addRowButtons = document.querySelectorAll('.add-row');
    addRowButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.parentNode.parentNode; // Get the parent tr of the button
            
            const department = row.querySelector('td:first-child').innerText.trim(); // Get the department name
            
            // Create a new row and insert it after the current row
            const newRow = document.createElement('tr');
            newRow.innerHTML = `<td style="background: #e1d8d8">${department}</td>
                                <td><textarea name="Person"></textarea></td>
                                <td><textarea name="Impect_Assessment"></textarea></td>
                                <td><textarea name="Comments"></textarea></td>
                                <td><textarea name="sign&date"></textarea></td>
                                <td><textarea name="Remarks"></textarea></td>`;
                
            // Insert the new row after the current row
            row.parentNode.insertBefore(newRow, row.nextSibling);
        });
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


@endsection
