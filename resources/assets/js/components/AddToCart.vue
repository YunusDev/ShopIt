<template>
    <div class="row" style="margin-top: 15px">
        <div class="col  form-group">
            <input class="form-control" type="number" v-model = "qty" placeholder="Quantity">
        </div>

        <div class="col form-group">
            <button class="btn btn-block btn-primary" @click="addToCart()"><span class="fa fa-shopping-cart"></span> Add to cart</button>
        </div>
    </div>
</template>

<script>

    import Axios from 'axios'
    import Swal from 'sweetalert'

    export default {

        props: ['product_id'],

        data(){

            return{

                qty: '',
                // product: JSON.parse(this.raw_product)
            }
        },

        methods: {

            addToCart(){

                Axios.post('/product', {

                    quantity: this.qty,
                    product_id: this.product_id,


                }).then(res => {

                    Swal('Product Added to Cart Successfully', {

                        buttons: false,
                        timer: 700,

                    });

                    console.log(res)

                }).catch(err => {

                    console.log(err)

                })
            }
        }

    }
</script>

<style scoped>

</style>