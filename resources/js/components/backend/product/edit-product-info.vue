<template>
    <div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card mt-5">
                        <h2 class="card-header text-dark">Edit Product Info</h2>
                        <div class="card-body">
                            <form @submit.prevent="updateProduct">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="category_id">Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="form.category_id" class="form-control"  id="category_id" @change="loadCategory" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                                <option value="">-----Select Category-----
                                                </option>
                                                <option v-for="category in Categories" :value="category.id">{{category.category_name}}</option>
                                            </select>
                                            <has-error :form="form" field="category_id"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="subcategory_id">Sub Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="form.subcategory_id" class="form-control"  id="subcategory_id" @change="loadSubCategory" :class="{ 'is-invalid': form.errors.has('subcategory_id') }">
                                                <option value="">-----Select SubCategory-----
                                                </option>
                                                <option v-for='subCategory in subcats' :value="subCategory.id">{{subCategory.subcategory_name}}</option>
                                            </select>
                                            <has-error :form="form" field="subcategory_id"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="ultra_sub_category_id">Super Sub Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="form.ultra_sub_category_id" class="form-control"  id="ultra_sub_category_id" :class="{ 'is-invalid': form.errors.has('ultra_sub_category_id') }" >
                                                <option value="">-----Select SubCategory of SubCategory-----
                                                </option>
                                                <option v-for='superSub in superSubcats' :value="superSub.id">{{superSub.ultra_sub_category_name}}</option>
                                            </select>
                                            <has-error :form="form" field="ultra_sub_category_id"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Product Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Product Name" type="text" v-model="form.product_name" class="form-control"   v-on:keyup="getValue(product_name)" :class="{ 'is-invalid': form.errors.has('product_name') }">
                                            <has-error :form="form" field="product_name"></has-error>
                                            <div v-if="length==1" class="text-danger">Name already exists*</div>
                                            <div v-if="length==0 && form.product_name" class="text-success">Name available</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_color">Product Colour:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Product Colour" type="text" v-model="form.product_color" class="form-control" :class="{ 'is-invalid': form.errors.has('product_color') }" >
                                            <has-error :form="form" field="product_color"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_price_regular">Product Price(Regular):</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Regular Price" type="Number" v-model="form.product_price_regular" class="form-control" :class="{ 'is-invalid': form.errors.has('product_price_regular') }" >
                                            <has-error :form="form" field="product_price_regular"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_price_discount">Product Price(Discount):</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Discount Price" type="Number" v-model="form.product_price_discount" class="form-control" :class="{ 'is-invalid': form.errors.has('product_price_discount') }" >
                                            <has-error :form="form" field="product_price_discount"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="product_quantity">Product Quantity:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Product Quantity" type="Number" v-model="form.product_quantity" class="form-control" :class="{ 'is-invalid': form.errors.has('product_quantity') }" >
                                            <has-error :form="form" field="product_quantity"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" v-model="form.user_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="short_description">Short Description:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" v-model="form.short_description" placeholder="Write At least 20 letter" :class="{ 'is-invalid': form.errors.has('short_description') }"></textarea>
                                            <has-error :form="form" field="short_description"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="long_description">Long Description:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" placeholder="Long Description" rows="5" v-model="form.long_description" :class="{ 'is-invalid': form.errors.has('long_description') }"></textarea>
                                            <has-error :form="form" field="long_description"></has-error>
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
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Shipping Charge:</label>
                                        </div>
                                        <div class="col-lg-4"> <span style="font-weight:600">Inside Dhaka</span>
                                                <span style="display: inline-block;">
                                                <input type="number" v-model="form.inside_dhaka" class="form-control" placeholder="Inside Dhaka" :class="{ 'is-invalid': form.errors.has('inside_dhaka') }">
                                                <has-error :form="form" field="inside_dhaka"></has-error>
                                            </span>
                                        </div>
                                            <div class="col-lg-4"> <span style="font-weight:600">Outside Dhaka</span>

                                                <span style="display: inline-block;">
                                                <input type="number" v-model="form.outside_dhaka" class="form-control" placeholder="Outside Dhaka" :class="{ 'is-invalid': form.errors.has('outside_dhaka') }">
                                                <has-error :form="form" field="outside_dhaka"></has-error>
                                            </span>
                                            </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-8 offset-4">
                                        <input type="submit"  :disabled="!form.product_name || !form.category_id|| !form.subcategory_id || !form.product_price_regular || !form.product_quantity || !form.short_description || !form.inside_dhaka || !form.outside_dhaka || length==1" value="Update Product Info" class="form-control btn btn-info text-white">
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
                id:'',
                product_name:null,
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
                }),
                length:'',
                subcats:[],
                superSubcats:[],
                errors :'',
            }
        },  
        mounted(){
            this.$store.dispatch('getActiveCategories');
            this.$store.dispatch('getActiveSubCategories');
            this.$store.dispatch('getCustomers');
            this.getUserName();
            this.getProduct();
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
            getActiveSubCategory:function(id){
                axios.get('/get-sub-cat/'+id).then((response)=>{
                    this.subcats = response.data.subCategories;

                })
            },
            getActiveSuperSubCategory:function(id){
                axios.get('/get-super-sub-cat/'+id).then((response)=>{
                    this.superSubcats = response.data.superSubcats;

                })
            },
            getProduct(){
                axios.get('/show-product/'+this.$route.params.slug).then((response)=>{
                    this.form.fill(response.data.product);
                this.getActiveSubCategory(this.form.category_id);
                this.getActiveSuperSubCategory(this.form.subcategory_id);
                }).catch((error)=>{

                })
            },
            getUserName(){
                axios.get('/get-user-name').then((response)=>{
                    this.user_name = response.data.name;
                })
            },
            updateProduct(){
                
                this.form.post('/update-product-info').then((response)=>{
                        toastr.success('Product Info Updated Successfully','Success!');
                        this.$router.push('/manage-my-product');
                    }).catch(error=>{
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
