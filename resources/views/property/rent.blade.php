@extends('layouts.app')

@section('title')
    Rent Property
@endsection

@section('content')
    {{-- Carousel --}}
    <div class="slide-one-item home-slider owl-carousel">
        @if ($rent->count() > 0)
            @foreach ($rent as $prop)
                <div class="site-blocks-cover overlay"
                    style="background-image: url({{ asset('assets/images/' . $prop->image . '') }});" data-aos="fade"
                    data-stellar-background-ratio="0.5">
                    <div class="container">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                @if ($prop->type == 'Rent')
                                    <span
                                        class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">For
                                        {{ $prop->type }}</span>
                                @else
                                    <span
                                        class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">For
                                        {{ $prop->type }}</span>
                                @endif
                                <h1 class="mb-2">{{ $prop->title }}</h1>
                                <p class="mb-5"><strong
                                        class="h2 text-success font-weight-bold">{{ currency($prop->price) }}</strong>
                                </p>
                                <p><a href="{{ route('property.detail', $prop->id) }}"
                                        class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See
                                        Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="site-blocks-cover overlay"
                style="background-image: url({{ asset('assets/images/hero_bg_1.jpg') }});" data-aos="fade"
                data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center text-center">
                        <div class="col-md-10">
                            <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">For
                                Rent</span>
                            <h1 class="mb-2">Not Available Now</h1>
                            <p class="mb-5"><strong class="h2 text-success font-weight-bold">Please Comeback Soon</strong>
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- Carousel End --}}

    {{-- Search Input --}}
    <div class="site-section site-section-sm pb-0">
        <div class="container">
            <div class="row">
                <form action="{{ route('searches.property') }}" class="form-search col-md-12" style="margin-top: -100px;">
                    <div class="row  align-items-end">
                        <div class="col-md-3">
                            <label for="list-types">Listing Types</label>
                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select name="list_types" id="list-types" class="form-control d-block rounded-0">
                                    <option value="Condo">Condo</option>
                                    <option value="Land Property">Land Property</option>
                                    <option value="Commercial Building">Commercial Building</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="offer-types">Offer Type</label>
                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select name="offer_types" id="offer-types" class="form-control d-block rounded-0">
                                    <option value="Sale">For Buy</option>
                                    <option value="Rent">For Rent</option>
                                    <option value="Lease">For Lease</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="select-city">Select City</label>
                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select name="select_city" id="select-city" class="form-control d-block rounded-0">
                                    <option value="New York">New York</option>
                                    <option value="Brooklyn">Brooklyn</option>
                                    <option value="London">London</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Philippines">Philippines</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
                        <div class="mr-auto">
                            <a href="{{ route('home') }}" class="icon-view view-module active"><span
                                    class="icon-view_module"></span></a>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <div>
                                <a href="{{ route('home') }}" class="view-list px-3 border-right">All</a>
                                <a href="{{ route('buy.property') }}" class="view-list px-3 border-right">Buy</a>
                                <a href="{{ route('rent.property') }}" class="view-list px-3 border-right active">Rent</a>
                                <a href="{{ route('price.property.desc') }}" class="view-list px-3 border-right">Price
                                    <span class="icon-arrow_upward"></span></a>
                                <a href="{{ route('price.property.asc') }}" class="view-list px-3 border-right">Price
                                    <span class="icon-arrow_downward"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- Search Input End --}}

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>rent Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($rent->count() > 0)
                    @foreach ($rent as $rent)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('property.detail', $rent->id) }}" class="property-thumbnail">
                                    <div class="offer-type-wrap">
                                        @if ($rent->type == 'Rent')
                                            <span class="offer-type bg-success">{{ $rent->type }}</span>
                                        @else
                                            <span class="offer-type bg-danger">{{ $rent->type }}</span>
                                        @endif
                                    </div>
                                    <img src="{{ asset('assets/images/' . $rent->image . '') }}" alt="Image"
                                        class="img-fluid" style="width: 400px; height: 200px;">
                                </a>
                                <div class="p-4 property-body">
                                    <h2 class="property-title"><a
                                            href="{{ route('property.detail', $rent->id) }}">{{ $rent->title }}</a>
                                    </h2>
                                    <span class="property-location d-block mb-3"><span
                                            class="property-icon icon-room"></span>
                                        {{ $rent->location }}</span>
                                    <strong
                                        class="property-price text-primary mb-3 d-block text-success">{{ currency($rent->price) }}</strong>
                                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                                        <li>
                                            <span class="property-specs">Beds</span>
                                            <span class="property-specs-number">{{ $rent->beds }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">Baths</span>
                                            <span class="property-specs-number">{{ $rent->bath }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">SQ FT</span>
                                            <span class="property-specs-number">{{ number($rent->area_sqft) }}</span>

                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12" style="text-align: center;">
                        <h3 class="alert alert-success">There Are No rent Properties Now</h3>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
