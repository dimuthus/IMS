<template>
   
					    <div class="section-body">

						
                            <table class="table table-striped table-md" id="sudupuka">
                                <thead>
								<tr>

                                    <th>Photo</th>
                                    <th>Product Name</th>
									<th>Product Code</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Selling Price(Rs)</th>
                                    <th>Buying Price(Rs)</th>
                                    <th>Discount(%)</th>
                                    <th>Buying Date</th>
                                    <th>Root</th>
                                    <th>Edit</th>
									<th>Delete</th>

                                </tr>
								</thead>
								<tbody>
                                <tr v-for="product in searchProduct" :key="product.id">

                                    <td><img :src="product.image" alt="image" style="width:60px;height:50px"></td>
                                    <td>{{product.p_name}}</td>
									<td>{{product.p_code}}</td>

                                    <td>{{product.p_quantity}}</td>
                                    <td>{{product.category.name}}</td>
                                    <td v-if="product.supplier != null">{{product.supplier.name}}</td>
                                    <td v-else=""></td>
                                    <td>{{product.selling_price}}</td>
                                    <td>{{product.buying_price}}</td>
                                    <td>{{product.p_discount}}</td>
                                    <td>{{product.buying_date}}</td>
                                    <td>{{product.root}}</td>


                                    <td colspan="1">
                                        <router-link :to="{name:'productEdit',params:{id:product.id}}" class="btn-sm btn-info"><i class="fas fa-edit"></i></router-link>
                                    </td>
                                    <td colspan="1">
                                        <a @click="productDel(product.id)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                </tbody>
</table>
	</div>							
                      
</template>

<script>
//Bootstrap and jQuery libraries
import 'bootstrap/dist/css/bootstrap.min.css'; //for table good looks
import 'jquery/dist/jquery.min.js';
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import "datatables.net-buttons/js/dataTables.buttons.js"
import "datatables.net-buttons/js/buttons.colVis.js"
import "datatables.net-buttons/js/buttons.flash.js"
import "datatables.net-buttons/js/buttons.html5.js"
import "datatables.net-buttons/js/buttons.print.js"
import $ from 'jquery';  
import axios from 'axios';

    export default {
        name: "index",
		
	 data(){
            return {
                products:[],
                searchFillter:'',
            }
        },
     methods:{
        allProduct(){
                axios.get("api/products").then((res)=>
    {
      this.products = res.data;
      setTimeout(function(){ $('#sudupuka').DataTable(
          {
             pageLength: 5,
             processing: true,
             dom: 'Bfrtip',
             buttons: ['copy', 'csv', 'print']
          }
      );
      }, 500
        );  
    })
            },
			
            productDel(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/products/'+id)
                            .then(()=>{
                                Notification.error();
                                this.products = this.products.filter(product=>{
                                    return product.id != id;
                                })
                            }).catch(()=>{
                            this.$router.push({name:'productIndex'})
                        })
                        }

                })
            }
        },
        created() {
            this.allProduct();
        }
        ,
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
            searchProduct(){
                return this.products.filter(product=>{
                    return product.p_name.match(this.searchFillter);
                })
            }
        }
    }
</script>

