@extends('layouts.app')

@section('title')
    Search Property
@endsection

@section('content')
    {{-- Carousel --}}
    <div class="site-blocks-cover inner-page-cover overlay"
        style="background-image: url({{ asset('assets/images/hero_bg_1.jpg') }});" data-aos="fade"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-2">Searches Properties</h1>
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
                        <h2>Searches Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($searches->count() > 0)
                    @foreach ($searches as $search)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('property.detail', $search->id) }}" class="property-thumbnail">
                                    <div class="offer-type-wrap">
                                        @if ($search->type == 'Rent')
                                            <span class="offer-type bg-success">{{ $search->type }}</span>
                                        @elseif($search->type == 'Sale')
                                            <span class="offer-type bg-danger">{{ $search->type }}</span>
                                        @else
                                            <span class="offer-type bg-info">{{ $search->type }}</span>
                                        @endif
                                    </div>
                                    <img src="{{ asset('assets/images/' . $search->image . '') }}" alt="Image"
                                        class="img-fluid" style="width: 400px; height: 200px;">
                                </a>
                                <div class="p-4 property-body">
                                    <h2 class="property-title"><a
                                            href="{{ route('property.detail', $search->id) }}">{{ $search->title }}</a>
                                    </h2>
                                    <span class="property-location d-block mb-3"><span
                                            class="property-icon icon-room"></span>
                                        {{ $search->location }}</span>
                                    <strong
                                        class="property-price text-primary mb-3 d-block text-success">{{ currency($search->price) }}</strong>
                                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                                        <li>
                                            <span class="property-specs">Beds</span>
                                            <span class="property-specs-number">{{ $search->beds }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">Baths</span>
                                            <span class="property-specs-number">{{ $search->bath }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">SQ FT</span>
                                            <span class="property-specs-number">{{ number($search->area_sqft) }}</span>

                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12" style="text-align: center;">
                        <h3 class="alert alert-success">There Are No Properties For Your Search</h3>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
