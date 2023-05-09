<template>
        <section id="content">
            <div class="content-wrap">
                <div class="container">

                    <table class="table cart mb-5">
                        <thead>
                            <tr>
                                <th class="cart-product-remove">&nbsp;</th>
                                <th class="cart-product-thumbnail">&nbsp;</th>
                                <th class="cart-product-name">Product</th>
                                <th class="cart-product-price">Unit Price</th>
                                <th class="cart-product-quantity">Quantity</th>
                                <th class="cart-product-quantity">Color</th>
                                <th class="cart-product-quantity">Shipping</th>
                                <th class="cart-product-subtotal">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <p style="display:none">{{sum = 0}}{{price = 0}}{{unit = 0}}{{ship = 0}}</p>
                            <tr class="cart_item" v-for="Product,index in CartProducts">
                                <td class="cart-product-remove">
                                    <button  @click="DeleteCart(Product.id)" class="remove" title="Remove this item"><i class="icon-trash2"></i></button>
                                </td>

                                <td class="cart-product-thumbnail"><img width="64" height="64" :src="fileLink(Product.product_image[0])" alt="DeramsEye">
                                </td>

                                <td class="cart-product-name">
                                    <span>{{Product.product_name}}</span>
                                </td>

                                <td class="text warning">
                                    <span class="amount">TK. {{Product.product_price}}</span>
                                </td>

                                <td class="cart-product-quantity">
                                    {{Product.product_quantity}} &nbsp;
                                        <button @click="increaseCartQuantity(Product)" :disabled="Product.product.product_quantity==1 || Product.product_quantity==Product.product.product_quantity" class="btn btn-success btn-sm">+</button>
                                        <button :disabled="Product.product_quantity==0" class="btn btn-danger btn-sm" @click="decreaseCartQuantity(Product)">-</button>
                                        <form class="form" @submit.prevent="updateQuantity(Product.id,Product.product_quantity,Product.product.id)">
                                            <input type="hidden" :value="Product.product_quantity" name="product_quantity">
                                            <input type="hidden" :value="Product.id" name="cart_id">
                                        <button class="btn btn-info btn-sm" type="submit">Update</button>
                                        </form>
                                </td>

                                <td class="cart-product-quantity">
                                    <span class="amount">{{Product.product_color}}</span>
                                </td>

                                <!-- <td v-if="region=='Inside Dhaka City'" class="">
                                    <span class="amount"><span class="ship">(shipping*)</span>TK. {{ShippingTotalDhaka}}</span>
                                </td> -->
                                <td v-if="region=='Inside Dhaka City'" class="">
                                    <span class="amount" v-if="Product.product_quantity<=2"><span class="ship">(shipping*)</span>TK. {{ship = Product.product.inside_dhaka}}</span>
                                    <span class="amount" v-if="Product.product_quantity>2"><span class="ship">(shipping*)</span>TK. {{ship = Product.product.inside_dhaka+(Product.product_quantity-2)*20}}</span>
                                </td>

                                <td v-if="region=='Inside Dhaka City'" class="cart-product-subtotal">
                                    <span class="amount">TK. {{(Product.product_price * Product.product_quantity)+ship}}</span>
                                </td>

                                <td v-if="region=='Outside Dhaka City'" class="">
                                    <span class="amount" v-if="Product.product_quantity<=2"><span class="ship">(shipping*)</span>TK. {{ship = Product.product.outside_dhaka}}</span>
                                    <span class="amount" v-if="Product.product_quantity>2"><span class="ship">(shipping*)</span>TK. {{ship = Product.product.outside_dhaka+(Product.product_quantity-2)*20}}</span>
                                </td>

                                <td v-if="region=='Outside Dhaka City'" class="cart-product-subtotal">
                                    <span class="amount">TK. {{total = (Product.product_price * Product.product_quantity)+ship}}</span>
                                </td>
                                <p style="display:none">{{sum = sum+ship}}{{price = price+total}}{{unit = unit+Product.product_quantity*Product.product_price}}</p>
                            </tr>
                            <tr class="cart_item">
                                <td colspan="12">
                                    <div class="row justify-content-between py-2 col-mb-30">
                                        <div class="col-lg-auto pl-lg-0">
                                            <div class="row">
                                                <div class="col-md-4 mt-3 mt-md-0">
                                                    <router-link to="/" class="button button-3d button-black m-0">Continue Shopping</router-link>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-auto pr-lg-0">
                                            <form @submit.prevent="putTotalToSession(sum+unit,sum)">
                                                <button v-if="CartProducts.length" type="submit" class="button button-3d mt-2 mt-sm-0 mr-0">Proceed to Checkout</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                            

                    <div class="row col-mb-30">
                        <div class="col-lg-6">
                            
                        </div>

                        <div class="col-lg-6">
                            <h4>Cart Totals</h4>

                            <div class="table-responsive">
                                <table class="table cart cart-totals">
                                    <tbody>
                                        <tr class="cart_item">
                                            <td class="cart-product-name">
                                                <strong>Cart Subtotal</strong>
                                            </td>


                                            <td class="cart-product-name">
                                                <span class="amount">TK. {{unit}} </span>
                                            </td>
                                        </tr>
                                        <tr class="cart_item">
                                            <td class="cart-product-name">
                                                <strong>Shipping Charge</strong>
                                            </td>

                                            <td class="cart-product-name" v-if="region=='Inside Dhaka City'">
                                                <span class="amount">Tk. {{sum}}</span>
                                            </td>
                                            <td class="cart-product-name" v-if="region=='Outside Dhaka City'">
                                                <span class="amount">Tk. {{sum}}</span>
                                            </td>
                                        </tr>
                                        <tr class="cart_item">
                                            <td class="cart-product-name">
                                                <strong>Total</strong>
                                            </td>

                                            <td class="cart-product-name">
                                                <span class="amount color lead"><strong>TK. {{grand = unit+sum}}</strong></span>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- #content end -->
