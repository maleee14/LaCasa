@extends('layouts.app')

@section('title')
    Buy Property
@endsection

@section('content')
    {{-- Carousel --}}
    <div class="slide-one-item home-slider owl-carousel">
        @if ($propertyHomeType->count() > 0)
            @foreach ($propertyHomeType as $prop)
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
                            <span
                                class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">{{ $hometype }}
                                Properties</span>
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

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>{{ $hometype }} Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($propertyHomeType->count() > 0)
                    @foreach ($propertyHomeType as $buy)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('property.detail', $buy->id) }}" class="property-thumbnail">
                                    <div class="offer-type-wrap">
                                        @if ($buy->type == 'Rent')
                                            <span class="offer-type bg-success">{{ $buy->type }}</span>
                                        @elseif($buy->type == 'Sale')
                                            <span class="offer-type bg-danger">{{ $buy->type }}</span>
                                        @else
                                            <span class="offer-type bg-info">{{ $buy->type }}</span>
                                        @endif
                                    </div>
                                    <img src="{{ asset('assets/images/' . $buy->image . '') }}" alt="Image"
                                        class="img-fluid" style="width: 400px; height: 200px;">
                                </a>
                                <div class="p-4 property-body">
                                    <h2 class="property-title"><a
                                            href="{{ route('property.detail', $buy->id) }}">{{ $buy->title }}</a>
                                    </h2>
                                    <span class="property-location d-block mb-3"><span
                                            class="property-icon icon-room"></span>
                                        {{ $buy->location }}</span>
                                    <strong
                                        class="property-price text-primary mb-3 d-block text-success">{{ currency($buy->price) }}</strong>
                                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                                        <li>
                                            <span class="property-specs">Beds</span>
                                            <span class="property-specs-number">{{ $buy->beds }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">Baths</span>
                                            <span class="property-specs-number">{{ $buy->bath }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">SQ FT</span>
                                            <span class="property-specs-number">{{ number($buy->area_sqft) }}</span>

                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12" style="text-align: center;">
                        <h3 class="alert alert-success">There Are No Properties For This Home Type</h3>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
