<template>
	<div class="">
        <div class="container">
            <div class="row">
                <div class="add-category col-10 offset-1">
                    <div class="card">
                        <h5 class="card-header text-success text-center">Edit Subcategory</h5>
                                                <div class="card-body">
                            <form @submit.prevent="updateSubcategory">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="category_id">Category Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select  v-model="form.category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" id="category_id">
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
                                            <label for="name">Subcategory Name:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input placeholder="Enter Subcategory Name" type="text" v-model="form.subcategory_name" class="form-control" :class="{ 'is-invalid': form.errors.has('subcategory_name') }">
                                            <has-error :form="form" field="subcategory_name"></has-error>
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

                                        <input type="submit" value="Update Subcategory Info" class="form-control btn btn-info text-white">
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
                    id:null,
                    category_id:'',
                    subcategory_name:null,
                    publication_status:1,
                })
            }
        },

        mounted(){

            this.getSubcategory();
            this.$store.dispatch('getActiveCategories');
        },
        computed:{
            Categories(){
                return this.$store.getters.categories;
            },
        },
        methods:{
            getSubcategory : function(){
                axios.get('/show-subcategory/'+this.$route.params.slug).then((response)=>{
                    this.form.fill(response.data.subcategory)
                }).catch((error)=>{

                })
            },
            updateSubcategory:function(){
                this.form.post('/update-subcategory').then((data)=>{
                        toastr.success('Subcategory Updated Successfully','Success!');
                        this.$router.push('/manage-subcategory');
                })
            },
        },
    }
</script>