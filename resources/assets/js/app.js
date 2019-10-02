
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueInstantSearch from 'vue-instantsearch';
Vue.use(VueInstantSearch);

Vue.filter('readMore', function (text, length, suffix) {

    if (text.length < length){

        return text;
    }

    return text.substring(0, length) + suffix;
});

Vue.filter('formatMon', function (amount, decimalCount = 0, decimal = ".", thousands = ",") {

    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
});

Vue.filter('formatMoney', function (amount, decimalCount = 2, decimal = ".", thousands = ",") {

    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
});
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

Vue.component('coupons', require('./components/Admin/Coupons.vue'));
Vue.component('create-coupon', require('./components/Admin/CreateCoupon.vue'));


Vue.component('my-search', require('./components/MySearch.vue'));

const app = new Vue({
    el: '#app'
});

