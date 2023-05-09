<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-subcategory col-12">
                <div class="card">
                    <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Manage Sub Category</h4>
                                <router-link to="/add-subcategory" class="ml-auto btn btn-outline-primary">Add Sub Category</router-link>
                            </div>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl. No</th>
                                <th>Category Name</th>
                                <th>Subcategory Name</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="subcategory,index in Subcategories">
                                <td>{{++index}}</td>
                                <td v-if="subcategory.category">{{subcategory.category.category_name}}</td>
                                <td>{{subcategory.subcategory_name}}</td>
                                <td><span class="badge" :class="statusColor(subcategory.publication_status)">{{statusName(subcategory.publication_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Subcategory" @click="DeleteSubcategory(subcategory.id)"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/edit-subcategory/${subcategory.slug}`" class="btn btn-success btn-sm" title="Edit Subcategory"><i class=" fab fa-chromecast"></i></router-link>
                                    <button type="button" @click="PublishSubcategory(subcategory.id)" v-if="unpublishedSubcategory(subcategory.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(subcategory.publication_status)" :class="statusIconColor(subcategory.publication_status)"><i class="fas" :class="statusIcon(subcategory.publication_status)"></i></button>
                                    <button v-if="publishedSubcategory(subcategory.publication_status)" @click="UnublishSubcategory(subcategory.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(subcategory.publication_status)" :class="statusIconColor(subcategory.publication_status)"><i class="fas" :class="statusIcon(subcategory.publication_status)"></i></button>
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
			this.$store.dispatch('getSubcategories');
		},
		computed:{
			Subcategories(){
				return this.$store.getters.getsubcategories;
			}
		},
		methods:{
			PublishSubcategory(id){
				axios.get("publish-subcategory/"+id).then((response)=>{
					toastr.success('Subcategory Info Published Successfully','Success!');
					this.$store.dispatch('getSubcategories');
				}).catch((error)=>{

				})
			},
			UnublishSubcategory(id){
				let this_=this;
				axios.get("unpublish-subcategory/"+id).then((response)=>{
					toastr.success('Subcategory Info Unpublished Successfully','Success!');
					this.$store.dispatch('getSubcategories');
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
			unpublishedSubcategory(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedSubcategory(status){
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
			DeleteSubcategory(id){
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
		  	axios.get("delete-subcategory/"+id).then((response)=>{
		       /* toastr.success('Subcategory Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your subcategory has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getSubcategories');


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
		      'Your subcategory is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Subcategories.length<1);
			},
		}
	}
</script>