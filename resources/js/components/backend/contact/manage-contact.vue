<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-contact col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary text-center">Manage Contact Info</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                            	<!-- <th><input type="checkbox"></th> -->
                                <th>Sl. No</th>
                                <th>Phone Number 1</th>
                                <th>Phone Number 2</th>
                                <th>Phone Number 3</th>
                                <th>Email Address</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="contact,index in Contacts">
                                <td>{{++index}}</td>
                                <td>{{contact.phone_number_1}}</td>
                                <td>{{contact.phone_number_2}}</td>
                                <td>{{contact.phone_number_3}}</td>
                                <td>{{contact.email_address}}</td>
                                <td><span class="badge" :class="statusColor(contact.publication_status)">{{statusName(contact.publication_status)}}</span></td>
                                <td>
                                    <button disabled="" type="button" class="btn btn-danger btn-sm" title="Delete Contact Info" @click="DeleteContact(contact.id)"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/edit-contact/${contact.slug}`" class="btn btn-success btn-sm" title="Edit Contact Info"><i class=" fab fa-chromecast"></i></router-link>
                                    <button type="button" @click="PublishContact(contact.id)" v-if="unpublishedContact(contact.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(contact.publication_status)" :class="statusIconColor(contact.publication_status)"><i class="fas" :class="statusIcon(contact.publication_status)"></i></button>
                                    <button v-if="publishedContact(contact.publication_status)" @click="UnublishContact(contact.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(contact.publication_status)" :class="statusIconColor(contact.publication_status)"><i class="fas" :class="statusIcon(contact.publication_status)"></i></button>
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
			this.$store.dispatch('getContacts');
		},
		computed:{
			Contacts(){
				return this.$store.getters.contacts;
			}
		},
		methods:{
			PublishContact(id){
				axios.get("publish-contact/"+id).then((response)=>{
					toastr.success('Contact Info Published Successfully','Success!');
					this.$store.dispatch('getContacts');
				}).catch((error)=>{

				})
			},
			UnublishContact(id){
				let this_=this;
				axios.get("unpublish-contact/"+id).then((response)=>{
					toastr.success('Contact Info Unpublished Successfully','Success!');
					this.$store.dispatch('getContacts');
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
			unpublishedContact(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedContact(status){
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
					0:'Publish Contact',
					1:'Unpublish Contact',
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
			DeleteContact(id){
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
		  	axios.get("delete-contact/"+id).then((response)=>{
		       /* toastr.success('Contact Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your contact info has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getContacts');


		      }).catch((error)=>{

		      })
		   	/* 
		      */
		  } else if (
		    /* Read more contact handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelled',
		      'Your contact is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Contacts.length<1);
			},
		}
	}
</script>