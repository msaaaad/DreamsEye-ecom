<template>
	<div>
		<div class="container">
        <div class="row">
            
            <div class="col-lg-6" style="margin-top: 50px;margin:auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header text-success text-center">Enter Varification Code</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="Verify">
                            <div class="form-group">
                                <p>Enter 6 Digit Code:</p>
                                <input type="number" v-model="form2.varification_code" placeholder="Enter Code" class="form-control" :class="{ 'is-invalid': form2.errors.has('varification_code') }">
                                            <has-error :form="form2" field="varification_code"></has-error>

                            </div>
                            <div class="form-group mt-5">
                                <input type="submit" value="Submit" name="btn" class="form-control btn btn-info">
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
		name:'Verify',
		data:function(){
			return{
				
				form2 : new Form({
					'varification_code':null,
				})
			}
		},
		methods:{
			Verify:function(){
				this.form2.post('/check-code').then((response)=>{
					toastr.success('Verification Successful','Success!');
                    this.$router.push('/reset-password');
                    
				}).catch((error)=>{
					toastr.error('Sorry Your Data Did not match','Verification Failed!')
				})
			},
		},
	}
</script>