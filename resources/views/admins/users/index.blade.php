@extends('layouts.admin')


@section('title', 'ALL USER')

@section('content')

<div class="container-fluid">
    <h4 class="mb-4">Danh sách User</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-busered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody> 
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->status }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>
                        {{-- <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">Xem</a>
                        <form action="{{ route('users.update', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Đang chờ thanh toán</option>
                                <option value="processing" {{ $user->status == 'processing' ? 'selected' : ''}}>Đang chờ duyệt đơn</option>
                                <option value="shipping" {{ $user->status == 'shipping' ? 'selected' : '' }}>Đơn hàng đang được giao</option>
                                <option value="delivered" {{ $user->status == 'delivered' ? 'selected' : '' }}>Đơn hàng đã giao thành công</option>
                                <option value="completed" {{ $user->status == 'completed' ? 'selected' : '' }}>Nhận hàng thành công</option>
                                <option class="text-red-500" value="cancelled" {{ $user->status == 'cancelled' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </form> --}}
                    </td>
                </tr>
            @empty
                {{-- <tr>
                    <td colspan="6" class="text-center">Không có đơn hàng nào</td>
                </tr> --}}
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection