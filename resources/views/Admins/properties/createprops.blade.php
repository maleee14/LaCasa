@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Properties</h5>
                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="title" id="form2Example1" class="form-control"
                                placeholder="Title" />
                            @error('title')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control"
                                placeholder="Price" />
                            @error('price')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Property image</label>
                            <input name="image" class="form-control" type="file" id="formFile">
                            @error('image')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="beds" id="form2Example1" class="form-control"
                                placeholder="Beds" />
                            @error('beds')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="bath" id="form2Example1" class="form-control"
                                placeholder="Bath" />
                            @error('bath')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="area_sqft" id="form2Example1" class="form-control"
                                placeholder="SQ/FT" />
                            @error('area_sqft')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year_built" id="form2Example1" class="form-control"
                                placeholder="Year Build" />
                            @error('year_built')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price_sqft" id="form2Example1" class="form-control"
                                placeholder="Price Per SQ FT" />
                            @error('price_sqft')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="location" id="form2Example1" class="form-control"
                                placeholder="location" />
                            @error('location')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <select name="home_type" class="form-control mb-4 form-select" aria-label="Default select example">
                            <option selected>Select Home Type</option>
                            @foreach ($hometypes as $item)
                                <option value="{{ $item->hometypes }}">{{ $item->hometypes }}</option>
                            @endforeach
                        </select>
                        <select name="type" class="form-control mt-3 mb-4 form-select"
                            aria-label="Default select example">
                            <option selected>Select Type</option>
                            <option value="Sale">For Sale</option>
                            <option value="Rent">For Rent</option>
                            <option value="Lease">For Lease</option>
                        </select>
                        <select name="city" class="form-control mt-3 mb-4 form-select"
                            aria-label="Default select example">
                            <option selected>Select City</option>
                            <option value="New York">New York</option>
                            <option value="Brooklyn">Brooklyn</option>
                            <option value="London">London</option>
                            <option value="Tokyo">Tokyo</option>
                            <option value="Philippines">Philippines</option>
                        </select>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">More Info</label>
                            <textarea placeholder="More Info" name="more_info" class="form-control" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                            @error('more_info')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="agent_name" id="form2Example1" class="form-control"
                                placeholder="Agent Name" />
                            @error('agent_name')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
