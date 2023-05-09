<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-message col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary text-center">Manage Message Info</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                            	<!-- <th><input type="checkbox"></th> -->
                                <th>Sl. No</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Category Name</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="message,index in Messages">
                                <td>{{++index}}</td>
                                <td>{{message.full_name}}</td>
                                <td>{{message.email_address}}</td>
                                <td>{{message.phone_number}}</td>
                                <td>{{message.category.category_name}}</td>
                                <td>{{message.subject}}</td>
                                <td>{{message.message}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Message Info" @click="DeleteMessage(message.id)"><i class="fas fa-trash-alt"></i></button>
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
				messageIds : []
			}
		},
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getMessages');
		},
		computed:{
			Messages(){
				return this.$store.getters.messages;
			}
		},
		methods:{
			DeleteMessage(id){
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
		  	axios.get("delete-message/"+id).then((response)=>{
		       /* toastr.success('Message Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your message info has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getMessages');


		      }).catch((error)=>{

		      })
		   	/* 
		      */
		  } else if (
		    /* Read more message handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelled',
		      'Your message is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Messages.length<1);
			},
		}
	}
</script>