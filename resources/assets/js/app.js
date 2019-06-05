
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
// Vue.component('plans', require('./components/InvestmentProduct.vue'));
Vue.component('step-form', require('./components/StepForm.vue'));
Vue.component('pay', require('./components/Pay.vue'));


Vue.component('merchants', require('./components/Admin/Merchants.vue'));
Vue.component('create-merchant', require('./components/Admin/CreateMerchant.vue'));

Vue.component('investment-products', require('./components/Admin/InvestmentProduct.vue'));
Vue.component('create-investment-product', require('./components/Admin/StoreInvestmentProduct.vue'));

Vue.component('savings-step', require('./components/SavingsStepForm.vue'));
Vue.component('activate-savings', require('./components/Activate.vue'));
Vue.component('auto-savings', require('./components/AutoSavings.vue'));
Vue.component('manual-savings', require('./components/ManualSavings.vue'));
Vue.component('savings-payments', require('./components/SavingsPayments.vue'));
Vue.component('savings-payments-auto', require('./components/SavingsPaymentsAuto.vue'));
Vue.component('test', require('./components/Test.vue'));

const app = new Vue({
    el: '#app'
});
