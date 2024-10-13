@extends('master3')

@section('title')
    Thêm mới sinh viên
@endsection

@section('content')
    <div class="container">
        <h2>Thêm mới sinh viên</h2>

        <!-- Hiển thị các thông báo lỗi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form để tạo sinh viên mới -->
        <form class="mt-3" action="{{ route('students.store') }}" method="POST">
            @csrf

            <!-- Tên sinh viên -->
            <div class="form-group mt-4">
                <label for="name">Họ tên:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <!-- Email sinh viên -->
            <div class="form-group mt-4">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <!-- Lớp học (Classroom) -->
            <div class="form-group mt-4">
                <label for="classroom_id">Lớp:</label>
                <select name="classroom_id" class="form-control" required>
                    <option value="">-- Chọn --</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                            {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Hộ chiếu (Passport) -->
            <div class="form-group mt-4">
                <label for="passport_number">Số hộ chiếu:</label>
                <input type="text" name="passport_number" class="form-control" value="{{ old('passport_number') }}"
                    required>
            </div>

            <!-- Ngày cấp hộ chiếu -->
            <div class="form-group mt-4">
                <label for="issued_date">Ngày cấp:</label>
                <input type="date" name="issued_date" class="form-control" value="{{ old('issued_date') }}"
                    required>
            </div>

            <!-- Ngày hết hạn hộ chiếu -->
            <div class="form-group mt-4">
                <label for="expiry_date">Ngày hết hạn:</label>
                <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}"
                    required>
            </div>

            <!-- Môn học (Subjects) -->
            <div class="form-group mt-4">
                <label for="subjects">Môn học:</label>
                <select name="subjects[]" class="form-control" multiple>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            {{ collect(old('subjects'))->contains($subject->id) ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nút tạo sinh viên -->
            <button type="submit" class="btn btn-primary mt-4">Thêm mới</button>
        </form>
    </div>
@endsection
