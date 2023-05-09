<template>
	<div id="top-account">
		<router-link to="/" v-if="login!=null" v-on:click.native="LogOut" data-lightbox="inline" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary font-weight-medium" style="color: #1ABC9C;">Log Out</span></router-link>
		<router-link to="/login" v-if="login==null" data-lightbox="inline" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary font-weight-medium" style="color: #1ABC9C;">Login</span></router-link>
	</div>
</template>
<script>
	export default{
		name:"customer-login",
		data: function(){
            return{
            	login:'',
            }
        },
        mounted(){
            this.customerLoggedIn();
        },
		methods:{
            customerLoggedIn(){
            	axios.get('/customer-logged-in').then((response)=>{
            		this.login = response.data.login;
            	})
            },
            LogOut(){
            	axios.get('/customer-logout-vue').then((response)=>{
					toastr.error('Log Out Successful','LogOut!');
            	})
            },
		}
	}
</script>