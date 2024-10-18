@extends('layouts.app')

@section('title')
    favorite Property
@endsection

@push('style')
    <style>
        .property-thumbnail {
            position: relative;
        }

        .btn-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .btn-overlay:hover {
            background-color: rgba(255, 0, 0, 1);
        }
    </style>
@endpush

@section('content')
    {{-- Carousel --}}
    <div class="slide-one-item home-slider owl-carousel">
        <div class="site-blocks-cover inner-page-cover overlay"
            style="background-image: url({{ asset('assets/images/hero_bg_3.jpg') }});" data-aos="fade"
            data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <h1 class="mb-2">Favorite Properties</h1>
                    </div>
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
                        <h2>Favorite Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($allFavorites->count() > 0)
                    @foreach ($allFavorites as $favorite)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('property.detail', $favorite->property_id) }}" class="property-thumbnail">
                                    <img src="{{ asset('assets/images/' . $favorite->image) }}" alt="Image"
                                        class="img-fluid">
                                    <form action="{{ route('delete.favorite', $favorite->id) }}" method="post"
                                        class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-overlay"
                                            onclick="return confirm('Are you sure you want to delete this property?');"><i
                                                class="icon-trash-o"></i></button>
                                    </form>
                                </a>
                                <div class="p-4 property-body">
                                    <h2 class="property-title">
                                        <a
                                            href="{{ route('property.detail', $favorite->property_id) }}">{{ $favorite->title }}</a>
                                    </h2>
                                    <span class="property-location d-block mb-3">
                                        <span class="property-icon icon-room"></span> {{ $favorite->location }}
                                    </span>
                                    <strong
                                        class="property-price text-primary mb-3 d-block text-success">{{ currency($favorite->price) }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12" style="text-align: center;">
                        <h3 class="alert alert-success">There Are No Favorite Properties</h3>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
