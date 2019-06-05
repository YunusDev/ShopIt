<template>
    <div class="modal fade" id="createMerchant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('name')}" placeholder="Name" v-model="merchant.name">
                        <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('code')}" placeholder="Code" v-model="merchant.code">
                        <div class="invalid-feedback" v-if="errors.hasError('code')">{{ errors.first('code') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="email" :class="{'form-control': true, 'is-invalid': errors.hasError('email')}"  placeholder="Email" v-model="merchant.email">
                        <div class="invalid-feedback" v-if="errors.hasError('email')">{{ errors.first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('state')}" placeholder="State" v-model="merchant.state">
                        <div class="invalid-feedback" v-if="errors.hasError('state')">{{ errors.first('state') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('country')}" placeholder="Country" v-model="merchant.country">
                        <div class="invalid-feedback" v-if="errors.hasError('country')">{{ errors.first('country') }}</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateMerchant(merchant.id)" v-if="editing">Update Merchant</button>
                    <button type="button" class="btn btn-primary" @click="createMerchant()" v-else>Create Merchant</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    class Merchant{

        constructor(merchant){

            this.name = merchant.name || '';
            this.code = merchant.code || '';
            this.email = merchant.email || '';
            this.state = merchant.state || '';
            this.country = merchant.country || '';
        }

    }

    import ErrorBag from '../error_bag'
    import Axios from 'axios'
    // import $ from "jquery"

    export default {

        mounted(){

            this.$parent.$on('create_merchant', () => {

                this.editing = false;
                this.merchant = new Merchant({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createMerchant').modal()


            })

            this.$parent.$on('edit_merchant', (merchant) => {

                // console.log(merchant.name);
                this.editing = true;
                this.merchant = new Merchant(merchant);
                this.merchant.id = merchant.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createMerchant').modal()

            });




        },

        data(){

            return {

                merchant: new Merchant({}),
                editing: false,
                errors: new ErrorBag

            }
        },

        computed: {

            name(){

                if (this.editing == true){

                    return 'Edit Merchant'
                }

                return 'Create Merchant'

            }
        },

        methods: {

            createMerchant(){

                Axios.post('/admin/merchants', this.merchant).then(res => {

                    this.$parent.$emit('store_merchant', res.data);

                    $('#createMerchant').modal('hide')

                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;

                        this.errors.setErrors(errors);
                    }
                })

            },

            updateMerchant(id){

                console.log(id);
                Axios.put(`/admin/merchants/${id}`, this.merchant).then(res => {

                    this.$parent.$emit('update_merchant', res.data);
                    $('#createMerchant').modal('hide');

                }).catch(err => {


                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                })

            }
        }



    }
</script>

<style scoped>

</style>