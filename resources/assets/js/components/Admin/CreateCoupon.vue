<template>
    <div class="modal fade" id="createCoupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                        <label>Name</label>
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('name')}" placeholder="Name" v-model="coupon.name">
                        <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Select Type</label>
                        <select  v-model="coupon.type" class="form-control">
                            <!--<option selected disabled>Select a Type</option>-->
                            <option  :value="'percentage'">Percentage</option>
                            <option  :value="'price'">Amount</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('discount')}" placeholder="Discount" v-model="coupon.discount">
                        <div class="invalid-feedback" v-if="errors.hasError('discount')">{{ errors.first('discount') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Max Usage</label>
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('max_usage')}" placeholder="Max Usage" v-model="coupon.max_usage">
                        <div class="invalid-feedback" v-if="errors.hasError('max_usage')">{{ errors.first('max_usage') }}</div>
                    </div>
                    <div class="custom-control custom-checkbox col-4">
                        <input type="checkbox"  v-model="coupon.status" class="custom-control-input" id="defaultUnchecked">
                        <label class="custom-control-label pl-3" for="defaultUnchecked" >Status</label>
                    </div>

                    <div class="custom-control custom-checkbox col-4">
                        <input type="checkbox"  v-model="coupon.will_expire" class="custom-control-input" id="defaultExpire">
                        <label class="custom-control-label pl-3" for="defaultExpire" >Will Expire</label>
                    </div>

                    <!--<datepicker v-model="coupon.expires_in" :format="customFormatter" name="uniquename"></datepicker>-->

                    <hr>

                    <div class="form-group">
                        <label>Expires In</label>
                         <datetime type="datetime"   v-model="coupon.expires_in"></datetime>
                    </div>
                    <!--<div></div>-->

                    <!--<div class="form-group ">-->
                        <!--<label>Expires In</label>-->
                        <!--<input type="datetime-local"  :class="{'form-control': true, 'is-invalid': errors.hasError('expires_in')}" v-model="coupon.date" >-->
                        <!--<div class="invalid-feedback" v-if="errors.hasError('expires_in')">{{ errors.first('expires_in') }}</div>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea :class="{'form-control': true, 'is-invalid': errors.hasError('description')}" placeholder="Description" v-model="coupon.description"></textarea>
                        <div class="invalid-feedback" v-if="errors.hasError('description')">{{ errors.first('description') }}</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateCoupon(coupon.id)" v-if="editing">Update coupon</button>
                    <button type="button" class="btn btn-primary" @click="createCoupon()" v-else>Create coupon</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>


    class Coupon{

        constructor(coupon){

            this.name = coupon.name || '';
            this.description = coupon.description || '';
            this.type = coupon.type || 'percentage';
            this.discount = coupon.discount || '';
            this.max_usage = coupon.max_usage || '';
            this.status = coupon.status || false;
            this.will_expire = coupon.will_expire || '';
            this.expires_in = coupon.expires_in || '';
            this.product_id = coupon.product_id || '';

        }

    }

    import ErrorBag from '../error_bag'
    import Axios from 'axios'
    import Datetime from 'vue-datetime'
    // You need a specific loader for CSS files
    import 'vue-datetime/dist/vue-datetime.css'

    export default {

        mounted(){

            this.$parent.$on('create_coupon', () => {

                this.editing = false;
                this.coupon = new Coupon({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }

                $('#createCoupon').modal()


            });

            this.$parent.$on('edit_coupon', (coupon) => {

                this.editing = true;
                this.coupon = new Coupon(coupon);
                this.coupon.id = coupon.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createCoupon').modal()

            });

        },

        data(){

            return {

                coupon: new Coupon({}),
                editing: false,
                errors: new ErrorBag,
                categories: '',
                admins: '',
                // price: 'price',
                // percentage: 'percentage',
            }
        },


        computed: {

            name(){

                if (this.editing == true){

                    return 'Edit Coupon'
                }

                return 'Create Coupon'

            }

        },

        methods: {


            customFormatter(date) {
                return moment(date).format('MMMM Do YYYY, h:mm:ss a');
            },

            createCoupon(){

                Axios.post('/admin/coupon', this.coupon).then(res => {

                    this.$parent.$emit('store_coupon', res.data);

                    $('#createCoupon').modal('hide')

                }).catch(err => {

                    console.log(err.response);

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;

                        this.errors.setErrors(errors);
                    }
                })

            },

            updateCoupon(id){

                console.log(id);
                Axios.put(`/admin/coupon/${id}`, this.coupon).then(res => {

                    this.$parent.$emit('update_coupon', res.data);

                    console.log(res.data);

                    $('#createCoupon').modal('hide');

                }).catch(err => {

                    console.log(err.response);

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