<template>
	<!-- Top Cart
							============================================= -->
							<div id="top-cart" class="header-misc-icon d-sm-block">
								<a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">{{CartLength}}</span></a>
								<router-link to="/view-cart" class="text-success">cart</router-link>
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4>Shopping Cart</h4>
									</div>
									<div class="top-cart-items">
										<div class="top-cart-item" v-for="Product in CartProducts">
											<div class="top-cart-item-image">
												<a href="#"><img :src="fileLink(Product.product_image[0])" alt="Blue Round-Neck Tshirt" /></a>
											</div>
											<div class="top-cart-item-desc">
												<div class="top-cart-item-desc-title">
													<a href="#">{{Product.product_name}}</a>
													<span class="top-cart-item-price d-block">TK. {{Product.product_price}}</span>
												</div>
												<div class="top-cart-item-quantity">x {{Product.product_quantity}}</div>
											</div>
										</div>
									</div>
									<div>
										<table class="table table-bordered">
											<tr>
												<td>Total amount</td>
												<td>TK. {{CartTotal}} </td>
											</tr>
										</table>
									</div>
									<div class="top-cart-action">
										<router-link to="/view-cart" class="button button-3d button-small m-0">View Cart</router-link>
										<router-link to="/shipping" class="btn btn-success">Checkout</router-link>
									</div>
								</div>
							</div><!-- #top-cart end -->
</template>
<script>
	export default{
		name:"top-cart",
        data(){
            return{
                CartLength:'',
                CartProducts:[],
            }
        },
        mounted(){
            this.$store.dispatch('getCompanyStatus');
            this.$store.dispatch('getCustomer');
            this.$store.dispatch('getVendorStat');
            this.$store.dispatch('getVarify');
            this.$store.dispatch('getCode');
            this.getCart();
        },
        methods:{
            getCart(){
                axios.get('/get-cart-item').then((response)=>{
                    this.CartProducts = response.data.cartProducts;
                    this.CartLength = this.CartProducts.length;
                })
            },
            fileLink:function(name){
                return 'dreamsEye/public/uploads/products/'+name;
            },
        },
        computed:{
            Some(){
                return this.$store.getters.cus;
            },
        	CartTotal(){
        		let total = 0;
        		this.CartProducts.forEach((Product)=>{
        			total+=Product.product_quantity*Product.product_price;
        		});
        		return total;
        	}
        }
	}
</script>