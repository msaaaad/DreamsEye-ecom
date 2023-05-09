export default{
	  state: {
	  	categoryData: [],
      subcategoryData: [],
      productData:[],
      aboutData:[],
      frontAboutData:[],
      contactData:[],
      teamData:[],
      modelData:[],
      logoData:[],
      customerData:[],
      vendorData:[],
      messageData:[],
      subCategoryData:[],
      superSubCatsData:[],
      ordersData:[],
  },
  getters:{
  	categories(state){
  		return state.categoryData;
  	},
    getsubcategories(state){
      return state.subcategoryData;
    },
    superSubCats(state){
      return state.superSubCatsData;
    },
    customers(state){
      return state.customerData;
    },
    products(state){
      return state.productData;
    },
    abouts(state){
      return state.aboutData;
    },
    frontAbout(state){
      return state.frontAboutData;
    },
    contacts(state){
      return state.contactData;
    },
    teams(state){
      return state.teamData;
    },
    models(state){
      return state.modelData;
    },
    logos(state){
      return state.logoData;
    },
    vendors(state){
      return state.vendorData;
    },
    messages(state){
      return state.messageData;
    },
    subCategories(state){
      return state.subCategoryData;
    },
    orders(state){
      return state.ordersData;
    },
	},
  actions:{
    getCategories(data){
      axios.get("get-category").then((response)=>{
        data.commit('categories',response.data.categories);

      }).catch((error)=>{

      })
    },
    getCustomers(data){
      axios.get("get-customer").then((response)=>{
        data.commit('customers',response.data.customers);

      }).catch((error)=>{

      })
    },
    getSubcategories(data){
      axios.get("get-getSubcategory").then((response)=>{
        data.commit('subcategories',response.data.subcategories);

      }).catch((error)=>{

      })
    },
    getsuperSubCats(data){
      axios.get("get-supersubcategory").then((response)=>{
        data.commit('superSubCats',response.data.superSubCats);

      }).catch((error)=>{

      })
    },
    getActiveSubCategories(data){
      axios.get("get-active-sub-category").then((response)=>{
        data.commit('subCategories',response.data.subCategories);
      }).catch((error)=>{

      })
    },
    getActiveCategories(data){
      axios.get("get-active-category").then((response)=>{
        data.commit('categories',response.data.categories);

      }).catch((error)=>{

      })
    },
    getProducts(data){
      axios.get("get-product").then((response)=>{
        data.commit('products',response.data.products);
      }).catch((error)=>{

      })
    },
    getAbouts(data){
      axios.get("get-about").then((response)=>{
        data.commit('abouts',response.data.abouts);
      }).catch((error)=>{

      })
    },
    getFrontAbouts(data){
      axios.get("get-front-about").then((response)=>{
        data.commit('frontAbout',response.data.frontAbout);
      }).catch((error)=>{

      })
    },
    getContacts(data){
      axios.get("get-contact").then((response)=>{
        data.commit('contacts',response.data.contacts);
      }).catch((error)=>{

      })
    },
    getTeams(data){
      axios.get("get-team").then((response)=>{
        data.commit('teams',response.data.teams);
      }).catch((error)=>{

      })
    },
    getModels(data){
      axios.get("get-model").then((response)=>{
        data.commit('models',response.data.models);
      }).catch((error)=>{

      })
    },
    getLogos(data){
      axios.get("get-logo").then((response)=>{
        data.commit('logos',response.data.logos);
      }).catch((error)=>{

      })
    },
    getMessages(data){
      axios.get("get-messages").then((response)=>{
        data.commit('messages',response.data.messages);
      }).catch((error)=>{

      })
    },
    getOrders(data){
      axios.get("get-orders").then((response)=>{
        data.commit('orders',response.data.orders);
      }).catch((error)=>{

      })
    },
  },
  mutations: {
    categories(state,data){
      return state.categoryData = data;
    },
    products(state,data){
      return state.productData = data;
    },
    abouts(state,data){
      return state.aboutData = data;
    },
    frontAbout(state,data){
      return state.frontAboutData = data;
    },
    contacts(state,data){
      return state.contactData = data;
    },
    teams(state,data){
      return state.teamData = data;
    },
    models(state,data){
      return state.modelData = data;
    },
    logos(state,data){
      return state.logoData = data;
    },
    subcategories(state,data){
      return state.subcategoryData = data;
    },
    customers(state,data){
      return state.customerData = data;
    },
    vendors(state,data){
      return state.vendorData = data;
    },
    messages(state,data){
      return state.messageData = data;
    },
    subCategories(state,data){
      return state.subCategoryData = data;
    },
    superSubCats(state,data){
      return state.superSubCatsData = data;
    },
    orders(state,data){
      return state.ordersData = data;
    },
  }
}