<template>
	<div>
		<section id="page-title">

			<div class="container clearfix">
				<h1 style="color: #1ABC9C;">{{Product.product_name}}</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Shop</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{Product.product_name}}</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="single-product">
						<div class="product">
							<div class="row gutter-40">

								<div class="col-md-6">

									<div class="product-image" style="overflow: visible;">
										<div id="oc-images" data-lightbox="gallery" data-margin="0" data-items="1" data-pagi="false" data-autoplay="6000" data-loop="true">
											<div class="oc-item" v-for="photo in Product.product_image">
												<a :href="fileLink(photo)" title="photo" data-lightbox="gallery-item"><img :src="fileLink(photo)" alt="photo"></a>
											</div>
										</div>
									</div>

									

								</div>

								<div class="col-md-6 product-desc">

									<div class="d-flex align-items-center justify-content-between">

										<!-- Product Single - Price
										============================================= -->
										<div v-if="Product.product_price_discount!=null" class="product-price"><del>TK.{{Product.product_price_regular}}</del> <ins style="color: #1ABC9C;">TK.{{Product.product_price_discount}}</ins></div>
									<div v-if="Product.product_price_discount==null" class="product-price font-primary"><ins style="color: #1ABC9C;">TK.{{Product.product_price_regular}}</ins></div>

										<!-- Product Single - Rating
										============================================= -->
										<!--<div class="product-rating">
											<i class="icon-star3"></i>
											<i class="icon-star3"></i>
											<i class="icon-star3"></i>
											<i class="icon-star-half-full"></i>
											<i class="icon-star-empty"></i>
										</div> Product Single - Rating End -->

									</div>

									<div class="line"></div>

									<!-- Product Single - Quantity & Cart Button  v-if="customerLoggedIn"
									============================================= -->
										<div  v-if="Product.product_quantity!=0">
											<form @submit.prevent="AddToCart" class="cart mb-0 d-flex justify-content-between align-items-center">
												<div class="quantity clearfix">
													<!-- <input type="button" value="-" class="minus">
													<input type="number" ref="qty" step="1" min="1" v-model="form.product_quantity" value="1" default="1" title="Qty" class="qty" />
													<input type="button" value="+" class="plus"> -->
													<input type="hidden" :value="Product.id" name="product_id">
													<input class="color" type="text" v-model="form.product_color" placeholder="Color">
												</div>
												<button type="submit" style="color: #1ABC9C;" class="add-to-cart button m-0">Add to cart</button>
											</form>
										</div>

									<!-- <div v-if="login='null'">
										
												<router-link to="/login-front" style="color: #1ABC9C;" class="add-to-cart button m-0">Add to cart</router-link>
									</div> -->

									<div class="line"></div>

									<div data-readmore="true" data-readmore-size="180px" data-readmore-trigger-open="Read More <i class='icon-angle-down'></i>" data-readmore-trigger-close="false">

										<h3 style="color: #1ABC9C;">{{Product.product_name}}</h3>

										<!-- Product Single - Short Description
										============================================= -->
										<p>{{Product.short_description}}</p>

										<a href="#" class="btn btn-dark btn-sm read-more-trigger"></a>

									</div>
								<ul class="iconlist mb-0">
									<li><i class="icon-caret-right"></i> Dynamic Color Options</li>
									<li><i class="icon-caret-right"></i> Lots of Size Options</li>
									<li><i class="icon-caret-right"></i> 04-Day Return Policy</li>
									<li v-if="Product.product_quantity==0"><i class="icon-caret-right"></i> <span class="text-danger">Out of Stock</span></li>
								</ul><!-- Product Single - Short Description End -->

									<!-- Product Single - Meta
									============================================= -->
									<div class="card product-meta">
										<div class="card-body">
											<span itemprop="productID" class="sku_wrapper">SKU: <span class="sku" style="color: #1ABC9C;">DE-000{{Product.id}}</span></span>
											<span>Colors: <span class="tagged_as" style="color: #1ABC9C;">{{Product.product_color}}</span></span>
										</div>
									</div><!-- Product Single - Meta End -->

									<!-- Product Single - Share
									============================================= -->
									<div class="si-share border-0 d-flex justify-content-between align-items-center mt-4">
										<span>Share:</span>
										<div>
											<a :href="`https://facebook.com/sharer.php?u=${path}`" class="social-icon si-borderless si-facebook">
												<i class="icon-facebook"></i>
												<i class="icon-facebook"></i>
											</a>
											<a :href="`https://twitter.com/share?u=${path}`" class="social-icon si-borderless si-twitter">
												<i class="icon-twitter"></i>
												<i class="icon-twitter"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-pinterest">
												<i class="icon-pinterest"></i>
												<i class="icon-pinterest"></i>
											</a>
											<a :href="`https://linkedin.com/sharing/share-offsite/?url=${path}`" class="social-icon si-borderless si-linkedin">
												<i class="icon-linkedin"></i>
												<i class="icon-linkedin"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-rss">
												<i class="icon-rss"></i>
												<i class="icon-rss"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-email3">
												<i class="icon-email3"></i>
												<i class="icon-email3"></i>
											</a>
										</div>
									</div><!-- Product Single - Share End -->

								</div>

								

								<div class="w-100"></div>

								<div class="col-12 mt-5">

									<div class="tabs clearfix mb-0" id="tab-1">

										<ul class="tab-nav clearfix">
											<li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="d-none d-md-inline-block"> Description</span></a></li>
										</ul>

										<div class="tab-container">

											<div class="tab-content clearfix" id="tabs-1">
												<p>{{Product.long_description}}</p>
											</div>

										</div>

									</div>

								</div>

							</div>
						</div>
					</div>

					<div class="line"></div>

					<div class="w-100">

						<h4>Related Products</h4>
						<carousel v-if="categoryProducts.length" :nav="false" :items= "5" :margin="5" :loop="true" :autoplay="true" :mouseDrag="true" :touchDrag="true" :responsive="{0:{items:2,nav:false},600:{items:5,nav:false}}">

   						<div class="oc-item" v-for="product in categoryProducts">
							<div class="product">
								<div class="product-image">
									<a href="#"><img style="width:200px;height:100%;" :src="relatedFileLink(product.product_image[0])" alt="DreamsEye"></a>
									<a href="#"><img style="width:200px;height:100%;" :src="relatedFileLink(product.product_image[1])" alt="DreamsEye"></a>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><router-link :to="`/view-related-product/${product.slug}/${product.id}`">{{product.product_name}}</router-link></h3></div>
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

					</carousel>

						

					</div>

				</div>
			</div>
		</section><!-- #content end -->
	</div>
