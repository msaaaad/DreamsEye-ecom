<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-vendor col-12">
                <div class="card">
                    <div class="card-header">
                    	<div class="row">
                        	<h4 class="text-primary text-left">Manage Vendor</h4>
								<input type="text" id="Form_Search" class="ml-auto" v-model="form.name" v-on:keyup="getValue" placeholder="Search Vendor">
								<!-- <div class="panel-footer" v-if="SearchResults.length" style="position:absolute;z-index:1000;border:1px solid #ccc;background:#fff;">
									<p v-for="result in SearchResults" style="color:red">
										{{result.first_name+result.last_name}}
									</p>
								</div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th>Sl. No</th>
                                <th>Vendor Name</th>
                                <th>Vendor Email</th>
                                <th>Vendor Phone No</th>
                                <th>Vendor Profile Picture</th>
                                <th>Vendor Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-if="SearchResults.length" v-for="vendor,index in SearchResults">
                                <td>{{++index}}</td>
                                <td>{{vendor.first_name+' '+vendor.last_name}}</td>
                                <td>{{vendor.email_address}}</td>
                                <td>{{vendor.phone_number}}</td>
                                <td><img :src="fileLink(vendor.profile_picture)" height="65px" width="80px" alt=""></td>
                                <td><span class="badge" :class="statusColor(vendor.publication_status)">{{statusName(vendor.publication_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Customer Info" @click="DeleteVendor(vendor.id)"><i class="fas fa-trash-alt"></i></button>
                                    <button type="button" @click="PublishVendor(vendor.id)" v-if="unpublishedVendor(vendor.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(vendor.publication_status)" :class="statusIconColor(vendor.publication_status)">Approve</button>
                                    <button disabled="" v-if="publishedVendor(vendor.publication_status)" @click="UnublishVendor(vendor.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(vendor.publication_status)" :class="statusIconColor(vendor.publication_status)">Approved</button>
                                </td>
                            </tr>

                            <tr v-if="!SearchResults.length" v-for="vendor,index in Vendors.data">
                                <td>{{++index}}</td>
                                <td>{{vendor.first_name+' '+vendor.last_name}}</td>
                                <td>{{vendor.email_address}}</td>
                                <td>{{vendor.phone_number}}</td>
                                <td><img :src="fileLink(vendor.profile_picture)" height="65px" width="80px" alt=""></td>
                                <td><span class="badge" :class="statusColor(vendor.publication_status)">{{statusName(vendor.publication_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Customer Info" @click="DeleteVendor(vendor.id)"><i class="fas fa-trash-alt"></i></button>
                                    <button type="button" @click="PublishVendor(vendor.id)" v-if="unpublishedVendor(vendor.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(vendor.publication_status)" :class="statusIconColor(vendor.publication_status)">Approve</button>
                                    <button disabled="" v-if="publishedVendor(vendor.publication_status)" @click="UnublishVendor(vendor.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(vendor.publication_status)" :class="statusIconColor(vendor.publication_status)">Approved</button>
                                </td>
                            </tr>
                            <tr v-if="emptyData()">
                            	<td colspan="10">
                            		<h4 class="text-center text-danger">Opps! Data Not Found</h4>
                            	</td>
                            </tr>
                        </table>
                        <pagination size="small" :data="Vendors" align="center" @pagination-change-page="getResults">
							<span slot="prev-nav">&lt; Previous</span>
							<span slot="next-nav">Next &gt;</span>
						</pagination>
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
				vendorIds : [],
				Vendors:{},
				SearchResults:{},
				form:new Form({
					name:null
				})
			}
		},
		// mounted diye action hit kore
		mounted(){
		this.getResults();
			// this.$store.dispatch('getCustomers');
		},
		// computed:{
		// 	Vendors(){
		// 		return this.$store.getters.customers;
		// 	}
		// },
		methods:{
			getValue(){
				this.form.post('/get-search-customer').then((response)=>{
					// console.log(response.data.getResultVal);
					this.SearchResults = response.data.getResultVal;

				})
			},
			getResults(page = 1) {
			axios.get('get-customer?page=' + page)
				.then(response => {
					this.Vendors = response.data.customers;
				});
		},
			PublishVendor(id){
				// axios.get("publish-vendor/"+id).then((response)=>{
				// 	toastr.success('Vendor Info Published Successfully','Success!');
				// 	this.$store.dispatch('getCustomers');
				// }).catch((error)=>{

				// })
				const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "This person should be Approved!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Approve him/her!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {

		axios.get("publish-vendor/"+id).then((response)=>{
					swalWithBootstrapButtons.fire(
      'Success!',
      'New Vendor Added',
      'success'
    )
					this.$store.dispatch('getCustomers');
				}).catch((error)=>{

				})

    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your guy is not a vendor :)',
      'error'
    )
  }
})
			},
			UnublishVendor(id){
				const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "This person should not be a Approved!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Demote him/her to Customer!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {

		axios.get("unpublish-vendor/"+id).then((response)=>{
					swalWithBootstrapButtons.fire(
      'Success!',
      'Approved customer becomes just a customer',
      'success'
    )
					this.$store.dispatch('getCustomers');
				}).catch((error)=>{

				})

    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your guy is not demoted :)',
      'error'
    )
  }
})
			},
			statusName(status){
				let data= {
					0:'Not Approved',
					1:'Approved',
				}
				return data[status];
			},
			unpublishedVendor(status){
				let data= {
					0:true
				}
				return data[status];
			},
			publishedVendor(status){
				let data= {
					1:true
				}
				return data[status];
			},
			statusColor(status){
				let data= {
					0:'bg-danger',
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
					0:'Publish Vendor',
					1:'Unpublish Vendor',
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
			DeleteVendor(id){
				const swalWithBootstrapButtons = Swal.mixin({
		  customClass: {
		    confirmButton: 'btn btn-success',
		    cancelButton: 'btn btn-danger'
		  },
		  buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
		  title: 'Are you sure to delete customer Info?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, cancel!',
		  reverseButtons: true
		}).then((result) => {
		  if (result.isConfirmed) {
		  	axios.get("delete-vendor/"+id).then((response)=>{
		       /* toastr.success('Vendor Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your Customer Info has been deleted.',
		      'success'
		    )
					this.$store.dispatch('getCustomers');


		      }).catch((error)=>{

		      })
		   	/* 
		      */
		  } else if (
		    /* Read more about handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelled',
		      'Your Customer is safe :)',
		      'error'
		    )
		  }
		})
			
			},
			emptyData(){
				return (this.Vendors.length<1);
			},
			fileLink:function(name){
				return 'dreamsEye/public/uploads/customer/'+name;
			},

		}
	}
</script>