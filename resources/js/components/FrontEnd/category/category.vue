<template>
	<li class="menu-item">
		<a class="menu-link" href="#"><div style="font-weight: 600;color: #1ABC9C;">Categories</div></a>
		<ul class="sub-menu-container">
			<li class="menu-item" v-for="category in Categories">
				<router-link class="menu-link" :to="`/view-category-product/${category.slug}/${category.id}`"><div class="text-info"><i class="icon-stack"></i>{{category.category_name}}<i class="icon-angle-down"></i></div></router-link>
				<ul class="sub-menu-container" v-if="category.subcategory.length">
					<li class="menu-item" v-for="subcategory in category.subcategory">
						<router-link class="menu-link" :to="`/view-subcategory-product/${subcategory.slug}/${subcategory.id}`"><div class="text-primary">{{subcategory.subcategory_name}}</div></router-link>
						<ul class="sub-menu-container" v-if="subcategory.supersubcategory.length">
							<li class="menu-item" v-for="supersubcategory in subcategory.supersubcategory">
								<router-link class="menu-link" :to="`/view-supersubcategory-product/${supersubcategory.slug}/${supersubcategory.id}`"><div style="color:#000066">{{supersubcategory.ultra_sub_category_name}}</div></router-link>
							</li>
						</ul>
					</li>
				</ul>
				<button class="sub-menu-trigger icon-chevron-right"></button>
			</li>
		</ul>
		<button class="sub-menu-trigger icon-chevron-right"></button>
	</li>
								
</template>
<script>
	export default{
		name:"Category",
		data(){
			return{
				Categories:{},
			}
		},

		mounted(){
			this.getActiveCategories();
		},
		methods:{
			getActiveCategories(){
				axios.get('/get-active-category').then((response)=>{
					this.Categories = response.data.categories;
				
				// this.Categories.forEach((category)=>{
                    // console.log(category.subcategory);
                    // category.subcategory.forEach((subcategory)=>{
                    	// console.log(subcategory.id);
                    	// axios.get('/get-active-front-super-sub-category/'+subcategory.id).then((response)=>{
                    	// 		this.SuperSubCategories = response.data.SuperSubCategories;
                    	// 	})
                    	// })
                    // })
                
				})
			},
		},
	}
</script>