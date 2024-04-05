@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <style>
        header {
            display: none;
        }
    </style>
    {{-- <style>
        /* CSS for changing the color of active site/location option to blue */
            .divisionlinks.active {
                color: blue;
}
    </style> --}}
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <div id="division-config-modal">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('formDivision') }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="left-block">
                            <div class="head">
                                Site/Location
                            </div>
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
                                @foreach ($divisions as $temp)
                                    <div class="divisionlinks" style="color: {{ $loop->first ? 'blue' : 'black' }};" onclick="openDivision(event, {{ $temp->id }})">
                                        <input type="hidden" value="{{ $temp->id }}" name="division_id">
                                        <div>{{ $temp->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="right-block">
                            <div class="head">
                                Process
                            </div>
                            @foreach ($divisions as $temp)
                                <div id="{{ $temp->id }}" class="divisioncontent bg-light" style="display: none;">
                                    @php
                                        // Get the user's roles
                                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $temp->id])->get();
    
                                        // Initialize an empty array to store division IDs
                                        $processIds = [];
    
                                        // Loop through user's roles
                                        foreach($userRoles as $role) {
                                            // Store division IDs from user's roles
                                            $processIds[] = $role->q_m_s_processes_id;
                                        }
    
                                        $processes = DB::table('q_m_s_processes')
                                                ->whereIn('id', $processIds)
                                                ->get();
                                    @endphp
                                    @foreach ($processes as $process)
                                        <label for="process">
                                            <input type="hidden" name="process_id" value="{{ $process->id }}">
                                            <input type="submit" class="bg-light text-dark"
                                                style="width: 100%; height: 60%; background-color: #011627; color: #fdfffc; padding: 7px; border: 0px;"
                                                bgcolor="#011627" border="0" type="submit" for="process"
                                                value="{{ $process->process_name }}" name="process_name" required>
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Function to open the division and display its processes
        function openDivision(event, divisionId) {
            // Prevent the default action of the event
            event.preventDefault();
    
            // Hide all division contents
            var divisionContents = document.querySelectorAll('.divisioncontent');
            divisionContents.forEach(function(divisionContent) {
                divisionContent.style.display = 'none';
            });
    
            // Remove 'active' class from all division links
            var divisionLinks = document.querySelectorAll('.divisionlinks');
            divisionLinks.forEach(function(divisionLink) {
                divisionLink.style.color = 'black'; // Reset color of all division links
            });
    
            // Show the selected division content
            var selectedDivisionContent = document.getElementById(divisionId);
            selectedDivisionContent.style.display = 'block';
    
            // Set color of the clicked division link to blue
            event.currentTarget.style.color = 'blue';
        }
    
        // Trigger click event on the first division link when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            var firstDivisionLink = document.querySelector('.divisionlinks');
            if (firstDivisionLink) {
                firstDivisionLink.click(); // Trigger click event
            }
        });
    </script>
    
    
    
    
@endsection
