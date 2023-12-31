<x-app-layout>
<div class="p-6 text-gray-900">
    <x-slot name="header">
        <div class="tollbar" style="display: flex; justify-content:space-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
        </h2>
        <a href="{{ route('user.create') }}">Add new</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->user_type }}</td>
                            <td>
                            @if (!empty($user->avatar))
                                <img src="{{ asset('storage/' . $user->avatar) }}" width="50" alt="Avatar">
                            @else
                                No avatar
                            @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->gender_label }}</td>
                            <td>
                                <a href="{{ route('user.edit', ['user' => $user->id]) }}">Edit</a>
                                <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa người dùng {{ $user->name }}?')">Delete</button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
