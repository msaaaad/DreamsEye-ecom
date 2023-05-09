<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-model col-12">
                <div class="card">
                    <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Manage Model Image</h4>
                                <router-link to="/add-model" class="ml-auto btn btn-outline-primary">Add Model Image</router-link>
                            </div>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl. No</th>
                                <th>Thumbnail</th>
                                <th>Publication Status</th>
                                <th>Other Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="model,index in Models">
                                <td>{{++index}}</td>
                                <td><img :src="fileLink(model.model_image)" height="65px" width="80px" alt=""></td>
                                <td><span class="badge" :class="statusColor(model.publication_status)">{{statusName(model.publication_status)}}</span></td>
                                <td><span class="badge" :class="bannerColor(model.banner_status)">{{bannerName(model.banner_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Model" @click="DeleteModel(model.id)"><i class="fas fa-trash-alt"></i></button>
                                    <button type="button" @click="PublishModel(model.id)" v-if="unpublishedModel(model.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(model.publication_status)" :class="statusIconColor(model.publication_status)"><i class="fas" :class="statusIcon(model.publication_status)"></i></button>
                                    <button v-if="publishedModel(model.publication_status)" @click="UnublishModel(model.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(model.publication_status)" :class="statusIconColor(model.publication_status)"><i class="fas" :class="statusIcon(model.publication_status)"></i></button>


                                    <button type="button" @click="PublishBanner(model.id)" v-if="unpublishedBanner(model.banner_status)" class="btn btn-sm" v-bind:title="bannerTitle(model.banner_status)" :class="bannerIconColor(model.banner_status)"><span>Make Banner</span></button>
                                    <button v-if="publishedBanner(model.banner_status)" @click="UnublishBanner(model.id)" type="button" class="btn btn-sm" v-bind:title="bannerTitle(model.banner_status)" :class="bannerIconColor(model.banner_status)"><span>Remove Banner</span></button>
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
			this.$store.dispatch('getModels');
		},
		computed:{
			Models(){
				return this.$store.getters.models;
			}
		},
		methods:{
			PublishModel(id){
				axios.get("publish-model/"+id).then((response)=>{
					toastr.success('Model Info Published Successfully','Success!');
					this.$store.dispatch('getModels');
				}).catch((error)=>{

				})
			},
			UnublishModel(id){
				let this_=this;
				axios.get("unpublish-model/"+id).then((response)=>{
					toastr.success('Model Info Unpublished Successfully','Success!');
					this.$store.dispatch('getModels');
				}).catch((error)=>{

				})
			},
			PublishBanner(id){
				axios.get("publish-banner/"+id).then((response)=>{
					toastr.success('Banner Info Published Successfully','Success!');
					this.$store.dispatch('getModels');
				}).catch((error)=>{

				})
			},
			UnublishBanner(id){
				let this_=this;
				axios.get("unpublish-banner/"+id).then((response)=>{
					toastr.success('Banner Info Unpublished Successfully','Success!');
					this.$store.dispatch('getModels');
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
			bannerName(status){
				let data= {
					0:'Image',
					1:'Banner',
				}
				return data[status];
			},
			unpublishedModel(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedModel(status){
				let data= {
					1:true
				}
				return data[status];
			},
			unpublishedBanner(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedBanner(status){
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
			bannerColor(status){
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
					0:'Publish Model',
					1:'Unpublish Model',
				}
				return data[status];
			},
			bannerIcon(status){
				let data= {
					0:'fa-arrow-up',
					1:'fa-arrow-down',
				}
				return data[status];
			},
			bannerTitle(status){
				let data= {
					0:'Publish Banner',
					1:'Unpublish Banner',
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
			bannerIconColor(status){
				let data= {
					1:'bg-warning',
					0:'bg-info',
				}
				return data[status];
			},
			DeleteModel(id){
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
		  	axios.get("delete-model/"+id).then((response)=>{
		       /* toastr.success('Model Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your model has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getModels');


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
		      'Your model is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Models.length<1);
			},
			fileLink:function(name){
				return 'dreamsEye/public/uploads/models/'+name;
			},
		}
	}
</script>