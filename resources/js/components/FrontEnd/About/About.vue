<template>
	<div>
		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1 class="text-success">About</h1>
								
				<span class="text-secondary">Know More About Us</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
					<li class="breadcrumb-item active" aria-current="page">About</li>
				</ol>

						<div class="col-lg-4 col-md-4">
									<div class="d-flex justify-content-md-end">
										<a href="about.facebook_page" class="social-icon si-small si-facebook" title="Facebook Page">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>

										<a href="about.instagram" class="social-icon si-small si-instagram" title="instagram">
											<i class="icon-instagram"></i>
											<i class="icon-instagram"></i>
										</a>

										<a href="about.twitter" class="social-icon si-small si-twitter" title="twitter">
											<i class="icon-twitter"></i>
											<i class="icon-twitter"></i>
										</a>

										<a href="about.facebook_group" class="social-icon si-small si-facebook" title="Facebook Group">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>

										<a href="https://www.linkedin.com/in/dreamseye" class="social-icon si-small si-linkedin" title="Facebook Group">
											<i class="icon-linkedin"></i>
											<i class="icon-linkedin"></i>
										</a>

										<a href=" https://www.youtube.com/channel/UCqLG1ZJGrIxZcVEydiqQTQA
" class="social-icon si-small si-youtube" title="Facebook Group">
											<i class="icon-youtube"></i>
											<i class="icon-youtube"></i>
										</a>
									</div>
						</div>
			</div>

		</section><!-- #page-title end -->
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">

				<div class="container">
					<div class="row justify-content-between align-items-end">
						<div class="col-md-8">
							<h2 class="display-4 text-dark font-weight-semibold ls--2">A New Shopping Space where you Feel Like <span>Home</span>.</h2>
						</div>
					</div>

					<img src="images/hero.jpg" alt="Image" class="rounded-xl my-5">

					<div class="row topmargin bottommargin gutter-lg-50 align-items-center">
						<div class="col-lg-12 p-lg-5">
							<div  class="heading-block border-bottom-0 mb-0">
								<h2 class="nott font-weight-semibold mb-4 text-secondary" style="color: #1ABC9C;">Our Story</h2>
								<p v-if="about">{{about.about_us}}</p>
								<div class="row">
									<div class="col-6 col-sm-6 mb-4">
										<div class="counter color font-weight-semibold"><span data-from="1" data-to="3" data-refresh-interval="2" data-speed="600"></span>+</div>
										<h5 class="mt-0 font-weight-medium">Branches</h5>
									</div>

									<div class="col-6 col-sm-6 mb-4">
										<div class="counter color font-weight-semibold"><span data-from="1" data-to="37" data-refresh-interval="11" data-speed="900"></span>+</div>
										<h5 class="mt-0 font-weight-medium">Single Studios</h5>
									</div>

									<div class="col-6 col-sm-6 mb-4">
										<div class="counter color font-weight-semibold"><span data-from="1" data-to="21" data-refresh-interval="3" data-speed="1000"></span>+</div>
										<h5 class="mt-0 font-weight-medium">Events per Month</h5>
									</div>

									<div class="col-6 col-sm-6 mb-4">
										<div class="counter color font-weight-semibold"><span data-from="100" data-to="4500" data-refresh-interval="100" data-speed="1500"></span>+</div>
										<h5 class="mt-0 font-weight-medium">Active Members</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div>

					<div class="row justify-content-center topmargin-sm">
						<div class="col-md-5 offset-md-1">
							<h3 class="text-dark"><i class="icon-line-circle-check color mr-1 position-relative" style="top: 2px;color: #1ABC9C;"></i> Why do you choose DreamsEye?</h3>
							<p v-if="about">{{about.choice_us}}</p>
						</div>
						<div class="col-md-5 pl-md-5">
							<h3 class="text-dark"><i class="icon-line-circle-check color mr-1 position-relative" style="top: 2px;color: #1ABC9C;"></i> Our Address</h3>
							<p v-if="about">{{about.address}}</p>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				<div class="section p-0 testimonials clearfix">
					<div class="container" style="padding: 120px 0">
						<div class="heading-block border-bottom-0 center">
							<div class="before-heading">What our Members Say</div>
							<h2 class="nott font-weight-semibold">Testimonials</h2>
							<p class="mb-0 mt-1"><span class="font-weight-semibold">Excellent, 9.6</span> out of 10 based on <span class="font-weight-semibold">2,118</span> reviews. </p>
						</div>

						<div id="testimonials-carousel" class="owl-carousel carousel-widget testimonial testimonial-full bg-transparent border-0 shadow-none p-0 mx-auto text-left clearfix" data-animate-in="fadeIn" data-animate-out="fadeOut" data-margin="24" data-nav="false" data-pagi="true" data-items="1" style="max-width: 740px">
							<div class="slide">
								<div class="testi-content">
									<div class="testi-stars mb-4">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
									</div>
									<p>Collaboratively enhance intermandated innovation via cutting-edge core competencies. Professionally extend covalent e-markets and mission-critical communities. Dramatically communicate revolutionary web services for interactive synergy. Synergistically.</p>
									<div class="testi-meta mt-4">
										Steve Jobs
										<span class="ls0">Apple Inc.</span>
									</div>
								</div>
							</div>
							<div class="slide">
								<div class="testi-content">
									<div class="testi-stars mb-4">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half2"></i>
									</div>
									<p>Intrinsicly synergize excellent content whereas user friendly action items. Rapidiously transition multimedia based information after top-line alignments. Authoritatively integrate accurate outsourcing vis-a-vis principle-centered systems energistically</p>
									<div class="testi-meta mt-4">
										Collis Ta'eed
										<span class="ls0">Envato Inc.</span>
									</div>
								</div>
							</div>
							<div class="slide">
								<div class="testi-content">
									<div class="testi-stars mb-4">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
									</div>
									<p>Compellingly engage multimedia based niche markets via value-added manufactured products. Competently formulate goal-oriented content for installed base users. Uniquely leverage other's granular ROI without 24/365 collaboration and idea-sharing.</p>
									<div class="testi-meta mt-4">
										John Doe
										<span class="ls0">XYZ Inc.</span>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

						<div class="heading-block center border-bottom-0">
							<h2 class="ls2 font-weight-bold">Your Priority is our Priority</h2>
							<span>Competently benchmark backward-compatible technologies vis-a-vis<br>parallel convergence. Rapidiously innovate stand-alone.</span>
						</div>

				<div class="section mb-0 pb-0 bg-theme-light clearfix" style="padding-top: 120px;">
					<div class="container">
						<div class="row">
							<div class="col-md-8 offset-1">
								<div class="before-heading">Don't Hesitate to Reach out to Us</div>
								<h2 class="nott font-weight-semibold display-4">Want to Talk?</h2>
								<h4 class="font-weight-light mb-4">Call us at :<br>
									<a href="tel:+88 contact.phone_number_1">+88 {{contact.phone_number_1}}</a>
									<br>
									<a href="tel:+88 contact.phone_number_2">+88 {{contact.phone_number_2}}</a>
									<br>
									<a href="tel:+88 contact.phone_number_3">+88 {{contact.phone_number_3}}</a></h4>
								<router-link to="/contact" class="button button-rounded button-xlarge m-0 nott font-weight-semibold ls0 px-5">Contact Us</router-link>
							</div>
						</div>
					</div>
					<img src="images/footer-bg.jpg" alt="Footer Image" class="footer-img">
				</div>

			</div>
		</section><!-- #content end -->
	</div>
</template>
<script>
export default{
	name:"about",
		mounted(){
			this.$store.dispatch('getFrontAbouts');
			this.$store.dispatch('getFrontContacts');
		},
		computed:{
			about(){
				return this.$store.getters.about;
			},
			contact(){
				return this.$store.getters.contact;
			},
		},
}
</script>