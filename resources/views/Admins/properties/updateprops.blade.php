@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Update Properties</h5>
                    <form method="POST" action="{{ route('properties.update', $property->id) }}"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="title" id="form2Example1" class="form-control"
                                value="{{ $property->title }}" />

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control"
                                value="{{ $property->price }}" />

                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Property image</label>
                            <input name="image" class="form-control" type="file" id="formFile">

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="beds" id="form2Example1" class="form-control"
                                value="{{ $property->beds }}" />

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="bath" id="form2Example1" class="form-control"
                                value="{{ $property->bath }}" />

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="area_sqft" id="form2Example1" class="form-control"
                                value="{{ $property->area_sqft }}" />

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year_built" id="form2Example1" class="form-control"
                                value="{{ $property->year_built }}" />

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price_sqft" id="form2Example1" class="form-control"
                                value="{{ $property->price_sqft }}" />

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="location" id="form2Example1" class="form-control"
                                value="{{ $property->location }}" />

                        </div>

                        <select name="home_type" class="form-control mb-4 form-select" aria-label="Default select example">
                            <option selected>{{ $property->home_type }}</option>
                            @foreach ($hometypes as $item)
                                @if ($item->hometypes !== $property->home_type)
                                    <option value="{{ $item->hometypes }}">{{ $item->hometypes }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="type" class="form-control mt-3 mb-4 form-select"
                            aria-label="Default select example">
                            <option selected>{{ $property->type }}</option>
                            @foreach (['Sale', 'Rent', 'Lease'] as $type)
                                @if ($type !== $property->type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="city" class="form-control mt-3 mb-4 form-select"
                            aria-label="Default select example">
                            <option selected>{{ $property->city }}</option>
                            @foreach (['New York', 'Brooklyn', 'London', 'Tokyo', 'Philippines'] as $city)
                                @if ($city !== $property->city)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">More Info</label>
                            <textarea placeholder="More Info" name="more_info" class="form-control" id="exampleFormControlTextarea1" rows="5">{{ $property->more_info }}</textarea>
                            @error('more_info')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="agent_name" id="form2Example1" class="form-control"
                                value="{{ $property->agent_name }}" />
                            @error('agent_name')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
