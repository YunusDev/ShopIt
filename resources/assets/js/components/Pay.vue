<template>

    <!--<div class="row col-sm-12 " style="margin-bottom:0px;">-->

    <modal name="payModal"   height="auto" width="330px"  :scrollable="true">
                    <header class="section-header">
                        <h2 class="mt-4">You're in good company</h2>
                        <hr>
                        <p class="lead">Join our satisfied customers using our product.</p>
                    </header>
                    <div class="col-md-8 col-md-offset-2" style="margin: 0px auto">

                        <button class="btn-round btn btn-success btn-lg btn-block" @click="submitPayForm()" style="margin-top: -60px; margin-bottom:10px" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                        </button>
                        
                        <div>
                            <img src="/user/assets/img/pay_stack_card.png" alt="" style="margin-bottom:20px">
                        </div>
                    </div>

            </modal>
    <!--</div>-->


</template>

<script>
    import Swal from 'sweetalert';
    import vmodal from 'vue-js-modal'
    import Axios from 'axios'
    Vue.use(vmodal)
    export default {

        props: ['amount', 'keyd', 'refd', 'user_email', 'batchId', 'invest_name', 'investment_product_id', 'user_id'],

        mounted(){

            this.$parent.$on('pay-plan', () => {

                this.$modal.show('payModal');

                // console.log('al good')
            })
        },

        methods: {

            submitPayForm(){

                this.$modal.hide('payModal');
                var self = this;
                var handler = PaystackPop.setup({
                    key: this.keyd,
                    email: this.user_email,
                    amount: this.amount * 100,
                    currency: "NGN",
                    ref: this.refd, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
                        // Swal({ text: 'Please wait while we subscribe you to the plan ...', buttons: false });

                        console.log(response);

                        if (response.status == 'success'){

                            Axios.post('/callback', {

                                name: self.invest_name,
                                amount: self.amount,
                                investment_batch_id: self.batchId,
                                reference: response.reference,
                                investment_product_id: self.investment_product_id,
                                user_id: self.user_id

                            }).then(res => {

                                console.log(res);

                                Swal( "Success" ,  "Payment Made Successfully!" ,  "success" ).then(() => {

                                    window.location = '/dashboard/investment';

                                });

                            }).catch(err => {

                                console.log(err)

                            })

                        }else {

                            Swal('Error', 'Payment not Successful try again!' , 'error').then(() => {

                                window.location = '/plan';

                            });

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