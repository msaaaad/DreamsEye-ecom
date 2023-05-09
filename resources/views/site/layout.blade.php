<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name="facebook-domain-verification" content="c8e5luff89pgs415rhsiq9lha37hhg" />

    <meta property="og:image" />
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:300,400,500,600,700|Merriweather:300,400,300i,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="icon" href="{{asset('img/ficon.jpg')}}" type="image/x-icon" />

	

	<!-- Document Title
	============================================= -->
	<title>DreamsEye</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link rel="stylesheet" href="{{asset('site/main.css')}}">
	<link rel="stylesheet" href="{{asset('site/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('site/colors.php?color=000000')}}">
	<link rel="stylesheet" href="{{asset('site/coworking.css')}}">

</head>

<body class="stretched">
	<div id="contentFront">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		

		
		<!-- Top Bar
		============================================= -->
		<div id="top-bar" class="dark" style="background-color: #a3a5a7;">
			<div class="container">

				<div class="row justify-content-between align-items-center">

					<div class="col-12 col-lg-auto">
						<p class="mb-0 d-flex justify-content-center justify-content-lg-start py-3 py-lg-0"><strong>Free Bd Shipping on Order above TK5000. Easy Returns.</strong></p>
					</div>

					<div class="col-12 col-lg-auto d-none d-lg-flex">

						<!-- Top Links
						============================================= -->
						<div class="top-links routerLink">
							<ul class="top-links-container">
								<li class="top-links-item"><router-link to="/about">About</router-link></li>
								<li class="top-links-item"><router-link to="/contact">FAQS</router-link></li>
								<li class="top-links-item"><a href="#">EN</a>
									<ul class="top-links-sub-menu">
										<li class="top-links-item"><a href="#"><img src="{{asset('images/icons/flags/french.png')}}" alt="French"> FR</a></li>
										<li class="top-links-item"><a href="#"><img src="{{asset('images/icons/flags/italian.png')}}" alt="Italian"> IT</a></li>
										<li class="top-links-item"><a href="#"><img src="{{asset('images/icons/flags/german.png')}}" alt="German"> DE</a></li>
									</ul>
								</li>
							</ul>
						</div><!-- .top-links end -->

						<!-- Top Social
						============================================= -->
						<ul id="top-social">
							<li><a href="{{$about->facebook_page}}" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
							<li><a href="{{$about->instagram}}" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
							<li><a href="tel:+88{{$contact->phone_number_1}}" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">{{$contact->phone_number_1}}</span></a></li>
							<li><a href="mailto:{{$contact->email_address}}" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">{{$contact->email_address}}</span></a></li>
						</ul><!-- #top-social end -->

					</div>
				</div>

			</div>
		</div>

		<!-- Header
		============================================= -->
		<header id="header" class="full-header header-size-md">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">

						<!-- Logo
						============================================= -->
						<div id="logo" class="mr-lg-4">
							<router-link to="/" class="standard-logo"><img src="{{ asset('uploads/logo/'.$logo->logo_image) }}" alt="Canvas Logo"></router-link>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							@if(Session::get('customerId'))
                <!-- <a href="#" onclick="document.getElementById('customerLogoutForm').submit();"><i class="fa fa-user"></i>Logout</a> -->
                <a href="#" onclick="document.getElementById('customerLogoutForm').submit();" data-lightbox="inline" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i><span class=" d-sm-inline-block font-primary font-weight-medium" style="color: #1ABC9C;">Log Out</span></a>
                <form action="{{route('customer-logout')}}" method="POST" id="customerLogoutForm">
                    @csrf


                </form>
            @else
		<router-link to="/login-front" data-lightbox="inline" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary font-weight-medium" style="color: #1ABC9C;">Login</span></router-link>
            @endif
							<!-- Top Search
							============================================= 
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
							</div> #top-search end -->
							<search></search>

							<cart></cart>


						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>
						<!-- <form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form> -->
						<search-form></search-form>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows mr-lg-auto">

							<ul class="menu-container">
								<li class="menu-item current"><router-link class="menu-link" to="/"><div style="font-weight: 600;color: #1ABC9C;">Home</div></router-link></li>

								<category></category>

								<li class="menu-item"><a class="menu-link" href="#"><div style="font-weight: 600;color: #1ABC9C;">Others</div></a></li>
								<li class="menu-item"><router-link class="menu-link" to="/about"><div style="font-weight: 600;color: #1ABC9C;">About Us</div></router-link></li>
								<li class="menu-item"><router-link class="menu-link" to="/contact"><div style="font-weight: 600;color: #1ABC9C;">Contact</div></router-link></li>
								<li class="menu-item"><router-link class="menu-link" to="/team"><div style="font-weight: 600;color: #1ABC9C;">Our Team</div></router-link></li>

            				@if(Session::get('customerId'))
								<li class="menu-item">
								<router-link class="menu-link" to="/account"><div style="font-weight: 600;color: #1ABC9C;">My Account</div></router-link>	
								</li>
							@endif
							</ul>

						</nav><!-- #primary-menu end -->


					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->

		<router-view></router-view>



		<!-- Footer
		============================================= -->
		<footer id="footer" class="bg-transparent border-0">

			<div class="container clearfix">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap pb-3 border-bottom clearfix">

					<div class="row">

						<div class="col-lg-2 col-md-3 col-6">
							<div class="widget clearfix">

								<h4 class="ls0 mb-3 nott" style="color: #1ABC9C;">Features</h4>

								<ul class="list-unstyled iconlist ml-0">
									<li><a href="#">Help Center</a></li>
									<li><a href="#">Paid with Moblie</a></li>
									<li><a href="#">Status</a></li>
									<li><a href="#">Contact Support</a></li>
								</ul>

							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-6">
							<div class="widget clearfix">

								<h4 class="ls0 mb-3 nott" style="color: #1ABC9C;">Support</h4>

								<ul class="list-unstyled iconlist ml-0">
									<li><router-link to="/">Home</router-link></li>
									<li><router-link to="/about">About</router-link></li>
									<li><router-link to="/contact">FAQs</router-link></li>
									<li><router-link to="/contact">Contact</router-link></li>
								</ul>

							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-6">
							<div class="widget clearfix">

								<h4 class="ls0 mb-3 nott" style="color: #1ABC9C;">Trending</h4>

								<ul class="list-unstyled iconlist ml-0">
									<li><router-link to="/">Shop</router-link></li>
									<li><router-link to="/team">Portfolio</router-link></li>
									<li><router-link to="#">Blog</router-link></li>
									<li><router-link to="#">Events</router-link></li>
								</ul>

							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-6">
							<div class="widget clearfix">

								<h4 class="ls0 mb-3 nott" style="color: #1ABC9C;">Get to Know us</h4>

								<ul class="list-unstyled iconlist ml-0">
									<li><router-link to="/contact">Contact</router-link></li>
									<li><router-link to="/team">Team</router-link></li>
									<li><router-link to="#">eCommerce</router-link></li>
									<li><router-link to="/about">About</router-link></li>
								</ul>

							</div>
						</div>
						<div class="col-lg-4 col-md-8">
							<div class="widget clearfix">

								<h4 class="ls0 mb-3 nott" style="color: #1ABC9C;">Subscribe Now</h4>
								<div class="widget subscribe-widget mt-2 clearfix">
									<p class="mb-4"><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</p>
									<div class="widget-subscribe-form-result"></div>
									<form id="widget-subscribe-form" action="include/subscribe.php" method="post" class="mt-1 mb-0 d-flex">
										<input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control sm-form-control required email" placeholder="Enter your Email Address">

										<button class="button nott font-weight-normal ml-1 my-0" type="submit">Subscribe Now</button>
									</form>
								</div>

							</div>
						</div>

					</div>

				</div><!-- .footer-widgets-wrap end -->

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights" class="bg-transparent">

				<div class="container clearfix">

					<div class="row justify-content-between align-items-center">
						<div class="col-md-6">
							Copyrights &copy; 2020 All Rights Reserved by <a style="color: #1ABC9C;" href="{{$about->facebook_page}}">Dreams Eye</a>.<br>
							<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
						</div>

						<div class="col-md-6 d-md-flex flex-md-column align-items-md-end mt-4 mt-md-0">
							<div class="copyrights-menu copyright-links clearfix">
								<router-link to="/about">About</router-link>/<router-link to="/team">Protfolio</router-link>/<router-link to="/contact">Contact</router-link>
							</div>

						</div>
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-line-arrow-up"></div>
	</div>


	<script src="{{asset('js/app2.js')}}"></script>
	<!-- <script src="{{asset('js/jquery.js')}}"></script> -->
	<script src="{{asset('js/plugins.min.js')}}"></script>
	<script src="{{asset('js/functions.js')}}"></script>
	<script src="{{asset('js/particles.js')}}"></script>
	<script src="{{asset('js/particles/app.js')}}"></script>


</body>
</html>
