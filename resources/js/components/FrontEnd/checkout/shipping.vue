<template>


    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 auto bg-dark">
                <p class="text-center text-capitalize text-warning" style="font-weight: 700;">Dear  <span class="text-white text-capitalize">{{customerName}}</span>  ...you have to give us product shipping info to complete your valuable order</p>
                <p class="text-center text-capitalize text-success" style="font-weight: 700;">if your billing info and shipping info are same then just press <span class="text-danger">save shipping info</span> button</p>
            </div>
            <div class=" col-lg-8 auto" style="margin-top: 50px;">
                <div class="card">
                    <h5 class="card-header text-success text-center">Shipping Info Goes Here...</h5>
                    <div class="card-body">
                        <form @submit.prevent="saveShippingInfo">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="form.first_name+form.last_name" placeholder="Surname" :class="{ 'is-invalid': form.errors.has('last_name') }">
                                            <has-error :form="form" field="last_name"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="email" v-model="form.email_address" placeholder="example@email.com" class="form-control" :class="{ 'is-invalid': form.errors.has('email_address') }">
                                            <has-error :form="form" field="email_address"></has-error>

                            </div>


                            <div class="form-group">
                                <input v-model="form.phone_number"  type="text" placeholder="Phone Number" class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                            <has-error :form="form" field="phone_number"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.address" placeholder="Address" class="form-control" id="" cols="30" rows="5" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                            <has-error :form="form" field="address"></has-error>
                            </div>
                            <div class="form-group">
                                <input name="btn" type="submit" value="Save Shipping Info" class="form-control btn btn-warning">
                            </div>

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
</style>
<script>
	export default{
		name:"shipping",
		data(){
			return{
				customerName:'',
				shippingInfo:'',
				form : new Form({
					'id' : null,
					'first_name':null,
                    'last_name':null,
					'email_address':null,
					'phone_number':null,
					'address':null,

				})
			}
		},
        mounted(){
            this.getShippingInfo();
            this.getCustomerName();
        },
		methods:{
			getCustomerName(){
				axios.get('/customername').then((response)=>{
					this.customerName = response.data.customername;
				})
			},
			getShippingInfo(){
				axios.get('/shipping-info').then((response)=>{
					this.form.fill(response.data.shippingInfo[0]);
				})
			},
			saveShippingInfo(){
				this.form.post('/save-shipping-info').then((response)=>{
					toastr.success('Shipping Info Saved Successfully','Success!');
					this.$router.push('/payment');
				}).catch((error)=>{
					toastr.error('Please Check Your Informations','Error!');
				})
			}
		}

	}
</script>