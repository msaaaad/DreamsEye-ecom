<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h4 class="text-primary text-left">Add Category Info</h4>
                                <router-link to="/manage-category" class="ml-auto btn btn-outline-primary">Manage Category Info</router-link>
                            </div>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="addCategory" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Category Name" type="text" name="category_name" v-model="form.category_name" class="form-control" :class="{ 'is-invalid': form.errors.has('category_name') }">
                                            <has-error :form="form" field="category_name"></has-error>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="category_image">Category Picture:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="category_image" id="category_image" @change="loadThumbnail($event)">
                                            <has-error :form="form" field="category_image"></has-error>
                                        </div>
                                        <div class="col-lg-4">
                                            <img :src="form.category_image" height="70px" width="85px" alt="">
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
                                                <input type="radio" id="publication_status" value="1" v-model="form.publication_status" checked class="custom-radio"><label for="publication_status">Published</label>
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

                                        <input type="submit" value="Save Category Info" class="form-control btn btn-info text-white">
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
                    category_name:null,
                    category_image:null,
                    publication_status:1,
                })
            }
        },
        methods:{
            addCategory:function(){
                let test = this;
                this.form.post('/save-category').then(function(data){
                       /*
                         Toast.fire({
                            icon: 'success',
                            title: 'Category Added successfully'
                    })
                        test.$router.push('/manage-category');
                        */
                        toastr.success('Category Added Successfully','Success!');
                        test.form.category_name = null;
                        test.form.category_image = null;
                }).catch((error)=>{
                    toastr.error('Please Add A photo','Error')
                })
            },
            loadThumbnail:function(e){
                let file = e.target.files[0];
                // if(file.type==='image/jpg')
                let reader = new FileReader();
                reader.onload = e=>{
                    this.form.category_image=e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },
    }
</script>