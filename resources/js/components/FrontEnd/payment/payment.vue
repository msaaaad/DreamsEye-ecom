<template>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 auto bg-warning">
                <p class="text-center text-capitalize text-dark" style="font-weight: 700;">dear ...you have to give us product payment info to complete your valuable order</p>

            </div>
            <div class=" col-lg-8 auto" style="margin-top: 50px;">
                <div class="card">
                    <h5 class="card-header text-success text-center">Payment Info Goes Here...</h5>
                    <div class="card-body">
                        <form @submit.prevent="saveOrder">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Cash On Delivery</th>
                                    <td><input id="cash" type="radio" v-model="form.payment_type" value="Cash"><label for="cash">Cash On Delivery(<span class="text-success size">Available</span>)</label>
                                    	<input type="hidden" v-model="form.payment_status" value="pending">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rocket</th>
                                    <td><input id="rocket" disabled="" type="radio" v-model="form.payment_type" value="Rocket"><label
                                            for="rocket">Rocket (<span class="text-danger size">Currently unavailable*</span>) </label></td>
                                </tr>
                                <tr>
                                    <th>Bkash</th>
                                    <td><input disabled="" type="radio" id="bkash" v-model="form.payment_type" value="Bkash"><label
                                            for="bkash">Bkash(<span class="text-danger size">Currently unavailable*</span>)</label></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><input v-if="ShippingAndTotal" type="submit" value="Confirm Order" name="btn"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <br>
    <br>
    </div>




</template>
<style>
	.auto{
		margin: auto;
	}
	.size{
		font-size: 10px;
		font-weight: 700;
	}
</style>
<script>
	export default{
		name:'payment',
		data(){
			return{
				form : new Form({
					payment_type:'Cash',
					payment_status:'pending',
				})
			}
		},
		mountrd(){
			this.ShippingAndTotal();
		},
		methods:{
			ShippingAndTotal(){
				axios.get('/ship-tot').then((response)=>{
					if(response.data.ship == null){
						return false;
					}
					else {
						return true;
					}
				})
			},
			saveOrder(){
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
				  confirmButtonText: 'Yes, Confirm Order!',
				  cancelButtonText: 'No, cancel!',
				  reverseButtons: true
				}).then((result) => {
				  if (result.isConfirmed) {
				  	this.form.post("/save-order").then((response)=>{
				       /* toastr.success('About Deleted Successfully','Success!');*/
				       swalWithBootstrapButtons.fire(
				      'Confirmed!',
				      'Your order has been confirmed.',
				      'success'
				    )
							this.$router.push('/');


				      }).catch((error)=>{
				      	toastr.error('Please Select a Payment Method','Error!');
				      })
				   	/* 
				      */
				  } else if (
				    /* Read more about handling dismissals below */
				    result.dismiss === Swal.DismissReason.cancel
				  ) {
				    swalWithBootstrapButtons.fire(
				      'Cancelled',
				      'Your money is safe :)',
				      'error'
				    )
				  }
				})
			}
		},
	}
</script>