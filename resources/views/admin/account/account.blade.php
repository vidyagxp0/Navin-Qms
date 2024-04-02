@php
    $mainmenu = 'User Management';
    $submenu = 'Login Account';

@endphp
@extends('admin.layout')

@section('container')
    <div class="fluid-container mb-3">

        <a href="{{ route('user_management.create') }}" class="btn btn-primary">
            New
        </a>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Login Accounts</h3>
                </div>


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                            
                            <tr>
                                    @php
                                    $RoleList = DB::table('user_roles')->where(['user_id' =>$user->id])->pluck('role_id')->toArray();
                                    $role = '';
                                    $roleName = '';
                                    if($RoleList){
                                        $role = implode(',', $RoleList);
                                        $roleNameList = DB::table('q_m_s_roles')
                                            ->whereIn('id', $RoleList)
                                            ->pluck('name')->toArray();
                                        $roleName = implode(',', $roleNameList);
                                    }
                                    @endphp
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->dname }}</td>
                                    <th>{{ $roleName }}</th>
                                    <td>
                                        <a class="mdi mdi-table-edit"
                                            href="{{ route('user_management.edit', $user->id) }}"><button
                                                class="btn btn-dark">Edit</button></a>

                                        <form action="{{ route('user_management.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="confirmation btn btn-danger">Delete</button>
                                        </form>

                                        <a class="mdi mdi-table-edit" href="{{ route('user_management.duplicate', $user->id) }}" target="_blank">
                                            <button class="btn btn-primary">Duplicate</button>
                                        </a>
                                        
                                        {{-- <a class="mdi mdi-table-edit" href="{{ route('user_management.duplicate', $user->id) }}" onclick="openNewWindow(event)">
                                            <button class="btn btn-primary">Duplicate</button>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach

                            </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->

                <!-- /.card -->
            </div>
            <!-- /.col -->


        </div>




    </div>
    <script>
        function openNewWindow(event) {
            event.preventDefault(); // Prevent the default link behavior
            var url = event.currentTarget.getAttribute('href'); // Get the URL from the href attribute
            window.open(url, '_blank', 'width=600,height=400'); // Open the URL in a new window
        }
    </script>
@endsection


@section('jquery')
@endsection
