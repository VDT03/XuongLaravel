@extends('master3')

@section('title')
    Thông tin sinh viên
@endsection

@section('content')
    <div class="container">
        <h1>Thông tin sinh viên: {{ $data->name }}</h1>

        <div class="card mb-4">
            <div class="card-header">
                Thông tin cá nhân
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $data->email }}</p>
                <p><strong>Lớp học:</strong> {{ $data->classroom->name }}</p>
                <p><strong>Giáo viên chủ nhiệm:</strong> {{ $data->classroom->teacher_name }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Thông tin hộ chiếu
            </div>
            <div class="card-body">
                @if ($data->passport)
                    <p><strong>Số hộ chiếu:</strong> {{ $data->passport->passport_number }}</p>
                    <p><strong>Ngày cấp:</strong> {{ $data->passport->issued_date }}</p>
                    <p><strong>Ngày hết hạn:</strong> {{ $data->passport->expiry_date }}</p>
                @else
                    <p>Chưa có thông tin hộ chiếu.</p>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Các môn học đã đăng ký
            </div>
            <div class="card-body">
                @if ($data->subjects->isEmpty())
                    <p>Sinh viên chưa đăng ký môn học nào.</p>
                @else
                    <ul>
                        @foreach ($data->subjects as $subject)
                            <li>{{ $subject->name }} - {{ $subject->credits }} tín chỉ</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <a href="{{ route('students.index') }}" class="btn btn-primary">Danh sách sinh viên</a>
    </div>
@endsection
