<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Pos</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-5">
					<div class="card">
						<div class="card-header">
							<h3>Sell payments</h3>
						</div>
						<div class="card-body">
							<table class="table">
							  <thead>
							    <tr>
							      <th>Name</th>
							      <th>Qty</th>
							      <th>Unit</th>
							      <th>Total</th>
							      <th>Action</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th>G-Technology G DRIVE</th>
							      <td>10</td>
							      <td>100</td>
							      <td>120</td>
							      <td>
							      	<button class="btn btn-danger btn-xs">×</button>
							      </td>
							    </tr>
							  </tbody>
							</table>
						</div>
					</div>
				</div>
	          	<div class="col-12 col-sm-7">
	          		<div class="card">
	          			<div class="card-header">
	          				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All products</a>
							  </li>
							  <li v-for="category in categories" :key="category.id" class="nav-item">
							    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" @click="subProduct(category.id)" aria-selected="false">{{ category.category_name }}</a>
							  </li>
							</ul>
	          			</div>
	          			<div class="card-body">
	          				<input placeholder="Search" type="text" class="form-control" name="">
	          				<div class="tab-content" id="pills-tabContent">
							  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							  	<div class="row mt-3">
									<div class="col-3" v-for="product in products" :key="product.id">
										<div class="card text-center">
										  <router-link to="#">
											  <img alt="Card image cap" :src="product.image" width="100" height="90">
											  <div class="card-body">
											    <h5 class="card-title">{{ product.product_name }}</h5>
											    <span v-if="product.product_quantity > 0" class="badge badge-success">Available ({{ product.product_quantity }})</span>
											    <span v-else="" class="badge badge-danger">Stock out</span>
											    <small class="d-block text-dark">{{ product.buying_price }} Tk</small>
											  </div>
										  </router-link>
										</div>
									</div>
								</div>
							  </div>
							  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							  	<div class="row mt-3">
									<div class="col-3" v-for="subProduct in subProducts" :key="subProducts.id">
										<div class="card text-center">
										  <router-link to="#">
											  <img :src="subProducts.image" width="100" height="90">
											  <div class="card-body">
											    <h5 class="card-title">{{ subProduct.product_name }}</h5>
											    <span v-if="subProduct.product_quantity > 0" class="badge badge-success">Available ({{ subProduct.product_quantity }})</span>
											    <span v-else="" class="badge badge-danger">Stock out</span>
											    <small class="d-block text-dark">{{ subProduct.buying_price }} Tk</small>
											  </div>
										  </router-link>
										</div>
									</div>
								</div>
							  </div>
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
		data(){
			return {
				categories: [],
				products: [],
				searchTerm: '',
				subProducts: [],
			}
		},

		created(){
			if (!User.loggedIn()) {
				this.$router.push({name: '/'})
			};

			this.fetchProduct();
			this.fetchCategory();

		},

		computed: {
			filterSearch() {
				return this.categories.filter(category => {
					return category.category_name.match(this.searchTerm)
				})
			}
		}, 

		methods: {
			fetchProduct() {
				axios.get('/api/product')
				.then(response => {
					this.products = response.data
					// console.log(response.data)
				})
				.catch(error => {
					console.log(error)
				})
			},
			fetchCategory() {
				axios.get('/api/category')
				.then(response => {
					this.categories = response.data
				})
				.catch(error => {
					console.log("Data ante pari nai")
				})
			},
			subProduct(id) {
				axios.get('/api/subProduct/'+id)
				.then(response => {
					this.subProducts = response.data
				})
				.catch(error => {
					console.log("Data ante pari nai")
				})
			},
		}
	}
</script>