<template>

    <div>

        <form-wizard @on-complete="onComplete" title=" " subtitle = ' ' stepSize = "md" color ="#007bff">
            <tab-content title="Name of Plan" icon="ti-user" :before-change="validateFirstStep">

                <div class="" v-if="first_errors.length > 0" >

                    <h6 style="color: orangered" class="text-center" v-for="error in first_errors" :key="first_errors.indexOf(error)">{{error}}</h6>

                </div>

                <div class="form-group col-lg-6 " style="margin: 10px auto">
                    <label for="name">What name would you like to name it: </label>
                    <input type="text"  class="form-control" id ="name" v-model="name" placeholder="Name" >
                </div>

                <!--<h3 id="flatpickr-basic-usage">Basic Usage</h3>-->
                <!--<p><b>A basic datepicker</b></p>-->
            </tab-content>
            <tab-content title="Type of Savings" icon="ti-user" :before-change="validateSecondStep">

                <div class="" v-if="second_errors.length > 0" >

                    <h6 style="color: orangered" class="text-center" v-for="error in second_errors" :key="second_errors.indexOf(error)">{{error}}</h6>

                </div>

                <div class="form-group col-lg-6" style="margin: 10px auto">
                    <label for="amount">Savings Type:</label>
                    <select class="form-control" v-model="type">
                        <!--<option value="daily" selected>Select an Option</option>-->
                        <option value="manual" >Manual</option>
                        <option value="automatic">Automatic</option>
                    </select>
                </div>

            </tab-content>
            <tab-content title="Goal Settings" icon="ti-money" :before-change="validateThirdStep">
                <div style="margin: 10px auto">

                   <div v-if="isAutomatic" class="form-group col-lg-6" style="margin: 10px auto">
                       <label for="amount">Choose Frequency:</label>
                       <select class="form-control" v-model="frequency">
                           <!--<option value="daily" selected>Select an Option</option>-->
                           <option value="daily" >Daily</option>
                           <option value="weekly">Weekly</option>
                           <option value="monthly">Monthly</option>
                       </select>
                   </div>


                    <div  class="form-group col-lg-6" style="margin: 10px auto">
                            <label for="amount">Goal Amount to Save:</label>
                            <input type="number"  class="form-control" id ="amount" v-model="goal_amount" placeholder="Amount" >
                     </div>

                    <div v-if="!isAutomatic" class="form-group col-lg-6" style="margin: 10px auto">
                        <label for="amount">Amount to Save Now:</label>
                        <input type="number"  class="form-control"  v-model="first_amount" placeholder="Amount" >
                    </div>

                    <div  class="form-group col-lg-6" style="margin: 10px auto" >
                        <label for="amount">End Date: <small style="font-size: 13px" v-if="isAutomatic">{{diffDates}} {{frequencyOther}} from now...</small></label>
                        <input type="date" class="form-control" v-model = "end_date">
                        <!--<input type="number" class="form-control flatpickr" v-model = "end_date" value="End Date">-->
                    </div>

                 </div>
            </tab-content>
            <tab-content title="Confirm Settings"
                         icon="ti-settings">


                <div v-if="isAutomatic"  class="form-group col-lg-6" style="margin: 10px auto">

                    <h5>Amount to save is N{{goal_amount}}</h5>
                    <small>Type of Savings is {{type}} and the frequency is {{frequency}}</small>
                    <br>
                    <h6>To reach your goal of N{{goal_amount}} you will have to deposit N{{computeFreqAmount}} {{frequency}} for {{diffDates}} {{frequencyOther}}</h6>
                    <hr>
                    <h5>Total Amount That will be saved is N{{computeFreqAmount * diffDates}} .. {{goal_amount}}</h5>
                    <hr>
                    <h6>You will be charged <b>N{{computeFreqAmount}}</b> now for your first payment!</h6>

                </div>

                <div v-else class="form-group col-lg-6" style="margin: 10px auto">

                    <h5>Goal Amount to save is N{{goal_amount}}</h5>
                    <hr>

                    <h6>The Amount is expected to be saved before or on {{end_date}}</h6>
                    <hr>

                    <h5>First Amount to be charged is N{{first_amount}}</h5>

                </div>

            </tab-content>
        </form-wizard>

        <activate-savings :isAutomatic = "isAutomatic" :first_amount = "first_amount" :goal_amount = "goal_amount" :type = "type" :frequency = "frequency" :end_date = "end_date" :refd = "refd" :keyd = "keyd"
             :frequency_name ="frequencyOther"   :user_email ="user_email" :user_id = "user_id" :name = "name" :freq_amount="freq_amount" :goal_cnt_payments="goal_cnt_payments"></activate-savings>


    </div>


</template>

<script>
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'

    export default {

        name: 'Savings-Step',

        props: ['keyd', 'refd', 'user_email', 'user_id', 'start_date'],

        data(){

            return{

                name: 'Testing',
                type: 'manual',
                goal_amount: 5000,
                freq_amount: '',
                first_amount: '',
                // diff_dates: diffDates(),
                frequency: 'daily',
                goal_cnt_payments: '',
                end_date: '',
                first_errors: [],
                second_errors: [],
                frequency_rep: ''

            }

        },

         computed: {

            isAutomatic(){

                return this.type === 'automatic';
            },

             diffDates(){

                 const date1 = new Date(this.start_date);
                 const date2 = new Date(this.end_date);
                 const diffTime = Math.abs(date2.getTime() - date1.getTime());
                 this.goal_cnt_payments =   Math.round(Math.ceil(diffTime / (1000 * 60 * 60 * 24)) / this.frequency_rep);

                 return this.goal_cnt_payments;

             },


             computeFreqAmount(){

                if (this.frequency == 'daily'){

                    this.frequency_rep = 1

                }else if (this.frequency == 'weekly'){

                    this.frequency_rep = 7

                }else{

                    this.frequency_rep = 30
                }

                 const diff = this.diffDates

                 this.freq_amount = Math.ceil(this.goal_amount / diff);

                 return this.freq_amount;
             },

             frequencyOther(){

                 if (this.frequency == 'daily'){

                     return 'days'

                 }else if (this.frequency == 'weekly'){

                     return 'weeks'

                 }else{

                     return 'months'
                 }

             }


         },

        methods: {

            onComplete(){

                this.$emit('activate-savings');

            },

            validateFirstStep(){

                if (this.name) {
                    return true;
                }

                this.first_errors = [];

                if (!this.name) {
                    this.first_errors.push('Name required.');

                }
            },

            validateSecondStep(){

                if (this.type) {
                    return true;
                }

                this.first_errors = [];
                this.second_errors = [];

                if (!this.type) {
                    this.second_errors.push('Type of Savings required.');

                }

            },

            validateThirdStep(){

                return true;

            }
        }
    }
</script>

<style scoped>


</style>