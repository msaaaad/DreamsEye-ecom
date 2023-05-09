<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-about col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary text-center">Manage About Info</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                            	<!-- <th><input type="checkbox"></th> -->
                                <th>Sl. No</th>
                                <th>About Us</th>
                                <th>Why Choice Us</th>
                                <th>Address</th>
                                <th>Facebook Page</th>
                                <th>Facebook Group</th>
                                <th>Instagram</th>
                                <th>Twitter</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="about,index in Abouts">
                                <td>{{++index}}</td>
                                <td>{{about.about_us}}</td>
                                <td>{{about.choice_us}}</td>
                                <td>{{about.address}}</td>
                                <td>{{about.facebook_page}}</td>
                                <td>{{about.facebook_group}}</td>
                                <td>{{about.instagram}}</td>
                                <td>{{about.twitter}}</td>
                                <td><span class="badge" :class="statusColor(about.publication_status)">{{statusName(about.publication_status)}}</span></td>
                                <td>
                                    <button type="button" disabled="" class="btn btn-danger btn-sm" title="Delete About Info" @click="DeleteAbout(about.id)"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/edit-about/${about.slug}`" class="btn btn-success btn-sm" title="Edit About Info"><i class=" fab fa-chromecast"></i></router-link>
                                    <button type="button" @click="PublishAbout(about.id)" v-if="unpublishedAbout(about.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(about.publication_status)" :class="statusIconColor(about.publication_status)"><i class="fas" :class="statusIcon(about.publication_status)"></i></button>
                                    <button v-if="publishedAbout(about.publication_status)" @click="UnublishAbout(about.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(about.publication_status)" :class="statusIconColor(about.publication_status)"><i class="fas" :class="statusIcon(about.publication_status)"></i></button>
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
				aboutIds : []
			}
		},
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getAbouts');
		},
		computed:{
			Abouts(){
				return this.$store.getters.abouts;
			}
		},
		methods:{
			PublishAbout(id){
				axios.get("publish-about/"+id).then((response)=>{
					toastr.success('About Info Published Successfully','Success!');
					this.$store.dispatch('getAbouts');
				}).catch((error)=>{

				})
			},
			UnublishAbout(id){
				let this_=this;
				axios.get("unpublish-about/"+id).then((response)=>{
					toastr.success('About Info Unpublished Successfully','Success!');
					this.$store.dispatch('getAbouts');
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
			unpublishedAbout(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedAbout(status){
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
					0:'Publish About',
					1:'Unpublish About',
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
			DeleteAbout(id){
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
		  	axios.get("delete-about/"+id).then((response)=>{
		       /* toastr.success('About Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your about info has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getAbouts');


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
		      'Your about is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Abouts.length<1);
			},
		}
	}
</script>