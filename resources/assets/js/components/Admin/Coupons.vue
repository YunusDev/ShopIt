<template>
    <div>

        <div class="card-header row" >
            <div class="col-lg-6 mb-2">
                <h3 class="card-title">Coupons</h3>

            </div>
            <div class="col-lg-6">
                <button style="padding: 10px" @click="createCoupon()" class="col-sm-6 col-xs-12 pull-right btn btn-success">
                    <i class="fa fa-user-plus" style="padding-right: 10px"></i>Add New Coupon
                </button>
            </div>

        </div>
        <br>
        <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Discount</th>
                    <th>Max Usage</th>
                    <th>Will Expire</th>
                    <th>Expires In</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="coupon, key in coupons">
                    <td>{{coupon.id}}</td>
                    <td>{{coupon.code | uppercase}}</td>
                    <td>{{coupon.status == 1 ? 'Usable' : 'Not Usable'}}</td>
                    <td>{{coupon.type}}</td>
                    <td>{{coupon.discount}}</td>
                    <td>{{coupon.max_usage}}</td>
                    <td>{{coupon.will_expire == 1 ? 'Yes' : 'No'}}</td>
                    <td>{{coupon.expires_format}}</td>
                    <!--<td>{{ coupon.description}}</td>-->
                    <td><a @click="editCoupon(coupon)"><i class="text-center fa fa-edit"></i></a></td>
                    <td><a  @click="deleteCoupon(coupon.id, key)"><span class="text-center fa fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Discount</th>
                    <th>Max Usage</th>
                    <th>Will Expire</th>
                    <th>Expires In</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>
            </table>

        </div>

        <create-coupon></create-coupon>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    import Axios from 'axios'

    export default {
        props: ['raw_coupons'],

        mounted(){

            this.$on('store_coupon', (coupon) => {

                this.coupons.push(coupon);
                Swal('Coupon Created Successfully');


            });

            this.$on('update_coupon', (coupon) => {

                const index = this.coupons.findIndex(item => item.id == coupon.id);

                this.coupons.splice(index, 1, coupon);
                Swal('Coupon Updated Successfully');

            });

        },

        data(){

            return{

                coupons: JSON.parse(this.raw_coupons),

            }

        },

        computed: {



        },


        methods: {


            createCoupon(){

                this.$emit('create_coupon');

            },

            editCoupon(coupon){

                $('#createCoupon').modal();

                this.$emit('edit_coupon', coupon);

            },

            deleteCoupon(id, key){

                Axios.delete(`/admin/coupon/${id}`).then(res => {

                    this.coupons.splice(key, 1);
                    Swal('Coupon Deleted Successfully');

                }).catch(err => {

                    console.log(err)
                })

            }
        },

        filters: {

            uppercase: function (v) {

                return v.toUpperCase();

            }
        }
    }
</script>

<style scoped>

    table.table{

        width:100%;overflow-x: scroll

    }
</style>