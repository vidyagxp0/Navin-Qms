@extends('frontend.layout.main')
@section('container')
    @include('frontend.TMS.head')


    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        @php
        toastr()->error($error);
        @endphp
        @endforeach
    @endif  
    {{-- ======================================
                CREATING TRAINING
    ======================================= --}}
    <div id="create-training-plan">
        <div class="container-fluid">

            <form action="{{ route('TMS.store') }}" method="POST">
                @csrf
                <div class="inner-block">
                    <div class="main-head">
                        Basic Information
                    </div>
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="training-name">Training Plan Name</label>
                                    <input type="text" id="traning_plan_name" name="traning_plan_name" required>
                                </div>
                                <p id="trainingPlan" style="color: red">
                                    ** Training plan is missing...
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="training-id">Training Plan ID</label>
                                    <div class="static">Not-Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="training-type">Training Plan Type</label>
                                    <select id="training-select" name="training_plan_type" required>
                                        <option value="">---</option>
                                        <option value="Read & Understand">Read & Understand</option>
                                        <option value="Read & Understand with Questions">Read & Understand with Questions
                                        </option>
                                        <option value="Classroom Training">Classroom Training</option>
                                    </select>
                                    <p id="trainingType" style="color: red">
                                        ** Training type is missing...
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="desc">Training Plan Description</label>
                                    <textarea name="desc"></textarea>
                                </div>
                            </div>
                            <div class="col-12" id="quizz">
                                <div class="group-input">
                                    <label for="quize">Quizz</label>
                                    <select id="quizzz" name="quize">
                                        <option value="">---</option>
                                        @foreach ($quize as $temp)
                                            <option data-id="{{ $temp->passing }}" value="{{ $temp->id }}">
                                                {{ $temp->title }}</option>
                                        @endforeach
                                    </select>
                                    <p id="trainingQuiz" style="color: red">
                                        ** Training quiz is missing...
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="effective-criteria">Effective Criteria(in %)</label>
                                    <input type="number" name="effective_criteria" required>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6" id="trainee-criteria">
                                <div class="group-input">
                                    <label for="trainee-criteria">Trainee Criteria(in %)</label>
                                    <input type="number" id="effective" name="trainee_criteria">
                                </div>
                                <p id="trainingCriteria" style="color: red">
                                    ** Trainee Criteria is missing...
                                </p>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=""></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="inner-block">
                            <div class="main-head">
                                Selecting SOP's
                            </div>
                            <div class="inner-block-content">
                                <div class="search-bar">
                                    <input type="text" name="search" placeholder="Search SOP's">
                                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                                </div>
                                <div class="selection-table">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Document Number</th>
                                                {{-- <th>Document Title</th> --}}
                                                <th>Originator</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($due as $temp)
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" id="sopData" name="sops[]"
                                                            value="{{ $temp->document_id }}"></td>
                                                    <td>{{ Helpers::getDivisionName(session()->get('division')) }}/@if($temp->document_type_name){{ $temp->document_type_name }} /@endif {{$temp->year}}/
                                                        000{{ $temp->document_id }}/R{{ $temp->major}}.{{$temp->minor}}</td>
                                                    {{-- <td>&nbsp;</td> --}}
                                                    <td>{{ $temp->originator }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <p id="SOPType" style="color: red">
                                        ** Please Select atliest one SOP...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="inner-block">
                            <div class="main-head">
                                Selecting Trainees
                            </div>
                            <div class="inner-block-content">
                                <div class="search-bar">
                                    <input type="text" name="search" placeholder="Search Trainees">
                                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                                </div>
                                <div class="selection-table">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Trainees Name</th>
                                                <th>Department</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $temp)
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" id="trainee" name="trainees[]"
                                                            value="{{ $temp->id }}"></td>
                                                    <td>{{ $temp->name }}</td>
                                                    <td>{{ $temp->department }}</td>
                                                </tr>
                                            @endforeach
                                            <p id="TraineeType" style="color: red">
                                                ** Please Select atliest one Trainee...
                                            </p>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="inner-block add-question" id="question-select">
                    <div class="main-head">
                        Select Questions for Trainees
                    </div>
                    <div class="inner-block-content">
                        <div class="question-container">
                            <div class="left-block">
                                <div class="head">Select Questions</div>
                                <div class="table-max">
                                    <table class="table table-bordered left-table">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody id="training-question">
                                            <tr data-item="item1">
                                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est nesciunt at
                                                    cupiditate.</td>
                                                <td>Single Select Questions</td>
                                            </tr>
                                            <tr data-item="item2">
                                                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae dolor
                                                    reiciendis
                                                    ullam.</td>
                                                <td>Multi Selection Questions</td>
                                            </tr>
                                            <tr data-item="item3">
                                                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae dolor
                                                    reiciendis
                                                    ullam.</td>
                                                <td>Exact Answer Questions</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="right-block">
                                <div class="head">Selected Questions</div>
                                <div class="table-max">
                                    <table class="table table-bordered right-table">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="training-ques-selected">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="foot-btns">
                    <a href="{{ route('TMS.index') }}"><button>Cancel</button></a>
                    <button type="submit" id="SubmitTraining">Create</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#training-select").change(function() {
                var selectedValue = $(this).val();
                var quizDiv = $("#quizz");
                var traineeCriteriaDiv = $("#trainee_criteria");
                if (selectedValue === "Read & Understand") {
                    quizDiv.hide();
                    traineeCriteriaDiv.hide();
                } else if (selectedValue === "Read & Understand with Questions") {
                    quizDiv.show();
                    traineeCriteriaDiv.show();
                } else if (selectedValue === "Classroom Training") {
                    quizDiv.hide();
                    traineeCriteriaDiv.show();
                }
            });
        });




        const itemList = document.getElementById('training-question');
        const selectedList = document.getElementById('training-ques-selected');
        itemList.addEventListener('click', function(e) {
            const selectedItem = e.target.closest('tr');
            if (selectedItem) {
                const itemData = selectedItem.getAttribute('data-item');
                const existingItem = selectedList.querySelector(`tr[data-item="${itemData}"]`);
                if (!existingItem) {
                    const newItem = selectedItem.cloneNode(true);
                    const deleteBtn = document.createElement('button');
                    deleteBtn.textContent = 'Delete';
                    deleteBtn.addEventListener('click', function() {
                        newItem.remove();
                    });
                    const td = document.createElement('td');
                    td.appendChild(deleteBtn);
                    newItem.appendChild(td);
                    selectedList.appendChild(newItem);
                }
            }
        });
    </script>
@endsection
