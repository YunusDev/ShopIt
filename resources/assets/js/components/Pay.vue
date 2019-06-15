<template>

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
</template>

<script>

    import Swal from 'sweetalert';
    import vmodal from 'vue-js-modal'
    import Axios from 'axios'
    Vue.use(vmodal)

    export default {
        props: ['amount', 'refd', 'keyd'],

        mounted(){

            this.$parent.$on('pay-plan', () => {

                this.$modal.show('payModal');

            })
        },

    }
</script>

<style scoped>

</style>