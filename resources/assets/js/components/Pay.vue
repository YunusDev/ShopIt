<template>

    <modal name="payModal"   height="auto" width="320px"  :scrollable="true">
        <header class="section-header">
            <h2 class="mt-4">You're in good company</h2>
            <hr>
            <p class="lead">Join our satisfied customers using our product.</p>
        </header>
        <div class="col-md-8 col-md-offset-2" style="margin: 0px auto">

            <button class="btn-round btn btn-success btn-lg btn-block" @click="submitPayForm()"
                    style="padding-left:3px; padding-right:3px; margin-top: -60px; margin-bottom:10px" type="submit" value="Pay Now!">
                <i class="fa fa-plus-circle fa-lg"></i> Pay N{{this.amount | formatMon}} Now!
            </button>

            <div>
                <img src="/user/assets/img/pay_stack_card.png" alt="" style="margin-bottom:20px">
            </div>
        </div>

    </modal>
</template>

<script>

    import Swal from 'sweetalert';
    import vmodal from 'vue-js-modal'
    import Axios from 'axios'
    Vue.use(vmodal)

    export default {
        props: ['amount', 'keyd', 'coupon', 'order'],

        data(){

            return {

                req: this.order,

            }

        },

        mounted(){

            this.$parent.$on('pay-plan', () => {

                this.$modal.show('payModal');

            })
        },

        methods: {

            submitPayForm(){

                var the = this;

                var handler = PaystackPop.setup({

                    key: 'pk_test_5e135e1e155153434af039038d29a2a3812843f4',
                    email: 'yunusabdulqudus1@gmail.com',
                    amount: the.amount * 100,
                    currency: "NGN",
                    // ref: Math.random().toString(36).substring(7), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    metadata: {
                        custom_fields: [
                            {
                                display_name: "Mobile Number",
                                variable_name: "mobile_number",
                                value: "+2348012345678"
                            }
                        ]
                    },
                    callback: function(response){
                        Swal({ text: 'Please wait while we charge you ...', buttons: false });

                        // console.log(response);

                        if (response.status === 'success'){

                            Axios.post('/order', {order: the.order, total_price: the.amount, coupon: the.coupon}).then(res => {

                                console.log(res);

                                Swal('Order Initiated successfully...').then(()=>{

                                    window.location = '/';

                                })

                            }).catch(err => {

                                console.log(err.response);

                            });



                        }else {

                            Swal('Error', 'Payment not Successful try again!' , 'error');

                        }

                    },
                    onClose: function(){
                        alert('window closed');
                    }
                });
                handler.openIframe();




            }

        }

    }
</script>

<style scoped>

</style>