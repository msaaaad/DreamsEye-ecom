<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-product col-12">
                <div class="card">
                    <div class="card-header">
                            <span style="font-weight:700;font-sixe:20px" class="text-success text-left">Manage Products</span>
                            <router-link to="/add-product/:slug" style="font-weight:700;font-sixe:20px" class="float-right btn btn-outline-primary">Add Product</router-link>
                            <form action="" class="ml-auto" role="search" method="get" id="searchform">
								<input type="text" id="Form_Search" class="form-control" v-model="form.name" v-on:keyup="getValue" placeholder="Search Product">
							</form>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <tr class="bg-success">
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Product Color</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Super Sub Category Name</th>
                                <th>Product Price Regular</th>
                                <th>Product Price Discount</th>
                                <th>Product Quantity</th>
                                <th>Short Description</th>
                                <th class="width">Long Description</th>
                                <th>Product Image</th>
                                <th>Updated By</th>
                                <th>Publication Status</th>
                                <th>Boost Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-if="SearchResults.length" v-for="product,index in SearchResults">
                                <td>{{product.id}}</td>
                                <td>{{product.product_name}}</td>
                                <td>{{product.product_color}}</td>
                                <td>{{product.category.category_name}}</td>
                                <td>{{product.subcategory.subcategory_name}}</td>
                                <td v-if="product.ultrasubcategory">{{product.ultrasubcategory.ultra_sub_category_name}}</td>
                                <td v-if="!product.ultrasubcategory">N/A</td>
                                <td>{{product.product_price_regular}}</td>
                                <td v-if="product.product_price_discount==null">N/D</td>
                                <td v-if="product.product_price_discount!=null">{{product.product_price_discount}}</td>
                                <td>{{product.product_quantity}}</td>
                                <td>{{product.short_description|subString(70)}} <span class="text-success">...</span></td>
                                <td class="width">{{product.long_description|subString(100)}} <span class="text-success">...</span></td>
                                <td><img v-for="image in product.product_image" :src="fileLink(image)" height="35px" width="45px" alt=""></td>
                                <td>{{product.user_name}}</td>
                                <td><span class="badge" :class="statusColor(product.publication_status)">{{statusName(product.publication_status)}}</span></td>
                                <td><span class="badge" :class="boostColor(product.boost_status)">{{boostName(product.boost_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Product" @click="DeleteProduct(product.id)">Delete</button>
                                    <router-link :to="`/edit-product-info/${product.slug}`" class="btn btn-success btn-sm" title="Edit Product">Edit Product Info</router-link>
                                    <router-link :to="`/edit-product-image/${product.slug}`" class="btn btn-dark btn-sm" title="Edit Product">Change Product Image</router-link>
                                    <button type="button" @click="PublishProduct(product.id)" v-if="unpublishedProduct(product.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(product.publication_status)" :class="statusIconColor(product.publication_status)">Publish</button>
                                    <button v-if="publishedProduct(product.publication_status)" @click="UnublishProduct(product.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(product.publication_status)" :class="statusIconColor(product.publication_status)">Unpublish</button>
                                </td>

                            <tr v-if="!SearchResults.length" v-for="product,index in Products">
                                <td>{{product.id}}</td>
                                <td>{{product.product_name}}</td>
                                <td>{{product.product_color}}</td>
                                <td>{{product.category.category_name}}</td>
                                <td>{{product.subcategory.subcategory_name}}</td>
                                <td v-if="product.ultrasubcategory">{{product.ultrasubcategory.ultra_sub_category_name}}</td>
                                <td v-if="!product.ultrasubcategory">N/A</td>
                                <td>{{product.product_price_regular}}</td>
                                <td v-if="product.product_price_discount==null">N/D</td>
                                <td v-if="product.product_price_discount!=null">{{product.product_price_discount}}</td>
                                <td>{{product.product_quantity}}</td>
                                <td>{{product.short_description|subString(70)}} <span class="text-success">...</span></td>
                                <td class="width">{{product.long_description|subString(100)}} <span class="text-success">...</span></td>
                                <td><img v-for="image in product.product_image" :src="fileLink(image)" height="35px" width="45px" alt=""></td>
                                <td>{{product.user_name}}</td>
                                <td><span class="badge" :class="statusColor(product.publication_status)">{{statusName(product.publication_status)}}</span></td>
                                <td><span class="badge" :class="boostColor(product.boost_status)">{{boostName(product.boost_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Product" @click="DeleteProduct(product.id)">Delete</button>
                                    <router-link :to="`/edit-product-info/${product.slug}`" class="btn btn-success btn-sm" title="Edit Product">Edit Product Info</router-link>
                                    <router-link :to="`/edit-product-image/${product.slug}`" class="btn btn-dark btn-sm" title="Edit Product">Change Product Image</router-link>
                                    <button type="button" @click="PublishProduct(product.id)" v-if="unpublishedProduct(product.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(product.publication_status)" :class="statusIconColor(product.publication_status)">Publish</button>
                                    <button v-if="publishedProduct(product.publication_status)" @click="UnublishProduct(product.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(product.publication_status)" :class="statusIconColor(product.publication_status)">Unpublish</button>
                                </td>
                            </tr>
                            <tr v-if="emptyData()">
                            	<td colspan="12">
                            		<h4 class="text-center text-danger">Opps! Data Not Found</h4>
                            	</td>
                            </tr>
                        </table>

                        <pagination size="small" :data="Products" align="center" @pagination-change-page="getResults">
							<span slot="prev-nav">&lt; Previous</span>
							<span slot="next-nav">Next &gt;</span>
						</pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>
</template>
<style>
	.width{
		column-width: 120px !important;
	}
</style>
<script>
	export default{
		name:'manage',
		data:function(){
			return{
				Images:[],
				Products:{},
				SearchResults:{},
				form:new Form({
					name:null
				})
			}
		},
		mounted(){
		this.getProducts();
		},
		methods:{
			getValue(){
				this.form.post('/get-search-vendor-product').then((response)=>{
					// console.log(response.data.getResultVal);
					this.SearchResults = response.data.getResultVal;

				})
			},
			getProducts(page = 1) {
			axios.get('get-front-product?page=' + page)
				.then((response) => {
					this.Products = response.data.products;
				});
		},
			unpublishedProduct(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedProduct(status){
				let data= {
					1:true
				}
				return data[status];
			},
			PublishProduct(id){
				axios.get("publish-product/"+id).then((response)=>{
					toastr.success('Product Info Published Successfully','Success!');
					this.$store.dispatch('getProducts');
				}).catch((error)=>{

				})
			},
			UnublishProduct(id){
				let this_=this;
				axios.get("unpublish-product/"+id).then((response)=>{
					toastr.success('Product Info Unpublished Successfully','Success!');
					this.$store.dispatch('getProducts');
				}).catch((error)=>{

				})
			},
			unboostedProduct(status){
				let data= {
					0:true
				}
				return data[status];
			},
			boostedProduct(status){
				let data= {
					1:true
				}
				return data[status];
			},
			BoostProduct(id){
				axios.get("boost-product/"+id).then((response)=>{
					toastr.success('Product Info Boosted Successfully','Success!');
					this.$store.dispatch('getProducts');
				}).catch((error)=>{

				})
			},
			UnBoostProduct(id){
				let this_=this;
				axios.get("unboost-product/"+id).then((response)=>{
					toastr.success('Product Info UnBoosted Successfully','Success!');
					this.$store.dispatch('getProducts');
				}).catch((error)=>{

				})
			},
			statusName(status){
				let data= {
					0:'Unpublished',
					1:'Published',
				}
				return data[status];
			},
			statusColor(status){
				let data= {
					0:'bg-warning',
					1:'bg-success',
				}
				return data[status];
			},
			statusIcon(status){
				let data= {
					0:'fa-arrow-up',
					1:'fa-arrow-down',
				}
				return data[status];
			},
			statusTitle(status){
				let data= {
					0:'Publish Product',
					1:'Unpublish Product',
				}
				return data[status];
			},
			statusIconColor(status){
				let data= {
					1:'bg-warning',
					0:'bg-info',
				}
				return data[status];
			},
			boostName(status){
				let data= {
					0:'Not Boosted',
					1:'Boosted',
				}
				return data[status];
			},
			boostColor(status){
				let data= {
					0:'bg-warning',
					1:'bg-success',
				}
				return data[status];
			},
			boostTitle(status){
				let data= {
					0:'Boost Product',
					1:'UnBoost Product',
				}
				return data[status];
			},
			boostIconColor(status){
				let data= {
					1:'bg-warning',
					0:'bg-info',
				}
				return data[status];
			},
			DeleteProduct(id){
				const swalWithBootstrapButtons = Swal.mixin({
		  customClass: {
		    confirmButton: 'btn btn-success',
		    cancelButton: 'btn btn-danger'
		  },
		  buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, cancel!',
		  reverseButtons: true
		}).then((result) => {
		  if (result.isConfirmed) {
		  	axios.get("delete-product/"+id).then((response)=>{
		       /* toastr.success('Category Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your product has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getProducts');


		      }).catch((error)=>{

		      })
		   	/* 
		      */
		  } else if (
		    /* Read more about handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelled',
		      'Your product is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Products.length<1);
			},
			fileLink:function(name){
				return 'dreamsEye/public/uploads/products/'+name;
			},
		}
	}
</script>