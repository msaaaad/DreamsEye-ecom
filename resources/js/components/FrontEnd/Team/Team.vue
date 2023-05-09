<template>
	<div>
		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1 class="text-success">Team</h1>
				<span style="font-weight:500" class="text-warning">List of People who matter in Our Company</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Team</li>
				</ol>
			</div>

		</section><!-- #page-title end -->
		<br>
					<div class="row justify-content-center mb-0">

						<div class="col-sm-6 col-lg-4">
								<div class="team-image" style="height:300px;width150px">
									<img height="100%" style="border-radius:20px;" width="100%" :src="'dreamsEye/public/uploads/team/'+ceo.profile_picture" alt="ceo.member_name">
								</div>
								<div class="team-desc">
									<div class="team-title"><h4 style="color:#666600">{{ceo.member_name}}</h4><span style="color: #4d4d00">{{ceo.designation}}</span></div>
									<span style="display:block;color: #4d4d00">Phone: {{ceo.mobile_number}}</span>
									<span style="display:block;color: #4d4d00">Email: {{ceo.email_address}}</span>
									<span style="display:block;color: #4d4d00">Address: {{ceo.address}}</span>
									<a :href="ceo.facebook_profile" class="social-icon inline-block si-small si-light si-rounded si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a :href="ceo.twitter" class="social-icon inline-block si-small si-light si-rounded si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a :href="ceo.instagram" class="social-icon inline-block si-small si-light si-rounded si-instagram">
										<i class="icon-instagram"></i>
										<i class="icon-instagram"></i>
									</a>
								</div>
						</div>
					</div>
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="fancy-title title-border">
						<h3 style="color:#999900">Team Members</h3>
					</div>

					<div class="row justify-content-center col-mb-50 mb-0">
						<div class="col-sm-6 col-lg-4" v-for="team in teams">
							<div class="team">
								<div class="team-image"  style="height:300px;width150px">
									<img  height="100%" width="100%" :src="'dreamsEye/public/uploads/team/'+team.profile_picture"  alt="team.member_name">
								</div>
								<div class="team-desc">
									<div class="team-title"><h4 style="color:#666600">{{team.member_name}}</h4><span style="color:#4d4d00;font-weight:500">{{team.designation}}</span></div>
									<span style="display:block;color: #4d4d00">Phone: {{team.mobile_number}}</span>
									<span style="display:block;color: #4d4d00">Email: {{team.email_address}}</span>
									<span style="display:block;color: #4d4d00">Address: {{team.address}}</span>
									<a :href="team.facebook_profile" class="social-icon inline-block si-small si-light si-rounded si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a :href="team.twitter" class="social-icon inline-block si-small si-light si-rounded si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a :href="team.instagram" class="social-icon inline-block si-small si-light si-rounded si-instagram">
										<i class="icon-instagram"></i>
										<i class="icon-instagram"></i>
									</a>
								</div>
							</div>
						</div>

						
					</div>
				</div>
			</div>
		</section>
	</div>
</template>
<script>
	export default{
		name:'Team',
		mounted(){
			this.$store.dispatch('getFrontTeams');
			this.$store.dispatch('getCeo');
		},
		computed:{
			teams(){
				return this.$store.getters.teams;
			},
			ceo(){
				return this.$store.getters.ceo;
			},
		}
	}
</script>