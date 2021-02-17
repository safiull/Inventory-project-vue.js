<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Update product</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-11 m-auto">
					<div class="card">
						<div class="card-header bg-dark">
							<h3 class="display-5 float-left"><i class="fa fa-user-plus"></i> Edit product</h3>
							<router-link class="btn btn-info btn-sm float-right" to="/all-supplier"><i class="fa fa-users"></i> Product list</router-link>
						</div>
						<div class="card-body">
							<form @submit.prevent="productUpdate" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="name">Product name</label>
											<input id="name" type="text" class="form-control" placeholder="Product name" v-model="form.product_name" name="product_name">
											<small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="category_id">Category ID</label>
											<select placeholder="Product code" id="category_id" class="form-control" v-model="form.category_id" name="category_id">
												<option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
											</select>
											<small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="product_code">Product code</label>
											<input id="product_code" type="text" class="form-control" placeholder="Product code"v-model="form.product_code" name="product_code">
											<small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="root">Root</label>
											<input id="root" type="text" class="form-control" placeholder="Root" v-model="form.root" name="root">
											<small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="buying_price">Buying price</label>
											<input id="buying_price" type="text" class="form-control" placeholder="Buying price" v-model="form.buying_price" name="buying_price">
											<small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="selling_price">Selling price</label>
											<input id="selling_price" type="text" class="form-control" placeholder="Selling price" v-model="form.selling_price" name="selling_price">
											<small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="supplier_id">Supplier ID</label>
											<select id="category_id" class="form-control" v-model="form.supplier_id" name="category_id" placeholder="Supplier id">
												<option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
											</select>
											<small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="buying_date">Buying date</label>
											<input id="buying_date" type="date" class="form-control" placeholder="Buying date" v-model="form.buying_date" name="buying_date">
											<small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="product_quantity">Product quantity</label>
											<input id="product_quantity" type="number" class="form-control" placeholder="Product quantity" v-model="form.product_quantity" name="product_quantity">
											<small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="file">Product image</label>
											<input id="file" type="file" class="form-control" @change="onFileSelected">
										</div>
									</div>
									<div class="col-6 text-center">
										<div class="form-group">
											<img v-if="this.form.image" :src="this.form.image" width="100" height="100">
										</div>
									</div>
								</div>
								<button class="btn btn-info"><i class="fa fa-save"></i> Update</button>
							</form>
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
				form: {
					category_id: null,
					product_name: null,
					product_code: null,
					root: null,
					buying_price : null,
					selling_price: null,
					supplier_id: null,
					buying_date: null,
					image: null,
					new_image: null,
					product_quantity: null,
				},
				errors: {},
				suppliers: {},
				categories: {}
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
		},
		mounted() {
			let id = this.$route.params.id
			axios.get('/api/product/'+id)
			.then(({data}) => (this.form = data))
			.catch(console.log('Data pai nai'))
		},
		methods: {
			onFileSelected(event) {
				let file = event.target.files[0]
				// console.log(file.name)
				if (file.size > 1048770) {
					Notification.image_validation();
				} else {
					let reader = new FileReader();
					reader.onload = event => {
						this.form.new_image = event.target.result
					};
					reader.readAsDataURL(file)
				}
			},

			productUpdate() {
				let id = this.$route.params.id
				axios.patch('/api/product/'+id, this.form)
				.then(response => {
					this.$router.push({name: 'all-product'})
					Notification.success();
					console.log(response.data)
				})
				.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>