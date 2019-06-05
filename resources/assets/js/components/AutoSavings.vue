<template>
    <div class="row">
        <div class="col-lg-4" v-for="saving in savings" >
            <div>
                <div  class="card ks-card-widget ks-widget-payment-card-rate-details mb-3 "  style="">

                    <h5 class="card-header">

                        {{saving.name}}

                        <button class="btn btn-outline-info btn-sm" @click="viewSavingsModal(saving)">View</button>

                    </h5>
                    <div class="card-block">
                        <div class="ks-card-widget-datetime">
                            To reach your goal of <span class="ks-text-bold">N{{saving.goal_amount}}</span>
                            you will be charged <span class="ks-text-bold">N{{saving.freq_amount}}</span>
                            {{saving.frequency}} for {{saving.goal_cnt_payments}} times
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
                                    Freq. Amount
                                </td>
                                <td class="ks-amount">N{{saving.freq_amount}}</td>
                            </tr>

                            <tr>
                                <td class="ks-currency">
                                    Frequency
                                </td>
                                <td class="ks-amount" style="">{{saving.frequency}}</td>
                            </tr>

                            <tr>
                                <td class="ks-currency">
                                    Range
                                </td>
                                <td class="ks-amount" style="">{{saving.goal_cnt_payments}} times
                                </td>
                            </tr>
                            <tr>
                                <td class="ks-currency">
                                    Count of Payments Made
                                </td>
                                <td class="ks-amount" style="">{{saving.cnt_payments_made}} / {{saving.goal_cnt_payments}}
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
                                    Next Payout Date
                                </td>
                                <td class="ks-amount" style="">{{saving.next_payout_date}}
                                </td>
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

        <savings-payments-auto></savings-payments-auto>

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

            viewSavingsModal(savingIsh){

                this.$emit('savings_payment_modal_auto', savingIsh)

            }
        }
    }
</script>

<style scoped>

</style>