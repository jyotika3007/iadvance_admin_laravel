﻿@extends('layouts.front.app')

@section('hello')

	<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Offers</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid mb-14">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="default-title mt-4">
							<h2>Offers</h2>
							<img src="{{ asset('front/images/line.svg') }}" alt="">
						</div>
					</div>
					<div class="col-lg-4">
						<a href="#" class="offers-item">
							<div class="offer-img">
								<img src="{{ asset('front/images/offers/img-1.jpg') }}" alt="">
							</div>
							<div class="offers-text">
								<h4>📢  Offer Title Here!</h4>
								<p>Up to 25% off on Vegetables & Fruits & much more</p>
							</div>
						</a>
					</div>
					<div class="col-lg-4">
						<a href="#" class="offers-item">
							<div class="offer-img">
								<img src="{{ asset('front/images/offers/img-2.jpg') }}" alt="">
							</div>
							<div class="offers-text">
								<h4>📢  Offer Title Here!</h4>
								<p>Up to 25% off on Grocery & Staples & much more</p>
							</div>
						</a>
					</div>
					<div class="col-lg-4">
						<a href="#" class="offers-item">
							<div class="offer-img">
								<img src="{{ asset('front/images/offers/img-3.jpg') }}" alt="">
							</div>
							<div class="offers-text">
								<h4>📢  Offer Title Here!</h4>
								<p>Up to 75% off on Personal Care & much more</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!-- Body End -->
	
	@endsection