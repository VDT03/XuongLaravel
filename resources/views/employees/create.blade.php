@extends('master2')

@section('title')
    Thêm mới nhân viên
@endsection

@section('content')
    <h1>Thêm mới nhân viên</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 row">
                <label for="first_name" class="col-4 col-form-label">First name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="first_name" id="first_name" {{ old('first_name') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="last_name" class="col-4 col-form-label">Last name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="last_name" {{ old('last_name') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" {{ old('email') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone" {{ old('phone') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date_of_birth" class="col-4 col-form-label">Date of birth</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" {{ old('date_of_birth') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="hire_date" class="col-4 col-form-label">Hire date</label>
                <div class="col-8">
                    <input type="datetime-local" class="form-control" name="hire_date" id="hire_date" {{ old('hire_date') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="salary" class="col-4 col-form-label">Salary</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="salary" id="salary" {{ old('salary') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="department_id" class="col-4 col-form-label">Department ID</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="department_id" id="department_id" {{ old('department_id') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="manager_id" class="col-4 col-form-label">Manager ID</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="manager_id" id="manager_id" {{ old('manager_id') }}/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address" {{ old('address') }}/>
                </div>
            </div>            
            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Is active</label>
                <div class="col-8">
                    <input type="checkbox" class="form-checkbox" value="1" name="is_active" id="is_active" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="profile_picture" class="col-4 col-form-label">Profile picture</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profile_picture" id="profile_picture" />
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
