@extends('WebSite.layouts.master')

@section('content')



<div class="page-wrapper rtl">
    <!-- Preloader -->
    <div class="preloader"></div>


	<!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/7.jpg);">
        <div class="auto-container">
            <h1>أطباء المشفى</h1>
				<ul class="bread-crumb clearfix">
				<li><a href="{{route('welcome')}}"><span class="fas fa-home"></span> الرئيسية </a></li>
				<li>الأطباء</li>
			</ul>
        </div>
    </section>
    <!--End Page Title-->

	<!-- Team Section -->
	<section class="team-section">
		<div class="auto-container">

			<!-- Sec Title -->
			<div class="sec-title centered">
				<h2>الأطباء</h2>
				<div class="separator"></div>
			</div>

			<div class="row clearfix">
			@foreach($doctors as $doctor)

				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
						
							     @if($doctor->image)
                                            <img src="{{asset('dashboard/img/doctors/'.$doctor->image->filename)}}"
                                                 height="50px" width="50px" alt="">

                                           @else
                                            <img src="{{asset('dashboard/img/doctor_default.png')}}" height="50px"
                                                 width="50px" alt="">
                                        @endif
							
						</div>
						<div class="lower-content">
							<h3><a href="#">{{$doctor->name}}</a></h3>
							<div class="designation">{{$doctor->section->name}}</div>
						</div>
					</div>
				</div>

	        @endforeach

			</div>

		</div>
	</section>
	<!-- End Team Section -->



</div>
<!--End pagewrapper-->

@endsection
