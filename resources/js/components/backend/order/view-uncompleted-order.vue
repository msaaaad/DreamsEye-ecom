<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-order col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary text-center">Manage Orders</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th>Sl. No</th>
                                <th>Customer Name</th>
                                <th>Order Total</th>
                                <th>Order Time</th>
                                <th>Order Status</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="order,index in Orders">
                                <td>{{++index}}</td>
                                <td style="font-weight:700;">{{order.first_name+' '+order.last_name}}</td>
                                <td>{{order.order_total}}</td>
                                <td>{{order.created_at}}</td>
                                <td><span class="badge" :class="statusColor(order.order_status)">{{statusName(order.order_status)}}</span></td>
                                <td>{{order.payment_type}}</td>
                                <td><span class="badge badge-warning">{{order.payment_status}}</span></td>
                                <td>
                                    <!-- <button type="button" class="btn btn-danger btn-sm" title="Delete Order Info" @click="DeleteContact(order.id)"><i class="fas fa-trash-alt"></i></button> -->
                                    <router-link :to="`/view-order/${order.id}`" class="btn btn-info btn-sm" title="View Order Details"><i class="fas fa-search-plus"></i></router-link>

                                    <router-link :to="`/view-order-invoice/${order.id}`" class="btn btn-warning btn-sm" title="View Order Invoice"><i class="fas fa-search-plus"></i></router-link>
                                    <button @click="DownloadOrderInvoice(order.id)" class="btn btn-danger btn-sm" title="Download Order Invoice"><i class="fas fa-download"></i></button>
                                    <button v-if="order.order_status==0" @click="CompletedOrder(order.id)" class="btn btn-light btn-sm" title="Mark Order Completed?"><i class="fas fa-check"></i></button>
                                    <button disabled="" v-if="order.order_status==1" class="btn btn-success btn-sm" title="Order Completed?"><i class="fas fa-check"></i></button>
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
				aboutIds : [],
				Orders:'',
			}
		},
		mounted(){
			this.getOrders();
		},
		methods:{
			getOrders(){
				axios.get('/get-uncompleted-order').then((response)=>{
					this.Orders = response.data.orders;
				})
			},
			DownloadOrderInvoice(id){
				axios.get('/download-order/'+id).then((response)=>{
					toastr.success('Invoice Downloaded...','Success!');
				})
			},
			CompletedOrder(id){
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
		  confirmButtonText: 'Yes, Mark Completed!',
		  cancelButtonText: 'No, cancel!',
		  reverseButtons: true
		}).then((result) => {
		  if (result.isConfirmed) {
		  	axios.get("complete-order/"+id).then((response)=>{
		       /* toastr.success('Order Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your order info has been deleted.',
		      'success'
		    )
					this.getOrders();


		      }).catch((error)=>{

		      })
		   	/* 
		      */
		  } else if (
		    /* Read more order handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelled',
		      'Order is not completed :)',
		      'error'
		    )
		  }
		})			},
			PublishContact(id){
				axios.get("publish-order/"+id).then((response)=>{
					toastr.success('Order Info Published Successfully','Success!');
					this.$store.dispatch('getContacts');
				}).catch((error)=>{

				})
			},
			UnublishContact(id){
				let this_=this;
				axios.get("unpublish-order/"+id).then((response)=>{
					toastr.success('Order Info Unpublished Successfully','Success!');
					this.$store.dispatch('getContacts');
				}).catch((error)=>{

				})
			},
			statusName(status){
				let data= {
					0:'Pending',
					1:'Completed',
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
					0:'Publish Order',
					1:'Unpublish Order',
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
		  	axios.get("delete-order/"+id).then((response)=>{
		       /* toastr.success('Order Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your order info has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getContacts');


		      }).catch((error)=>{

		      })
		   	/* 
		      */
		  } else if (
		    /* Read more order handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelled',
		      'Your order is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Orders.length<1);
			},
		}
	}
</script>