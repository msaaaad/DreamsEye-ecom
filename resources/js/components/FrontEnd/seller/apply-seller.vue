<template>
	<div class="mt-5">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <h4 class="card-header text-success text-center">Add Company Info</h4>
                        <div class="card-body">
                            <form @submit.prevent="SaveCompanyInfo" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Company Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Company Name" type="text" name="company_name" v-model="form.company_name" class="form-control" v-on:keyup="getValue(form.company_name)" :class="{ 'is-invalid': form.errors.has('company_name') }">
                                            <has-error :form="form" field="company_name"></has-error>

                                            <div v-if="length==1" class="text-danger">Name already exists*</div>
                                            <div v-if="length==0 && form.company_name" class="text-success">Name available</div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" v-model="form.customerId">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Billing Address:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea placeholder="Enter Billing Address" v-model="form.bill_address" class="form-control" :class="{ 'is-invalid': form.errors.has('bill_address') }"></textarea>
                                            <has-error :form="form" field="bill_address"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Emergency Contact No:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="01*********" type="text" v-model="form.emergency_contact" class="form-control" :class="{ 'is-invalid': form.errors.has('emergency_contact') }">
                                            <has-error :form="form" field="emergency_contact"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="certificate">Tin Certificate:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="certificate" id="certificate" @change="loadThumbnail($event)">
                                            <has-error :form="form" field="certificate"></has-error>
                                        </div>
                                        <div class="col-lg-4">
                                            <img :src="form.certificate" height="70px" width="85px" alt="">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="category_image">Trade License/National Id/Passport:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="varification" id="varification" @change="loadThumbnail2($event)">
                                            <has-error :form="form" field="varification"></has-error>
                                        </div>
                                        <div class="col-lg-4">
                                            <img :src="form.varification" height="70px" width="85px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-8 offset-4">
                                        <p v-if="compId.length>=1" class="text-danger">You can update your company info only one time*</p>
                                        <input :disabled="compId.length>=1" type="submit" value="Submit Shop Info" class="form-control btn btn-info text-white">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>
<script>
	export default{
		name:"Apply",
        data: function(){
            return{
            	length:'',
                cusId:'',
                compId:'',
                form: new Form({
                    company_name:null,
                    bill_address:null,
                    certificate:null,
                    varification:null,
                    customerId:'',
                    emergency_contact:null,
                })
            }
        },
        mounted(){

            this.getCustomer();
            this.getCompany();
        },
        methods:{
        	SaveCompanyInfo(){
        		this.form.post('/save-company').then((response)=>{
        			toastr.success('Company Info Sent to the Admin','Success!');
        			this.$router.push('/account');
        		}).catch((error)=>{
        			console.log(error);
        			toastr.error('Please Provide Valid Information or Your Image is not Correct','Opps!');
        		})
        	},
        	getCustomer(){
        		axios.get('/get-some').then((response)=>{
        			this.form.customerId = response.data.cus;
                    this.cusId = response.data.cus;
        		});
        	},
            getCompany(){
                axios.get('/get-comp').then((response)=>{
                    this.compId = response.data.comp;
                });
            },
            loadThumbnail:function(e){
                let file = e.target.files[0];
                // if(file.type==='image/jpg')
                let reader = new FileReader();
                reader.onload = e=>{
                    this.form.certificate=e.target.result;
                };
                reader.readAsDataURL(file);
            },
            loadThumbnail2:function(e){
                let file = e.target.files[0];
                // if(file.type==='image/jpg')
                let reader = new FileReader();
                reader.onload = e=>{
                    this.form.varification=e.target.result;
                };
                reader.readAsDataURL(file);
            },
            getValue(name){
                axios.post('/get-company-name/'+name).then((response)=>{
                    this.length = response.data.company.length;
                })
            },
        },
	}
</script>