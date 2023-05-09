<template>
	<div class="container">
		<div class="col-lg-7" style="margin-top: 50px;margin:auto">
                <div class="card">
                    <h5 class="card-header text-success text-center">Edit Bio</h5>
                    <div class="card-body">

                        <form  @submit.prevent="Update">
                            <div class="form-group">
                                <input type="text" v-model="form.first_name" placeholder="First Name" class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                            <has-error :form="form" field="first_name"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="form.last_name" placeholder="Surname" :class="{ 'is-invalid': form.errors.has('last_name') }">
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
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="region">Region:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="form.region" class="form-control" :class="{ 'is-invalid': form.errors.has('region') }" id="region">
                                                <option disabled="">-----Select Your Region-----
                                                </option>
                                                <option>Inside Dhaka City</option>
                                                <option>Outside Dhaka City</option>
                                            </select>
                                            <has-error :form="form" field="region"></has-error>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group">
                                <textarea v-model="form.address" placeholder="Address" class="form-control" id="" cols="30" rows="5" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                            <has-error :form="form" field="address"></has-error>
                            </div>
                            <div class="form-group">
                                <input name="btn" type="submit" value="Update" class="form-control btn btn-warning">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
	</div>
</template>

<script>
	export default{
		name:'edit',
		data:function(){
			return{
				form : new Form({
					'id':null,
					'first_name':null,
					'last_name':null,
					'email_address':null,
					'phone_number':null,
					'address':null,
					'region':null,
				}),
			}
		},
        mounted(){
            this.getCustomer();
        },
        methods:{
        	getCustomer : function(){
                axios.get('/show-customer/'+this.$route.params.slug).then((response)=>{
                    this.form.fill(response.data.customer)
                }).catch((error)=>{

                })
            },
            Update:function(){
                this.form.post('/update-bio').then((response)=>{
                        toastr.success('Bio Updated Successfully','Success!');
                        this.$router.push('/account');
                })
            },
        },
	}
</script>