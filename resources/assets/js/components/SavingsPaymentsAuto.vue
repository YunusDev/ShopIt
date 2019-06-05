<template>
    <div class="modal fade bd-example-modal-horizontal-form" id="viewSavingsModalAuto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{saving.name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="card ks-card-widget ks-widget-table">
                            <h5 class="card-header">
                                Activities

                                <!--<div class="ks-controls">-->
                                <!--<a href="#" class="ks-control-link">View All Invoices</a>-->
                                <!--</div>-->
                            </h5>
                            <div  class="card-block flowx">
                                <table  class="table ks-payment-table-invoicing">
                                    <tbody><tr>
                                        <th width="1">#</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th width="1">Status</th>
                                    </tr>


                                    <tr v-for="payment in saving.savings_payments">
                                        <td>{{payment.id}}</td>
                                        <td>{{payment.amount}}</td>
                                        <td>{{payment.date}}</td>
                                        <td>
                                            <span class="badge badge-success">SUCCESS</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){

            return {

                saving: ''

            }
        },

        mounted(){

            this.$parent.$on('savings_payment_modal_auto', (savingIsh) => {

                this.saving = savingIsh;

                $('#viewSavingsModalAuto').modal();

            });

        }
    }
</script>

<style scoped>

    @media screen and (max-width:450px) {
        div.flowx{

            width:100%;
            overflow-x: scroll

        }
    }

</style>