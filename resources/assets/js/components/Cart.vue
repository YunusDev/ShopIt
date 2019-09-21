<template>

    <div>
        <header v-if="!(carts.length > 0)" class="section-header" style="margin-top: -50px">
            <small>CART</small>
            <p class="lead">No items in cart. Go to <a href="/">shop</a></p>
        </header>

        <div v-else>

            <div class="row gap-y">

                <div class="col-12 col-lg-8">

                    <form class="col-lg-6 form-round mb-2" style="margin: 0 auto">
                        <div class="input-group" >
                            <input type="text" v-model="coupon_code" class=" form-control" placeholder="Apply Coupon...">
                            <span class="input-group-btn">
                                <button  @click="applyCoupon()" class="btn btn-primary" type="button">Apply!</button>
                            </span>
                        </div>
                        <div class="invalid-feedback" v-if="!validCoupon" >{{coupon_error}}</div>

                    </form>

                    <div style="overflow-x:auto;">
                        <table class="table table-cart" style="">
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
                                        <small>(N{{cart.price | formatMon}})</small>
                                    </td>

                                    <td>
                                        <label>Quantity</label>
                                        <select  @change="editItemCart(cart.rowId, cart.qty)"   class="form-control" v-model="cart.qty">
                                            <option  v-for="index in 10" :key="index" >{{index}}</option>
                                        </select>
                                        <!--<input class="form-control form-control-sm" type="text" placeholder="Quantity" :value="cart.qty">-->
                                    </td>

                                    <td>
                                        <h4 class="price">N{{cart.price * cart.qty | formatMon}}</h4>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="col-12 col-lg-4">
                    <div class="cart-price">
                        <div class="flexbox">
                            <div>
                                <p><strong>Subtotal:</strong></p>
                                <div v-if="Object.keys(coupon).length > 1">
                                    <p class="text-success" v-if=" coupon.valid === 'Yes'"><strong>Coupon:</strong></p>
                                </div>
                                <p><strong>Delivery Fee:</strong></p>
                            </div>

                            <div>
                                <p style="font-weight: bolder" class="text-bold">N{{getSubTotal | formatMoney}}</p>
                                <div style="font-weight: bolder" v-if="Object.keys(coupon).length > 1">
                                    <p class="text-success " v-if="coupon.message.type === 'price'">N{{coupon.message.discount | formatMon}} off</p>
                                    <p class="text-success" v-else>{{coupon.message.discount}}% off</p>
                                </div>
                                <p style="font-weight: bolder">N{{shipping_fee | formatMoney}}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="flexbox">
                            <div>
                                <p><strong>Total:</strong></p>
                            </div>

                            <div>
                                <p class="fw-600">N{{totalFee | formatMoney}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flexbox">
                        <a class="btn btn-secondary" href="/"><i class="ti-angle-left fs-9"></i> Revise</a>
                        <button class="btn btn-primary"  type="submit">Checkout <i class="ti-angle-right fs-9"></i></button>
                    </div>
                </div>


            </div>

            <order-step  :totalFee = totalFee :carts = carts :keyd = "keyd" :coupon="coupon" ></order-step>

        </div>
    </div>

</template>

<script>

    import Axios from 'axios'
    import Swal from 'sweetalert'

    export default {
        props: ['raw_carts', 'keyd', 'auth'],

        mounted(){

            // this.carts = JSON.parse(this.raw_carts);

        },


        data(){

            return{

                carts: Object.values(JSON.parse(this.raw_carts)),
                // obj_carts: JSON.parse(this.raw_carts),
                subtotal: this.getSubTotal,
                sub: 0,
                coupon: '',
                shipping_fee: 1000,
                coupon_code: '',
                coupon_error: '',
                validCoupon: false
            }
        },

        computed: {

            totalFee(){


                if (this.validCoupon){

                    return Math.ceil(((this.getSubTotal - this.getCouponDiscount ) + this.shipping_fee) / 100) * 100;

                }

                return Math.ceil((this.getSubTotal + this.shipping_fee) / 100) * 100;

            },


            getSubTotal(){

                // subtotal = 0;
                this.sub = 0;

                this.carts.forEach(cart => {

                    this.sub = this.sub + (cart.price * cart.qty)

                });

                return this.sub;

            },

            getCouponDiscount(){


                if (this.coupon.message.type === 'price'){

                    return this.coupon.message.discount;

                }else{

                    return (this.coupon.message.discount / 100) * this.getSubTotal;
                }


            }

        },

        methods: {

            applyCoupon(){

                if (this.auth === '1'){

                    Axios.post('/apply/coupon', {coupon_code: this.coupon_code}).then(res => {

                        console.log(res);
                        if (res.data.valid === 'No'){

                            this.coupon_error = res.data.message;

                        }else {

                            this.coupon = res.data;
                            this.validCoupon = true;
                            Swal('Coupon Added Successfully', {

                                buttons: false,
                                timer: 1000,

                            });
                        }

                    }).catch(err => {

                        console.log(err.response)
                    })

                }else {

                    window.location = '/login'
                }



            },

            editItemCart(id, qty) {


                Axios.post('/edit/cart', {

                    quantity: qty,
                    rowId: id,

                }).then(res => {

                    Swal('Product Edited in Cart Successfully', {

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


        },


    }
</script>

<style scoped>

    .invalid-feedback{

        margin-top: 4px;
        color: red;
        font-weight: bold;
        font-size: 13px;
        margin-left: 15px
    }

    table.table{

        /*width:100%;overflow-x: scroll*/
    }

</style>