<template>
	<div>
		<div class="container">
        <div class="row">
            
            <div class="col-lg-6" style="margin-top: 50px;margin:auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header text-success text-center">Already registered ! Log in Now</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="Login">
                            <div class="form-group">
                                <input type="email" v-model="form2.login_email_address" placeholder="example@email.com" class="form-control" :class="{ 'is-invalid': form2.errors.has('login_email_address') }">
                                            <has-error :form="form2" field="login_email_address"></has-error>

                            </div>



                            <div class="form-group">
                                <input v-model="form2.login_password" placeholder="password***"  type="password" class="form-control" :class="{ 'is-invalid': form2.errors.has('login_password') }">
                                            <has-error :form="form2" field="login_password"></has-error>
                            </div>
                            <div class="form-group mt-5">
                                <input type="submit" value="Log In" name="btn" class="form-control btn btn-info">
                            </div>
                        <p class="text-warning">Don't Have An Acount ? <router-link class="text-info" to="/register-front"><u>Register Now</u></router-link></p>
                        <p class="text-primary"><router-link class="text-primary" to="/forgot-password"><u>Forgot Password?</u></router-link></p>
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
					'login_email_address':null,
					'login_password':null,
				})
			}
		},
		methods:{
			Login:function(){
				this.form2.post('/login-customer').then((response)=>{
					toastr.success('Login Successful','Success!');
                    
                    // this.$router.push('/');
                    this.$router.go();
				}).catch((error)=>{
					toastr.error('Sorry Your Data Did not match','Login Failed!')
				})
			},
		},
	}
</script>