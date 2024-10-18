@extends('layouts.admin')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('delete') }}
                    </div>
                @endif
                @if (session()->has('gallery'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('gallery') }}
                    </div>
                @endif
                @if (session()->has('update'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('update') }}
                    </div>
                @endif
                <h5 class="card-title mb-4 d-inline">Properties</h5>
                <a href="{{ route('properties.create') }}" class="btn btn-primary mb-4 text-center float-right ">Create
                    Properties</a>
                <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-4 text-center float-right mr-5">Create
                    Gallery</a>

                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Home type</th>
                            <th scope="col">Type</th>
                            <th scope="col">City</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allProperties as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{ currency($item->price) }}</td>
                                <td>{{ $item->home_type }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->city }}</td>
                                <td class="d-flex"><a href="{{ route('properties.edit', $item->id) }}"
                                        class="btn btn-info mr-2 text-center ">Update</a>
                                    <form action="{{ route('properties.delete', $item->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this property?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