</template>
<style>
	.color{
		width: 80px;
	}
</style>
<script>
import carousel from 'vue-owl-carousel'

	export default{
		name:'Product-details',
    components: { carousel },

        data: function(){
            return{
            	Product:{},
            	categoryProducts:{},
            	login:'',
            	path:'',
            	imagePath:'',
            	form : new Form({
            		product_id:this.$route.params.id,
            		product_image:null,
            		product_quantity :1,
            		product_color:null,
            	}),
            }
        },

        mounted(){
            this.getProduct();
            this.getCategoryProduct();
            this.getCart();
            this.getCus();
        },
        methods:{
        	getCus(){
        		axios.get('/get-some').then((response)=>{
        			this.login = response.data.cus;

        		})
        	},
            getCart(){
                axios.get('/get-cart-item').then((response)=>{
                })
            },
            getProduct : function(){
                axios.get('/view-product/'+this.$route.params.slug).then((response)=>{
                    this.Product = response.data.product[0];
                    // this.path = 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg';
                    this.path ='https://dreamseye.net/#'+this.$route.fullPath;
                    this.imagePath = 'https://dreamseye.net/#'+this.fileLink(this.Product.product_name);
                    document.querySelector('meta[property="og:image"]').setAttribute("content",this.imagePath);
                    // console.log(this.fileLink(this.Product.product_name));
                }).catch((error)=>{

                })
            },
        	AddToCart(){
        		this.form.post('/add-to-cart').then((response)=>{
        			toastr.success('Product Added To Cart','Success!');
        			this.$router.push('/view-cart');
        		}).catch((error)=>{
        			toastr.error('Please Select A Color Or Please Login First','Opps!');
        		});
        	},
            getCategoryProduct : function(){
                axios.get('/related-category-product/'+this.$route.params.id).then((response)=>{
                    this.categoryProducts = response.data.categoryProducts;
                }).catch((error)=>{

                })
            },

            fileLink:function(name){
                return 'dreamsEye/public/uploads/products/'+name;
            },
            relatedFileLink:function(name){
                return 'dreamsEye/public/uploads/products/'+name;
            },
        },
	}
</script>