    {{-- ======================================
                    TMS HEAD
    ======================================= --}}
    <div id="tms-head">
        <div class="head">Training Management System</div>
        <div class="link-list">
            <a href="{{ route('TMS.index') }}" class="tms-link">Dashboard</a>
            <div class="tms-drop-block">
                <div class="drop-btn">Quizzes&nbsp;<i class="fa-solid fa-angle-down"></i></div>
                <div class="drop-list">
                    <a href="/question">Question</a>
                    <a href="/question-bank">Question Banks</a>
                    <a href="{{ route('quize.index') }}">Manage Quizzes</a>
                </div>
            </div>
            <div class="tms-drop-block">
                <div class="drop-btn">Activities&nbsp;<i class="fa-solid fa-angle-down"></i></div>
                <div class="drop-list">
                    <a href="{{ route('TMS.create') }}">Create Training Plan</a>
                    <a href="{{ url('TMS/show') }}">Manage Training Plan</a>
                </div>
            </div>
        </div>
    </div>
