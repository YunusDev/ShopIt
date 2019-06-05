<template>
    <!--color="#46da60 0facf3"-->

    <div id = "here">

        <form-wizard @on-complete="onComplete" title=" " subtitle = ' ' stepSize = "md" color ="#007bff">
        <tab-content title="Name of Plan" icon="ti-user" :before-change="validateFirstStep">

            <div class="" v-if="errors.length > 0" >

                <h6 style="color: orangered" class="text-center" v-for="error in errors" :key="errors.indexOf(error)">{{error}}</h6>

            </div>
            <div class="form-group col-lg-6 " style="margin: 10px auto">
                <label for="name">What name would you like to name it: </label>
                <input type="text"  class="form-control" id ="name" v-model="name" placeholder="Name" >
            </div>
        </tab-content>
        <tab-content title="Amount" icon="ti-money" :before-change="validateSecondStep">
            <div class="" v-if="errors.length > 0" >

                <h6 style="color: orangered" class="text-center" v-for="error in errors" :key="errors.indexOf(error)">{{error}}</h6>

            </div>
            <div class="form-group col-lg-6" style="margin: 10px auto">
                <label for="amount">Amount:</label>
                <input type="number"  class="form-control" id ="amount" v-model="amount" placeholder="Amount" >
            </div>
        </tab-content>
        <tab-content title="Confirm Settings"
                     icon="ti-settings">
            <h5>Amount invested is N{{amount}}</h5>
            <small>Profit Percentage for plan is {{plan.forecasted_profit}}%</small>
            <br>
            <small>plan spans for  {{plan.duration}} days</small>
            <br><br>
            <h5>Expected Profit is N{{expectedProfit}}</h5>
        </tab-content>

    </form-wizard>
    <pay :amount = "amount" :batchId = "batch_id" :refd = "refd" :keyd = "keyd" :user_email ="user_email" :user_id = "user_id" :invest_name = "name" :investment_product_id ="plan.id"></pay>

    </div>

</template>

<script>
    import {FormWizard, TabContent} from 'vue-form-wizard'
    import VeeValidate from 'vee-validate'
    // import VueFormWizard from 'vue-form-wizard'
    // Vue.use(VueFormWizard)
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'
    import Axios from 'axios'
    export default {
        props: ['raw_plan', 'keyd', 'refd', 'user_email', 'user_id', 'batch_id'],

        data(){

            return{

                plan: JSON.parse(this.raw_plan),
                amount: 10000,
                name: 'First Plan',
                verified: false,
                errors: [],
            }
        },

        computed: {

            expectedProfit(){

                return Math.round(this.amount * (this.plan.forecasted_profit / 100));
            }
        },

        methods: {
            onComplete() {


                this.$emit('pay-plan');

            },
            validateFirstStep(){
                if (this.name) {
                    return true;
                }

                this.errors = [];

                if (!this.name) {
                    this.errors.push('Name required.');

                }

                // e.preventDefault();
            },
            validateSecondStep(){

                if (this.amount) {
                    return true;
                }

                this.errors = [];

                if (!this.amount) {
                    this.errors.push('Amount required.');

                }



            }

        }

    }
</script>

<style scoped>

    @media screen and (max-width: 376px){

        div#here .vue-form-wizard .wizard-card-footer div#.wizard-footer-right button{

            margin-top: 10px
        }

    }

</style>