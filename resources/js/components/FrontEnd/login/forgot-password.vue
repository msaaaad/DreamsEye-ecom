<template>
	<div>
		<div class="container">
        <div class="row">
            
            <div class="col-lg-6" style="margin-top: 50px;margin:auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header text-success text-center">Forgot Password!!!</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="ForgotPassword">
                            <div class="form-group">
                                <p class="text-warning">Enter Your Email Address:</p>
                                <input type="email" v-model="form2.email_address" placeholder="example@email.com" class="form-control" :class="{ 'is-invalid': form2.errors.has('email_address') }">
                                            <has-error :form="form2" field="email_address"></has-error>

                            </div>
                            <div class="form-group mt-5">
                                <input type="submit" value="Send Verification Code" name="btn" class="form-control btn btn-info">
                            </div>
                        <p class="text-warning">Don't Have An Acount ? <router-link class="text-info" to="/register"><u>Register Now</u></router-link></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
	</div>
</template>
<script>
	export default{
		name:'Login',
		data:function(){
			return{
				
				form2 : new Form({
					'email_address':null,
				})
			}
		},
		methods:{
			ForgotPassword:function(){
				this.form2.post('/forgot-password').then((response)=>{
					toastr.success('Verification Code Sent To Your Email','Success!');
                    this.$router.push('/enter-code');
				}).catch((error)=>{
					toastr.error('Sorry Your Email Did not match','Reset Failed!')
				})
			},
		},
	}
</script>