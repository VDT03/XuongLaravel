@extends('master2')

@section('title')
    Danh sách nhân viên
@endsection

@section('content')
    <h1>Danh sách nhân viên</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-info">
            Thao tác thành công
        </div>
    @endif

    <a class="btn btn-info" href="{{ route('employees.create') }}">Create</a>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Date of birth</th>
                    <th scope="col">Hire date</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Address</th>
                    <th scope="col">Profile picture</th>
                    <th scope="col">Is Active</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="{{ Storage::url($employee->profile_picture) }}" width="100px">
                            @endif
                        </td>
                        <td>
                            @if ($employee->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}">Edit</a>

                            <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Xác nhận xóa?')">
                                    Xóa mềm
                                </button>

                            </form>

                            <form action="{{ route('employees.forceDestroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-dark" onclick="return confirm('Xác nhận xóa?')">
                                    Xóa cứng
                                </button>

                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}

    </div>
@endsection
