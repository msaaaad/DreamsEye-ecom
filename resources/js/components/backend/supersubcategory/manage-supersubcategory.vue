<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-subcategory col-12">
                <div class="card">
                    <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Manage Super Sub Category</h4>
                                <router-link to="/add-super-subcategory" class="ml-auto btn btn-outline-primary">Add Super Sub Category</router-link>
                            </div>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th>Sl. No</th>
                                <th>Category Name</th>
                                <th>Subcategory Name</th>
                                <th>Super Subcategory Name</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="superSubCat,index in superSubCats">
                                <td>{{++index}}</td>
                                <td>{{superSubCat.category.category_name}}</td>
                                <td>{{superSubCat.subcategory.subcategory_name}}</td>
                                <td>{{superSubCat.ultra_sub_category_name}}</td>
                                <td><span class="badge" :class="statusColor(superSubCat.publication_status)">{{statusName(superSubCat.publication_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Subcategory" @click="DeleteSuperSubcategory(superSubCat.id)"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/edit-supersubcategory/${superSubCat.slug}`" class="btn btn-success btn-sm" title="Edit Subcategory"><i class=" fab fa-chromecast"></i></router-link>
                                    <button type="button" @click="PublishSuperSubcategory(superSubCat.id)" v-if="unpublishedSuperSubcategory(superSubCat.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(superSubCat.publication_status)" :class="statusIconColor(superSubCat.publication_status)"><i class="fas" :class="statusIcon(superSubCat.publication_status)"></i></button>
                                    <button v-if="publishedSuperSubcategory(superSubCat.publication_status)" @click="UnublishSuperSubcategory(superSubCat.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(superSubCat.publication_status)" :class="statusIconColor(superSubCat.publication_status)"><i class="fas" :class="statusIcon(superSubCat.publication_status)"></i></button>
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
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getsuperSubCats');
		},
		computed:{
			superSubCats(){
				return this.$store.getters.superSubCats;
			}
		},
		methods:{
			PublishSuperSubcategory(id){
				axios.get("publish-supersubcategory/"+id).then((response)=>{
					toastr.success('Supersubcategory Info Published Successfully','Success!');
					this.$store.dispatch('getsuperSubCats');
				}).catch((error)=>{

				})
			},
			UnublishSuperSubcategory(id){
				let this_=this;
				axios.get("unpublish-supersubcategory/"+id).then((response)=>{
					toastr.success('Supersubcategory Info Unpublished Successfully','Success!');
					this.$store.dispatch('getsuperSubCats');
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
			unpublishedSuperSubcategory(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedSuperSubcategory(status){
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
					0:'Publish Subcategory',
					1:'Unpublish Subcategory',
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
			DeleteSuperSubcategory(id){
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
		  	axios.get("delete-supersubcategory/"+id).then((response)=>{
		       /* toastr.success('Subcategory Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your supersubcategory has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getsuperSubCats');


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
		      'Your supersubcategory is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.superSubCats.length<1);
			},
		}
	}
</script>