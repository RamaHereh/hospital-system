@extends('WebSite.layouts.master')

@section('content')



<div class="page-wrapper rtl">
    <!-- Preloader -->
    <div class="preloader"></div>


	<!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/7.jpg);">
        <div class="auto-container">
            <h1>أقسام المشفى</h1>
			
			<ul class="bread-crumb clearfix">
				<li><a href="{{route('welcome')}}"><span class="fas fa-home"></span> الرئيسية </a></li>
				<li>الأقسام</li>
			</ul>
        </div>
    </section>
    <!--End Page Title-->

	<!-- Services Section Two -->
	<section class="services-section-two style-two">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<h2>الأقسام</h2>
				<div class="separator"></div>
			</div>
			<div class="row clearfix">


			
@foreach($sections as $section)
				<div class="service-block-three col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="border-one"></div>
						<div class="border-two"></div>
						<div class="icon-box">
							<span class="icon flaticon-stethoscope"></span>
						</div>
						<h3><a href="#">{{$section->name}}</a></h3>
						<div class="text">We provide best service for our cline. Now place take it. Cum consectetur sit ullam perspiciatis, deserunt.</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</section>
	<!-- End Services Section Two -->



</div>
<!--End pagewrapper-->

@endsection
