@extends('frontend.layout.main')
@section('container')

    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }

        .group-input table input,
        .group-input table select {
            border: 0;
            margin: 0 !important;
            padding: 0 !important;
        }
        .sop-type-header {
    display: grid;
    grid-template-columns: 135px 1fr;
    border: 2px solid #000000;
    margin-bottom: 20px;
        }
        .main-head {
    display: grid;
    place-items: center;
    align-content: center;
    font-size: 1.2rem;
    font-weight: 700;
    border-left: 2px solid #000000;
}
.sub-head-2 {
    text-align: center;
    background: #4274da;
    margin-bottom: 20px;
    padding: 10px 20px;
    font-size: 1.5rem;
    color: #fff;
    border: 2px solid #000000;
    border-radius: 40px;
}

    </style>
<?php $division_id = isset($_GET['id'])?$_GET['id']:'';?>
    <div id="data-field-head">
        <div class="pr-id">
            New Document
        </div>
        @if(isset($_GET['id']))
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($_GET['id'])}} / Document 
            {{-- {{ $division->dname }} / {{ $division->pname }} --}}
        </div>
        @endif
    </div>

    <div id="data-fields">

        <div class="container-fluid">
            <div class="tab">
                <button class="tablinks active" onclick="openData(event, 'doc-info')" id="defaultOpen">Document information</button> 
                {{-- <button class="tablinks" onclick="openData(event, 'doc-chem')">Chemistry SOP</button>  
                <button class="tablinks" onclick="openData(event, 'doc-instru')">Instrument SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-instrumental')">Instrumental Chemistry SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-micro')">Microbiology SOP</button> 
                <button class="tablinks" onclick="openData(event, 'doc-lab')">Good Laboratory Practices</button>
                <button class="tablinks" onclick="openData(event, 'doc-wet')">Wet Chemistry</button> 
                <button class="tablinks" onclick="openData(event, 'doc-others')">Others</button>--}}
                <button class="tablinks" onclick="openData(event, 'add-doc')">Training Information</button>
                <button class="tablinks" onclick="openData(event, 'doc-content')">Document Content</button>
                <button class="tablinks" onclick="openData(event, 'annexures')">Annexures</button>
                <button class="tablinks" onclick="openData(event, 'distribution-retrieval')">Distribution & Retrieval</button>
                {{-- <button class="tablinks" onclick="openData(event, 'print-download')">Print and Download Control </button> --}}
                <button class="tablinks" onclick="openData(event, 'sign')">Signature</button>
                <button class="tablinks printdoc" style="float: right;" onclick="window.print();return false;" >Print</button>
            </div>

            <form id="document-form" action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">
                    <!-- Tab content -->
                    <div id="doc-info" class="tabcontent">
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="group-input">
                                        <label for="originator">Originator</label>
                                        <div class="default-name">{{ Auth::user()->name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group-input">
                                        <label for="open-date">Date Opened</label>
                                        <div class="default-name"> {{ date('d-M-Y') }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="group-input">
                                        <label for="record-num">Record Number</label>
                                        <div class="default-name">{{ $recordNumber }}</div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        @if(isset($_GET['id']))
                                        <label for="Division Code"><b>Site/Location Code </b></label>
                                        <input readonly type="text" name="division_id"
                                            value="{{ Helpers::getDivisionName($_GET['id'])}}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                        @else
                                        <label for="Division Code"><b>Site/Location Code </b></label>
                                        <input readonly type="text" name="division_id"
                                            value="">
                                        <input type="hidden" name="division_id" value="">
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="document_name-desc">Document Name<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="document_name" maxlength="255" required>
                                    </div>
                                    <p id="docnameError" style="color:red">**Document Name is required</p>

                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description<span class="text-danger">*</span></label>
                                        <input type="text" id="short_desc" name="short_desc">
                                    </div>
                                    <p id="short_descError" style="color:red">**Short description is required</p>

                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="sop_type">SOP Type<span class="text-danger">*</span></label>
                                        <select name="sop_type">
                                            <option>Enter Your Selection Here</option>
                                            <option>Chemistry SOP</option>
                                            <option>Instrument SOP</option>
                                            <option>Analytical SOP</option>
                                            <option> Microbiology SOP</option>
                                            <option>Quality Policies</option>
                                            {{-- <option>Wet Chemistry</option> --}}
                                            <option>Others</option>
                                        </select>
                                        {{-- <p id="sop_typeError" style="color:red">**SOP type is required</p> --}}
                                    </div>

                                </div>

                                <div class="col-md-4 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date</label>
                                        <div><small class="text-primary">Kindly Fill Target Date of Completion</small>
                                        </div>
                                        <div class="calenderauditee"> 
                                            <input type="text" name="due_dateDoc" id="due_dateDoc"  readonly placeholder="DD-MMM-YYYY" />                                    
                                        <input
                                         type="date" id="due_dateDoc" name="due_dateDoc" pattern="\d{4}-\d{2}-\d{2}"
                                         class="hide-input"
                                         oninput="handleDateInput(this, 'due_dateDoc')"/>
                                        </div>

                                            {{-- onchange="changeFormat(this,'due-dateDoc')"> --}}
                                    </div>
                                    <p id="due_dateDocError" style="color:red">**Due Date is required</p>

                                </div>
                                <div class="col-md-8">
                                    <div class="group-input">
                                        <label for="notify_to">Notify To</label>
                                        <select multiple name="notify_to[]" placeholder="Select Persons" data-search="false"
                                            data-silent-initial-value-set="true" id="notify_to">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                    ({{ $data->role }})
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="description">Description</label>
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="orig-head">
                            Document Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-num">Document Number</label>
                                        <div class="default-name">Not available</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="link-doc">Reference Record</label>
                                        <select multiple name="reference_record[]" placeholder="Select Reference Records"
                                            data-search="false" data-silent-initial-value-set="true" id="reference_record">
                                            @if (!empty($document))
                                                @foreach ($document as $temp)
                                                    <option value="{{ $temp->id }}">
                                                        {{ $temp->division }}/{{ $temp->typecode }}/{{ $temp->year }}/SOP-000{{ $temp->id }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="depart-name">Department Name<span class="text-danger">*</span></label>
                                        <select name="department_id" id="depart-name" required>
                                            <option value="" selected>Enter your Selection</option>
                                            <option value="CQA" @if (old('department_id') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('department_id') == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('department_id') == 'CQA') selected @endif>Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('department_id') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('department_id') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('department_id') == 'CS') selected @endif>Central
                                                Stores</option>
                                            <option value="ITG" @if (old('department_id') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('department_id') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('department_id') == 'CL') selected @endif>
                                                Central Laboratory</option>
                                            <option value="TT" @if (old('department_id') == 'TT') selected @endif>Tech
                                                Team</option>
                                            <option value="QA" @if (old('department_id') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('department_id') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('department_id') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('department_id') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('department_id') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('department_id') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('department_id') == 'BA') selected @endif>
                                                Business Administration</option>
                                            <option value="others" @if (old('department_id') == 'others') selected @endif>
                                                Others</option>
                                            {{-- @foreach ($departments as $department)
                                                <option data-id="{{ $department->dc }}" value="{{ $department->id }}">
                                                    {{ $department->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <p id="depart-nameError" style="color:red">** Department is required</p>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="depart-code">Department Code</label>
                                        <div class="default-name"> <span id="department-code">Not selected</span></div>
                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="major">Major<span class="text-danger">*</span>
                                        <span  class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#document-management-system-modal"
                                        style="font-size: 0.8rem; font-weight: 400;">
                                        (Launch Instruction)
                                        </span>
                                    </label>
                                    <input type="number" name="major" id="major" min="0" required>
                                    </div>
                                    {{-- <p id="majorError" style="color:red">** Department is required</p> --}}
                                </div>

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="minor">Minor<span class="text-danger">*</span> 
                                            <span  class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#document-management-system-modal-minor"
                                            style="font-size: 0.8rem; font-weight: 400;">
                                            (Launch Instruction)
                                            </span>
                                        </label>
                                        <input type="number" name="minor" id="minor" min="0" max="9" required>
                                       
                                    </div>
                                    {{-- <p id="minorError" style="color:red">** Department is required</p> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Document Type<span class="text-danger">*</span></label>
                                        <select name="document_type_id" id="doc-type" required>
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach ($documentTypes as $type)
                                                <option data-id="{{ $type->typecode }}" value="{{ $type->id }}">
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p id="doc-typeError" style="color:red">** Department is required</p>

                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-code">Document Type Code</label>
                                        <div class="default-name"> <span id="document_type_code">Not selected</span></div>               
                                     </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Document Sub Type<span class="text-danger">*</span></label>
                                        <select name="document_subtype_id" id="doc-subtype">
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach ($documentsubTypes as $type)
                                                <option data-id="{{ $type->code }}" value="{{ $type->id }}">
                                                    {{ $type->docSubtype }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-code">Document SubType Code</label>
                                        <div class="default-name"> <span id="document_subtype_code">Not selected</span>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-lang">Document Language</label>
                                        <select name="document_language_id" id="doc-lang">
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach ($documentLanguages as $lan)
                                                <option data-id="{{ $lan->lcode }}" value="{{ $lan->id }}">
                                                    {{ $lan->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-lang">Document Language Code</label>
                                        <div class="default-name"><span id="document_language">Not selected</span></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="keyword">Keywords</label>
                                        <div class="add-keyword">
                                            <input type="text" id="sourceField" class="mb-0">
                                            <button id="addButton" type="button">ADD</button>
                                        </div>
                                        <select name="keywords[]" class="targetField" multiple id="keywords">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="effective-date">Effective Date</label>
                                        <div class="calenderauditee"> 
                                        <input type="text" name="effective_date" id="effective_date"  readonly placeholder="DD-MMM-YYYY" />
                                        <input 
                                        type="date" name="effective_date" id="effective_date"
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'effective_date')"
                                        />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 new-date-data-field">
                                    <div class="group-input ">
                                        <label for="review-period">Review Period</label>

                                        <input type="number" name="review_period" id="review_period">
                                    </div>
                                </div>

                                <div class="col-md-4 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="next_review_date">Next Review Date</label>
                                        <div class="calenderauditee"> 
                                            <input type="text" name="next_review_date" id="next_review_date"  readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="next_review_date" id="next_review_date"
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'next_review_date')"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="draft-doc">Attach Draft document</label>
                                        <input type="file" name="attach_draft_doocument">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="effective-doc">Attach Effective document</label>
                                        <input type="file" name="attach_effective_docuement">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="orig-head">
                            Other Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reviewers">Reviewers<span class="text-danger">*</span></label>
                                        <select id="choices-multiple-remove-button" class="choices-multiple-reviewer"
                                            name="reviewers[]" placeholder="Select Reviewers" multiple required>
                                            @if (!empty($reviewer))
                                            
                                                @foreach ($reviewer as $lan)
                                                    @if(Helpers::checkUserRolesreviewer($lan))
                                                    <option value="{{ $lan->id }}">
                                                        {{ $lan->name }}
                                                    </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                    <p id="reviewerError" style="color:red">** Reviewers are required</p>

                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="approvers">Approvers<span class="text-danger">*</span></label>
                                        <select id="choices-multiple-remove-button" class="choices-multiple-reviewer"
                                            name="approvers[]" placeholder="Select Approvers" multiple required>
                                            @if (!empty($approvers))
                                                @foreach ($approvers as $lan)
                                                    @if(Helpers::checkUserRolesApprovers($lan))
                                                    <option value="{{ $lan->id }}">
                                                        {{ $lan->name }}
                                                    </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <p id="approverError" style="color:red">** Approvers are required</p>

                                </div>
                                <div class="col-md-6">

                                    <div class="group-input">
                                        <label for="reviewers-group">Reviewers Group</label>
                                        {{--  <select class="form-control"  name="reviewers_group" required/>  --}}
                                        <select id="choices-multiple-remove-button" name="reviewers_group[]"
                                            placeholder="Select Reviewers" class="is-hidden" aria-hidden="true" multiple>

                                            @if (count($reviewergroup) > 0)
                                                @foreach ($reviewergroup as $lan)
                                                    <option value="{{ $lan->id }}">
                                                        {{ $lan->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="approvers-group">Approvers Group</label>
                                        {{--  <select class="form-control"   name="approver_group"/>  --}}

                                        <select id="choices-multiple-remove-button" name="approver_group[]"
                                            placeholder="Select Approvers" multiple>
                                            @if (count($approversgroup) > 0)
                                                @foreach ($approversgroup as $lan)
                                                    <option value="{{ $lan->id }}">
                                                        {{ $lan->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label  for="revision-type">Revision Type</label>
                                        <select name="revision_type">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="NA">NA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="summary">Revision Summary</label>
                                        <textarea name="revision_summary"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton" class="saveButton">Save</button>
                            <button type="button" class="nextButton" id="DocnextButton">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a>
                            </button> 
                        </div>
                    </div>


<!-- ---------------------------------------------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

                    <div id="add-doc" class="tabcontent">
                        <div class="orig-head">
                            Training Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="train-require">Training Required?</label>
                                        <select name="training_required" required>
                                            <option value="">Enter your Selection</option>
                                            <option value="yes">Yes</option>
                                            <option value="no" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="link-doc">Trainer</label>
                                        <select name="trainer">
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach ($trainer as $temp)
                                            @if(Helpers::checkUserRolestrainer($temp))
                                                <option value="{{ $temp->id }}">{{ $temp->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="launch-cbt">Launch CBT</label>
                                    <select name="cbt">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="training-type">Type</label>
                                    <select name="training-type">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="test">
                                            Test(0)<button type="button" name="test"
                                                onclick="addTrainRow('test')">+</button>
                                        </label>
                                        <table class="table-bordered table" id="test">
                                            <thead>
                                                <tr>
                                                    <th class="row-num">Row No.</th>
                                                    <th class="question">Question</th>
                                                    <th class="answer">Answer</th>
                                                    <th class="result">Result</th>
                                                    <th class="comment">Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="test">
                                            Survey(0)<button type="button" name="reporting1"
                                                onclick="addTrainRow('survey')">+</button>
                                        </label>
                                        <table class="table-bordered table" id="survey">
                                            <thead>
                                                <tr>
                                                    <th class="row-num">Row No.</th>
                                                    <th class="question">Subject</th>
                                                    <th class="answer">Topic</th>
                                                    <th class="result">Rating</th>
                                                    <th class="comment">Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" > Exit </a>
                            </button>
                        </div>
                    </div>
                   
                    <div id="doc-content" class="tabcontent">
                        <div class="orig-head">
                            Document Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Purpose</label>
                                        <input type="text" name="purpose">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="scope"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        
                                        <label for="responsibility" id="responsibility">
                                            Responsibility<button type="button" id="responsibilitybtnadd"
                                                name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        </label>

                                        <input type="text" name="responsibility[]" class="myclassname">


                                        <div id="responsibilitydiv"></div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="abbreviation" id="abbreviation">
                                            Abbreviation<button type="button" id="abbreviationbtnadd"
                                                name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        </label>

                                        <input type="text" name="abbreviation[]" class="myclassname">


                                        <div id="abbreviationdiv"></div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="abbreviation" id="definition">
                                            Definition<button type="button" id="Definitionbtnadd"
                                                name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        </label>

                                        <input type="text" name="defination[]" class="myclassname">

                                        <div id="definitiondiv"></div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Materials and Equipments<button type="button" id="materialsbtadd"
                                                name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        </label>

                                        <input type="text" name="materials_and_equipments[]" class="myclassname">


                                        <div id="materialsdiv"></div>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">Procedure</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea name="procedure" id="summernote">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Reporting<button type="button" id="reportingbtadd" name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <input type="text" name="reporting[]" class="myclassname">


                                        <div id="reportingdiv"></div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="references" id="references">
                                            References<button type="button" id="referencesbtadd" >+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <input type="text" name="references[]" class="myclassname">
                                        <div id="referencesdiv"></div>
                                        {{-- <div class="row reference-data">
                                            <div class="col-lg-6">
                                                <input type="text" name="reference-text">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="file" name="references" class="myclassname">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="ann" id="ann">
                                            Annexure<button type="button" id="annbtadd" >+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <input type="text" name="ann[]" class="myclassname">
                                        <div id="anndiv"></div>
                                        {{-- <div class="row reference-data">
                                            <div class="col-lg-6">
                                                <input type="text" name="reference-text">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="file" name="references" class="myclassname">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">  ---By Aditya
                                    <div class="group-input">
                                        <label for="annexure">
                                            Annexure<button type="button" name="ann" id="annexurebtnadd">+</button>
                                        </label>
                                        <table class="table-bordered table" id="annexure">
                                            <div><small class="text-primary">Please mention brief summary</small></div>
                                            <thead>
                                                <tr>
                                                    <th class="sr-num">Sr. No.</th>
                                                    <th class="annx-num">Annexure No.</th>
                                                    <th class="annx-title">Title of Annexure</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]" value="1"></td>
                                                    <td><input type="text" name="annexure_number[]"></td>
                                                    <td><input type="text" name="annexure_data[]"></td>
                                                </tr>
                                                <div id="annexurediv"></div>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="test">
                                            Revision History<button type="button" name="reporting2"
                                                onclick="addRevRow('revision')">+</button>
                                        </label>
                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                        <table class="table-bordered table" id="revision">
                                            <thead>
                                                <tr>
                                                    <th class="sop-num">SOP Revision No.</th>
                                                    <th class="dcrf-num">Change Control No./ DCRF No.</th>
                                                    <th class="changes">Changes</th>
                                                    <th class="deleteRow">&nbsp;</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" id="rev-num0"></td>
                                                    <td><input type="text" id="control0"></td>
                                                    <td><input type="text" id="change0"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a>
                            </button>
                        </div>
                    </div>

                    <div id="annexures" class="tabcontent">
                        <div class="input-fields">
                            <div class="group-input">
                                <label for="annexure-1">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-1"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-2">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-2"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-3">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-3"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-4">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-4"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-5">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-5"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-6">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-6"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-7">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-7"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-8">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-8"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-9">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-9"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-10">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-10"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-11">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-11"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-12">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-12"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-13">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-13"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-14">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-14"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-15">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-15"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-16">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-16"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-17">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-17"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-18">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-18"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-19">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-19"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-20">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-20"></textarea>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" > Exit </a>
                            </button>
                        </div>
                    </div>

                    <div id="distribution-retrieval" class="tabcontent">
                        <div class="orig-head">
                            Distribution & Retrieval
                        </div>
                        <div class="col-md-12 input-fields">
                            <div class="group-input">
                                <label for="distribution" id="distribution">
                                    Distribution & Retrieval<button type="button" id="distributionbtnadd" >+</button>
                                </label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <input type="text" name="distribution[]" class="myclassname">
                                <div id="distributiondiv"></div>
                            </div>
                        </div>
                        {{-- <div class="input-fields">
                            <div class="group-input">
                                <label for="distriution_retrieval">
                                    Distribution & Retrieval
                                    <button type="button" name="    "
                                        onclick="addDistributionRetrieval('distribution-retrieval-grid')">+</button>
                                </label>
                                <div class="table-responsive retrieve-table">
                                    <table class="table table-bordered" id="distribution-retrieval-grid">
                                        <thead>
                                            <tr>
                                                <th>Row </th>
                                                <th>Document Title</th>
                                                <th>Document Number</th>
                                                <th>Document Printed By</th>
                                                <th>Document Printed on</th>
                                                <th>Number of Print Copies</th>
                                                <th>Issuance Date</th>
                                                <th>Issued To </th>
                                                <th>Department/Location</th>
                                                <th>Number of Issued Copies</th>
                                                <th>Reason for Issuance</th>
                                                <th>Retrieval Date</th>
                                                <th>Retrieved By</th>
                                                <th>Retrieved Person Department</th>
                                                <th>Number of Retrieved Copies</th>
                                                <th>Reason for Retrieval</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                 <td><input type="text" Value="1" name="serial_number[]" readonly>
                                                 </td>
                                                 <td><input type="text" name="document_title[]">
                                                 </td>
                                                 <td><input type="number" name="document_number[]">
                                                 </td>
                                                 <td><input type="text" name="document_printed_by[]">
                                                 </td>
                                                 <td><input type="text" name="document_printed_on[]">
                                                 </td>
                                                 <td><input type="number" name="document_printed_copies[]">
                                                 </td>
                                                 <td><div class="group-input new-date-data-field mb-0">
                                                    <div class="input-date "><div
                                                     class="calenderauditee">
                                                    <input type="text" id="issuance_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                                                    <input type="date" name="issuance_date[]" class="hide-input" 
                                                    oninput="handleDateInput(this, `issuance_date' + serialNumber +'`)" /></div></div></div>
                                                </td>
                                                
                                                    <td>
                                                        <select id="select-state" placeholder="Select..."
                                                            name="issuance_to[]">
                                                            <option value='0'>-- Select --</option>
                                                            <option value='1'>Amit Guru</option>
                                                            <option value='2'>Shaleen Mishra</option>
                                                            <option value='3'>Madhulika Mishra</option>
                                                            <option value='4'>Amit Patel</option>
                                                            <option value='5'>Harsh Mishra</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="select-state" placeholder="Select..."
                                                            name="location[]">
                                                            <option value='0'>-- Select --</option>
                                                            <option value='1'>Tech Team</option>
                                                            <option value='2'>Quality Assurance</option>
                                                            <option value='3'>Quality Management</option>
                                                            <option value='4'>IT Administration</option>
                                                            <option value='5'>Business Administration</option>
                                                        </select>
                                                    </td>    
                                                <td><input type="number" name="issued_copies[]">
                                                </td>
                                                <td><input type="text" name="issued_reason[]">
                                                </td>
                                                <td><div class="group-input new-date-data-field mb-0">
                                                    <div class="input-date "><div
                                                     class="calenderauditee">
                                                    <input type="text" id="retrieval_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                                                    <input type="date" name="retrieval_date[]" class="hide-input" 
                                                    oninput="handleDateInput(this, `retrieval_date' + serialNumber +'`)" /></div></div></div>
                                                </td>
                                                <td>
                                                    <select id="select-state" placeholder="Select..."
                                                        name="retrieval_by[]">
                                                        <option value="">Select a value</option>
                                                        <option value='1'>Amit Guru</option>
                                                        <option value='2'>Shaleen Mishra</option>
                                                        <option value='3'>Madhulika Mishra</option>
                                                        <option value='4'>Amit Patel</option>
                                                        <option value='5'>Harsh Mishra</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="select-state" placeholder="Select..."
                                                        name="retrieved_department[]">
                                                        <option value='0'>-- Select --</option>
                                                        <option value='1'>Tech Team</option>
                                                        <option value='2'>Quality Assurance</option>
                                                        <option value='3'>Quality Management</option>
                                                        <option value='4'>IT Administration</option>
                                                        <option value='5'>Business Administration</option>
                                                    </select>
                                                </td>    
                                                <td><input type="number" name="retrieved_copies[]">
                                                </td>
                                                <td><input type="text" name="retrieved_reason[]">
                                                </td>
                                                <td><input type="text" name="remark[]">
                                                </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a  href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a>
                            </button>
                        </div>
                    </div>

                    {{-- <div id="print-download" class="tabcontent">
                        <div class="orig-head">
                            Print Permissions
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="person-print">Person Print Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Person</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    Amit Patel
                                                </td>
                                                <td class="permission">
                                                    6543
                                                </td>
                                                <td class="permission">
                                                    6543
                                                </td>
                                                <td class="permission">
                                                    6543
                                                </td>
                                                <td class="permission">
                                                    432
                                                </td>
                                                <td class="permission">
                                                    123
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="group-print">Group Print Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Group</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    QA
                                                </td>
                                                <td class="permission">1</td>
                                                <td class="permission">
                                                    54
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                                <td class="permission">
                                                    765
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="orig-head">
                            Download Permissions
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="person-print">Person Download Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Person</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    Amit Patel
                                                </td>
                                                <td class="permission">1</td>
                                                <td class="permission">
                                                    54
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                                <td class="permission">
                                                    765
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="group-print">Group Download Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Group</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    QA
                                                </td>
                                                <td class="permission">1</td>
                                                <td class="permission">
                                                    54
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                                <td class="permission">
                                                    765
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a  href="{{ url('rcms/qms-dashboard') }}" class="text-white" > Exit </a>
                            </button>
                        </div>
                    </div> --}}

                    <div id="sign" class="tabcontent">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Originated By 
                                        {{-- Review Proposed By --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Review Proposed On
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Originated On 
                                        {{-- Document Reuqest Approved By --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Document Reuqest Approved On
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Document Writing Completed By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Document Writing Completed On
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Reviewd By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Reviewd On
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Approved By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Approved On
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="submit">Submit</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" href="#"> Exit </a> </button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

    {{-- ======================================
                  DIVISION MODAL
    ======================================= --}}
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
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#document-form').validate({
                rules: {
                    name: 'required',
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                // Add custom messages if needed
                messages: {
                    name: 'Please enter your name',
                    email: {
                        required: 'Please enter your email',
                        email: 'Please enter a valid email address'
                    },
                    password: {
                        required: 'Please enter a password',
                        minlength: 'Password must be at least 6 characters long'
                    }
                },
                submitHandler: function(form) {
                    form.submit(); // Submit the form if validation passes
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#addButton').click(function() {
                var sourceValue = $('#sourceField').val(); // Get the value from the source field
                var targetField = $(
                    '.targetField'); // The target field where the data will be added and selected

                // Create a new option with the source value
                var newOption = $('<option>', {
                    value: sourceValue,
                    text: sourceValue
                });

                // Append the new option to the target field
                targetField.append(newOption);

                // Set the new option as selected
                newOption.prop('selected', true);
                $('#sourceField').val('');
            });
        });
    </script>

    <script>
        function openData(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("tablinks");
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
        const stepButtons = document.querySelectorAll(".tablinks");
        const steps = document.querySelectorAll(".tabcontent");
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
@endsection
