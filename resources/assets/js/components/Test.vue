<template>
    <div class="modal fade bd-example-modal-horizontal-form" id="testShit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">


                        <div class="form-group row">
                            <div class="col-10">
                                <input placeholder="Amount to Save" class="form-control" v-model="amount" type="tel" id="example-tel-input">
                            </div>
                        </div>

                        <hr>

                        <h5>Amount Remaining to save is N{{remaining_amount}}</h5>

                        <hr>

                        <div class="form-group row">
                            <div class="offset-sm-4 col-sm-10" style="">
                                <!--<button type="submit" class="btn btn-success">Pay Now!!!</button>-->
                                <button type="submit" @click="topUpManual()" class="btn btn-success">Top Now!!!</button>
                            </div>
                        </div>

                        <div>
                            <img src="/user/assets/img/pay_stack_card.png" alt=""  style="margin-bottom:20px">
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Swal from 'sweetalert';
    import Axios from 'axios'
    export default {

        props: ['keyd', 'refd', 'user_email'],

        data(){

            return{

                amount: '',
                savingId: '',
                remaining_amount: ''
            }
        },

        mounted() {

            this.$parent.$on('test_shit', (savingsId, remaining) => {

                this.savingId = savingsId;
                this.remaining_amount = remaining;
                $('#testShit').modal();

            });

        },

        methods: {

             topUpManual(){

                // this.$modal.hide('payModal');
                $('#testShit').modal('hide');

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

                            Axios.post('/manual/top_up', {

                                amount: self.amount,
                                saving_id: self.savingId,
                                reference: response.reference


                            }).then((res) => {

                                console.log(res);

                                Swal( "Success" ,  "Payment Made Successfully!" ,  "success" ).then(() => {

                                    window.location = '/dashboard/my_savings';

                                });

                            }).catch((err) => {

                                console.log(err);

                            })


                        }else {

                            Swal('Error', 'Payment not Successful try again!' , 'error');

                        }


                        console.log('Them Status half!!!4');

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