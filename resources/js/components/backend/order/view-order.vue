<template>
	<div class="order-details col-12" style="margin:auto">
	    <div class="container">
	        <div class="row">
	            <div class="manage-category col-lg-8" style="margin:auto">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="text-success text-center">Customer For This Order</h4>
	                    </div>
	                    <div class="card-body">
	                       <table class="table table-bordered table-responsive">
	                           <tr>
	                               <th>Customer Name</th>
	                               <td>{{customer.first_name+' '+customer.last_name}}</td>
	                           </tr>
	                           <tr>
	                               <th>Phone Number</th>
	                               <td>{{customer.phone_number}}</td>
	                           </tr>
	                           <tr>
	                               <th>Email Address</th>
	                               <td>{{customer.email_address}}</td>
	                           </tr>
	                           <tr>
	                               <th>Address</th>
	                               <td>{{customer.address}}</td>
	                           </tr>

	                       </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <hr>
	    <div class="container">
	        <div class="row">
	            <div class="manage-category col-lg-8" style="margin:auto">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="text-success text-center">Order Details For This Order</h4>
	                    </div>
	                    <div class="card-body">
	                       <table class="table table-bordered">
	                           <tr>
	                               <th>Order No.</th>
	                               <td>{{order.id}}</td>
	                           </tr>
	                           <tr>
	                               <th>Order Total</th>
	                               <td>{{order.order_total}}</td>
	                           </tr>
	                           <tr>
	                               <th>Order Status</th>
	                               <td v-if="order.order_status==0">Pending</td>
	                               <td v-if="order.order_status==1">Completed</td>
	                           </tr>
	                           <tr>
	                               <th>Order Time</th>
	                               <td>{{time}}</td>
	                           </tr>

	                       </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <hr>
	    <div class="container">
	        <div class="row">
	            <div class="manage-category col-lg-8" style="margin:auto">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="text-success text-center">Shipping Info For This Order</h4>
	                    </div>
	                    <div class="card-body">
	                        <table class="table table-bordered table-responsive">
	                            <tr>
	                                <th>Full Name</th>
	                                <td>{{shipping.last_name}}</td>
	                            </tr>
	                            <tr>
	                                <th>Phone Number</th>
	                                <td>{{shipping.phone_number}}</td>
	                            </tr>
	                            <tr>
	                                <th>Email Address</th>
	                                <td>{{shipping.email_address}}</td>
	                            </tr>
	                            <tr>
	                                <th>Address</th>
	                                <td>{{shipping.address}}</td>
	                            </tr>

	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <hr>

	    <div class="container">
	        <div class="row">
	            <div class="manage-category col-lg-8" style="margin:auto">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="text-success text-center">Payment Info For This Order</h4>
	                    </div>
	                    <div class="card-body">
	                        <table class="table table-bordered">
	                            <tr>
	                                <th>Payment Type</th>
	                                <td>{{payment.payment_type}}</td>
	                            </tr>
	                            <tr>
	                                <th>Payment Status</th>
	                                <td>pending</td>
	                            </tr>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <hr>
	    <div class="container">
	        <div class="row">
	            <div class="manage-category col-lg-8" style="margin:auto">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="text-success text-center">Product Info For This Order</h4>
	                    </div>
	                    <div class="card-body">
	                        <table class="table table-bordered table-responsive">
	                            <tr>
	                                <th>Sl No.</th>
	                                <th>Product Name</th>
	                                <th>Product Price</th>
	                                <th>Product Quantity</th>
	                                <th>Total Product Price</th>
	                            </tr>
	                            <tr v-for="orderDetail,index in orderDetails">
	                                <td>{{++index}}</td>
	                                <td>{{orderDetail.product_name}}</td>
	                                <td>{{orderDetail.product_price}}</td>
	                                <td>{{orderDetail.product_quantity}}</td>
	                                <td>{{orderDetail.product_quantity*orderDetail.product_price}}</td>
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
		name:'view',
		data(){
			return{
				customer:'',
				order:'',
				time:'',
				shipping:'',
				payment:'',
				orderDetails:'',
			}
		},
		mounted(){
			this.getCustomer();
			this.getOrder();
		},
		methods:{
			getCustomer(){
				axios.get('/customer-info/'+this.$route.params.id).then((response)=>{
					this.customer = response.data.customer;
				})
			},
			getOrder(){
				axios.get('/order-info/'+this.$route.params.id).then((response)=>{
					this.order = response.data.order;
					this.time = response.data.carbon;
					this.shipping = response.data.shipping;
					this.payment = response.data.payment;
					this.orderDetails = response.data.orderDetails;
				})
			},
		},
	}
</script>