
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('add-to-cart', require('./components/AddToCart.vue'));
Vue.component('cart', require('./components/Cart.vue'));
Vue.component('order-step', require('./components/OrderStepForm.vue'));
Vue.component('pay', require('./components/Pay.vue'));

Vue.component('categories', require('./components/Admin/Categories.vue'));
Vue.component('create-category', require('./components/Admin/CreateCategory.vue'));

Vue.component('products', require('./components/Admin/Products.vue'));
Vue.component('create-product', require('./components/Admin/CreateProduct.vue'));



const app = new Vue({
    el: '#app'
});
