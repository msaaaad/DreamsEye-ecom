<template>
	<div class="">
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row clearfix">

						<div class="col-md-9">

							<img :src="fileLink(customer.profile_picture)" class="alignleft img-circle img-thumbnail my-0" alt="Avatar" style="max-width: 200px;">

							<div class="heading-block border-0">
								<h3>{{customer.first_name+' '+customer.last_name}}</h3>
							</div>

							<div class="clear"></div>

							<div class="row clearfix">

								<div class="col-lg-12">

									<div class="tabs tabs-alt clearfix" id="tabs-profile">

										<ul class="tab-nav clearfix">
											<li><a href="#"><i class="icon-rss2"></i> My Bio</a></li>
											<li><router-link :to="`/edit-bio/${customer.slug}`"><i class="icon-pencil2"></i> Edit Bio</router-link></li>
											<li v-if="vendor(customer.publication_status) && company==0"><router-link :to="`/apply-seller/${customer.slug}`" class="text-success"><i class="icon-reply"></i>Be A Seller<span class="text-success">(Apply Now*)</span></router-link></li>
											<li v-if="company!=0"><router-link :to="`/add-product/${customer.slug}`" class="text-success"><i class="icon-reply"></i> Switch to Selling</router-link></li>
											<li v-if="company!=0"><router-link :to="`/manage-product/${customer.slug}/${customer.id}`" class="text-primary"><i class="icon-reply"></i> My Products</router-link></li>
										</ul>

										<div class="tab-container">

											<div class="tab-content clearfix" id="tab-feeds">

												<table class="table table-bordered table-striped">
												  <thead>
													<tr>
													  <th>Name</th>
													  <th>Info</th>
													</tr>
												  </thead>
												  <tbody>
													<tr>
													  <td>
														<code>Name</code>
													  </td>
													  <td>{{customer.first_name+' '+customer.last_name}}</td>
													</tr>
													<tr>
													  <td>
														<code>Email</code>
													  </td>
													  <td>{{customer.email_address}}</td>
													</tr>
													<tr>
													  <td>
														<code>Phone Number</code>
													  </td>
													  <td>{{customer.phone_number}}</td>
													</tr>
													<tr>
													  <td>
														<code>Region</code>
													  </td>
													  <td>{{customer.region}}</td>
													</tr>
													<tr>
													  <td>
														<code>Address</code>
													  </td>
													  <td>{{customer.address}}</td>
													</tr>
												  </tbody>
												</table>

											</div>
											

										</div>

									</div>

								</div>

							</div>

						</div>

						<div class="w-100 line d-block d-md-none"></div>

						<div class="col-md-3">

							<div class="list-group">
								<router-link to="/account" class="list-group-item list-group-item-action d-flex justify-content-between"><div>Profile</div><i class="icon-user"></i></router-link>
								<!-- <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between"><div>Messages</div><i class="icon-envelope2"></i></a> -->
								<router-link to="/contact" class="list-group-item list-group-item-action d-flex justify-content-between"><div>Contact</div><i class="icon-envelope2"></i></router-link>
								<router-link to="/" class="list-group-item list-group-item-action d-flex justify-content-between"><div>Browse Products</div></router-link>
							</div>

							<div class="fancy-title topmargin title-border">
								<h4>About Me</h4>
							</div>

							<p>I am <b>{{customer.first_name+' '+customer.last_name}}<br></b>.My address is: <b>{{customer.address}}</b></p>

						</div>

					</div>

				</div>
			</div>
		</section><!-- #content end -->
	</div>
</template>
<script>
	export default{
		name:"Account",
		data(){
			return{
				company_status:'',
			}
		},
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getCustomers');
			this.$store.dispatch('getCompanyStatus');
		},
		computed:{
			customer(){
				return this.$store.getters.customer;
			},
			company(){
				return this.$store.getters.companyStatus;
			}
		},
		methods:{
			vendor:function(status){
				let data = {
					1:true
				}
				return data[status];
			},

			fileLink:function(name){
				return 'dreamsEye/public/uploads/customer/'+name;
			},
		}
	}
</script>