<template>

    <div class="col-lg-10 col-sm-12 " style="margin: 0px auto">

        <form-wizard @on-complete="onComplete" title=" " subtitle = ' ' stepSize = "md" color ="#007bff">
            <tab-content title="Confirm Order" icon="ti-user" :before-change="validateFirstStep">

                <div class="form-group " style="">

                    <div class="row">

                        <header class="section-header" style="margin-bottom: 10px">
                            <h2>Confirm Order</h2>
                            <hr>
                            <p class="lead">Drop us an email if you couldn't find an answer to your question in the following list.</p>
                        </header>

                    </div>

                    <div class="cart-price">

                        <div class="flexbox" v-for="cart in carts">
                            <div>
                                <p><strong>{{cart.name}}</strong> ({{cart.qty}})</p>
                            </div>

                            <div>
                                <p class="fw-600">N{{cart.price  * cart.qty | formatMon}}</p>
                            </div>
                        </div>
                        <div class="flexbox" v-if="Object.keys(coupon).length > 1">
                            <div>
                                <p class="text-success"><strong>Coupon:</strong></p>
                            </div>

                            <div>
                                <p  class="fw-600 text-success" v-if="coupon.message.type === 'price'">N{{coupon.message.discount | formatMon}} off</p>
                                <p class="fw-600 text-success" v-else>{{coupon.message.discount}}% off</p>
                            </div>
                        </div>

                        <div class="flexbox">
                            <div>
                                <p><strong>Delivery Fee:</strong></p>
                            </div>

                            <div>
                                <p class="fw-600">N1,000</p>
                            </div>
                        </div>

                        <hr>

                        <div class="flexbox">
                            <div>
                                <p><strong>Total:</strong></p>
                            </div>

                            <div>
                                <p class="fw-600">N{{totalFee | formatMon}}</p>
                            </div>
                        </div>
                     </div>

                </div>

            </tab-content>
            <tab-content title="Order Details" icon="ti-settings" :before-change="validateSecondStep">

                <div class="row">
                    <header class="section-header">
                        <h2>Order Details</h2>
                    </header>
                </div>
                <div class="row">

                    <div class="col-12 col-md-6 form-group">
                        <input class="form-control" v-model="order.name" type="text" placeholder="Full Name">
                    </div>

                    <div class="col-12 col-md-6 form-group">
                        <input class="form-control" v-model="order.phone" type="number" placeholder="Phone Number">
                    </div>

                    <div class="col-12 col-md-6 form-group">
                        <input class="form-control" v-model="order.email" type="email" placeholder="Email Address">
                    </div>

                    <input type="hidden" v-model="coupon.total_price">

                    <div class="col-12 col-md-6 form-group">
                        <input class="form-control" v-model="order.address" type="text" placeholder="Address">
                    </div>

                    <div class="col-12 col-md-6 form-group">
                        <input class="form-control" v-model="order.local_govt" type="text" placeholder="Local Government">

                    </div>
                    <div class="col-12 col-md-6 form-group">
                        <input class="form-control" v-model="order.state" type="text" placeholder="State">

                    </div>

                    <div class="col-12 form-group">
                        <textarea class="form-control"  v-model="order.comment" placeholder="Additional instructions" rows="5"></textarea>
                    </div>

                </div>

            </tab-content>
            <tab-content title="Initiate Order" icon="ti-settings">

                <div>
                    <div class="form-group col-lg-8" style="margin: 10px auto">

                            <header class="section-header" style="margin-buttom: 0">
                                <small>Faq</small>
                                <h2>Method of Payment:</h2>
                                <hr>
                                <p class="lead">Drop us an email if you couldn't find an answer to your question in the following list.</p>
                            </header>


                            <label class="custom-control custom-radio">
                                <input v-model="order.paylater" :value="'Yes'" type="radio" class="custom-control-input" name="radio1">
                                <span class="custom-control-indicator"></span>
                                <span style="font-size: 16px" class="custom-control-description">Pay on Delivery</span>
                            </label>
                            <hr>
                            <label class="custom-control custom-radio">
                                <input v-model="order.paylater" :value="'No'" type="radio" class="custom-control-input" name="radio1">
                                <span class="custom-control-indicator"></span>
                                <span style="font-size: 16px" class="custom-control-description">Pay Online with Card Now...</span>
                            </label>

                    </div>

                    <div v-if="isPayingOnDelivery">

                        <div class="form-group">
                            <label>
                                <input type="radio" name="r3" class="flat-red" checked>
                            </label>
                            <label>
                                <input type="radio" name="r3" class="flat-red">
                            </label>

                        </div>

                    </div>
                </div>

            </tab-content>

        </form-wizard>

        <pay :amount = "totalFee"  :keyd = "keyd" :coupon = "coupon" :order = "order" ></pay>

    </div>

</template>

<script>

    class Order{

        constructor(order){

            this.name = order.name || 'Ade';
            // this.total_price = this.total_price;
            this.email = order.email || 'ade@gmail.com';
            this.phone = order.phone || 2333455;
            this.local_govt = order.local_govt || '';
            this.state = order.state || '';
            this.address = order.address || '';
            this.comment = order.comment || '';
            this.paylater = order.paylater || 'Yes';
        }

    }

    import {FormWizard, TabContent} from 'vue-form-wizard'
    import VeeValidate from 'vee-validate'
    // import VueFormWizard from 'vue-form-wizard'
    // Vue.use(VueFormWizard)
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'
    import Axios from 'axios'
    import Swal from 'sweetalert'

    export default {

        props: ['totalFee', 'carts', 'keyd', 'coupon'],

        data(){

            return{

                order: new Order({}),
                payment_type: '',
                // total_price:  this.totalFee

            }
        },

        computed: {

            isPayingOnDelivery(){

                return this.paylater === 'Yes';
            },

        },

        methods: {

            validateFirstStep(){

                return true;

            },

            validateSecondStep(){

                return true;

            },

            onComplete(){

                if (this.order.paylater === 'Yes'){

                    Axios.post('/order', {order: this.order, total_price: this.totalFee, coupon: this.coupon}).then(res => {

                        console.log(res);
                        Swal('Order Initiated successfully...').then(()=>{

                            window.location = '/';

                        })

                    }).catch(err => {

                        console.log(err.response);

                    })

                } else{

                    this.$emit('pay-plan');

                }


            }


        }


    }
</script>

<style scoped>

    .big_label{

        font-size: 20px;
        font-weight: bold;
        font-family: "Dosis","Open Sans",sans-serif;
        line-height: 1.6;
        letter-spacing: 1.5px;
        margin-right: 15px;
    }

</style>