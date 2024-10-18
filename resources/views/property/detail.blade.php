@extends('layouts.app')

@section('title')
    Property Detail
@endsection

@section('content')
    {{-- Cover Image --}}
    <div class="site-blocks-cover inner-page-cover overlay"
        style="background-image: url({{ asset('assets/images/' . $props->image . '') }});" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
                    <h1 class="mb-2">{{ $props->title }}</h1>
                    <p class="mb-5"><strong class="h2 text-success font-weight-bold">{{ currency($props->price) }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- Cover Image End --}}

    {{-- Detail Property --}}
    <div class="site-section site-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div>
                        <div class="slide-one-item home-slider owl-carousel">
                            @foreach ($images as $image)
                                <div>
                                    <img src="{{ asset('assets/gallery/' . $image->image . '') }}" alt="Image"
                                        class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white property-body border-bottom border-left border-right">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <strong class="text-success h1 mb-3">{{ currency($props->price) }}</strong>
                            </div>
                            <div class="col-md-6">
                                <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                                    <li>
                                        <span class="property-specs">Beds</span>
                                        <span class="property-specs-number">{{ $props->beds }}</span>

                                    </li>
                                    <li>
                                        <span class="property-specs">Baths</span>
                                        <span class="property-specs-number">{{ $props->bath }}</span>

                                    </li>
                                    <li>
                                        <span class="property-specs">SQ FT</span>
                                        <span class="property-specs-number">{{ number($props->area_sqft) }}</span>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                                <strong class="d-block">{{ $props->home_type }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                                <strong class="d-block">{{ $props->year_built }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                                <strong class="d-block">{{ currency($props->price_sqft) }}</strong>
                            </div>
                        </div>
                        <h2 class="h4 text-black">More Info</h2>
                        <p>{{ $props->more_info }}</p>

                        <div class="row no-gutters mt-5">
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3">Gallery</h2>
                            </div>
                            @foreach ($images as $image)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-1">
                                    <a href="{{ asset('assets/gallery/' . $image->image . '') }}"
                                        class="image-popup gal-item"><img
                                            src="{{ asset('assets/gallery/' . $image->image . '') }}" alt="Image"
                                            class="img-fluid" style="width: 300px; height: 100px;"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="bg-white widget border rounded">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('success') }}
                            </div>
                        @endif
                        <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
                        @if (isset(Auth::user()->id))
                            @if ($validatedForm > 0)
                                <p class="alert alert-info">You Already Sent a Request to This Property</p>
                            @else
                                <form action="{{ route('insert.request', $props->id) }}" class="form-contact-agent"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="property_id" id="property_id" class="form-control"
                                            value="{{ $props->id }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="agent_name" id="agent_name" class="form-control"
                                            value="{{ $props->agent_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        @error('name')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                        @error('email')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control">
                                        @error('phone')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" id="phone" class="btn btn-primary"
                                            value="Send Request">
                                    </div>
                                </form>
                            @endif
                        @else
                            <p class="alert alert-info">Login to Sent a Request</p>
                        @endif

                    </div>

                    <div class="bg-white widget border rounded">
                        @if (session()->has('favorite'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('favorite') }}
                            </div>
                        @endif
                        <h3 class="h4 text-black widget-title mb-3">Save This Property</h3>
                        @if (isset(Auth::user()->id))
                            @if ($validatedFavorite > 0)
                                <input type="submit" id="phone" class="btn btn-primary mr-2" disabled
                                    value="Already Saved to Favorite">
                            @else
                                <form action="{{ route('favorite.property', $props->id) }}" class="form-contact-agent"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="property_id" id="property_id" class="form-control"
                                            value="{{ $props->id }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="title" id="title" class="form-control"
                                            value="{{ $props->title }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="image" id="image" class="form-control"
                                            value="{{ $props->image }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="location" id="location" class="form-control"
                                            value="{{ $props->location }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="price" id="price" class="form-control"
                                            value="{{ $props->price }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" id="phone" class="btn btn-primary"
                                            value="Add Favorite">
                                    </div>
                                </form>
                            @endif
                        @else
                            <p class="alert alert-info">Login to Add Favorite</p>
                        @endif

                    </div>

                    <div class="bg-white widget border rounded">
                        <h3 class="h4 text-black widget-title mb-3 ml-0">Share</h3>
                        <div class="px-3" style="margin-left: -15px;">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('property.detail', $props->id) }}&quote={{ $props->title }}"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                            <a href="https://twitter.com/intent/tweet?text={{ $props->title }}&url={{ route('property.detail', $props->id) }}"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('property.detail', $props->id) }}"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- Detail Property End --}}

    {{-- Related Property --}}
    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>Related Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($relatedProps->count() > 0)
                    @foreach ($relatedProps as $related)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('property.detail', $related->id) }}" class="property-thumbnail">
                                    <div class="offer-type-wrap">
                                        @if ($related->type == 'Rent')
                                            <span class="offer-type bg-success">{{ $related->type }}</span>
                                        @elseif ($related->type == 'Rent')
                                            <span class="offer-type bg-danger">{{ $related->type }}</span>
                                        @else
                                            <span class="offer-type bg-info">{{ $related->type }}</span>
                                        @endif
                                    </div>
                                    <img src="{{ asset('assets/images/' . $related->image . '') }}" alt="Image"
                                        class="img-fluid">
                                </a>
                                <div class="p-4 property-body">
                                    <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                                    <h2 class="property-title"><a
                                            href="{{ route('property.detail', $related->id) }}">{{ $related->title }}</a>
                                    </h2>
                                    <span class="property-location d-block mb-3"><span
                                            class="property-icon icon-room"></span>
                                        {{ $related->location }}</span>
                                    <strong
                                        class="property-price text-primary mb-3 d-block text-success">{{ currency($related->price) }}</strong>
                                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                                        <li>
                                            <span class="property-specs">Beds</span>
                                            <span class="property-specs-number">{{ $related->beds }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">Baths</span>
                                            <span class="property-specs-number">{{ $related->bath }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">SQ FT</span>
                                            <span class="property-specs-number">{{ number($related->area_sqft) }}</span>

                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12" style="text-align: center;">
                        <h3 class="alert alert-success">There Are No Related Properties Now</h3>
                    </div>
                @endif

            </div>
        </div>
    </div>
    {{-- Related Property End --}}
@endsection
