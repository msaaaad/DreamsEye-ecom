<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <h5 class="card-header text-success text-center">Edit Super Subcategory</h5>
                                                <div class="card-body">
                            <form @submit.prevent="UpdateSuperSub">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="category_id">Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                        	<select  v-model="form.category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" id="category_id" @change="loadCategory">
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
                                            <label for="sub_category_id">Sub Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="form.sub_category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('sub_category_id') }" id="sub_category_id">
                                                <option value="">-----Select SubCategory-----
                                                </option>
                                                <option v-for='subCategory in subcats' :value="subCategory.id">{{subCategory.subcategory_name}}</option>
                                            </select>
                                            <has-error :form="form" field="sub_category_id"></has-error>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Super Sub Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Subcategory of Subcategory Name" type="text" v-model="form.ultra_sub_category_name" class="form-control" :class="{ 'is-invalid': form.errors.has('ultra_sub_category_name') }">
                                            <has-error :form="form" field="ultra_sub_category_name"></has-error>
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
                                        <input type="submit" value="Update Super Subcategory Info" class="form-control btn btn-info text-white">
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
                subcats:[],
                cat_id:'',
                form:new Form({
                id:null,
                category_id:'',
                sub_category_id:'',
                publication_status:1,
                ultra_sub_category_name:null,
                })

            }
        },  
        mounted(){
            this.getSuperSubcategory();
        	this.$store.dispatch('getActiveCategories');
        },
        computed:{
        	Categories(){
        		return this.$store.getters.categories;
        	},        },
        methods:{
            getActiveSubCategory:function(id){
                axios.get('/get-sub-cat/'+id).then((response)=>{
                    this.subcats = response.data.subCategories;

                })
            },
            loadCategory:function(e){
                let category = (e.target.value);
                axios.get('/get-sub-cat/'+category).then((response)=>{
                    this.subcats = response.data.subCategories;

                })
            },
            getSuperSubcategory : function(){
                axios.get('/show-supersubcategory/'+this.$route.params.slug).then((response)=>{
                    this.form.fill(response.data.supersubcategory);
                    this.cat_id = this.form.category_id; 

                this.getActiveSubCategory(this.form.category_id);
                }).catch((error)=>{

                })
            },
            UpdateSuperSub(){
                this.form.post('/update-supersubcategory').then((response)=>{
                    toastr.success('Super Subcategory Added Successfully','Success!');
                    this.$router.push('/manage-super-subcategory');
                }).catch((error)=>{
                    toastr.error('Please Check All Fields','Error!');
                })
            },
        },
    }
</script>
