//moment Js

import moment from 'moment';
import Vue from 'vue';
Vue.filter('time',(a)=>{
	return moment(a).format('MMMM Do YYYY, h:mm:ss a');
});
Vue.filter('subString',(content,length)=>{
	return content.substring(0,length)
});