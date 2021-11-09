<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row">


                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h4>All Products</h4>
                                </div>
                            </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Product</a>
                                        </li>

                                        <li class="nav-item" v-for="category in allCategories" :key="category.id">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="categoryProduct(category.id)">{{category.name}}</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <input type="text" v-model="searchFillterAllProduct"  class="form-control" placeholder="search"><br>
                                            <div class="row">

                                    <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in searchAllProduct" :key="product.id">
                                        <td>{{product.p_name}}</td>
                                        <td>{{product.p_code}}</td>
                                        <td>
										<button class="btn bt-sm" v-if="product.p_quantity < 1" disabled @click.prevent="addToCart(product.id)">
                                                    <span class="badge badge-success" v-if="product.p_quantity >=1"> Availble({{product.p_quantity}})   <i class="fa fa-shopping-cart" aria-hidden="true"></i>
</span>
                                                    <span class="badge badge-danger" v-else="">Stock Out </span>
                                      
                                        </button>
                                        <button class="btn bt-sm" v-else="" @click.prevent="addToCart(product.id)">
                                                                <span class="badge badge-success" v-if="product.p_quantity >=1"> Availble({{product.p_quantity}})  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
 </span>
                                                                <span class="badge badge-danger" v-else="">Stock Out</span>
                                        </button>
										</td>
                                    </tr>
                                    </tbody>
                                    </table>
								
								  
								
								  
								
								  
                                               <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-4" v-for="product in searchAllProduct" :key="product.id">
                                                   
                                                
                                                    <button class="btn bt-sm" v-if="product.p_quantity < 1" disabled @click.prevent="addToCart(product.id)">
                                                        <div class="card" style="width: 9rem; height: 180px;">
                                                            <img :src="product.image" class="card-img-top" style="height: 100px; width: 143px;">
                                                            <div class="card-body">
                                                                <small class="card-title">{{product.p_name}}-{{product.p_code}}</small>
                                                                <span class="badge badge-success" v-if="product.p_quantity >=1"> Availble({{product.p_quantity}}) </span>
                                                                <span class="badge badge-danger" v-else="">Stock Out </span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <button class="btn bt-sm" v-else="" @click.prevent="addToCart(product.id)">
                                                        <div class="card" style="width: 9rem; height: 180px;">
                                                           <img :src="product.image" class="card-img-top" style="height: 100px; width: 143px;">
                                                            <div class="card-body">
                                                                <small class="card-title">{{product.p_name}}-{{product.p_code}}</small>
                                                                <span class="badge badge-success" v-if="product.p_quantity >=1"> Availble({{product.p_quantity}}) </span>
                                                                <span class="badge badge-danger" v-else="">Stock Out</span>
                                                            </div>
                                                        </div>
                                                    </button> 

                                                </div>-->
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <input type="text" v-model="searchCategoryProducts" class="form-control" placeholder="search"><br>
                                            <div class="row">
                                            <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in searchCategoryProduct" :key="product.id">
                                        <td>{{product.p_name}}</td>
                                        <td>{{product.p_code}}</td>
                                        <td>
										<button class="btn bt-sm" v-if="product.p_quantity < 1" disabled @click.prevent="addToCart(product.id)">
                                                    <span class="badge badge-success" v-if="product.p_quantity >=1"> Availble({{product.p_quantity}})   <i class="fa fa-shopping-cart" aria-hidden="true"></i>