</template>
<style>
    .form{
        display: inline-block;
    }
    #from{
        display: none;
    }
    .ship{
        color: red;
        font-size: 13px;
        font-weight: 300;
    }

</style>
<script>
    export default{
        name:"view-cart",
        data(){
            return{
                CartProducts:{},
                sessionId:'',
                total:'',
                shiptotal:'',
                unittotal:'',
                region:'',
            }
        },
        mounted(){
            this.getCart();
            this.customerLoggedIn();
        },
        methods:{
            getCart(){
                axios.get('/get-cart-item').then((response)=>{
                    this.CartProducts = response.data.cartProducts;
                })
            },
            putTotalToSession(total,ship){
                axios.post('/total-to-session/'+total+'/'+ship).then((response)=>{
                    this.$router.push('/shipping');
                }).catch((error)=>{

                })
            },
            fileLink:function(name){
                return 'dreamsEye/public/uploads/products/'+name;
            },
            increaseCartQuantity:function(cartItem){
                cartItem.product_quantity++;
                cartItem.product.product_quantity--;
                if (cartItem.product.product_quantity==1) {
                toastr.error("Out Of Stock",'Sorry!');}
            },
            decreaseCartQuantity:function(cartItem){
                cartItem.product.product_quantity++;
                cartItem.product_quantity--;
            },
            updateQuantity(id,qty,product_id){
                axios.post('/update-quantity/'+id+'/'+qty+'/'+product_id).then((response)=>{
                    toastr.success('Product Quantity Updated','Success!');
                    this.getCart();
                })
            },
            customerLoggedIn(){
                axios.get('/customer-logged-in').then((response)=>{
                    this.region = response.data.region;
                })
            },
            DeleteCart(id){
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
            axios.get("delete-cart-item/"+id).then((response)=>{
               /* toastr.success('About Deleted Successfully','Success!');*/
               swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your Cart info has been deleted.',
              'success'
            )
                    this.getCart();


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
              'Your cart is safe :)',
              'error'
            )
          }
        })
            
            },
        },
        computed:{
            ShippingTotalDhaka(){
                let total = 0;
                    this.CartProducts.forEach((Product)=>{
                    let n = Product.product_quantity;
                    if(n>2){
                        total = (n-2)*20+Product.product.inside_dhaka;
                    }
                    else if(n==0){
                        total = 0;
                    }
                    else{
                        total = Product.product.inside_dhaka;
                    }                
                });
                this.shiptotal = total;
                return total;

            },
            ShippingTotal(){
                let total = 0;
                    this.CartProducts.forEach((Product)=>{
                    let n = Product.product_quantity;
                    if(n>2){
                        total = (n-2)*20+Product.product.outside_dhaka;
                    }
                    else if(n==0){
                        total = 0;
                    }
                    else{
                        total = Product.product.outside_dhaka;
                    }                
                });
                this.shiptotal = total;
                return total;
            },

        
            CartTotal(){
                let total = 0;
                let unittotal = 0;
                this.CartProducts.forEach((Product)=>{
                    total+=(Product.product_quantity*Product.product_price)+this.shiptotal;
                    unittotal+=Product.product_quantity*Product.product_price;
                });
                this.total = total;
                this.unittotal = unittotal;
                return total;
            },

        }
    }
</script>