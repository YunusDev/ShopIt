<template>
    <div>

        <div class="card-header row" >
            <div class="col-lg-6 mb-2">
                <h3 class="card-title">Merchants</h3>

            </div>
            <div class="col-lg-6">
                <button style="padding: 10px" @click="createMerchant()" class="col-sm-6 col-xs-12 pull-right btn btn-success">
                    <i class="fa fa-user-plus" style="padding-right: 10px"></i>Add New Merchant
                </button>
            </div>

        </div>
        <br>
        <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Code</th>
                <th>Email</th>
                <th>State</th>
                <th>Country</th>
                <th>View Batches</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="merchant, key in merchants">
                    <td>{{merchant.id}}</td>
                    <td><a :href="merchant.url">{{merchant.name}}</a></td>
                    <td>{{merchant.code}}</td>
                    <td>{{merchant.email}}</td>
                    <td>{{merchant.state}}</td>
                    <td>{{merchant.country}}</td>
                    <td><a :href="merchant.batch_url"><i class="text-center fa fa-eye"></i></a></td>
                    <td><a @click="editMerchant(merchant)"><i class="text-center fa fa-edit"></i></a></td>
                    <td><a  @click="deleteMerchant(merchant.id, key)"><span class="text-center fa fa-trash" ></span></a></td>
                </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Code</th>
                <th>Email</th>
                <th>State</th>
                <th>Country</th>
                <th>View Batches</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </tfoot>

        </table>

        </div>

        <create-merchant></create-merchant>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    import Axios from 'axios'

    export default {
        props: ['raw_merchants'],

        mounted(){

            this.$on('store_merchant', (merchant) => {

                this.merchants.push(merchant)
                Swal('Merchant Created Successfully');


            });

            this.$on('update_merchant', (merchant) => {

                const index = this.merchants.findIndex(item => item.id == merchant.id);

                this.merchants.splice(index, 1, merchant);
                Swal('Merchant Updated Successfully');


            });

        },

        data(){

            return{

                merchants: JSON.parse(this.raw_merchants),

            }

        },

        methods: {


            createMerchant(){

                this.$emit('create_merchant');

            },

            editMerchant(merchant){

                $('#createMerchant').modal();

                this.$emit('edit_merchant', merchant);

            },

            deleteMerchant(id, key){

                Axios.delete(`/admin/merchants/${id}`).then(res => {

                    this.merchants.splice(key, 1);
                    Swal('Merchant Deleted Successfully');

                }).catch(err => {

                    console.log(err)
                })

            }
        }
    }
</script>

<style scoped>

    table.table{

        width:100%;overflow-x: scroll

    }
</style>