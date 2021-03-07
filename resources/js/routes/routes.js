import dashboard from '../components/backend/dashboard.vue';
import categories
 from '../components/backend/category/manage-category.vue';

export const routes = [
	{path:'/',component: dashboard},
	{path:'/categories',component: categories},
];