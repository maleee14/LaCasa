@extends('layouts.app')

@section('title')
    request Property
@endsection

@section('content')
    {{-- Carousel --}}
    <div class="site-blocks-cover inner-page-cover overlay"
        style="background-image: url({{ asset('assets/images/hero_bg_4.jpg') }});" data-aos="fade"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-2">Request For Properties</h1>
                </div>
            </div>
        </div>
    </div>
    {{-- Carousel End --}}

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>Request For Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($allRequests->count() > 0)
                    @foreach ($allRequests as $request)
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="property-entry h-100">
                                <div class="p-4 property-body">
                                    <h1 class="property-title pb-3">Property ID : {{ $request->property_id }}</h1>
                                    <div class="d-flex">
                                        <a href="{{ route('property.detail', $request->property_id) }}"
                                            class="btn btn-primary mr-3">See
                                            Property</a>
                                        <form action="{{ route('delete.requests', $request->id) }}" method="post"
                                            class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this request?');"><i
                                                    class="icon-trash-o"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12" style="text-align: center;">
                        <h3 class="alert alert-success">There Are No Request For All Properties</h3>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
