@extends('frontend.layout.main')
@section('container')
    @include('frontend.TMS.head')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            @php
                toastr()->error('Please add some questions');
            @endphp
        @endforeach
    @endif
    {{-- ======================================
                MANAGE QUESTION BANK
    ======================================= --}}
    <div id="manage-question-bank">
        <div class="container-fluid">
            <div class="inner-block basic-info">
                <div class="main-head">
                    Manage Question Bank
                </div>
                <div class="inner-block-content">
                    <div class="bar">
                        <div>Title</div>
                        <div> : </div>
                        <div>{{ $question->title }}.</div>
                    </div>
                    <div class="bar">
                        <div>Status</div>
                        <div> : </div>
                        <div>{{ $question->status }}</div>
                    </div>
                    <div class="bar">
                        <div>Description</div>
                        <div> : </div>
                        <div>{{ $question->description }}</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('question-bank.update', $question->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="inner-block add-question">
                    <div class="main-head">Manage Questions</div>
                    <div class="inner-block-content">
                        <div class="question-container">
                            <div class="left-block">
                                <div class="head">Select Questions</div>
                                <table class="table table-bordered left-table">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>

                                    <tbody id="item-list">
                                        @foreach ($data as $key => $temp)
                                            <tr data-item="{{ $temp->id }}">

                                                <td>{{ $temp->question }}</td>
                                                <td>{{ $temp->type }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="pagination">
                                     {{ $data->links() }}
                                </div>
                            </div>
                            <div class="right-block">
                                <div class="head">Selected Questions</div>
                                <table class="table table-bordered right-table">
                                    <thead>
                                        <tr id="selectQuestion" data-id="{{ $question->id }}">
                                            <th>Question</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-list">

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="foot-btns">
                    <a href="{{ route('question-bank.index') }}"> <button>Cancel</button></a>
                    <button type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        const itemList = document.getElementById('item-list');
        const selectedList = document.getElementById('selected-list');
        function deleteItem() {
            const itemRow = this.closest('tr');
            itemRow.remove();
        }
        selectedList.addEventListener('click', function(e) {
            if (e.target.matches('button')) {
                deleteItem.call(e.target);
            }
        });
        itemList.addEventListener('click', function(e) {
            const selectedItem = e.target.closest('tr');
            if (selectedItem) {
                const itemData = selectedItem.getAttribute('data-item');
                const existingItem = selectedList.querySelector(`tr[data-item="${itemData}"]`);
                if (!existingItem) {
                    const newItem = selectedItem.cloneNode(true);
                    const deleteBtn = document.createElement('button');
                    deleteBtn.textContent = 'Delete';
                    deleteBtn.addEventListener('click', deleteItem);
                    const td = document.createElement('td');
                    const inputType = document.createElement('input');
                    inputType.setAttribute('type', 'hidden');
                    inputType.setAttribute('name', 'questions[]');
                    inputType.setAttribute('value', itemData);
                    td.appendChild(deleteBtn);
                    newItem.appendChild(td);
                    newItem.appendChild(inputType);
                    selectedList.appendChild(newItem);
                }
            }
        });
    </script>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
 $(document).ready(function() {
  loadUsers();

  // Handle pagination click event
  $(document).on('click', '#pagination a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    loadUsers(page);
  });

  // Function to load paginated users
  function loadUsers(page) {
    fetch('/question-bank/2/edit?page=' + page)
      .then(response => response.text())
      .then(data => {
        // Extract the userList HTML and pagination HTML from the response
        var userList = $(data).find('#item-list').html();
        var pagination = $(data).find('#pagination').html();

        // Update the #userList and #pagination elements on the page
        $('#item-list').html(userList);
        $('#pagination').html(pagination);
      })
      .catch(error => {
        console.log(error); // Handle error response
      });
  }
});

    </script>
@endsection
