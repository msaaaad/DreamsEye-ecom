<template>
	<div class="order-details col-12" style="margin:auto">
	    <div class="container">
	        <div class="row">
	            <div class="manage-category col-lg-8" style="margin:auto">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="text-success text-center">Seller Basic Info</h4>
	                    </div>
	                    <div class="card-body">
	                       <table class="table table-bordered table-responsive">
	                           <tr>
	                               <th>Seller Name</th>
	                               <td>{{Seller.customer.first_name+' '+Seller.customer.last_name}}</td>
	                           </tr>
	                           <tr>
	                               <th>Company Name</th>
	                               <td>{{Seller.company_name}}</td>
	                           </tr>
	                           <tr>
	                               <th>Phone Number</th>
	                               <td>{{Seller.customer.phone_number}}</td>
	                           </tr>
	                           <tr>
	                               <th>Emergency Phone Number</th>
	                               <td>{{Seller.emergency_contact}}</td>
	                           </tr>
	                           <tr>
	                               <th>Email Address</th>
	                               <td>{{Seller.customer.email_address}}</td>
	                           </tr>
	                           <tr>
	                               <th>Billing Address</th>
	                               <td>{{Seller.bill_address}}</td>
	                           </tr>
	                           <tr>
	                               <th>Address</th>
	                               <td>{{Seller.customer.address}}</td>
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
	                        <h4 class="text-success text-center">Tin Certificate</h4>
	                    </div>
	                    <div class="card-body">
	                       <img :src="fileLink(Seller.tin_certificate)" height="450px" width="600px" alt="">
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
	                        <h4 class="text-success text-center">National Id/Passport/Trade License</h4>
	                    </div>
	                    <div class="card-body">
	                       <img :src="fileLink(Seller.varification)" height="450px" width="600px" alt="">
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	</div>
</template>
<script>
	export default{
		name:'view-seller',
		data(){
			return{
				Seller:'',
			}
		},
		mounted(){
			this.getSeller();
		},
		methods:{
			getSeller(){
				axios.get('/seller-info/'+this.$route.params.id).then((response)=>{
					this.Seller = response.data.Seller;
				})
			},
			fileLink:function(name){
				return 'dreamsEye/public/uploads/company/'+name;
			},
		},
	}
</script>