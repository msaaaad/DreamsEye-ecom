<template>
	<div>
		<div class="container clearfix" v-if="!superSubCategoryProducts.length">
			<h1 class="text-danger text-center">
				Opps. No Product Found
			</h1>
		</div>
		<div class="container clearfix" v-if="superSubCategoryProducts.length">

					<div class="fancy-title title-border topmargin-sm mb-4 title-center">
						<h4 class="text-primary">New Arrivals ( {{superSubCategoryName}} )</h4>
					</div>

					<div class="row grid-6">
						<div class="col-lg-2 col-md-3 col-6 px-2" v-for="product in superSubCategoryProducts">
							<div class="product">
								<div class="product-image">
									<a href="#"><img style="width:200px;height:100%;" :src="productFileLink(product.product_image[0])" alt="DreamsEye">
									<div v-if="StockOut(product.publication_status)" class="sale-flash badge badge-danger p-2">Out of Stock</div></a>
									<a href="#"><img style="width:200px;height:100%;" :src="productFileLink(product.product_image[1])" alt="DreamsEye">
									<div v-if="StockOut(product.publication_status)" class="sale-flash badge badge-danger p-2">Out of Stock</div></a>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><router-link :to="`/view-product/${product.slug}/${product.id}`">{{product.product_name}}</router-link></h3></div>
									<div  v-if="product.product_price_discount!=NULL" class="product-price font-primary"><del class="mr-1">TK.{{product.product_price_regular}}</del> <ins>TK.{{product.product_price_discount}}</ins></div>
									<div v-if="product.product_price_discount==NULL" class="product-price font-primary"><ins>TK.{{product.product_price_regular}}</ins></div>
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

				</div>
				<hr>
				<hr>
	</div>
</template>
<script>
	export default{
		name:"Super-subcategory-product",
		data(){
			return{

				superSubCategoryProducts:{},
				superSubCategoryName:null,
			}
		},

        mounted(){
            this.getCategoryProduct();
        },

	methods:{
            getCategoryProduct : function(){
                axios.get('/super-sub-category-product/'+this.$route.params.id).then((response)=>{
                    this.superSubCategoryProducts = response.data.superSubCategoryProducts;
                    this.superSubCategoryName = response.data.superSubCategoryProducts[0].ultrasubcategory.ultra_sub_category_name;
                }).catch((error)=>{

                })
            },
			StockOut(status){
				let data = {
					0:true
				}
				return data[status];
			},
			productFileLink:function(name){
				return 'dreamsEye/public/uploads/products/'+name;
			},
		}
	}
</script>