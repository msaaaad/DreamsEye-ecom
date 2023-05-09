<template>
	<form class="top-search-form" action="search.html" method="get">
		<input type="text" id="Form_Search" class="form-control" v-model="form.name" v-on:keyup="getValue" placeholder="What Are You Looking For">
		<div class="panel-footer foot" v-if="SearchResults.length" style="position:relative;z-index:1000;border:1px solid #ccc;background:#fff;">
			<div v-for="result in SearchResults" style="color:#000000;font-weight:700">
				<img class="ml-5" style="width:100px;height:50%;" :src="productFileLink(result.product_image[0])" alt="DreamsEye">
				<span class="ml-5" style="font-weight:700">Product: </span>
				<router-link style="color:#1ABC9C" :to="`/view-product/${result.slug}/${result.id}`">{{result.product_name}}</router-link>
				<span class="ml-5" style="font-weight:700">Category: </span>
				<router-link style="color:#1ABC9C" :to="`/view-category-product/${result.category.slug}/${result.category.id}`">{{result.category.category_name}}</router-link>
				<span class="ml-5" style="font-weight:700">Price: </span>
				<span  v-if="result.product_price_discount!=null" class="product-price font-primary"><del class="mr-1">TK.{{result.product_price_regular}}</del> <ins style="color:#1ABC9C">TK.{{result.product_price_discount}}</ins></span>
				<span v-if="result.product_price_discount==null" class="product-price font-primary"><ins style="color:#1ABC9C">TK.{{result.product_price_regular}}</ins></span>
			</div>
		</div>
	</form>
</template>
<style>
	.foot{
		border-radius: 10px;
	}
</style>
<script>

	export default{
		name:"search-form",
		data:function(){
			return{
				Images:[],
				SearchResults:{},
				Products:{},
				form:new Form({
					name:null
				})
			}
		},
		methods:{

			getValue(){
				this.form.post('/get-search-front-product').then((response)=>{
					// console.log(response.data.getResultVal);
					this.SearchResults = response.data.getResultVal;

				})
			},
			productFileLink:function(name){
				return 'dreamsEye/public/uploads/products/'+name;
			},
		},
	}
</script>