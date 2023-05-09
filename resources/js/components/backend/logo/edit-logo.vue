<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <h5 class="card-header text-success text-center">Edit Logo Image</h5>
                                                <div class="card-body">
                            <form @submit.prevent="updateLogo" enctype="multipart/form-data">


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="logo_image">Logo Image:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="logo_image" id="logo_image" @change="loadThumbnail($event)">
                                            <has-error :form="form" field="logo_image"></has-error>
                                        </div>
                                        <div class="col-lg-4">
                                            <img :src="fileLink(form.logo_image)" height="70px" width="85px" alt="">
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
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
                                </div> -->
                                <div class="form-group">
                                    <div class="col-8 offset-4">

                                        <input type="submit" value="Update Logo Image" class="form-control btn btn-info text-white">
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
        name : "edit",
        data: function(){
            return{
                form: new Form({
                    id:null,
                    logo_image:null,
                    publication_status:1,
                })
            }
        },
        mounted(){
        	this.getLogo();
        },
        methods:{
            updateLogo:function(){
                this.form.post('/update-logo').then((data)=>{
                       /*
                         Toast.fire({
                            icon: 'success',
                            title: 'Category Added successfully'
                    })
                        test.$router.push('/manage-category');
                        */
                        toastr.success('Logo Image Added Successfully','Success!');
                        this.$router.push('/manage-logo');
                })
            },
            getLogo : function(){
                axios.get('/show-logo/'+this.$route.params.id).then((response)=>{
                    this.form.fill(response.data.logo)
                }).catch((error)=>{

                })
            },
            loadThumbnail:function(e){
                let file = e.target.files[0];
                // if(file.type==='image/jpg')
                let reader = new FileReader();
                reader.onload = e=>{
                    this.form.logo_image=e.target.result;
                };
                reader.readAsDataURL(file);
            },

            fileLink:function(name){
                if (name !== null && name.length<256) {
                return 'dreamsEye/public/uploads/logo/'+name;
            }
            else{
                return this.form.logo_image;     
            }
            },
        },
    }
</script>