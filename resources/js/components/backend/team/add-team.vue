<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Add Team Member</h4>
                                <router-link to="/manage-team" class="ml-auto btn btn-outline-primary">Manage Team Member</router-link>
                            </div>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="addMember" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Member Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Member Name" type="text" v-model="form.member_name" class="form-control" :class="{ 'is-invalid': form.errors.has('member_name') }">
                                            <has-error :form="form" field="member_name"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Designation:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Designation Name" type="text" v-model="form.designation" class="form-control" :class="{ 'is-invalid': form.errors.has('designation') }">
                                            <has-error :form="form" field="designation"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Mobile Number:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="123xxxxxxx" type="text" v-model="form.mobile_number" class="form-control" :class="{ 'is-invalid': form.errors.has('mobile_number') }">
                                            <has-error :form="form" field="mobile_number"></has-error>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Email Address:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="example@email.com" type="email" v-model="form.email_address" class="form-control" :class="{ 'is-invalid': form.errors.has('email_address') }">
                                            <has-error :form="form" field="email_address"></has-error>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Address:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea placeholder="Enter Address" type="text" v-model="form.address" class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                            <has-error :form="form" field="address"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                    
                                <h4 class="text-center text-success">Socal Media Link:</h4>
                                <hr>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Facebook Profile:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.facebook_profile" :class="{'is-invalid':form.errors.has('facebook_profile')}" placeholder="Facebook grpup link" class="form-control">
                                            <has-error :form="form" field="facebook_profile"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Instagram Profile:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.instagram" :class="{'is-invalid':form.errors.has('instagram')}" placeholder=" instagram page link" class="form-control">
                                            <has-error :form="form" field="instagram"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Twitter Profile:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.twitter" :class="{'is-invalid':form.errors.has('twitter')}" placeholder="twitter page link" class="form-control">
                                            <has-error :form="form" field="twitter"></has-error>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="profile_picture">Profile Picture:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="profile_picture" id="profile_picture" @change="loadThumbnail($event)">
                                            <has-error :form="form" field="profile_picture"></has-error>
                                        </div>
                                        <div class="col-lg-4">
                                            <img :src="form.profile_picture" height="70px" width="85px" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Publication Status:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <span style="display: block;">
                                                <input type="radio" id="publication_status" value="1" v-model="form.publication_status" class="custom-radio"><label for="publication_status">Published</label>
                                            </span>
                                            <span>
                                                <input type="radio" id="unpublication_status" value="0" v-model="form.publication_status" class="custom-radio"><label for="unpublication_status">Unpublished</label>
                                            </span>
                                            <span :class="{ 'is-invalid': form.errors.has('publication_status') }"></span>
                                            <has-error :form="form" field="publication_status"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-8 offset-4">

                                        <input type="submit" value="Save Team Member Info" class="form-control btn btn-info text-white">
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
        name : "create",
        data: function(){
            return{
                form: new Form({
                    member_name:null,
                    designation:null,
                    mobile_number:null,
                    email_address:null,
                    address:null,
                    publication_status:1,
                    facebook_profile:'#',
                    instagram:'#',
                    twitter:'#',
                    profile_picture:null,

                })
            }
        },
        methods:{
            addMember:function(){
                this.form.post('/save-team').then((data)=>{
                        toastr.success('Member Added Successfully','Success!');
                    this.form.member_name=null;
                    this.form.designation=null;
                    this.form.mobile_number=null;
                    this.form.email_address=null;
                    this.form.address=null;
                    this.form.publication_status=1;
                    this.form.facebook_profile='#';
                    this.form.instagram='#';
                    this.form.twitter='#';
                    this.form.profile_picture=null;
                })
            },
            loadThumbnail:function(e){
                let file = e.target.files[0];
                // if(file.type==='image/jpg')
                let reader = new FileReader();
                reader.onload = e=>{
                    this.form.profile_picture=e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },
    }
</script>