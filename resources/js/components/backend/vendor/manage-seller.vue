<template>
	<div class="">
		<div class="container">
        <div class="row">
            <div class="manage-company col-12">
                <div class="card">
                    <div class="card-header">
                    	<div class="row">
                        	<h4 class="text-primary text-left">Manage Company</h4>
								<input type="text" id="Form_Search" class="ml-auto" v-model="form.name" v-on:keyup="getValue" placeholder="Search Company">
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
                                <th>Company Name</th>
                                <th>Seller Name</th>
                                <th>Billing Address</th>
                                <th>Emergency Phone No</th>
                                <th>Tin certificate</th>
                                <th>National Id/Passport/Trade License</th>
                                <th>Company Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-if="SearchResults.length" v-for="company,index in SearchResults">
                                <td>{{++index}}</td>
                                <td>{{company.company_name}}</td>
                                <td>{{company.customer.first_name+' '+company.customer.last_name}}</td>
                                <td>{{company.bill_address}}</td>
                                <td>{{company.emergency_contact}}</td>
                                <td><img :src="fileLink(company.tin_certificate)" height="65px" width="80px" alt=""></td>
                                <td><img :src="fileLink(company.varification)" height="65px" width="80px" alt=""></td>
                                <td><span class="badge" :class="statusColor(company.seller_status)">{{statusName(company.seller_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Customer Info" @click="DeleteVendor(company.id)"><i class="fas fa-trash-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-success" title="View Information">View Info</button>
                                    <button type="button" @click="PublishVendor(company.id)" v-if="unpublishedVendor(company.seller_status)" class="btn btn-sm" v-bind:title="statusTitle(company.seller_status)" :class="statusIconColor(company.seller_status)">Make Seller</button>
                                    <button v-if="publishedVendor(company.seller_status)" @click="UnublishVendor(company.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(company.seller_status)" :class="statusIconColor(company.seller_status)">Demote to Customer</button>
                                </td>
                            </tr>

                            <tr v-if="!SearchResults.length" v-for="company,index in Companies.data">
                                <td>{{++index}}</td>
                                <td>{{company.company_name}}</td>
                                <td>{{company.customer.first_name+' '+company.customer.last_name}}</td>
                                <td>{{company.bill_address}}</td>
                                <td>{{company.emergency_contact}}</td>
                                <td><img :src="fileLink(company.tin_certificate)" height="65px" width="80px" alt=""></td>
                                <td><img :src="fileLink(company.varification)" height="65px" width="80px" alt=""></td>
                                <td><span class="badge" :class="statusColor(company.seller_status)">{{statusName(company.seller_status)}}</span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Customer Info" @click="DeleteVendor(company.id)"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/view-info/${company.id}`" type="button" class="btn btn-sm btn-success" title="View Information">View Info</router-link>
                                    <button type="button" @click="PublishVendor(company.id)" v-if="unpublishedVendor(company.seller_status)" class="btn btn-sm" v-bind:title="statusTitle(company.seller_status)" :class="statusIconColor(company.seller_status)">Make Seller</button>
                                    <button v-if="publishedVendor(company.seller_status)" @click="UnublishVendor(company.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(company.seller_status)" :class="statusIconColor(company.seller_status)">Demote to Customer</button>
                                </td>
                            </tr>
                            <tr v-if="emptyData()">
                            	<td colspan="10">
                            		<h4 class="text-center text-danger">Opps! Data Not Found</h4>
                            	</td>
                            </tr>
                        </table>
                        <pagination size="small" :data="Companies" align="center" @pagination-change-page="getResults">
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
				companyIds : [],
				Companies:{},
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
		methods:{
			getValue(){
				this.form.post('/get-search-company').then((response)=>{
					// console.log(response.data.getResultVal);
					this.SearchResults = response.data.getResultVal;

				})
			},
			getResults(page = 1) {
			axios.get('get-company?page=' + page)
				.then(response => {
					this.Companies = response.data.company;
				});
		},
			PublishVendor(id){
				// axios.get("publish-company/"+id).then((response)=>{
				// 	toastr.success('Company Info Published Successfully','Success!');
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
  text: "This person should be a Seller!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Make him/her Seller!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {

		axios.get("publish-company/"+id).then((response)=>{
					swalWithBootstrapButtons.fire(
      'Success!',
      'New Seller Added',
      'success'
    )
					this.getResults();
				}).catch((error)=>{

				})

    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your company is not a Seller :)',
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
  text: "This Company should not be a Seller!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Demote Company to Customer!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {

		axios.get("unpublish-company/"+id).then((response)=>{
					swalWithBootstrapButtons.fire(
      'Success!',
      'Company becomes just a customer',
      'success'
    )
					this.getResults();
				}).catch((error)=>{

				})

    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your company is not demoted :)',
      'error'
    )
  }
})
			},
			statusName(status){
				let data= {
					0:'Customer',
					1:'Seller',
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
					0:'Publish Company',
					1:'Unpublish Company',
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
		  	axios.get("delete-company/"+id).then((response)=>{
		       /* toastr.success('Company Deleted Successfully','Success!');*/
		       swalWithBootstrapButtons.fire(
		      'Deleted!',
		      'Your Customer Info has been deleted.',
		      'success'
		    )
					this.getResults();


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
				return (this.Companies.length<1);
			},
			fileLink:function(name){
				return 'dreamsEye/public/uploads/company/'+name;
			},

		}
	}
</script>