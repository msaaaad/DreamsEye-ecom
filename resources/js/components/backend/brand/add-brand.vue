<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <h5 class="card-header text-success text-center">Add Brand</h5>                        <div class="card-body">
                            <form @submit.prevent="addBrand">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Brand Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="brand_name" v-model="form.brand_name" :class="{'is-invalid':form.errors.has('brand_name')}" placeholder="Enter Brand Name" class="form-control">
                                            <has-error :form="form" field="brand_name"></has-error>
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

                                        <input type="submit" value="Save Brand Info" class="form-control btn btn-info">
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
                    name:null,
                    publication_status:1,
                })
            }
        },
        methods:{
            addBrand:function(){
                let this_=this;
                this.form.post('/save-brand').then((data)=>{
                    toastr.success('Brand Info Added Successfully','Success!');
                    this_.form.brand_name=null;
                })
            }
        },
    }
</script>