<template>
	<div>
		<div class="container">
        <div class="row">
            
            <div class="col-lg-6" style="margin-top: 50px;margin:auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header text-success text-center">Reser Yout Password</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="ResetPassword">
                            <div class="form-group">
                                <input type="email" :value="Email" class="form-control" disabled="">

                            </div>

                            <div class="form-group">
                                <label>New Password:</label>
                                <input v-model="form2.new_password" placeholder="New Password***"  type="password" class="form-control" :class="{ 'is-invalid': form2.errors.has('new_password') }">
                                            <has-error :form="form2" field="new_password"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Confirm New Password:</label>
                                <input v-model="form2.confirm_new_password" placeholder="Confirm New Password***"  type="password" class="form-control" :class="{ 'is-invalid': form2.errors.has('confirm_new_password') }">
                                            <has-error :form="form2" field="confirm_new_password"></has-error>
                            </div>
                            <div class="form-group mt-5">
                                <input type="submit" value="Reset Password" name="btn" class="form-control btn btn-info">
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
                email:'',
				
				form2 : new Form({
					'new_password':null,
                    'confirm_new_password':null,
				})
			}
		},
        mounted(){
            this.$store.dispatch('getVarify');
        },
		methods:{
			ResetPassword:function(){
				this.form2.post('/reset-pass').then((response)=>{
					toastr.success('Password Reset Successful','Success!');
                    
                     this.$router.push('/login');
				}).catch((error)=>{
					toastr.error('Sorry Password Did not match','Login Failed!')
				})
			},
		},
        computed:{
            Email(){
                return this.$store.getters.very;
            },
        }
	}
</script>