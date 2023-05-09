<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Add About Info</h4>
                                <router-link to="/manage-about" class="ml-auto btn btn-outline-primary">Manage About Info</router-link>
                            </div>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="addAbout">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Who We Are:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea type="text" v-model="form.about_us" :class="{'is-invalid':form.errors.has('about_us')}" placeholder="Who We Are" class="form-control"></textarea>
                                            <has-error :form="form" field="about_us"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Why Choice Us:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea type="text" v-model="form.choice_us" :class="{'is-invalid':form.errors.has('choice_us')}" placeholder="Why Choice Us" class="form-control"></textarea>
                                            <has-error :form="form" field="choice_us"></has-error>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Our Address:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea type="text" v-model="form.address" :class="{'is-invalid':form.errors.has('address')}" placeholder="Our Address" class="form-control"></textarea>
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
                                            <label for="name">Facebook Page:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.facebook_page" :class="{'is-invalid':form.errors.has('facebook_page')}" placeholder="facebook page link" class="form-control">
                                            <has-error :form="form" field="facebook_page"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Facebook Group:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" value="#" v-model="form.facebook_group" :class="{'is-invalid':form.errors.has('facebook_group')}" placeholder="Facebook grpup link" class="form-control">
                                            <has-error :form="form" field="facebook_group"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Instagram Page:</label>
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
                                            <label for="name">Twitter Page:</label>
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

                                        <input type="submit" value="Save About Info" class="form-control btn btn-info">
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
                    about_us:null,
                    choice_us:null,
                    address:null,
                    publication_status:1,
                    facebook_page:'#',
                    facebook_group:'#',
                    instagram:'#',
                    twitter:'#',
                })
            }
        },
        methods:{
            addAbout:function(){
                let this_=this;
                this.form.post('/save-about').then((data)=>{
                    toastr.success('About Info Added Successfully','Success!');
                    this_.form.about_us=null;
                    this_.form.choice_us=null;
                    this_.form.address=null;
                    this_.form.facebook_page='#';
                    this_.form.facebook_group='#';
                    this_.form.instagram='#';
                    this_.form.twitter='#';
                }).catch((errors)=>{
                    
                })
            }
        },
    }
</script>