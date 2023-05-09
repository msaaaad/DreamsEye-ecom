<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <h5 class="card-header text-success text-center">Add Contact Info</h5>                        <div class="card-body">
                            <form @submit.prevent="updateContact">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Phone Number 1:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.phone_number_1" :class="{'is-invalid':form.errors.has('phone_number_1')}" placeholder="0123xxxxxxxx" class="form-control">
                                            <has-error :form="form" field="phone_number_1"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Phone Number 2:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.phone_number_2" :class="{'is-invalid':form.errors.has('phone_number_2')}" placeholder="0123xxxxxxxx" class="form-control">
                                            <has-error :form="form" field="phone_number_2"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Phone Number 3:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.phone_number_3" :class="{'is-invalid':form.errors.has('phone_number_3')}" placeholder="0123xxxxxxxx" class="form-control">
                                            <has-error :form="form" field="phone_number_3"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Email Address:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.email_address" :class="{'is-invalid':form.errors.has('email_address')}" placeholder="example@email.com" class="form-control">
                                            <has-error :form="form" field="email_address"></has-error>
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
                                                <input type="radio" id="publication_status" name="publication_status" value="1" checked v-model="form.publication_status" class="custom-radio"><label for="publication_status">Published</label>
                                            </span>
                                            <span>
                                                <input type="radio" id="unpublication_status" name="publication_status" value="0" v-model="form.publication_status" class="custom-radio"><label for="unpublication_status">Unpublished</label>
                                            </span>
                                            <span :class="{ 'is-invalid': form.errors.has('publication_status') }"></span>
                                            <has-error :form="form" field="publication_status"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-8 offset-4">

                                        <input type="submit" value="Update Contact Info" class="form-control btn btn-info">
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
        name:"create",
        data:function(){
            return{
                form : new Form({
                    id :null,
                    phone_number_1:null,
                    phone_number_2:null,
                    phone_number_3:null,
                    email_address:null,
                    publication_status:1,
                })
            }
        },
        mounted(){
            this.getContact()
        },
        methods:{
            updateContact:function(){
                this.form.post('/update-contact').then((data)=>{
                    toastr.success('Contact Info Updated Successfully','Success!');
                    this.$router.push('/manage-contact');
                }).catch((errors)=>{
                    
                })
            },
            getContact : function(){
                axios.get('/show-contact/'+this.$route.params.slug).then((response)=>{
                    this.form.fill(response.data.contact)
                }).catch((error)=>{

                })
            },
        },
    }
</script>