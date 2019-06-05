<template>
    <!--<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--<div class="modal-dialog" role="document">-->

    <!--<form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">-->

    <modal name="payModal"  height="auto" :scrollable="true">
        <div class="row" style="margin-bottom:0px;">
            <header class="section-header">
                <h2>You're in good company</h2>
                <hr>
                <p class="lead">Join our satisfied customers using our product.</p>
            </header>
            <div class="col-md-8 col-md-offset-2" style="margin: 0px auto">

                <input hidden="email" name="email" class="form-control" value="ade@gmail.com">
                <input type="hidden" name="orderID" value="345">
                <input type="hidden" name="amount" value="1000">
                <input type="hidden" name="reference" value="34343">
                <input type="hidden" name="key" value="xfewww6">
                <button class="btn btn-success btn-lg btn-block" @click="submitPayForm()" style="margin-top: -60px; margin-bottom:10px" type="submit" value="Pay Now!">
                    <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                </button>

                <div>
                    <img src="/user/assets/img/pay_stack_card.png" alt="" style="margin-bottom:20px">
                </div>
            </div>
        </div>

    </modal>

    <!--</form>-->

</template>

<script>
    import vmodal from 'vue-js-modal'
    import Axios from 'axios'
    Vue.use(vmodal)
    export default {

        props: ['amount', 'keyd', 'refd', 'user_email'],

        mounted(){

            this.$parent.$on('pay-plan', () => {

                this.$modal.show('payModal');

                // console.log('al good')
            })
        },

        methods: {

            submitPayForm(){

                let axiosConfig = {
                    headers: {
                        'Content-Type': 'application/json;charset=UTF-8',
                        "Access-Control-Allow-Origin": "http://127.0.0.1:8000/pay",
                    }
                }

                var postData = {
                    amount: this.amount,
                    reference: this.refd,
                    key: this.keyd,
                    email: this.user_email,
                }

                Axios.post('/pay',


                    postData,

                    axiosConfig,

                ).then(res => {
                    console.log(res)
                }).catch(err => {
                    console.log(err)
                })

            }
        }
    }
</script>

<style scoped>

</style>