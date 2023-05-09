<template>
	
	<div class="">
		<!-- Slider
		============================================= -->
		<section style="height: 600px;">
			<div class="particles-js" id="particles-js" :style="{ 'background-image': 'url(' + fileLink(Models.model_image) + ')' }"></div>

		</section>
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<!-- Featured Carousel
					============================================= -->
					<div class="fancy-title title-border mt-4 title-center">
						<h4>Shop By Category</h4>
					</div>
					<carousel v-if="Categories.length" :nav="false" :items= "5" :margin="5" :loop="true" :autoplay="true" :mouseDrag="true" :touchDrag="true" :responsive="{0:{items:2,nav:false},600:{items:4,nav:false}}">

   						<div v-for="category in Categories" class="oc-item">
							<div class="product">
								<div class="product-image" style="height:150px">
									<router-link :to="`/view-category-product/${category.id}/${category.slug}`"><img style="height:100%" :src="fileLinkCategory(category.category_image)" alt="category.category_name"></router-link>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end">
											<router-link :to="`/view-category-product/${category.slug}/${category.id}`" class="btn btn-dark">{{category.category_name}}</router-link>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
							</div>
						</div>

					</carousel>

					<br>
					<br>

					<!-- Featured Carousel
					============================================= -->
					<div class="fancy-title title-border mt-4 title-center">
						<h4>Weekly Featured Items</h4>
					</div>

					<carousel v-if="BoostProducts.length" :nav="false" :items= "5" :margin="5" :loop="true" :autoplay="true" :mouseDrag="true" :touchDrag="true" :responsive="{0:{items:2,nav:false},600:{items:5,nav:false}}">

   						<div class="oc-item" v-for="boost in BoostProducts">
							<div class="product">
								<div class="product-image">
									<a href="#"><img style="width:200px;height:100%;" :src="boostFileLink(boost.product_image[0])" alt="DreamsEye"></a>
									<a href="#"><img style="width:200px;height:100%;" :src="boostFileLink(boost.product_image[1])" alt="DreamsEye"></a>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><router-link :to="`/view-boost-product/${boost.slug}/${boost.id}`">{{boost.product_name}}</router-link></h3></div>
									<div  v-if="boost.product_price_discount!=null" class="product-price font-primary"><del class="mr-1">TK.{{boost.product_price_regular}}</del> <ins>TK.{{boost.product_price_discount}}</ins></div>
									<div v-if="boost.product_price_discount==null" class="product-price font-primary"><ins>TK.{{boost.product_price_regular}}</ins></div>
									<!-- <div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div> -->
								</div>

							</div>
						</div>

					</carousel>

				</div>

				<!-- New Arrival Section
				============================================= -->
				<div class="section my-4">
					<div class="container">
						<div class="row align-items-stretch">
							<div class="col-md-5">
								<div class="row">
									<div class="col-md-12 center p-5">
										<div class="heading-block mb-1 border-bottom-0 mx-auto">
											<div class="font-secondary text-black-50 mb-1">New Arrivals</div>
											<h3 class="nott ls0">Fresh Arrivals / This Weekend</h3>
											<p class="font-weight-normal mt-2 mb-3 text-muted" style="font-size: 17px; line-height: 1.4">New Products Uploaded By DreamsEye</p>
											<router-link to="/" class="button bg-dark text-white button-dark button-small ml-0">Shop Now</router-link>
										</div>
									</div>
									<div v-for="MiddleModel in MiddleModels" class="col-6">
										<a :href="fileLink(MiddleModel.model_image)" data-lightbox="image"><img style="height:300px;width:100%" :src="fileLink(MiddleModel.model_image)" alt="Image"></a>
									</div>
								</div>
							</div>
							<div class="col-md-7 min-vh-50">
								<a href="https://www.youtube.com/watch?v=1IGnAWMMC7Q" data-lightbox="iframe" class="d-block position-relative h-100" style="background: url('images/sections/1.jpg') center center no-repeat; background-size: cover;">
									<div class="vertical-middle text-center">
										<div class="play-icon"><i class="icon-play-sign display-3 text-light"></i></div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="clear"></div>

				<!-- New Arrivals Men
				============================================= -->
				<div class="container clearfix">

					<div class="fancy-title title-border topmargin-sm mb-4 title-center">
						<h4>New Arrivals</h4>
					</div>

					<div class="row grid-6">
						<div class="col-lg-2 col-md-3 col-6 px-2" v-for="product in frontProducts.data">
							<div class="product">
								<div class="product-image">
									<a href="#"><img style="width:200px;height:100%;" :src="productFileLink(product.product_image[0])" alt="DreamsEye">
									<div v-if="product.product_quantity==0" class="sale-flash badge badge-danger p-2">Out of Stock</div></a>
									<a href="#"><img style="width:200px;height:100%;" :src="productFileLink(product.product_image[1])" alt="DreamsEye">
									<div v-if="product.product_quantity==0" class="sale-flash badge badge-danger p-2">Out of Stock</div></a>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><router-link :to="`/view-product/${product.slug}/${product.id}`">{{product.product_name}}</router-link></h3></div>
									<div  v-if="product.product_price_discount!=null" class="product-price font-primary"><del class="mr-1">TK.{{product.product_price_regular}}</del> <ins>TK.{{product.product_price_discount}}</ins></div>
									<div v-if="product.product_price_discount==null" class="product-price font-primary"><ins>TK.{{product.product_price_regular}}</ins></div>
									<!-- <div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div> -->
								</div>
							</div>
						</div>

					</div>

                        <pagination size="small" :data="frontProducts" align="center" @pagination-change-page="getResults">
							<span slot="prev-nav">&lt; Previous</span>
							<span slot="next-nav">Next &gt;</span>
						</pagination>

				</div>

				<!-- Sign Up
				============================================= -->
				<div class="section my-4 py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="row align-items-stretch align-items-center">
									<div class="col-md-7 min-vh-50 banner" :style="{ 'background-image': 'url(' + fileLink(Models.model_image) + ')' }">
										<!-- style="background: url('images/sections/3.jpg') center center no-repeat; " -->
										<div class="vertical-middle pl-5">
											<h2 class="pl-5" style="color: #ecf0f1;"><strong>Fashion</strong> Is<br>Freedom*</h2>
										</div>
									</div>
									<div class="col-md-5 bg-white">
										<div class="card border-0 py-2">
											<div class="card-body">
												<h3 class="card-title mb-4 ls0">Sign up to get the most out of shopping.</h3>
												<ul class="iconlist ml-3">
													<li><i class="icon-circle-blank text-black-50"></i> Receive Exclusive Sale Alerts</li>
													<li><i class="icon-circle-blank text-black-50"></i> 4 Days Return Policy</li>
													<li><i class="icon-circle-blank text-black-50"></i> Cash on Delivery Accepted</li>
												</ul>
												<router-link to="/register" class="button button-rounded ls0 font-weight-semibold ml-0 mb-2 nott px-4">Sign Up</router-link><br>
												<small class="font-italic text-black-50">Don't worry, it's totally free.</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="container">

					<!-- Features
					============================================= -->
					<div class="row col-mb-50 mb-0 mt-5">
						<div class="col-lg-7">
							<div class="row mt-3">
								<div class="col-sm-6">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-present text-dark text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">100% Original</h3>
											<p>We Provide 100% Authentic Products.</p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 mt-4 mt-sm-0">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-globe text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">Free Shipping</h3>
											<p>Get Free Shipping On Certain Products.</p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 mt-4">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-reload text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">04-Days Exchanges</h3>
											<p>4 Days easy exchange available. <small style="color:red">(Conditions Appliable)*</small> </p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 mt-4">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-wallet text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">Payment Options</h3>
											<p>We Accept Bkash, Rocket, Nagad, Visa, MasterCard. And We also Deliver by COD(only in Bangladesh)</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-5">
							<div class="accordion clearfix">

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										Our Products
									</div>
								</div>

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										Free Shipping
									</div>
								</div>

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										Our Exchange Policy
									</div>
								</div>

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										Payment Methods
									</div>
								</div>

							</div>
						</div>

					</div>

					<div class="clear"></div>

				</div>

				<div class="clear"></div>

				<!-- App Buttons
				============================================= -->
				<div class="section pb-0 mb-0" style="background-color: #f8f5f0">
					<div class="container">
						<div class="row">
							<div class="col-md-6 offset-1 bottommargin-lg d-flex flex-column align-self-center">
								<h3 class="card-title font-weight-normal ls0">Follow. Find. Favorite.<br>Discover Fashion on the Go.</h3>
								<span>Proactively enable Corporate Benefits.</span>
								<div class="mt-3">
									<button href="#" @click="Download()" class="button inline-block button-small button-rounded button-desc font-weight-normal ls1 clearfix"><i class="icon-apple"></i><div><span>Download Dreams Eye Shop</span>App Store</div></button>
									<button href="#" @click="Download()" class="button inline-block button-small button-rounded button-desc button-light text-dark font-weight-normal ls1 bg-white border clearfix"><i class="icon-googleplay"></i><div><span>Download Dreams Eye Shop</span>Google Play</div></button>
								</div>
							</div>
							<div class="col-md-4 d-none d-md-flex align-items-end">
								<img :src="fileLink(Models.model_image)" alt="Image" class="mb-0">
							</div>
						</div>
					</div>
				</div>

				<!-- Last Section
				============================================= -->
				<div class="section footer-stick bg-white m-0 py-3 border-bottom">
					<div class="container clearfix">

						<div class="row clearfix">
							<div class="col-lg-4 col-md-6">
								<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-globe-alt"></i><h5 class="inline-block mb-0 ml-2 font-weight-semibold"><a href="#">Free Shipping</a><span class="font-weight-normal text-muted"> &amp; Easy Exchange</span></h5></div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-notebook"></i><h5 class="inline-block mb-0 ml-2"><a href="#">Geniune Products</a><span class="font-weight-normal text-muted"> Guaranteed</span></h5></div>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-lock"></i><h5 class="inline-block mb-0 ml-2"><a href="#">256-Bit</a> <span class="font-weight-normal text-muted">Secured Checkouts</span></h5></div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section><!-- #content end -->

	</div>


