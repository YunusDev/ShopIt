<template>
    <div class="modal fade" id="createPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('name')}" placeholder="Name" v-model="plan.name">
                        <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('code')}" placeholder="Code" v-model="plan.code">
                        <div class="invalid-feedback" v-if="errors.hasError('code')">{{ errors.first('code') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('minimum_capital')}"  placeholder="Minimum Capital " v-model="plan.minimum_capital">
                        <div class="invalid-feedback" v-if="errors.hasError('minimum_capital')">{{ errors.first('minimum_capital') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('maximum_capital')}" placeholder="Maximum Capital" v-model="plan.maximum_capital">
                        <div class="invalid-feedback" v-if="errors.hasError('maximum_capital')">{{ errors.first('maximum_capital') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('forecasted_profit')}" placeholder="Forecasted Profit" v-model="plan.forecasted_profit">
                        <div class="invalid-feedback" v-if="errors.hasError('forecasted_profit')">{{ errors.first('forecasted_profit') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('duration')}" placeholder="Duration" v-model="plan.duration">
                        <div class="invalid-feedback" v-if="errors.hasError('duration')">{{ errors.first('duration') }}</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updatePlan(plan.id)" v-if="editing">Update Plan</button>
                    <button type="button" class="btn btn-primary" @click="createPlan()" v-else>Create Plan</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Axios from 'axios'
    import ErrorBag from '../error_bag'

    class Plan{

        constructor(plan){

            this.name = plan.name || '',
            this.code = plan.code || '',
            this.minimum_capital = plan.minimum_capital || '',
            this.maximum_capital = plan.maximum_capital || '',
            this.duration = plan.duration || '',
            this.forecasted_profit = plan.forecasted_profit || ''

        }
    }

    export default {
        mounted(){

            this.$parent.$on('create-plan', () => {

                this.plan = new Plan({});
                this.editing = false;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createPlan').modal()
            });

            this.$parent.$on('edit-plan', (plan) => {

                this.plan = new Plan(plan);
                this.plan.id = plan.id;
                this.editing = true;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createPlan').modal()

            })
        },

        props: ['merchantId'],

        data(){

            return{

                editing:  false,
                plan: new Plan({}),
                merchant_id: this.merchantId,
                errors: new ErrorBag
            }

        },

        methods: {

            createPlan(){

                Axios.post(`/admin/merchant/${this.merchant_id}/plans`, this.plan).then(res => {

                    $('#createPlan').modal('hide')
                    this.$parent.$emit('store_plan', res.data)

                }).catch(err => {

                    this.errors = new ErrorBag;

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                })

            },

            updatePlan(id){

                Axios.put(`/admin/merchant/${this.merchant_id}/plans/${id}`, this.plan).then(res => {


                    $('#createPlan').modal('hide');
                    this.$parent.$emit('update_plan', res.data)

                }).catch(err => {

                    this.errors = new ErrorBag;

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }

                    console.log(err)
                })

            }

        },

        computed: {

            name(){

                if (this.editing == true){

                    return 'Edit Investment Product'
                }

                return 'Create Investment Product'

            }
        }
    }
</script>

<style scoped>

</style>