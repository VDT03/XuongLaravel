@extends('master')

@section('title')
    Danh sách khách hàng
@endsection

@section('content')
    <h1>Danh sách khách hàng</h1>

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

    <a class="btn btn-info" href="{{ route('customers.create') }}">Create</a>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Is Active</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $customer)
                    <tr class="">
                        <td scope="row">{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            @if ($customer->avatar)
                                <img src="{{ Storage::url($customer->avatar) }}" width="100px">
                            @endif
                        </td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            @if ($customer->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('customers.show', $customer) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('customers.edit', $customer) }}">Edit</a>

                            <form action="{{ route('customers.destroy', $customer) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Xác nhận xóa?')">
                                    Xóa mềm
                                </button>

                            </form>

                            <form action="{{ route('customers.forceDestroy', $customer) }}" method="post">
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