</span>
                                                    <span class="badge badge-danger" v-else="">Stock Out </span>
                                      
                                        </button>
                                        <button class="btn bt-sm" v-else="" @click.prevent="addToCart(product.id)">
                                                                <span class="badge badge-success" v-if="product.p_quantity >=1"> Availble({{product.p_quantity}})  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
 </span>
                                                                <span class="badge badge-danger" v-else="">Stock Out</span>
                                        </button>
										</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
	<div>
    <b-modal ref="asp-modal" hide-footer title="Adjust the seling price">
      <form @submit.prevent="adjustedSellPrice()">

	  <div class="d-block text-center">
        <h3>Unit Price</h3>
		<input type="hidden"  style="width:80px" name='cartId' v-model="this.cartId" >

		<input type="text"  style="width:80px" name='adjustedPrice' v-model="adjustedPrice" >
      </div>
      <button class="btn btn-danger" block @click="hideModal">Close</button>
      <button class="btn btn-success" type="submit">Save</button>
	  </form>
    </b-modal>
    </div>
    <div>
   <b-modal ref="asq-modal" hide-footer title="Adjust the quantity">
      <form @submit.prevent="adjustedBuyingQty()">

	  <div class="d-block text-center">
        <h3>Change Qty</h3>
		<input type="hidden"  style="width:80px" name='cartIdQty' v-model="this.cartId" >

		<input type="text"  style="width:80px" name='buyingQty' v-model="buyingQty" >
      </div>
      <button class="btn btn-danger" block @click="hideModal">Close</button>
      <button class="btn btn-success" type="submit">Save</button>
	  </form>
    </b-modal>
  </div>
 <div>
   <b-modal ref="asd-modal" hide-footer title="Adjust the discount">
      <form @submit.prevent="adjustedBuyDiscount()">

	  <div class="d-block text-center">
        <h3>Change Discount</h3>
		<input type="hidden"  style="width:80px" name='cartIdDiscount' v-model="this.cartId" >
 <select name="buyingDiscount" id="" v-on:change="onChangeDiscount($event)" v-model="buyingDiscount">
         <option value="5">5%</option>
         <option value="10">10%</option>
         <option value="15">15%</option>
         <option value="25">25%</option>

   </select>
      </div>
      <button class="btn btn-danger" block @click="hideModal">Close</button>
      <button class="btn btn-success" type="submit">Save</button>
	  </form>
    </b-modal>
  </div>

                            <div class="card-header">
                                <div class="d-flex">
                                    <h4>All Cards</h4>
                                    <router-link :to="{name:'customerCreate'}" class="btn btn-info btn-sm">New Customer</router-link>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Unit Dis.(%)</th>
										<th>Dis. Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="cart in getAllCarts" :key="cart.id">
                                        <td>{{cart.product_name}}</td>
                                        <td>
                                            <input type="text" step="any" readonly="" style="width:20px" :value="cart.product_quantity" >
                                           <i  class="fas fa-plus-square" @click.prevent="cartIncrement(cart.id)" title="Increment"></i>
                                           <i class="fas fa-minus-square" v-if="cart.product_quantity >=2" @click.prevent="cartDecrement(cart.id)" title="Decrement"></i> 
                                           <i class="fas fa-minus-square" v-else="" disabled @click.prevent="cartDecrement(cart.id)" title="Decrement"></i> 
										   <i class="fas fa-pen"  id="show-btn" @click="showModalBuyingQty(cart)"></i>
                                        </td>
                                        <td>{{cart.product_price}} <i class="fas fa-pen"  id="show-btn" @click="showModal(cart)"></i></td>

                                        <td>{{cart.unit_discount}}<i class="fas fa-pen"  id="show-btn" @click="showModalAdjDiscount(cart)"></i></td>
										<td>{{cart.product_discount}}</td>
                                        <td>{{cart.sub_total}}</td>
                                        <td><i class="fas fa-trash"  @click.prevent="removeCart(cart.id)" title="Remove"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <table class="table">
                                    <tbody>
                                    <tr style="line-height:1.5">
                                        <td>Total Quantity</td>
                                        <td class="text-right"><strong>{{this.totaltQuantity}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td class="text-right"><strong>{{this.cartsSubtotal}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>vat</td>
                                        <td class="text-right"><strong>0 %</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td class="text-right"><strong>{{this.cartsTotalPrice}}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h5><strong>Customer</strong></h5>
                                <form @submit.prevent="orderDone">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <select class="form-control" v-model="customer_id">
                                                    <option :value="customer.id" v-for="customer in allCustomers">{{customer.name}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pay</label>
                                                <input v-model="pay" @keyup="payValue" type="number" class="form-control" placeholder="Pay">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Due</label>
                                                <input v-model="due"  type="number" class="form-control" placeholder="Due">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pay Bye</label>
                                                <select v-model="payby" class="form-control">
                                                    <option value="">--select payment--</option>
                                                    <option value="Hand Cash">Hand Cash</option>
                                                    <option value="Check">Check</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pointofsell",
        data(){
            return {
                allProducts:[],
                allCategories:[],
                allCategoryProducts:[],
                searchFillterAllProduct:'',
                searchCategoryProducts:'',
                allCustomers:[],
                customer_id:'',
                pay:'',
                due:'',
                payby:'',
                vats:0,
                product_discount:0,
                unit_discount:0,
                getAllCarts:[],
                totaltQuantity:'',
                cartsSubtotal:'',
                cartsTotalPrice:'',
				adjustedPrice:0,
                buyingQty:0,
                buyingDiscount:0,
				cartId:0,
				
				
            }
        },
        methods:{
		showModal(cart) {
		this.cartId=cart.id;
		this.adjustedPrice=cart.product_price;
        this.$refs['asp-modal'].show()
        },
        showModalBuyingQty(cart) {
		this.cartId=cart.id;
		this.adjustedPrice=cart.product_price;
        this.$refs['asq-modal'].show()
      },
       showModalAdjDiscount(cart) {
		this.cartId=cart.id;
		this.adjustedPrice=cart.product_price;
        this.$refs['asd-modal'].show()
      },
      hideModal() {
        this.$refs['asp-modal'].hide()
      },
      toggleModal() {
        // We pass the ID of the button that we want to return focus to
        // when the modal has hidden
        this.$refs['my-modal'].toggle('#toggle-btn')
      },
	  adjustedSellPrice(){
	  let data={ cart_id:this.cartId,adjustment:this.adjustedPrice }
                axios.post('api/cart-adjust-selling-price',data)
                    .then(res=>{
                        if(res.data.error){
                            Toast.fire({
                                icon: 'error',
                                title: res.data.error,
                            });
                        }else{
                        Notification.success();
                        Reload.$emit('afterChange');
						this.$refs['asp-modal'].hide();
                        }
                        
                    }).catch(error=>{console.log(error.response.data)});
	  },

      adjustedBuyingQty(){
            let data={ cart_id:this.cartId,buyingQty:this.buyingQty }
                axios.post('api/cart-adjust-selling-qty',data)
                    .then(res=>{
                        Notification.success();
                        Reload.$emit('afterChange');
						this.$refs['asq-modal'].hide();
                    }).catch(error=>{console.log(error.response.data)});
            },
             adjustedBuyDiscount(){
            let data={ cart_id:this.cartId,unit_discount:this.unit_discount }
                axios.post('api/cart-adjust-selling-discount',data)
                    .then(res=>{

                        if(res.data.error){
                            Toast.fire({
                                icon: 'error',
                                title: res.data.error,
                            });
                        }else{
                        Notification.success();
                        Reload.$emit('afterChange');
						this.$refs['asp-modal'].hide();
                        }
                       
                    }).catch(error=>{console.log(error.response.data)});
            },
            onChangeDiscount(event){
                this.unit_discount = event.target.value;
            },
            allProduct(){
                axios.get('api/products')
                    .then(res=>{
                        this.allProducts = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            allCategory(){
                axios.get('api/categories')
                    .then(res=>{
                        this.allCategories = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            categoryProduct(id){
                axios.get('api/product/category/'+id)
                    .then(res=>{
                        this.allCategoryProducts = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            allCustomer(id){
                axios.get('api/customers')
                    .then(res=>{
                        this.allCustomers = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            //cart method start
            addToCart(id){
                axios.get('api/add-to-cart/product/'+id)
                    .then(res=>{
                        if(res.data.error){
                            Toast.fire({
                                icon: 'error',
                                title: 'Product Limited. Stock out!',
                            });
                        }else{
                            Reload.$emit('afterChange');
                            Notification.addTocart();
                        }
                    }).catch(error=>{console.log(error.response.data)});
            },
           allCarts(){
                axios.get('api/product/carts')
                    .then(res=>{
                        this.getAllCarts = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            removeCart(id){
                axios.get('api/cart-remove/'+id)
                    .then(res=>{
                        Reload.$emit('afterChange');
                        Notification.cartRemove();
                    }).catch(error=>{console.log(error.response.data)});
            },
            cartIncrement(id){
                axios.get('api/cart-increment/'+id)
                    .then(res=>{
                        if(res.data.error){
                            Toast.fire({
                                icon: 'error',
                                title: 'Product Limited. Stock out!',
                            });
                        }else{
                            Reload.$emit('afterChange');
                            Notification.increment();
                        }

                    }).catch(error=>{console.log(error.response.data)});
            },
            cartDecrement(id){
                axios.get('api/cart-decrement/'+id)
                    .then(res=>{
                        Reload.$emit('afterChange');
                        Notification.decrement();
                    }).catch(error=>{console.log(error.response.data)});
            },
            cartDiscount(id,discount){
                axios.get('api/cart-discount/'+id+'&discount='+discount)
                    .then(res=>{
                        Reload.$emit('afterChange');
                        Notification.discount();
                    }).catch(error=>{console.log(error.response.data)});
            },
            totalCartQuantity(){
                axios.get('api/cart-quantity')
                    .then(res=>{
                        this.totaltQuantity = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            cartSubTotal(){
                axios.get('api/cart-subtotal')
                    .then(res=>{
                        this.cartsSubtotal = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            } ,
            cartTotalPrice(){
                axios.get('api/carts-product-price-total')
                    .then(res=>{
                        this.cartsTotalPrice = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            orderDone(){
                let data={
                    customer_id:this.customer_id,pay:this.pay,due:this.due,payby:this.payby,sub_total:this.cartsSubtotal,total:this.cartsTotalPrice,cart_quantity:this.totaltQuantity,vat:this.vats
                }
                axios.post('api/order-done',data)
                    .then(res=>{
                        Notification.success();
                        this.$router.push({name:'home'});
                    }).catch(error=>{console.log(error.response.data)});
            },
            payValue(){
                let pay = this.pay;
                let due = this.cartsTotalPrice - pay;
                this.due = due;
            },
			handleBlur() {
				this.cartsSubtotal=1000;
			}

            // cart method end


        },
        created() {
            this.allProduct();
            this.allCategory();
            this.allCustomer();
            this.allCarts();
            this.totalCartQuantity();
            this.cartSubTotal();
            this.cartTotalPrice();
            Reload.$on('afterChange',()=>{
                this.allCarts();
                this.totalCartQuantity();
                this.cartSubTotal();
                this.cartTotalPrice();
            })
        },
        mounted() {
            if(!User.loggedIn()){
                Toast.fire({
                    icon: 'warning',
                    title: 'Login First!',
                });
                this.$router.push({name:'login'})
            }

        },
        computed:{
            searchAllProductOriginal(){
                return this.allProducts.filter(product=>{
                   // return product.p_code.match(this.searchFillterAllProduct);
					return product.p_name.match(this.searchFillterAllProduct);

                })
            },
            searchCategoryProduct(){
                return this.allCategoryProducts.filter(product=>{
                    return product.p_code.match(this.searchCategoryProducts);
                })
            },
			searchAllProduct() {
			const value = this.searchFillterAllProduct;
			return this.allProducts.filter(function(product){
            return product.p_code.toLowerCase().indexOf(value) > -1 ||
            product.p_name.toLowerCase().indexOf(value) > -1 
        })
    }
        }
    }
</script>

<style scoped>
 .table:not(.table-sm):not(.table-md):not(.dataTable) td, .table:not(.table-sm):not(.table-md):not(.dataTable) th {
     padding: 0 10px;
     height: 35px !important;
     vertical-align: middle;
 }
 .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
     position: relative;
     width: 100%;
     padding-right: 0px!important;
     padding-left: 4px!important;
 }
</style>
