<template>
    <div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card mt-5">
                        <div class="card-header">
                            <span style="font-weight:700;font-sixe:20px" class="text-success text-left">Add Product</span>
                            <router-link :to="`/manage-product/${customer.slug}/${customer.id}`" style="font-weight:700;font-sixe:20px" class="float-right btn btn-outline-primary">My Products</router-link>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="addProduct">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="category_id">Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="category_id" class="form-control"  id="category_id" @change="loadCategory">
                                                <option value="">-----Select Category-----
                                                </option>
                                                <option v-for="category in Categories" :value="category.id">{{category.category_name}}</option>
                                            </select>
                                            <div v-if="errors && errors.category_id" class="alert alert-danger">
                                                {{errors.category_id[0]}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="subcategory_id">Sub Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="subcategory_id" class="form-control"  id="subcategory_id" @change="loadSubCategory">
                                                <option value="">-----Select SubCategory-----
                                                </option>
                                                <option v-for='subCategory in subcats' :value="subCategory.id">{{subCategory.subcategory_name}}</option>
                                            </select>
                                            <div v-if="errors.subcategory_id" class="alert alert-danger">
                                                {{errors.subcategory_id}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="ultra_sub_category_id">Super Sub Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="ultra_sub_category_id" class="form-control"  id="ultra_sub_category_id" >
                                                <option value="">-----Select SubCategory of SubCategory-----
                                                </option>
                                                <option v-for='superSub in superSubcats' :value="superSub.id">{{superSub.ultra_sub_category_name}}</option>
                                            </select>
                                            <div v-if="errors.ultra_sub_category_id" class="alert alert-danger">
                                                {{errors.ultra_sub_category_id}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Product Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Product Name" type="text" v-model="product_name" class="form-control"   v-on:keyup="getValue(product_name)">
                                            <div v-if="errors.product_name" class="alert alert-danger">
                                                {{errors.product_name}}
                                            </div>
                                            <div v-if="length==1" class="text-danger">Name already exists*</div>
                                            <div v-if="length==0 && product_name" class="text-success">Name available</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_color">Product Colour:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Product Colour" type="text" v-model="product_color" class="form-control" >
                                            <div v-if="errors.product_color" class="alert alert-danger">
                                                {{errors.product_color}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_price_regular">Product Price(Regular):</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Regular Price" type="Number" v-model="product_price_regular" class="form-control" >
                                            <div v-if="errors.product_price_regular" class="alert alert-danger">
                                                {{errors.product_price_regular}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_price_discount">Product Price(Discount):</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Discount Price" type="Number" v-model="product_price_discount" class="form-control" >
                                            <div v-if="errors.product_price_discount" class="alert alert-danger">
                                                {{errors.product_price_discount}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_quantity">Product Quantity:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Product Quantity" type="Number" v-model="product_quantity" class="form-control" >
                                            <div v-if="errors.product_quantity" class="alert alert-danger">
                                                {{errors.product_quantity}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" v-model="user_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="short_description">Short Description:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" v-model="short_description" placeholder="Write At least 20 letter"></textarea>
                                            <div v-if="errors.short_description" class="alert alert-danger">
                                                {{errors.short_description}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="long_description">Long Description:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" placeholder="Long Description" rows="5" v-model="long_description"></textarea>
                                            <div v-if="errors.long_description" class="alert alert-danger">
                                                {{errors.long_description}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_image">Product Image:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="file" name="product_image[]" id="product_image uploadCaptureInputFile" @change="fieldChange" multiple>
                                            <span class="text-danger" style="display:block">Please do not add your shop information in product image.If image contains shop info then product will be deleted</span>
                                            <div v-if="errors.product_image" class="alert alert-danger">
                                                {{errors.product_image}}
                                            </div>
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
                                                <input type="radio" id="publication_status" value="1" v-model="publication_status" class="custom-radio"><label for="publication_status">Published</label>
                                            </span>
                                            <span>
                                                <input type="radio" id="unpublication_status" value="0" v-model="publication_status" class="custom-radio"><label for="unpublication_status">Unpublished</label>
                                            </span>
                                            <div v-if="errors.publication_status" class="alert alert-danger">
                                                {{errors.publication_status}}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Shipping Charge:</label>
                                        </div>
                                        <div class="col-lg-4"> <span style="font-weight:600">Inside Dhaka</span>
                                                <span style="display: inline-block;">
                                                <input type="number" v-model="inside_dhaka" class="form-control" placeholder="Inside Dhaka">
                                            </span>
                                        </div>
                                            <div class="col-lg-4"> <span style="font-weight:600">Outside Dhaka</span>

                                                <span style="display: inline-block;">
                                                <input type="number" v-model="outside_dhaka" class="form-control" placeholder="Outside Dhaka">
                                            </span>
                                            </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-8 offset-4">
                                        <input type="submit"  :disabled="!product_name || !category_id|| !subcategory_id || !product_price_regular || !product_quantity || !short_description || !inside_dhaka || !outside_dhaka || length==1" value="Save Product Info" class="form-control btn btn-info text-white">
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
                length:'',
                product_name:null,
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
            this.$store.dispatch('getActiveCategories');
            this.$store.dispatch('getActiveSubCategories');
            this.$store.dispatch('getCustomers');
            this.getUserName();
        },
        computed:{
            Categories(){
                return this.$store.getters.categories;
            },
            customer(){
                return this.$store.getters.customer;
            },
        },
        methods:{
            fieldChange(e){
                let selectedFiles = e.target.files;
                if (!selectedFiles.length) {
                    return false;
                }
                for(let i=0;i<selectedFiles.length;i++){
                    this.attachments.push(selectedFiles[i])
                }
            },
            getUserName(){
                axios.get('/get-user-name').then((response)=>{
                    this.user_name = response.data.name;
                })
            },
            addProduct(e){
                for(let i=0;i<this.attachments.length;i++){
                this.imageForm.append('product_image[]',this.attachments[i]);
                }
                this.imageForm.append('product_name',this.product_name);
                this.imageForm.append('product_color',this.product_color);
                this.imageForm.append('category_id',this.category_id);
                this.imageForm.append('product_quantity',this.product_quantity);
                this.imageForm.append('subcategory_id',this.subcategory_id);
                this.imageForm.append('ultra_sub_category_id',this.ultra_sub_category_id);
                this.imageForm.append('product_price_regular',this.product_price_regular);
                this.imageForm.append('product_price_discount',this.product_price_discount);
                this.imageForm.append('short_description',this.short_description);
                this.imageForm.append('long_description',this.long_description);
                this.imageForm.append('user_name',this.user_name);
                this.imageForm.append('inside_dhaka',this.inside_dhaka);
                this.imageForm.append('outside_dhaka',this.outside_dhaka);
                this.imageForm.append('publication_status',this.publication_status);
                const config= {
           headers:{
                    "Content-Type": "multipart/form-data"
                   } 
                }
                axios.post('/save-product',this.imageForm,config).then((response)=>{
                        toastr.success('Product Info Added Successfully','Success!');
                        this.$router.push('/manage-product/:slug/:id');
                    }).catch(error=>{
                        if(error.response.status){
                        this.errors = error.response.data.errors;
                    }
                        toastr.error('Please Check All Fields','ERROR!');
                         
                    });
            },
            loadCategory:function(e){
                let category = (e.target.value);
                axios.get('/get-sub-cat/'+category).then((response)=>{
                    this.subcats = response.data.subCategories;

                })
            },
            loadSubCategory:function(e){
                let subCategory = (e.target.value);
                axios.get('/get-super-sub-cat/'+subCategory).then((response)=>{
                    this.superSubcats = response.data.superSubcats;

                })
            },
            getValue(name){
                axios.post('/get-prod-name/'+name).then((response)=>{
                    this.length = response.data.product.length;
                })
            },
        },
    }
</script>
