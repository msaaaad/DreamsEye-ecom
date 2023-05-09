//Public Component
import store from"../store/store2";
import Home from"../components/FrontEnd/Home.vue";
import About from"../components/FrontEnd/About/About.vue";
import Contact from"../components/FrontEnd/Contact/Contact.vue";
import Team from"../components/FrontEnd/Team/Team.vue";
import Login from"../components/FrontEnd/login/login.vue";
import ResetPassword from"../components/FrontEnd/login/reset-password.vue";
import EnterCode from"../components/FrontEnd/login/enter-code.vue";
import ForgotPassword from"../components/FrontEnd/login/forgot-password.vue";
import Register from"../components/FrontEnd/login/register.vue";
import Account from"../components/FrontEnd/Account/Account.vue";
import AccountEdit from"../components/FrontEnd/Account/edit.vue";
import addProduct from"../components/FrontEnd/Product/add-product.vue";
import editProductInfo from"../components/FrontEnd/Product/edit-product-info.vue";
import editProductImage from"../components/FrontEnd/Product/edit-product-image.vue";
import addProductHack from"../components/FrontEnd/Product/add-product-hack.vue";
import viewProduct from"../components/FrontEnd/Product/view-product.vue";
import ViewBoostProduct from"../components/FrontEnd/Product/view-boost-product.vue";
import ViewRelatedProduct from"../components/FrontEnd/Product/view-related-product.vue";
import categoryProduct from"../components/FrontEnd/category/category-product.vue";
import subCategoryProduct from"../components/FrontEnd/subcategory/subcategory-product.vue";
import superSubCategoryProduct from"../components/FrontEnd/supersubcategory/supersubcategory-product.vue";
import manageProduct from"../components/FrontEnd/product/manage-product.vue";
import viewCart from"../components/FrontEnd/cart/view-cart.vue";
import Shipping from"../components/FrontEnd/checkout/shipping.vue";
import Payment from"../components/FrontEnd/payment/payment.vue";
import ApplySeller from"../components/FrontEnd/seller/apply-seller.vue";


//public routes



export const routes = [
	{path:'/',component: Home,name:"Home"},
	{
    path :'*',
    component:Home
	},
	{path:'/about',component: About},
	{path:'/contact',component: Contact},
	{path:'/team',component: Team},
	{
		path:'/login-front',component: Login,name: 'Login',
		beforeEnter: (to, from, next) => {
        if (store.state.cusData!=null) next({ name: 'Home' })
  		else next()
      }},
	{
		path:'/forgot-password',component: ForgotPassword,name: 'ForgotPassword',
		// beforeEnter: (to, from, next) => {
  //       if (store.state.cusData!=null) next({ name: 'Home' })
  // 		else next()
  //     }
},
	{
		path:'/register-front',component: Register,
		beforeEnter: (to, from, next) => {
        if (store.state.cusData!=null) next({ name: 'Home' })
  		else next()
      }
	},
	{
		path:'/account',component: Account,name:"Acount",
		beforeEnter: (to, from, next) => {
  		// console.log(store.state.cusData);
        if (store.state.cusData==null) next({ name: 'Login' })
  		else next()
      }
	},
	{
		path:'/edit-bio/:slug',component: AccountEdit,
		beforeEnter: (to, from, next) => {
        if (store.state.cusData==null) next({ name: 'Login' })
  		else next()
      }
	},
	{
		path:'/add-product/:slug',component: addProduct,
		beforeEnter: (to, from, next) => {
        if (store.state.companyStatusData==0) next({ name: 'Acount' })
  		else next()
      }
	},
	{
		path:'/edit-product-info/:slug',component: editProductInfo,
		beforeEnter: (to, from, next) => {
        if (store.state.companyStatusData==0) next({ name: 'Acount' })
  		else next()
      }
	},
	{
		path:'/edit-product-image/:slug',component: editProductImage,
		beforeEnter: (to, from, next) => {
        if (store.state.companyStatusData==0) next({ name: 'Acount' })
  		else next()
      }
	},
	{
		path:'/apply-seller/:slug',component: ApplySeller,Name:'ApplySeller',
		beforeEnter: (to, from, next) => {
        if (store.state.vendorData==0 || store.state.cusData==null) next({ name: 'Acount' })
  		else next()
      }
	},
	{path:'/add-product',component: addProductHack},
	{path:'/view-product/:slug/:id',component: viewProduct},
	{path:'/view-boost-product/:slug/:id',component: ViewBoostProduct},
	{path:'/view-related-product/:slug/:id',component: ViewRelatedProduct},
	{
		path:'/manage-product/:slug/:id',component: manageProduct,
		beforeEnter: (to, from, next) => {
        if (store.state.companyStatusData==0) next({ name: 'Acount' })
  		else next()
      }
	},
	{path:'/view-category-product/:slug/:id',component: categoryProduct},
	{path:'/view-subcategory-product/:slug/:id',component: subCategoryProduct},
	{path:'/view-supersubcategory-product/:slug/:id',component: superSubCategoryProduct},
	{
		path:'/view-cart',component: viewCart,name:'Cart',
		beforeEnter: (to, from, next) => {
  		// console.log(store.state.cusData);
        if (store.state.cusData==null) next({ name: 'Login' })
  		else next()
      }
	},
	{
		path:'/shipping',component: Shipping,
		beforeEnter: (to, from, next) => {
        if (store.state.cusData==null) next({ name: 'Login' })
  		else next()
      }
	},
	{
		path:'/payment',component: Payment,
		beforeEnter: (to, from, next) => {
  		// console.log(store.state.cusData);
        if (store.state.cusData==null) next({ name: 'Login' })
  		else next()
      }
		
	},
	{
		path:'/enter-code',component: EnterCode
		// beforeEnter: (to, from, next) => {
  		// console.log(store.state.cusData);
    //     if (store.state.veryData==null) next({ name: 'Home' })
  		// else next()
    //   }
		
	},
	{
		path:'/reset-password',component: ResetPassword,
		beforeEnter: (to, from, next) => {
  		// console.log(store.state.cusData);
        if (store.state.veryData==null) next({ name: 'Home' })
  		else next()
      }
		
	},
];