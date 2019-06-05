<template>
    <div>

        <div class="card-header row" >
            <div class="col-lg-6 mb-2">
                <h3 class="card-title">Plans</h3>

            </div>
            <div class="col-lg-6">
                <button style="padding: 10px" @click="createPlan()" class="col-sm-6 col-xs-12 pull-right btn btn-success">
                    <i class="fa fa-user-plus" style="padding-right: 10px"></i>Add New Plan
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
                    <th>Minimum Capital</th>
                    <th>Maximum Capital</th>
                    <th>Forecasted Profit</th>
                    <th>Duration</th>
                    <th>VIew Batches</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="plan, key in plans">
                    <td>{{plan.id}}</td>
                    <td>{{plan.name}}</td>
                    <td>{{plan.code}}</td>
                    <td>{{plan.minimum_capital}}</td>
                    <td>{{plan.maximum_capital}}</td>
                    <td>{{plan.forecasted_profit}}</td>
                    <td>{{plan.duration}}</td>
                    <td><a :href="plan.batch_url"><i class="text-center fa fa-eye"></i></a></td>
                    <td><a @click="editPlan(plan)"><i class="text-center fa fa-edit"></i></a></td>
                    <td><a  @click="deletePlan(plan.id, key)"><span class="text-center fa fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Minimum Capital</th>
                    <th>Maximum Capital</th>
                    <th>Forecasted Profit</th>
                    <th>Duration</th>
                    <th>View Batches</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>

            </table>

        </div>

        <create-investment-product :merchantId = "merchant_id"></create-investment-product>

    </div>
</template>

<script>
    import Axios from 'axios'
    import Swal from 'sweetalert'

    export default {

        props: ['merchant_unique', 'raw_plans'],

        mounted(){

          this.$on('store_plan', (plan) => {

              this.plans.push(plan)
              Swal('Investment Product Created Successfully')

          });
          this.$on('update_plan', (plan) => {

              const index = this.plans.findIndex(item => item.id == plan.id);
              this.plans.splice(index, 1, plan);
              Swal('Investment Product Updated Successfully')


          });

        },

        data(){
            
            return{
                
                plans: JSON.parse(this.raw_plans),
                merchant_id: this.merchant_unique
                
            }
        },

        methods: {

            createPlan(){

                this.$emit('create-plan')

            },

            editPlan(plan){

                this.$emit('edit-plan', plan)

            },

            deletePlan(id, key){


                Axios.delete(`/admin/merchant/${this.merchant_id}/plans/${id}`).then(res => {


                    this.plans.splice(key, 1);
                    Swal('Investment Product Deleted Successfully');

                }).catch(err => {

                    console.log(err)
                })
            }

        }
    }
</script>

<style scoped>

</style>