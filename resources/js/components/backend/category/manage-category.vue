<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-category col-12">
                <div class="card">
                    <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Manage Category Info</h4>
                                <router-link to="/add-category" class="ml-auto btn btn-outline-primary">Add Category Info</router-link>
                            </div>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl. No</th>
                                <th>Category Name</th>
                                <th>Thumbnail</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="category,index in Categories">
                                <td>{{++index}}</td>
                                <td>{{category.category_name}}</td>
                                <td><img :src="fileLink(category.category_image)" height="65px" width="80px" alt=""></td>
                                <td><span class="badge" :class="statusColor(category.publication_status)">{{statusName(category.publication_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Category" @click="DeleteCategory(category.id)"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/edit-category/${category.slug}`" class="btn btn-success btn-sm" title="Edit Category"><i class=" fab fa-chromecast"></i></router-link>
                                    <button type="button" @click="PublishCategory(category.id)" v-if="unpublishedCategory(category.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(category.publication_status)" :class="statusIconColor(category.publication_status)"><i class="fas" :class="statusIcon(category.publication_status)"></i></button>
                                    <button v-if="publishedCategory(category.publication_status)" @click="UnublishCategory(category.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(category.publication_status)" :class="statusIconColor(category.publication_status)"><i class="fas" :class="statusIcon(category.publication_status)"></i></button>
                                </td>
                            </tr>
                            <tr v-if="emptyData()">
                            	<td colspan="10">
                            		<h4 class="text-center text-danger">Opps! Data Not Found</h4>
                            	</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>
</template>
<script>
	export default{
		name:'manage',
		data:function(){
			return{
				categoryIds : []
			}
		},
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getCategories');
		},
		computed:{
			Categories(){
				return this.$store.getters.categories;
			}
		},
		methods:{
			PublishCategory(id){
				axios.get("publish-category/"+id).then((response)=>{
					toastr.success('Category Info Published Successfully','Success!');
					this.$store.dispatch('getCategories');
				}).catch((error)=>{

				})
			},
			UnublishCategory(id){
				let this_=this;
				axios.get("unpublish-category/"+id).then((response)=>{
					toastr.success('Category Info Unpublished Successfully','Success!');
					this.$store.dispatch('getCategories');
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
			unpublishedCategory(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedCategory(status){
				let data= {
					1:true
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
					0:'Publish Category',
					1:'Unpublish Category',
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
			DeleteCategory(id){
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
		  	axios.get("delete-category/"+id).then((response)=>{
		       /* toastr.success('Category Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your category has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getCategories');


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
		      'Your category is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Categories.length<1);
			},
			fileLink:function(name){
				return 'dreamsEye/public/uploads/category/'+name;
			},
		}
	}
</script>