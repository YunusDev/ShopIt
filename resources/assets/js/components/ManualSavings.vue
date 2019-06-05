<template>
    <div class="row">
        <div class="col-lg-4" v-for="saving in savings" >
        <div>
            <div  class="card ks-card-widget ks-widget-payment-card-rate-details mb-3 "  style="">

                <h5 class="card-header">

                    {{saving.name}}

                    <button class="btn btn-outline-info btn-sm" @click="viewSavingsModal(saving)">View</button>
                    <button class="btn btn-success btn-sm" @click="testShit(saving.id, saving.remaining_amount)">TopUp!</button>

                </h5>

                <div class="card-block">
                    <div class="ks-card-widget-datetime">
                        To reach your goal of <span class="ks-text-bold">N{{saving.goal_amount}}</span>
                        you will have to
                    </div>

                    <table class="table ks-payment-card-rate-details-table">
                        <tbody><tr >
                            <td class="ks-currency">
                                Date Created
                            </td>
                            <td class="ks-amount">{{saving.date}}</td>
                        </tr>
                        <tr>
                            <td class="ks-currency">
                                Type
                            </td>

                            <td class="ks-amount" >{{saving.type}}</td>
                        </tr>
                        <tr>
                            <td class="ks-currency">
                                Goal Amount
                            </td>
                            <td class="ks-amount">N{{saving.goal_amount}}</td>
                        </tr>
                        <tr>
                            <td class="ks-currency">
                                Payment  Channel
                            </td>

                            <td class="ks-amount" >{{saving.authorize.channel}}</td>
                        </tr>
                        <tr>
                            <td class="ks-currency">
                                Count of Payments Made
                            </td>
                            <td class="ks-amount" style="">{{saving.cnt_payments_made}}
                            </td>
                        </tr>
                        <tr>
                            <td class="ks-currency">
                                Remaining Amount
                            </td>

                            <td class="ks-amount" ><i>N{{saving.remaining_amount}}</i></td>
                        </tr>

                        <tr>
                            <td class="ks-currency">
                                End Date
                            </td>
                            <td class="ks-amount" style="">{{saving.end_date}}</td>
                        </tr>


                        </tbody></table>
                </div>
            </div>
        </div>

    </div>

        <test  :refd = "refd" :keyd = "keyd"  :user_email = "user_email"></test>

        <savings-payments></savings-payments>
    </div>
</template>

<script>
    
    export default {
        
        props: ['raw_savings', 'user_email', 'refd', 'keyd'],
        
        data(){
            
            return {

                savings: JSON.parse(this.raw_savings)
            }
        },

        methods: {

            testShit(savingId, remaining){

                this.$emit('test_shit', savingId, remaining)

            },


            openTopUpModal(savingId, remaining){

                this.$emit('toppingManual', savingId, remaining);

            },

            viewSavingsModal(savingIsh){

                this.$emit('savings_payment_modal', savingIsh)

            }
        }
    }
</script>

<style scoped>

</style>