@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <div id="document">
        <div class="container-fluid">
            <div class="dashboard-container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="document-left-block">
                            <div class="inner-block create-block">
                                <div class="head text-right mb-0">
                                    <a href="#" id="set-division">
                                        <i class="fa-solid fa-plus"></i> Create Document
                                    </a>
                                    {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Import Data
                                    </button> --}}
                                    {{-- <a href="{{route('documentExportEXCEL')}}">
                                        Export EXCEL
                                    </a> --}}
                                </div>

                            </div>
                            <div class="inner-block table-block">

                                <div class="filter-block">
                                    <div class="drop-filter-block">
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div class="right">
                                            <label for="corporate-doc">Documents</label>
                                            <select name="corporate-doc">
                                                <option value="all">All</option>
                                                <option value="draft">Draft</option>
                                                <option value="under-review">Under Review</option>
                                                <option value="reviewd">Reviewed</option>
                                                <option value="under-approval">Under Approval</option>
                                                <option value="approved">Approved</option>
                                                <option value="effective">Effective</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="search-bar">
                                        <input id="searchInput" type="text" name="search"
                                            placeholder="Search from the list...">
                                        <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                                    </div> --}}
                                </div>

                                <div class="main-head">
                                    <div>Records</div>
                                    <div>
                                        {{ count($documents) }} Results out of {{ $count }} Results
                                    </div>
                                </div>
                                <div class="table-list">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th class="pr-id" data-bs-toggle="modal" data-bs-target="#division-modal">
                                                ID
                                            </th>
                                            <th class="division">
                                                Document Type
                                            </th>
                                            <th class="division">
                                                Division
                                            </th>
                                            <th class="short-desc">
                                                Short Description
                                            </th>
                                            <th class="create-date">
                                                Create Date Time
                                            </th>
                                            <th class="assign-name">
                                                Originator
                                            </th>
                                            <th class="modify-date">
                                                Modify Date Time
                                            </th>
                                            <th class="status">
                                                Status
                                            </th>
                                            <th class="action">
                                                Action
                                            </th>
                                        </thead>
                                        <tbody id="searchTable">
                                            @if (count($documents) > 0)
                                                @foreach ($documents as $doc)
                                                    <tr>
                                                        <td class="pr-id" style="text-decoration:underline"><a
                                                                href="{{ route('documents.edit', $doc->id) }}">
                                                                000{{ $doc->id }}
                                                            </a>
                                                        </td>
                                                        <td class="division">
                                                            {{ $doc->document_type_name }}
                                                        </td>
                                                        <td class="division">
                                                            {{ Helpers::getDivisionName($doc->division_id) }}
                                                        </td>

                                                        <td class="short-desc">
                                                            {{ $doc->short_description }}
                                                        </td>
                                                        <td class="create-date">
                                                            {{ $doc->created_at }}
                                                        </td>
                                                        <td class="assign-name">
                                                            {{ $doc->originator_name }}
                                                        </td>
                                                        <td class="modify-date">
                                                            {{ $doc->updated_at }}
                                                        </td>
                                                        <td class="status">
                                                            {{ $doc->status }}
                                                        </td>
                                                        <td class="action">
                                                            <div class="action-dropdown">
                                                                <div class="action-down-btn">Action <i
                                                                        class="fa-solid fa-angle-down"></i></div>
                                                                <div class="action-block">
                                                                    <a href="{{ url('doc-details', $doc->id) }}">View
                                                                    </a>

                                                                    <a
                                                                        href="{{ route('documents.edit', $doc->id) }}">Edit</a>
                                                                    <!--<form-->
                                                                    <!--    action="{{ route('documents.destroy', $doc->id) }}"-->
                                                                    <!--    method="post">-->
                                                                    <!--    @csrf-->
                                                                    <!--    @method('DELETE')-->
                                                                    <!--    <button type="submit">Delete</button>-->
                                                                    <!--</form>-->

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <center>
                                                    <h5>Data not Found</h5>
                                                </center>
                                            @endif

                                        </tbody>
                                    </table>
                                    {!! $documents->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-3 col-lg-3">
                        <div class="document-right-block">
                            <div class="inner-block recent-record">
                                <div class="head">
                                    Recent Records
                                </div>
                                <div class="record-list">
                                    <div>
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">DMS/TMS Dashboard</a></div>
                                    </div>
                                    <div>
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">Amit Guru</a></div>
                                    </div>
                                    <div>
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">Change Control Dashboard</a></div>
                                    </div>
                                    <div class="mb-0">
                                        <div class="icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div><a href="#">EQMS Home Dashboard</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-block recent-items">
                                <div class="head">
                                    Recent Items (0)
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input mb-3">
                            <label for="file">Upload Document (All PDF with csv or xls)</label>
                            <input type="file" name="files[]" multiple>
                        </div>
                        <div class="download mb-3">
                            <div class="title">(Download the example format from here.)</div>
                            <a href="{{ asset('user/images/document.xls') }}" class="btn btn-primary" download>
                                Download
                            </a>
                        </div>
                        <div>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('division_submit') }}" method="post">
                    @csrf 
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                            // Get the user's roles
                            $userRoles = DB::table('user_roles')->where('user_id', Auth::user()->id)->get();
                            // Initialize an empty array to store division IDs
                            $divisionIds = [];
                            // Loop through user's roles
                            foreach($userRoles as $role) {
                                // Store division IDs from user's roles
                                $divisionIds[] = $role->q_m_s_divisions_id;
                            }
                            // Retrieve divisions where status = 1 and the division ID is in the array of division IDs
                            $divisions = DB::table('q_m_s_divisions')->where('status', 1)->whereIn('id', $divisionIds)->get();
                        @endphp
                            <style>
                                #division-modal .tab a.active {
                                    background-color: #23a723 !important;
                                    color: white !important;
                                }
                            </style>
                            @foreach ($divisions as $temp)
                                <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                                <a style="display: block;
                                background-color: inherit;
                                color: black;
                                padding: 5px 10px;
                                width: 100%;
                                border: none;
                                outline: none;
                                text-align: left;
                                cursor: pointer;
                                transition: 0.3s;" class="divisionlinks"
                                    onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</a>
                            @endforeach
                        </div>
                        @php
                            $process = DB::table('processes')->get();
                        @endphp
                        @foreach ($process as $temp)
                            <div id="{{ $temp->division_id }}" class="divisioncontent">
                                @php
                                    $pro = DB::table('processes')
                                        ->where('division_id', $temp->division_id)
                                        ->get();
                                @endphp
                                @foreach ($pro as $test)
                                    <label for="process">
                                        <input type="radio" class="process_id_reset"  for="process" value="{{ $test->id }}"
                                            name="process_id" required> {{ $test->process_name }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                    <div class="button-container">
                        
                        <a href="/documents" style="border: 1px solid grey;
                        letter-spacing: 1px;
                        font-size: 0.9rem;
                        padding: 3px 10px;
                        background: black;
                        color: white;">Cancel</a>
                        <button id="submit-division" type="submit">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
