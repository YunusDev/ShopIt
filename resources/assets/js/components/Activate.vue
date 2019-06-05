<template>

    <modal name="activateSavings"   height="auto" width="330px"  :scrollable="true">
        <header class="section-header">
            <h2 class="mt-4">You're in good company</h2>
            <hr>
            <p class="lead">Join our satisfied customers using our product.</p>
        </header>
        <div class="col-md-8 col-md-offset-2" style="margin: 0px auto">

            <div v-if="is_auto">You will be charged <b><i>N{{freq_amount}}</i></b> now!</div>
            <h6 v-else>You will be charged <b><i>{{first_amount}}</i></b> now!</h6>
            <button class="btn-round btn btn-success btn-lg btn-block" @click="submitPayForm()" style="margin-top: -60px; margin-bottom:10px" type="submit" value="Pay Now!">
                <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
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

        props: ['first_amount', 'isAutomatic','goal_cnt_payments', 'user_email', 'freq_amount', 'goal_amount', 'keyd', 'refd', 'user_id', 'type', 'name', 'frequency', 'end_date', 'name'],

        data(){

            return{

                is_auto:  this.isAutomatic
            }

        },

        mounted(){

            this.$parent.$on('activate-savings', () => {

                this.$modal.show('activateSavings');

                // console.log('al good')
            })
        },

        methods: {

            submitPayForm(){

                this.$modal.hide('activateSavings');
                var self = this;

                if (this.isAutomatic) {

                    var handler = PaystackPop.setup({
                        key: this.keyd,
                        email: this.user_email,
                        amount: this.freq_amount * 100,
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
                        callback: function (response) {
                            // Swal({ text: 'Please wait while we subscribe you to the plan ...', buttons: false });

                            console.log(response);

                            if (response.status == 'success') {

                                Axios.post('/activate_savings/automatic', {

                                    reference: response.reference,
                                    type: self.type,
                                    name: self.name,
                                    goal_amount: self.goal_amount,
                                    freq_amount: self.freq_amount,
                                    goal_cnt_payments: self.goal_cnt_payments,
                                    frequency: self.frequency,
                                    end_date: self.end_date,
                                    user_id: self.user_id,
                                    frequency_name: self.frequency_name

                                }).then(res => {

                                    console.log(res.data);

                                    Swal("Success", "Savings Activated Successfully!", "success").then(() => {

                                        window.location = '/dashboard/my_savings';

                                    });

                                }).catch(err => {

                                    console.log(err)

                                })


                            } else {

                                Swal('Error', 'Payment not Successful try again!', 'error').then(() => {

                                    window.location = '/create/savings';

                                });

                            }


                        },
                        onClose: function () {
                            alert('window closed');
                        }
                    });

                }else{

                    var handler = PaystackPop.setup({
                        key: this.keyd,
                        email: this.user_email,
                        amount: this.first_amount * 100,
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
                        callback: function (response) {
                            // Swal({ text: 'Please wait while we subscribe you to the plan ...', buttons: false });

                            console.log(response);

                            if (response.status == 'success') {

                                Axios.post('/activate_savings/manual', {

                                    reference: response.reference,
                                    type: self.type,
                                    name: self.name,
                                    goal_amount: self.goal_amount,
                                    first_amount: self.first_amount,
                                    end_date: self.end_date,
                                    user_id: self.user_id,
                                    remaining_amount: self.goal_amount - self.first_amount

                                }).then(res => {

                                    console.log(res.data);

                                    Swal("Success", "Savings Activated Successfully!", "success").then(() => {

                                        window.location = '/dashboard/my_savings';

                                    });

                                }).catch(err => {

                                    console.log(err)

                                })


                            } else {

                                Swal('Error', 'Payment not Successful try again!', 'error').then(() => {

                                    window.location = '/create/savings';

                                });

                            }


                        },
                        onClose: function () {
                            alert('window closed');
                        }
                    });

                }
                handler.openIframe();

            }
        }
    }
</script>

<style scoped>

</style>