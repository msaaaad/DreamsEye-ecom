import dashboard from '../components/backend/dashboard.vue';
//category
import manageCategories
 from '../components/backend/category/manage-category.vue';
import addCategory
 from '../components/backend/category/add-category.vue';
import editCategory
 from '../components/backend/category/edit-category.vue';
//Subcategory
import manageSubcategories
 from '../components/backend/subcategory/manage-subcategory.vue';
import addSubcategory
 from '../components/backend/subcategory/add-subcategory.vue';
import editSubcategory
 from '../components/backend/subcategory/edit-subcategory.vue';

//Super Subcategory
import manageSuperSubcategories
 from '../components/backend/supersubcategory/manage-supersubcategory.vue';
import addSuperSubcategory
 from '../components/backend/supersubcategory/add-supersubcategory.vue';
import editSuperSubcategory
 from '../components/backend/supersubcategory/edit-supersubcategory.vue';
//Brand
// import manageBrands
//  from '../components/backend/brand/manage-brand.vue';
// import addBrand
//  from '../components/backend/brand/add-brand.vue';
// import editBrand
//  from '../components/backend/brand/edit-brand.vue';


//Product
import manageProducts
 from '../components/backend/product/manage-product.vue';
import manageMyProducts
 from '../components/backend/product/manage-my-product.vue';
import addProduct
 from '../components/backend/product/add-product.vue';
import editProductInfo
 from '../components/backend/product/edit-product-info.vue';
import editProductImage
 from '../components/backend/product/edit-product-image.vue';

 //about 
import manageAbout
 from '../components/backend/about/manage-about.vue';
import addAbout
 from '../components/backend/about/add-about.vue';
import editAbout
 from '../components/backend/about/edit-about.vue';

//team
import manageTeam
 from '../components/backend/team/manage-team.vue';
import addTeam
 from '../components/backend/team/add-team.vue';
import editTeam
 from '../components/backend/team/edit-team.vue';

//Contact
import manageContact
 from '../components/backend/contact/manage-contact.vue';
import addContact
 from '../components/backend/contact/add-contact.vue';
import editContact
 from '../components/backend/contact/edit-contact.vue';

//Model
import manageModel
 from '../components/backend/model/manage-model.vue';
import addModel
 from '../components/backend/model/add-model.vue';

//Vendor
import manageVendor
 from '../components/backend/vendor/manage-vendor.vue';
import manageSeller
 from '../components/backend/vendor/manage-seller.vue';
import viewSeller
 from '../components/backend/vendor/view-seller.vue';

//Logo
import manageLogo
 from '../components/backend/logo/manage-logo.vue';
import addLogo
 from '../components/backend/logo/add-logo.vue';
import editLogo
 from '../components/backend/logo/edit-logo.vue';

//Order
import manageOrder
 from '../components/backend/order/manage-order.vue';
import viewOrder
 from '../components/backend/order/view-order.vue';
import viewCompletedOrder
 from '../components/backend/order/view-completed-order.vue';
import viewUncompletedOrder
 from '../components/backend/order/view-uncompleted-order.vue';
import viewOrderInvoice
 from '../components/backend/order/view-order-invoice.vue';

//Message
import manageMessage
 from '../components/backend/message/manage-message.vue';

export const routes = [
	{path:'/',component: dashboard},

	{path:'/manage-category',component: manageCategories},
	{path:'/add-category',component: addCategory},
	{path:'/edit-category/:slug',component: editCategory},

	{path:'/manage-subcategory',component: manageSubcategories},
	{path:'/add-subcategory',component: addSubcategory},
	{path:'/edit-subcategory/:slug',component: editSubcategory},

	{path:'/manage-super-subcategory',component: manageSuperSubcategories},
	{path:'/add-super-subcategory',component: addSuperSubcategory},
	{path:'/edit-supersubcategory/:slug',component: editSuperSubcategory},

	{path:'/manage-my-product',component: manageMyProducts},
	{path:'/manage-product',component: manageProducts},
	{path:'/add-product',component: addProduct},
	{path:'/edit-product-info/:slug',component: editProductInfo},
	{path:'/edit-product-image/:slug',component: editProductImage},

	{path:'/manage-about',component: manageAbout},
	{path:'/add-about',component: addAbout},
	{path:'/edit-about/:slug',component: editAbout},

	{path:'/manage-team',component: manageTeam},
	{path:'/add-team',component: addTeam},
	{path:'/edit-team/:slug',component: editTeam},

	{path:'/manage-contact',component: manageContact},
	{path:'/add-contact',component: addContact},
	{path:'/edit-contact/:slug',component: editContact},

	{path:'/manage-model',component: manageModel},
	{path:'/add-model',component: addModel},

	{path:'/manage-vendor',component: manageVendor},
	{path:'/manage-seller',component: manageSeller},
	{path:'/view-info/:id',component: viewSeller},

	{path:'/manage-logo',component: manageLogo},
	{path:'/add-logo',component: addLogo},
	{path:'/edit-logo/:id',component: editLogo},

	{path:'/manage-order',component: manageOrder},
	{path:'/view-order/:id',component: viewOrder},
	{path:'/view-completed-order',component: viewCompletedOrder},
	{path:'/view-uncompleted-order',component: viewUncompletedOrder},
	{path:'/view-order-invoice/:id',component: viewOrderInvoice},

	{path:'/manage-message',component: manageMessage},

	
];