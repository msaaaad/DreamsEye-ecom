<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <h5 class="card-header text-success text-center">Edit Category</h5>
                                                <div class="card-body">
                            <form @submit.prevent="updateCategory">
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
                                            <label for="category_image">Thumbnail:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="category_image" id="category_image" @change="loadThumbnail($event)">
                                            <has-error :form="form" field="category_image"></has-error>
                                        </div>
                                        <div class="col-lg-4">
                                            <img :src="fileLink(form.category_image)" height="70px" width="85px" alt="">
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

                                        <input type="submit" value="Update Category Info" class="form-control btn btn-info text-white">
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
        name : "update",
        data: function(){
            return{
                form: new Form({
                    id:null,
                    category_name:null,
                    category_image:null,
                    publication_status:1,
                })
            }
        },
        mounted(){
            this.getCategory();
        },
        methods:{
            updateCategory:function(){
                let this_=this;
                this.form.post('/update-category').then((response)=>{
                        toastr.success('Category Updated Successfully','Success!');
                        this_.$router.push('/manage-category');
                })
            },
            getCategory : function(){
                const this_=this;
                axios.get('/show-category/'+this.$route.params.slug).then((response)=>{
                    this_.form.fill(response.data.category)
                }).catch((error)=>{

                })
            },
            loadThumbnail:function(e){
                let file = e.target.files[0];
               
                let reader = new FileReader();
                reader.onload = e=>{
                    this.form.category_image=e.target.result;
                };
                reader.readAsDataURL(file);
            },

            fileLink:function(name){
                if (name !== null && name.length<256) {
                return 'dreamsEye/public/uploads/category/'+name;
            }
            else{
                return this.form.category_image;     
            }
            },
        },
    }
</script>