<template>
    <div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('name')}" placeholder="Name" v-model="product.name">
                        <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('price')}" placeholder="Price" v-model="product.price">
                        <div class="invalid-feedback" v-if="errors.hasError('price')">{{ errors.first('price') }}</div>
                    </div>
                    <div class="form-group">
                        <input type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('quantity')}" placeholder="Quantity" v-model="product.quantity">
                        <div class="invalid-feedback" v-if="errors.hasError('quantity')">{{ errors.first('quantity') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Select Creator</label>
                        <select  v-model="product.admin_id" class="form-control" >
                            <option :selected ="true" disabled>Select an Author</option>
                            <option v-for="admin in admins" :value="admin.id" >{{admin.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">File input</label>
                        <input type="file" id="image" :class="{'form-control': true, 'is-invalid': errors.hasError('image')}" v-on="product.image">
                        <div class="invalid-feedback" v-if="errors.hasError('image')">{{ errors.first('image') }}</div>

                    </div>
                    <div class="form-group">
                        <label>Select Category</label>
                        <select  v-model="product.category_id" class="form-control">
                            <option selected disabled>Select a Category</option>
                            <option  v-for="category in categories" :value="category.id">{{category.name}}</option>
                        </select>
                    </div>
                    <div class="form-group pull-left">
                        <label>Status</label>
                        <input type="checkbox"  :class="{'form-control': true, 'is-invalid': errors.hasError('status')}" value="1" v-model="product.status" >
                        <div class="invalid-feedback" v-if="errors.hasError('status')">{{ errors.first('status') }}</div>
                    </div>
                    <div class="form-group">
                        <textarea :class="{'form-control': true, 'is-invalid': errors.hasError('description')}" placeholder="Description" v-model="product.description"></textarea>
                        <div class="invalid-feedback" v-if="errors.hasError('description')">{{ errors.first('description') }}</div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateProduct(product.id)" v-if="editing">Update product</button>
                    <button type="button" class="btn btn-primary" @click="createProduct()" v-else>Create product</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    class Product{

        constructor(product){

            this.name = product.name || '';
            this.description = product.description || '';
            this.price = product.price || '';
            this.quantity = product.quantity || '';
            this.category_id = product.category_id || '';
            this.admin_id = product.admin_id || '';
            this.status = product.status || false;
            this.image = product.image || '';

        }

    }

    import ErrorBag from '../error_bag'
    import Axios from 'axios'

    export default {

        mounted(){

            this.$parent.$on('create_product', (categories, admins) => {

                this.categories = categories;
                this.admins = admins;
                this.editing = false;
                this.product = new Product({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }

                $('#createProduct').modal()


            })

            this.$parent.$on('edit_product', (product, categories, admins) => {

                this.categories = categories;
                this.admins = admins;
                this.editing = true;
                this.product = new Product(product);
                this.product.id = product.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createProduct').modal()

            });

        },

        data(){

            return {

                product: new Product({}),
                editing: false,
                errors: new ErrorBag,
                categories: '',
                admins: '',
            }
        },

        computed: {

            name(){

                if (this.editing == true){

                    return 'Edit Product'
                }

                return 'Create Product'

            }
        },

        methods: {

            createProduct(){

                Axios.post('/admin/product', this.product).then(res => {

                    this.$parent.$emit('store_product', res.data);

                    $('#createProduct').modal('hide')

                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;

                        this.errors.setErrors(errors);
                    }
                })

            },

            updateProduct(id){

                console.log(id);
                Axios.put(`/admin/product/${id}`, this.product).then(res => {

                    this.$parent.$emit('update_product', res.data);

                    console.log(res.data);

                    $('#createProduct').modal('hide');

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