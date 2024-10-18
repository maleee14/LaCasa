@extends('layouts.admin')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Requests</h5>

                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Agent</th>
                            <th scope="col">go to this property</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allRequests as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->agent_name }}</td>
                                <td><a href="{{ route('property.detail', $item->property_id) }}"
                                        class="btn btn-success  text-center ">Go to This Property</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
