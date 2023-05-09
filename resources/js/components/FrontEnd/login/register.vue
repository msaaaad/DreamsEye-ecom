<template>
	<div>
		<div class="container mt-5">
            <div class="col-lg-6" style="margin-top: 50px;margin:auto">
                <div class="card">
                    <h5 class="card-header text-success text-center">Registration Form</h5>
                    <div class="card-body">

                        <form  @submit.prevent="Registration" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" v-model="form.first_name" placeholder="First Name" class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                            <has-error :form="form" field="first_name"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="form.last_name" placeholder="Surname" :class="{ 'is-invalid': form.errors.has('last_name') }" v-on:keyup="getValue(product_name)">
                                            <has-error :form="form" field="last_name"></has-error>
                            </div>

                            <div class="form-group">
                                <input type="email" v-model="form.email_address" placeholder="example@email.com" class="form-control" :class="{ 'is-invalid': form.errors.has('email_address') }" v-on:keyup="getValue(form.email_address)">
                                            <has-error :form="form" field="email_address"></has-error>
                            <div v-if="length==1" class="text-danger">Email Already Registered*</div>
                            <div v-if="length==0 && form.email_address" class="text-success">Available</div>

                            </div>


                            <div class="form-group">
                                <input v-model="form.password" placeholder="password***"  type="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.confirm_password" placeholder="Confirm Your password***"  type="password" class="form-control" :class="{ 'is-invalid': form.errors.has('confirm_password') }">
                                            <has-error :form="form" field="confirm_password"></has-error>
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
                            <div class="row">
                            	<div class="col-4">
                            		<b>Profile Picture:</b>
                            	</div>
	                            <div class="form-group col-4">
	                                <input name="profile_picture"  type="file" class="form-control" :class="{ 'is-invalid': form.errors.has('profile_picture') }" @change="loadThumbnail($event)">
                                            <has-error :form="form" field="profile_picture"></has-error>
	                            </div>

                                <div class="col-lg-4">
                                    <img :src="form.profile_picture" height="70px" width="85px" alt="">
                                </div>
                            </div>

                                <!-- <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Status:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <span style="display: block;">
                                                <input disabled="" type="radio" id="publication_status" value="1" v-model="form.publication_status" class="custom-radio disabled"><label for="publication_status" class="text-warning" style="cursor:not-allowed;">Seller</label>
                                            </span>
                                            <span>
                                                <input type="radio" id="unpublication_status" value="0" v-model="form.publication_status"  checked="checked" class="custom-radio"><label class="text-success" for="unpublication_status">Customer</label>
                                            </span>
                                            <span :class="{ 'is-invalid': form.errors.has('publication_status') }"></span>
                                            <has-error :form="form" field="publication_status"></has-error>
                                        </div>
                                    </div>
                                </div> -->
                            <div class="form-group">
                                <input name="btn" type="submit" :disabled="length==1" value="Register" class="form-control btn btn-warning">
                            </div>
                        <p class="text-warning">Already Have An Acount ? <router-link class="text-info" to="/login"><u>Login Now</u></router-link></p>

                        </form>

                    </div>
                </div>
            </div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		name:'register',
		data:function(){
			return{
                length:'',
				form : new Form({
					'first_name':null,
					'last_name':null,
					'email_address':null,
					'password':null,
					'confirm_password':null,
					'phone_number':null,
					'address':null,
                    'region':null,
					'profile_picture':null,
				}),
			}
		},
		methods:{
			Registration:function(){
				this.form.post('/register-customer').then((response)=>{
					toastr.success('Thank you for joining with us','Thank You');
                    this.$router.go();
				}).catch((error)=>{
					toastr.error('Password does not match or Email Already Taken','Registration Failed!')
				})
			},
            loadThumbnail:function(e){
                let file = e.target.files[0];
                // if(file.type==='image/jpg')
                let reader = new FileReader();
                reader.onload = e=>{
                    this.form.profile_picture=e.target.result;
                };
                reader.readAsDataURL(file);
            },
            getValue(email){
                axios.post('/get-cus-mail/'+email).then((response)=>{
                    this.length = response.data.customer.length;
                })
            },
		},

	}
</script>