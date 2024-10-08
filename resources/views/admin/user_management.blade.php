@extends('../layouts.admin')

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
        <h2 class="font-bold">Halaman Manajemen User</h2>
        <span id="path"><a href="#">admin</a> / <a href="{{ route('admin.user_management') }}">user_management</a></span>
        <div id="today-section" style="display: flex; flex-direction: row; margin-top: 40px">
            <span style="background-color: #1b301c; color: white; padding: 10px; border-radius: 8px; margin-right: 10px">List user</span>
            <button data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-success" type="button">
                + Tambah User
            </button>
        </div>
        <div class="table-responsive mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#"
                                            class="btn btn-primary">Detail</a>
                                        <a data-bs-toggle="modal" data-bs-target="#modalEdit{{$user->id}}" href="#"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.user_management.destroy', $user->id) }}"
                                            method="POST" onsubmit="return confirm('Delete?')"
                                            class="float-right text-red-800">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                @include('admin.modal.edit_user')
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="5">User not found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.modal.create_user')
@endsection
