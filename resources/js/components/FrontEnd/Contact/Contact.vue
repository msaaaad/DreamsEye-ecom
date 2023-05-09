<template>
	<div>
		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1 class="text-success">Contact</h1>
				<span class="text-warning">Get in Touch with Us</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
					<li class="breadcrumb-item active" aria-current="page">Contact</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

<!-- Contact Section Begin -->
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="mt-5">
                        <h3 style="font-weight:700;margin-bottom:3px;color:#666600">Phone</h3>
                        <span style="display:block; color:#4d4d00">+88 {{contact.phone_number_1}}</span>
                        <span style="display:block; color:#4d4d00">+88 {{contact.phone_number_2}}</span>
                        <span style="display:block; color:#4d4d00">+88 {{contact.phone_number_3}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="mt-5">
                        <h3 style="font-weight:700;margin-bottom:3px;color:#666600">Address</h3>
                        <span style="display:inline-block; color:#4d4d00">{{about.address}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="mt-5">
                        <h3 style="font-weight:700;margin-bottom:3px;color:#666600">Open time</h3>
                        <span style="display:inline-block; color:#4d4d00">8:00 am to 10:00 pm</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="mt-5">
                        <h3 style="font-weight:700;margin-bottom:3px;color:#666600">Email</h3>
                        <span style="display:inline-block; color:#4d4d00">{{contact.email_address}}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- Contact Section End -->

		<!-- Google Map
		============================================= -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58346.98372959844!2d90.36870141820117!3d23.936153507469374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c5a6e6c02171%3A0x824025bd1e8a98f9!2sDreams%20Eye!5e0!3m2!1sen!2sbd!4v1617630944448!5m2!1sen!2sbd" width="600" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container">

					<div class="row gutter-40 col-mb-80 card">
						<!-- Postcontent
						============================================= -->
						<div class="postcontent col-lg-12">

							<h3 class="text-primary">Send us a message</h3>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" @submit.prevent="Contact">

									<div class="row">
										<div class="col-md-4 form-group">
											<label for="template-contactform-name">Name <small>*</small></label>
											<input placeholder="Enter Your Name" type="text" id="template-contactform-name"class="sm-form-control required" v-model="form.full_name" :class="{ 'is-invalid': form.errors.has('full_name') }"/>
                                            <has-error :form="form" field="full_name"></has-error>
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-email">Email <small>*</small></label>
											<input placeholder="example@email.com" type="email" id="template-contactform-email" class="required email sm-form-control"  v-model="form.email_address" :class="{ 'is-invalid': form.errors.has('email_address') }"/>
                                            <has-error :form="form" field="email_address"></has-error>
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-phone">Phone</label>
											<input placeholder="01xxxxxxxxx" type="text" id="template-contactform-phone" class="sm-form-control"  v-model="form.phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }"/>
                                            <has-error :form="form" field="phone_number"></has-error>
										</div>

										<div class="w-100"></div>

										<div class="col-md-8 form-group">
											<label for="template-contactform-subject">Subject <small>*</small></label>
											<input placeholder="Subject" type="text" id="template-contactform-subject" class="required sm-form-control"  v-model="form.subject" :class="{ 'is-invalid': form.errors.has('subject') }"/>
                                            <has-error :form="form" field="subject"></has-error>
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-service">Category</label>
											<select  v-model="form.category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" id="category_id">
                                                <option value="">-----Select Category-----
                                                </option>
                                                <option v-for="category in categories" :value="category.id">{{category.category_name}}</option>
                                            </select>
                                            <has-error :form="form" field="category_id"></has-error>
										</div>

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<label for="template-contactform-message">Message <small>*</small></label>
											<textarea placeholder="Your Message" class="required sm-form-control" id="template-contactform-message" rows="6" cols="30" v-model="form.message" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                                            <has-error :form="form" field="message"></has-error>
										</div>

										<div class="col-12 form-group">
											<button class="button button-3d m-0" type="submit" id="template-contactform-submit" value="submit">Send Message</button>
										</div>
									</div>

								</form>
							</div>

						</div><!-- .postcontent end -->
					</div>

				</div>
			</div>
		</section><!-- #content end -->
	</div>
</template>

<script>
	export default{
		name:'Contact',
		data:function(){
			return{
				form : new Form({
					'full_name':null,
					'email_address':null,
					'phone_number':null,
					'category_id':'',
					'subject':null,
					'message':null,
				}),
			}
		},
		mounted(){
			this.$store.dispatch('getFrontAbouts');
			this.$store.dispatch('getFrontContacts');
			this.$store.dispatch('getActiveCategories');
		},
		computed:{
			about(){
				return this.$store.getters.about;
			},
			contact(){
				return this.$store.getters.contact;
			},
			categories(){
				return this.$store.getters.categories;
			},
		},
		methods:{
			Contact:function(){
				this.form.post('/customer-contact').then((response)=>{
					toastr.success('Thank you for messaging us.We will reply you as soon as possible','Thank You');
					this.form.full_name = null;
					this.form.email_address = null;
					this.form.phone_number = null;
					this.form.category_id = null;
					this.form.subject = null;
					this.form.message = null;
				}).catch((error)=>{
					toastr.error('Something missing','Message Sending Failed!')
				})
			},
		},

	}
</script>