export default{
	  state: {
      aboutData:[],
      contactData:[],
      categoryData:[],
      ceoData:[],
      teamData:[],
      customerData:[],
      modelData:[],
      middleModelsData:[],
      boostsData:[],
      productData:[],
      subCategoryData:[],
      userLoggedInData:[],
      cusData:[],
      veryData:[],
      codeData:[],
      vendorData:[],
      companyStatusData:[],
      authData:false,
  },
  getters:{
    about(state){
      return state.aboutData;
    },
    contact(state){
      return state.contactData;
    },
    categories(state){
      return state.categoryData;
    },
    ceo(state){
      return state.ceoData;
    },
    teams(state){
      return state.teamData;
    },
    customer(state){
      return state.customerData;
    },
    models(state){
      return state.modelData;
    },
    middleModels(state){
      return state.middleModelsData;
    },
    boosts(state){
      return state.boostsData;
    },
    products(state){
      return state.productData;
    },
    subCategories(state){
      return state.subCategoryData;
    },
    login(state){
      return state.userLoggedInData;
    },
    cus(state){
      return state.cusData;
    },
    very(state){
      return state.veryData;
    },
    code(state){
      return state.codeData;
    },
    vendor(state){
      return state.vendorData;
    },
    companyStatus(state){
      return state.companyStatusData;
    },
	},
  actions:{
      userLoggedIn(data){
      axios.get("get-user-bool").then((response)=>{
        data.commit('login',response.data.login);
      }).catch((error)=>{

      })
    },
      getCustomer(data){
      axios.get("get-some").then((response)=>{
        data.commit('cus',response.data.cus);
      }).catch((error)=>{

      })
    },
      getVendorStat(data){
      axios.get("get-vendor-stat").then((response)=>{
        data.commit('vendor',response.data.vendor);
      }).catch((error)=>{

      })
    },
      getCompanyStatus(data){
      axios.get("get-company-status").then((response)=>{
        data.commit('companyStatus',response.data.companyStatus);
      }).catch((error)=>{

      })
    },
      getVarify(data){
      axios.get("get-very").then((response)=>{
        data.commit('very',response.data.very);
      }).catch((error)=>{

      })
    },
      getCode(data){
      axios.get("get-code").then((response)=>{
        data.commit('code',response.data.code);
      }).catch((error)=>{

      })
    },
      getFrontAbouts(data){
      axios.get("get-front-about").then((response)=>{
        data.commit('about',response.data.about);
      }).catch((error)=>{

      })
    },
      getFrontContacts(data){
      axios.get("get-front-contact").then((response)=>{
        data.commit('contact',response.data.contact);
      }).catch((error)=>{

      })
    },
    getActiveCategories(data){
      axios.get("get-active-category").then((response)=>{
        data.commit('categories',response.data.categories);

      }).catch((error)=>{

      })
    },
    getActiveSubCategories(data){
      axios.get("get-active-sub-category").then((response)=>{
        data.commit('subCategories',response.data.subCategories);
      }).catch((error)=>{

      })
    },
    getFrontTeams(data){
      axios.get("get-front-team").then((response)=>{
        data.commit('teams',response.data.teams);

      }).catch((error)=>{

      })
    },
    getCeo(data){
      axios.get("get-ceo").then((response)=>{
        data.commit('ceo',response.data.ceo);

      }).catch((error)=>{

      })
    },
    getCustomers(data){
      axios.get("get-front-customer").then((response)=>{
        data.commit('customer',response.data.customer);

      }).catch((error)=>{

      })
    },
    getModels(data){
      axios.get("get-front-model").then((response)=>{
        data.commit('models',response.data.models);
      }).catch((error)=>{

      })
    },
    getMiddleModels(data){
      axios.get("get-middle-model").then((response)=>{
        data.commit('middleModels',response.data.middleModels);
      }).catch((error)=>{

      })
    },
    getBoostProducts(data){
      axios.get("front-boost-product").then((response)=>{
        data.commit('boosts',response.data.boosts);
      }).catch((error)=>{

      })
    },
    getProducts(data){
      axios.get("front-product").then((response)=>{
        data.commit('products',response.data.products);
      }).catch((error)=>{

      })
    },
  },
  mutations: {
    about(state,data){
      return state.aboutData = data;
    },
    contact(state,data){
      return state.contactData = data;
    },
    categories(state,data){
      return state.categoryData = data;
    },
    teams(state,data){
      return state.teamData = data;
    },
    ceo(state,data){
      return state.ceoData = data;
    },
    customer(state,data){
      return state.customerData = data;
    },
    models(state,data){
      return state.modelData = data;
    },
    middleModels(state,data){
      return state.middleModelsData = data;
    },
    boosts(state,data){
      return state.boostsData = data;
    },
    products(state,data){
      return state.productData = data;
    },
    subCategories(state,data){
      return state.subCategoryData = data;
    },
    login(state,data){
      return state.userLoggedInData = data;
    },
    cus(state,data){
      return state.cusData = data;
    },
    very(state,data){
      return state.veryData = data;
    },

    code(state,data){
      return state.codeData = data;
    },
    setAuth(state,data){
      return state.authData = data;
    },
    vendor(state,data){
      return state.vendorData = data;
    },
    companyStatus(state,data){
      return state.companyStatusData = data;
    },
  }
}