<template>
    <div>

        <div class="row gap-y">
            <div class="col-12 col-lg-8">

                <table class="table table-cart">
                    <tbody valign="middle" v-for="cart, key in carts">

                    <tr>
                        <td>
                            <a class="item-remove" title="Remove Product" @click="removeItemCart(cart.rowId, key)"><i class="ti-close"></i></a>
                        </td>

                        <td>
                            <a href="shop-single.html">
                                <img src="assets/img/product-1.png" alt="...">
                            </a>
                        </td>

                        <td>
                            <h5>{{cart.name}}</h5>
                            <p>Superior Sports Watch</p>
                        </td>

                        <td>
                            <label>Quantity</label>
                            <input class="form-control form-control-sm" type="text" placeholder="Quantity" :value="cart.qty">
                        </td>

                        <td>
                            <h4 class="price">N{{cart.price * cart.qty}}</h4>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>


            <div class="col-12 col-lg-4">
                <div class="cart-price">
                    <div class="flexbox">
                        <div>
                            <p><strong>Subtotal:</strong></p>
                            <p><strong>Delivery Fee:</strong></p>
                        </div>

                        <div>
                            <p>N{{getSubTotal}}</p>
                            <p>N{{shipping_fee}}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="flexbox">
                        <div>
                            <p><strong>Total:</strong></p>
                        </div>

                        <div>
                            <p class="fw-600">N{{totalFee}}</p>
                        </div>
                    </div>
                </div>

                <div class="flexbox">
                    <a class="btn btn-secondary" href="/"><i class="ti-angle-left fs-9"></i> Revise</a>
                    <button class="btn btn-primary" type="submit">Checkout <i class="ti-angle-right fs-9"></i></button>
                </div>
            </div>


        </div>

        <order-step  :totalFee = totalFee :carts = carts :refd = "refd" :keyd = "keyd" ></order-step>

    </div>


</template>

<script>

    import Axios from 'axios'
    import Swal from 'sweetalert'

    export default {
        props: ['raw_carts', 'refd', 'keyd'],

        mounted(){

            // this.carts = JSON.parse(this.raw_carts);

        },


        data(){

            return{

                carts: Object.values(JSON.parse(this.raw_carts)),
                // obj_carts: JSON.parse(this.raw_carts),
                subtotal: this.getSubTotal,
                sub: 0,
                shipping_fee: 1000
            }
        },

        computed: {

            totalFee(){

                return this.getSubTotal + this.shipping_fee;

            },


            getSubTotal(){

                // subtotal = 0;

                this.carts.forEach(cart => {

                    this.sub = this.sub + (cart.price * cart.qty)

                });

                return this.sub;

            }

        },

        methods: {

            editItemCart(id) {

                Axios.post('/edit/cart', {

                    quantity: this.qty,
                    rowId: id,


                }).then(res => {

                    Swal('Product Edited to Cart Successfully', {

                        buttons: false,
                        timer: 1500,

                    });

                    console.log(res)

                }).catch(err => {

                    console.log(err)

                })
            },

            removeItemCart(id, key){


                Axios.post('/remove/product/cart', {

                    rowId: id,


                }).then(res => {

                    this.sub = 0;
                    this.carts.splice(key, 1);

                    Swal('Product Deleted Successfully', {

                        buttons: false,
                        timer: 1000,

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