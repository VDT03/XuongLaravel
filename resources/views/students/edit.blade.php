@extends('master3')

@section('title')
    Thêm mới sinh viên
@endsection

@section('content')
    <div class="container">
        <h1>Chỉnh sửa sinh viên</h1>

        {{-- Hiển thị các lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form cập nhật thông tin sinh viên --}}
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Thông tin sinh viên --}}
            <div class="form-group mt-4">
                <label for="name">Họ tên:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}">
            </div>

            <div class="form-group mt-4">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}">
            </div>

            <div class="form-group mt-4">
                <label for="classroom_id">Lớp:</label>
                <select name="classroom_id" class="form-control">
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}"
                            {{ $student->classroom_id == $classroom->id ? 'selected' : '' }}>
                            {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Thông tin hộ chiếu --}}
            <div class="form-group mt-4">
                <label for="passport_number">Số hộ chiếu:</label>
                <input type="text" name="passport_number" class="form-control"
                    value="{{ old('passport_number', $student->passport->passport_number) }}">
            </div>

            <div class="form-group mt-4">
                <label for="issued_date">Ngày cấp:</label>
                <input type="date" name="issued_date" class="form-control"
                    value="{{ old('issued_date', $student->passport->issued_date) }}">
            </div>

            <div class="form-group mt-4">
                <label for="expiry_date">Ngày hết hạn:</label>
                <input type="date" name="expiry_date" class="form-control"
                    value="{{ old('expiry_date', $student->passport->expiry_date) }}">
            </div>

            {{-- Danh sách môn học --}}
            <div class="form-group mt-4">
                <label for="subjects">Môn học:</label>
                <select name="subjects[]" class="form-control" multiple>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            {{ collect(old('subjects', $student->subjects->pluck('id')->toArray()))->contains($subject->id) ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Sửa</button>
        </form>
    </div>
@endsection
