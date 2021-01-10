<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">All product</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-11 m-auto">
				<div class="card">
	              <div class="card-header bg-dark">
						<h3 class="display-5 float-left"><i class="fas fa-satellite"></i> All products</h3>
						<router-link class="btn btn-info btn-sm float-right" to="store-product"><i class="fa fa-user-plus"></i> Add product </router-link>
				  </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	<div class="float-right">
	              		<label>Search</label>
	              		<input type="text" v-model="searchTerm">
	              	</div>
	                <table class="table table-bordered table-striped">
	                  <thead>
	                  <tr>
	                    <th>#</th>
	                    <th>Image</th>
	                    <th>Product name</th>
	                    <th>Buying price</th>
	                    <th>Selling price</th>
	                    <th>Category name</th>
	                    <th>Supplier name</th>
	                    <th>Product qty</th>
	                    <th>Action</th>
	                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr v-for="product in products" :key="product.id">
		                    <td>{{ product.id }}</td>
		                    <td>
		                    	<img :src="product.image" width="40" height="40">
		                    </td>
		                    <td>{{ product.product_name }}</td>
		                    <td>{{ product.buying_price }}</td>
		                    <td>{{ product.selling_price }}</td>
		                    <td>{{ product.category_name }}</td>
		                    <td>{{ product.name }}</td>
		                    <td>{{ product.product_quantity }}</td>
		                    <td>
		                    	<div class="btn-group">
		                    		<router-link :to="{name: 'edit-product', params:{id: product.id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></router-link>
		                    		<button @click="deleteProduct(product.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
		                    	</div>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  <tr>
	                    <th>#</th>
	                    <th>Image</th>
	                    <th>Product name</th>
	                    <th>Buying price</th>
	                    <th>Selling price</th>
	                    <th>Category name</th>
	                    <th>Supplier name</th>
	                    <th>Product qty</th>
	                    <th>Action</th>
	                  </tr>
	                  </tfoot>
	                </table>
	              </div>
	              <!-- /.card-body -->
	        	</div>
			</div>
		</div>
        <!-- /.card -->
	</div>
</template>

<script>
	export default {

		data(){
			return {
				products: [],
				searchTerm: '',
			}
		},
		created(){
			if (!User.loggedIn()) {
				this.$router.push({name: '/'})
			}

			axios.get('/api/supplier')
			.then(response => {
				this.suppliers = response.data
			})
			.catch(console.log('Supplier not available'))

			axios.get('/api/category')
			.then(response => {
				this.categories = response.data
			})
			.catch(console.log('Category not available'))

			this.fetchProduct();
		},
		computed: {
			filterSearch() {
				return this.products.filter(product => {
					return product.name.match(this.searchTerm)
				})
			}
		}, 
		methods: {
			fetchProduct() {
				axios.get('/api/product')
				.then(response => {
					this.products = response.data
					console.log(response.data)
				})
				.catch(error => {
					console.log(error)
				})
			},
			deleteProduct(id) {
				Swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.isConfirmed) {
				  	axios.delete('/api/product/'+id)
				  	.then(()=>{
				  		this.products = this.products.filter(product =>{
				  			return product.id != id
				  		})
				  	})
				  	.catch(console.log("error"))
				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				})
			}
		},
	}
</script>