@extends(auth()->user()->type == 'admin' ? 'layouts.admin' : 'layouts.user')

@section('title',
    'Laravel 10 Login SignUp with User Roles and Permissions with Admin CRUD | Tailwind CSS Custom Login
    register')

@section('contents')
    <div>
        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <h1 class="font-bold text-2xl ml-3">Manage Your Activity</h1>
        <button data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-success mt-4" type="button">
            + Add Activity
        </button>
        <div class="table-responsive mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3" style="min-width: 100px; max-width: 100px; width: 100px;">No
                        </th>
                        <th scope="col" class="px-6 py-3" style="min-width: 120px; max-width: 120px; width: 120px">
                            Tanggal</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 500px; max-width: 500px; width: 500px;">
                            Aktivitas</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($activities_today->count() > 0)
                        @foreach ($activities_today as $activity_today)
                            <tr>
                                <th scope="row">
                                    <p class="text-start text-nowrap">{{ $loop->iteration }}</p>
                                </th>
                                <td>
                                    <p class="text-start text-nowrap">{{ $activity_today->tanggal }}</p>
                                </td>
                                <td>
                                    <p class="text-start text-nowrap" style="width: 500px;">
                                        {{ substr($activity_today->activity, 0, 50) }}...</p>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalShow{{ $activity_today->id }}"
                                            class="btn btn-primary">Detail</a>
                                        {{-- <a data-bs-toggle="modal" data-bs-target="#modalEdit{{$user->id}}" href="#"
                                            class="btn btn-warning">Edit</a> --}}
                                        <form action="{{ route('activity_management.destroy', $activity_today->id) }}"
                                            method="POST" onsubmit="return confirm('Delete?')"
                                            class="float-right text-red-800">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                {{-- @include('admin.modal.edit_user') --}}
                                @include('modal.show_activity_today')
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="4">Activity not found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="table-responsive mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3" style="min-width: 100px; max-width: 100px; width: 100px;">No
                        </th>
                        <th scope="col" class="px-6 py-3" style="min-width: 120px; max-width: 120px; width: 120px">
                            Tanggal</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 500px; max-width: 500px; width: 500px;">
                            Aktivitas</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($activities->count() > 0)
                        @foreach ($activities as $activity)
                            <tr>
                                <th scope="row">
                                    <p class="text-start text-nowrap">{{ $loop->iteration }}</p>
                                </th>
                                <td>
                                    <p class="text-start text-nowrap">{{ $activity->tanggal }}</p>
                                </td>
                                <td>
                                    <p class="text-start text-nowrap" style="width: 500px;">
                                        {{ substr($activity->activity, 0, 50) }}...</p>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalShow{{ $activity->id }}"
                                            class="btn btn-primary">Detail</a>
                                        {{-- <a data-bs-toggle="modal" data-bs-target="#modalEdit{{$user->id}}" href="#"
                                    class="btn btn-warning">Edit</a> --}}
                                        <form action="{{ route('activity_management.destroy', $activity->id) }}"
                                            method="POST" onsubmit="return confirm('Delete?')"
                                            class="float-right text-red-800">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                {{-- @include('admin.modal.edit_user') --}}
                                @include('modal.show_activity')
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="4">Activity not found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('modal.add_activity')
    @if (Session::has('error_add'))
        @include('modal.error_add_activity', ['error' => Session::get('error_add')])
    @elseif (Session::has('success_add'))
        @include('modal.success_add_activity', ['success' => Session::get('success_add')])
    @endif
@endsection
