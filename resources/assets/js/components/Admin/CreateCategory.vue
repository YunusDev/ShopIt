<template>
    <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('name')}" placeholder="Name" v-model="category.name">
                        <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <textarea :class="{'form-control': true, 'is-invalid': errors.hasError('description')}" placeholder="Description" v-model="category.description"></textarea>
                        <div class="invalid-feedback" v-if="errors.hasError('description')">{{ errors.first('description') }}</div>
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateCategory(category.id)" v-if="editing">Update category</button>
                    <button type="button" class="btn btn-primary" @click="createCategory()" v-else>Create category</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    class Category{

        constructor(category){

            this.name = category.name || '';
            this.description = category.description || '';
        }

    }

    import ErrorBag from '../error_bag'
    import Axios from 'axios'

    export default {

        mounted(){

            this.$parent.$on('create_category', () => {

                this.editing = false;
                this.category = new Category({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }

                $('#createCategory').modal()


            })

            this.$parent.$on('edit_category', (category) => {

                this.editing = true;
                this.category = new Category(category);
                this.category.id = category.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createCategory').modal()

            });

        },

        data(){

            return {

                category: new Category({}),
                editing: false,
                errors: new ErrorBag
            }
        },

        computed: {

            name(){

                if (this.editing == true){

                    return 'Edit Category'
                }

                return 'Create Category'

            }
        },

        methods: {

            createCategory(){

                Axios.post('/admin/category', this.category).then(res => {

                    this.$parent.$emit('store_category', res.data);

                    $('#createCategory').modal('hide')

                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;

                        this.errors.setErrors(errors);
                    }
                })

            },

            updateCategory(id){

                console.log(id);
                Axios.put(`/admin/category/${id}`, this.category).then(res => {

                    this.$parent.$emit('update_category', res.data);
                    $('#createCategory').modal('hide');

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