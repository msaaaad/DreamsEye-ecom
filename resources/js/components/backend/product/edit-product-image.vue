<template>
    <div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card mt-5">
                        <div class="card-header">
                            <span style="font-weight:700;font-sixe:20px" class="text-success text-center">Change Product image</span>
                        </div>
                        <div class="card-body">

                            <form @submit.prevent="editProductImage">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Product Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input disabled="" type="text" class="form-control" :value="product_name">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" :value="productId">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_image">Product Image:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="product_image[]" id="product_image uploadCaptureInputFile" @change="fieldChange" multiple>
                                            <div v-if="errors.product_image" class="alert alert-danger">
                                                {{errors.product_image}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <div class="col-8 offset-4">
                                        <input type="submit" value="Update Product Image" class="form-control btn btn-info text-white">
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
                length:'',
                product_name:null,
                productId:'',
                product_image:null,
                product_color:null,
                publication_status:1,
                category_id:'',
                subcategory_id:'',
                ultra_sub_category_id:'',
                product_price_regular:null,
                product_price_discount:'',
                product_quantity:1,
                short_description:null,
                long_description:null,
                inside_dhaka:75,
                outside_dhaka:130,
                user_name:'',
                subcats:[],
                superSubcats:[],
                attachments:[],
                imageForm : new FormData,
                errors :'',
            }
        },
        mounted(){
            this.productName();
        },
        methods:{
            productName(){
                axios.get('/get-product-name/'+this.$route.params.slug).then((response)=>{
                    this.product_name = response.data.product;
                    this.productId = response.data.productId;
                })
            },
            fieldChange(e){
                let selectedFiles = e.target.files;
                if (!selectedFiles.length) {
                    return false;
                }
                for(let i=0;i<selectedFiles.length;i++){
                    this.attachments.push(selectedFiles[i])
                }
            },
            editProductImage(e){
                for(let i=0;i<this.attachments.length;i++){
                this.imageForm.append('product_image[]',this.attachments[i]);
                }
                this.imageForm.append('product_name',this.product_name);
                this.imageForm.append('productId',this.productId);
                
                const config= {
           headers:{
                    "Content-Type": "multipart/form-data"
                   } 
                }
                axios.post('/update-product-image',this.imageForm,config).then((response)=>{
                        toastr.success('Product Info Added Successfully','Success!');
                        this.$router.push('/manage-my-product');
                    }).catch(error=>{
                        if(error.response.status){
                        this.errors = error.response.data.errors;
                    }
                        toastr.error('Please Check All Fields','ERROR!');
                         
                    });
            },
        },
    }
</script>
