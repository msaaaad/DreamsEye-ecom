<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-logo col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary text-center">Manage Logo</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl. No</th>
                                <th>Thumbnail</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="logo,index in Logos">
                                <td>{{++index}}</td>
                                <td><img :src="fileLink(logo.logo_image)" height="65px" width="80px" alt=""></td>
                                <td>
                                	<span class="badge badge-success">Active</span>
                                	<!-- <span class="badge" :class="statusColor(logo.publication_status)">{{statusName(logo.publication_status)}}</span> -->
                                </td>
                                <td>
                                	<router-link :to="`/edit-logo/${logo.id}`" class="btn btn-success btn-sm" title="Edit Logo Image"><i class=" fab fa-chromecast"></i></router-link>
                                    <!-- <button type="button" class="btn btn-danger btn-sm" title="Delete Logo" @click="DeleteLogo(logo.id)"><i class="fas fa-trash-alt"></i></button> -->
                                    <!-- <button type="button" @click="PublishLogo(logo.id)" v-if="unpublishedLogo(logo.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(logo.publication_status)" :class="statusIconColor(logo.publication_status)"><i class="fas" :class="statusIcon(logo.publication_status)"></i></button>
                                    <button v-if="publishedLogo(logo.publication_status)" @click="UnublishLogo(logo.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(logo.publication_status)" :class="statusIconColor(logo.publication_status)"><i class="fas" :class="statusIcon(logo.publication_status)"></i></button> -->
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
				categoryIds : []
			}
		},
		// mounted diye action hit kore
		mounted(){
			this.$store.dispatch('getLogos');
		},
		computed:{
			Logos(){
				return this.$store.getters.logos;
			}
		},
		methods:{
			fileLink:function(name){
				return 'dreamsEye/public/uploads/logo/'+name;
			},
		}
	}
</script>