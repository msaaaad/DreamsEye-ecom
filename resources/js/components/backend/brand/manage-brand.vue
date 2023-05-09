<template>
  <div class="">
    <div class="container">
        <div class="row">
            <div class="manage-category col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary text-center">Manage Brand</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl. No</th>
                                <th>Brand Name</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="brand,index in Brands">
                                <td>{{++index}}</td>
                                <td>{{brand.brand_name}}</td>
                                <td><span class="badge" :class="statusColor(brand.publication_status)">{{statusName(brand.publication_status)}}</span></td>
                                <td>
                                    <button type="button" @click="deleteBrand(brand.id)" class="btn btn-danger btn-sm" title="Delete Brand"><i class="fas fa-trash-alt"></i></button>
                                    <router-link :to="`/edit-brand/${brand.slug}`" class="btn btn-success btn-sm" title="Edit Brand"><i class=" fab fa-chromecast"></i></router-link>
                                    <button type="button" @click="PublishBrand(brand.id)" v-if="unpublishedBrand(brand.publication_status)" class="btn btn-sm" v-bind:title="statusTitle(brand.publication_status)" :class="statusIconColor(brand.publication_status)"><i class="fas" :class="statusIcon(brand.publication_status)"></i></button>
                                    <button v-if="publishedBrand(brand.publication_status)" @click="UnublishBrand(brand.id)" type="button" class="btn btn-sm" v-bind:title="statusTitle(brand.publication_status)" :class="statusIconColor(brand.publication_status)"><i class="fas" :class="statusIcon(brand.publication_status)"></i></button>
                                </td>
                            </tr>
                            <tr v-if="emptyData()">
                                <td colspan="10">
                                    <h4 class="text-center text-danger">Opps! Data Not Found</h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
    export default{
        name:'manage',
        data:function(){
            return{
                brandIds:[]
            }
        },
        //mounted diye action e hit korbe
        mounted(){
            this.$store.dispatch('getBrands');
        },
        computed:{
            Brands(){
                return this.$store.getters.brands;
            }
        },
        methods:{
            unpublishedBrand(status){
                let data= {
                    0:true
                }
                return data[status];
            },
            publishedBrand(status){
                let data= {
                    1:true
                }
                return data[status];
            },
            PublishBrand(id){
                axios.get("publish-brand/"+id).then((response)=>{
                    toastr.success('Brand Info Published Successfully','Success!');
                    this.$store.dispatch('getBrands');
                }).catch((error)=>{

                })
            },
            UnublishBrand(id){
                let this_=this;
                axios.get("unpublish-brand/"+id).then((response)=>{
                    toastr.success('Brand Info Unpublished Successfully','Success!');
                    this.$store.dispatch('getBrands');
                }).catch((error)=>{

                })
            },
            statusName(status){
                let data= {
                    0:'Unpublished',
                    1:'Published',
                }
                return data[status];
            },
            statusColor(status){
                let data= {
                    0:'bg-warning',
                    1:'bg-success',
                }
                return data[status];
            },
            statusIconColor(status){
                let data= {
                    0:'btn-info',
                    1:'btn-warning',
                }
                return data[status];
            },
            statusIcon(status){
                let data= {
                    0:'fa-arrow-up',
                    1:'fa-arrow-down',
                }
                return data[status];
            },
            statusTitle(status){
                let data= {
                    0:'Publish Brand',
                    1:'Unpublish Brand',
                }
                return data[status];
            },
            emptyData:function(){
                return (this.Brands.length<1);
            },
            deleteBrand(id){
                const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            axios.get("delete-brand/"+id).then((response)=>{
               /* toastr.success('Category Deleted Successfully','Success!');*/
               swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your brand has been deleted.',
              'success'
            )
                    this.$store.dispatch('getBrands');


              }).catch((error)=>{

              })
            /* 
              */
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your brand is safe :)',
              'error'
            )
          }
        })
            },
        },
    }
</script>