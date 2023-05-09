<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-team col-12">
                <div class="card">
                    <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Manage Team Member</h4>
                                <router-link to="/add-team" class="ml-auto btn btn-outline-primary">Add Team Member</router-link>
                            </div>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th>Sl. No</th>
                                <th>Member Name</th>
                                <th>Designation</th>
                                <th>Mobile Number</th>
                                <th>Email Address</th>
                                <th>Address</th>
                                <th>Profile Picture</th>
                                <th>Facebook Profile</th>
                                <th>Instagram</th>
                                <th>Twitter</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="team,index in Teams">
                                <td>{{++index}}</td>
                                <td>{{team.member_name}}</td>
                                <td>{{team.designation}}</td>
                                <td>{{team.mobile_number}}</td>
                                <td>{{team.email_address}}</td>
                                <td>{{team.address}}</td>
                                <td><img :src="fileLink(team.profile_picture)" height="65px" width="80px" alt=""></td>
                                <td>{{team.facebook_profile}}</td>
                                <td>{{team.instagram}}</td>
                                <td>{{team.twitter}}</td>
                                <td><span class="badge" :class="statusColor(team.publication_status)">{{statusName(team.publication_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Team Info" @click="DeleteTeam(team.id)" :disabled="Chairman(team.designation)"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/edit-team/${team.slug}`" class="btn btn-success btn-sm" title="Edit Team Info"><i class=" fab fa-chromecast"></i></router-link>
                                    <button type="button" @click="PublishTeam(team.id)" v-if="unpublishedTeam(team.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(team.publication_status)" :class="statusIconColor(team.publication_status)"><i class="fas" :class="statusIcon(team.publication_status)"></i></button>
                                    <button v-if="publishedTeam(team.publication_status)" @click="UnublishTeam(team.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(team.publication_status)" :class="statusIconColor(team.publication_status)"><i class="fas" :class="statusIcon(team.publication_status)"></i></button>
                                </td>
                            </tr>
                            <tr v-if="emptyData()">
                            	<td colspan="10">
                            		<h4 class="text-center text-danger">Opps! Data Not Found</h4>
                            	</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>
</template>
<script>
	export default{
		name:'manage',
		data:function(){
			return{
				teamIds : []
			}
		},
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getTeams');
		},
		computed:{
			Teams(){
				return this.$store.getters.teams;
			}
		},
		methods:{
			PublishTeam(id){
				axios.get("publish-team/"+id).then((response)=>{
					toastr.success('Team Info Published Successfully','Success!');
					this.$store.dispatch('getTeams');
				}).catch((error)=>{

				})
			},
			UnublishTeam(id){
				let this_=this;
				axios.get("unpublish-team/"+id).then((response)=>{
					toastr.success('Team Info Unpublished Successfully','Success!');
					this.$store.dispatch('getTeams');
				}).catch((error)=>{

				})
			},
			Chairman(status){
				let data= {
					'CEO':true
				}
				return data[status];
			},
			statusName(status){
				let data= {
					0:'Unpublished',
					1:'Published',
				}
				return data[status];
			},
			unpublishedTeam(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedTeam(status){
				let data= {
					1:true
				}
				return data[status];
			},
			statusColor(status){
				let data= {
					0:'bg-warning',
					1:'bg-success',
				}
				return data[status];
			},
			statusIcon(status){
				let data= {
					0:'fa-arrow-up',
					1:'fa-arrow-down',
				}
				return data[status];
			},
			statusTitle(status){
				let data= {
					0:'Publish Team',
					1:'Unpublish Team',
				}
				return data[status];
			},
			statusIconColor(status){
				let data= {
					1:'bg-warning',
					0:'bg-info',
				}
				return data[status];
			},
			DeleteTeam(id){
				const swalWithBootstrapButtons = Swal.mixin({
		  customClass: {
		    confirmButton: 'btn btn-success',
		    cancelButton: 'btn btn-danger'
		  },
		  buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, cancel!',
		  reverseButtons: true
		}).then((result) => {
		  if (result.isConfirmed) {
		  	axios.get("delete-team/"+id).then((response)=>{
		       /* toastr.success('Team Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your team info has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getTeams');


		      }).catch((error)=>{

		      })
		   	/* 
		      */
		  } else if (
		    /* Read more team handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelled',
		      'Your team is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Teams.length<1);
			},
			fileLink:function(name){
				return 'dreamsEye/public/uploads/team/'+name;
			},
		}
	}
</script>