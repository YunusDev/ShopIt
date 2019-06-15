<template>
    <div>

        <div class="card-header row" >
            <div class="col-lg-6 mb-2">
                <h3 class="card-title">Categories</h3>

            </div>
            <div class="col-lg-6">
                <button style="padding: 10px" @click="createCategory()" class="col-sm-6 col-xs-12 pull-right btn btn-success">
                    <i class="fa fa-user-plus" style="padding-right: 10px"></i>Add New Category
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
                    <!--<th>Description</th>-->
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category, key in categories">
                    <td>{{category.id}}</td>
                    <td>{{category.name}}</td>
                    <!--<td>{{ category.description}}</td>-->
                    <td><a @click="editCategory(category)"><i class="text-center fa fa-edit"></i></a></td>
                    <td><a  @click="deleteCategory(category.id, key)"><span class="text-center fa fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <!--<th>Description</th>-->
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>
            </table>

        </div>

        <create-category></create-category>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    import Axios from 'axios'

    export default {
        props: ['raw_categories'],

        mounted(){

            this.$on('store_category', (category) => {

                this.categories.push(category);
                Swal('Category Created Successfully');


            });

            this.$on('update_category', (category) => {

                const index = this.categories.findIndex(item => item.id == category.id);

                this.categories.splice(index, 1, category);
                Swal('Category Updated Successfully');

            });

        },

        data(){

            return{

                categories: JSON.parse(this.raw_categories),

            }

        },

        methods: {


            createCategory(){

                this.$emit('create_category');

            },

            editCategory(category){

                $('#createCategory').modal();

                this.$emit('edit_category', category);

            },

            deleteCategory(id, key){

                Axios.delete(`/admin/category/${id}`).then(res => {

                    this.categories.splice(key, 1);
                    Swal('Category Deleted Successfully');

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