</template>
<style>
	.opacity{
		opacity: .5;
	}
	#particles-js{
		width: 100%;
		height: 100%;
		background-position: center 20%;
	}
	.particles-js{
		background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
	}
	.banner{
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center center;
	}
	.owl-carousel .owl-dots{
		display: none;
	}
	.product-price ins{
		font-size: 14px;
	}

</style>
<script>

import carousel from 'vue-owl-carousel'
export default{
	name:"Home",
    components: { carousel },

		data:function(){
			return{
				categoryIds : [],
				frontProducts:{},
			}
		},
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getModels');
			this.$store.dispatch('getMiddleModels');
			this.$store.dispatch('getActiveCategories');
			this.$store.dispatch('getBoostProducts');
			this.$store.dispatch('getProducts');
			this.getResults();
		},
		computed:{
			Models(){
				return this.$store.getters.models;
			},
			MiddleModels(){
				return this.$store.getters.middleModels;
			},
			Categories(){
				return this.$store.getters.categories;
			},
			BoostProducts(){
				return this.$store.getters.boosts;
			},
			Products(){
				return this.$store.getters.products;
			},
		},

	methods:{
			getResults(page = 1) {
			axios.get('front-product?page=' + page)
				.then(response => {
					this.frontProducts = response.data.products;
				});
		},
			BoostDiscount(status){
				let data = {
					0:true
				}
				return data[status];
			},
			StockOut(status){
				let data = {
					0:true
				}
				return data[status];
			},

			fileLink:function(name){
				return 'dreamsEye/public/uploads/models/'+name;
			},
			fileLinkCategory:function(name){
				return 'dreamsEye/public/uploads/category/'+name;
			},
			Download:function(){
				toastr.success('We are working on it','Sorry!');
			},
			boostFileLink:function(name){
				return 'dreamsEye/public/uploads/products/'+name;
			},
			productFileLink:function(name){
				return 'dreamsEye/public/uploads/products/'+name;
			},
	}
}
</script>