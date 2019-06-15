<template>
    <div>

        <div class="card-header row" >
            <div class="col-lg-6 mb-2">
                <h3 class="card-title">Products</h3>

            </div>
            <div class="col-lg-6">
                <button style="padding: 10px" @click="createProduct()" class="col-sm-6 col-xs-12 pull-right btn btn-success">
                    <i class="fa fa-user-plus" style="padding-right: 10px"></i>Add New Product
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
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product, key in products">
                    <td>{{product.id}}</td>
                    <td>{{product.name}}</td>
                    <td>{{product.category.name}}</td>
                    <!--<td>{{ product.description}}</td>-->
                    <td><a @click="editProduct(product)"><i class="text-center fa fa-edit"></i></a></td>
                    <td><a  @click="deleteProduct(product.id, key)"><span class="text-center fa fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>

                    <!--<th>Description</th>-->
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>
            </table>

        </div>

        <create-product></create-product>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    import Axios from 'axios'

    export default {
        props: ['raw_categories', 'raw_products', 'raw_admins'],

        mounted(){

            this.$on('store_product', (product) => {

                this.products.push(product);
                Swal('Product Created Successfully');


            });

            this.$on('update_product', (product) => {

                const index = this.products.findIndex(item => item.id == product.id);

                this.products.splice(index, 1, product);
                Swal('Product Updated Successfully');

            });

        },

        data(){

            return{

                categories: JSON.parse(this.raw_categories),
                admins: JSON.parse(this.raw_admins),
                products: JSON.parse(this.raw_products),

            }

        },

        methods: {


            createProduct(){

                this.$emit('create_product', this.categories, this.admins);

            },

            editProduct(product){

                $('#createProduct').modal();

                this.$emit('edit_product', product,  this.categories, this.admins);

            },

            deleteProduct(id, key){

                Axios.delete(`/admin/product/${id}`).then(res => {

                    this.products.splice(key, 1);
                    Swal('Product Deleted Successfully');

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