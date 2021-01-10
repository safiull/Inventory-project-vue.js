<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Update supplier</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-11 m-auto">
					<div class="card">
						<div class="card-header bg-dark">
							<h3 class="display-5 float-left"><i class="fa fa-user-plus"></i> Edit Supplier</h3>
							<router-link class="btn btn-info btn-sm float-right" to="/all-supplier"><i class="fa fa-users"></i> Supplier list</router-link>
						</div>
						<div class="card-body">
							<form @submit.prevent="supplierUpdate" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="name">Name</label>
											<input id="name" type="text" class="form-control" placeholder="Supplier name" v-model="form.name">
											<small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="email">Email</label>
											<input id="email" type="email" class="form-control" placeholder="Supplier email"v-model="form.email">
											<small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="phone">Phone</label>
											<input id="phone" type="number" class="form-control" placeholder="Phone"v-model="form.phone">
											<small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="address">Address</label>
											<input id="address" type="text" class="form-control" placeholder="Address" v-model="form.address">
											<small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="shop_name">Shop name</label>
											<input id="shop_name" type="text" class="form-control" placeholder="Shop name" v-model="form.shop_name">
											<small class="text-danger" v-if="errors.shop_name">{{ errors.shop_name[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="file">Supplier image</label>
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
					name: null,
					email: null,
					phone: null,
					address: null,
					shop_name: null,
					image: null,
					new_image: null,
				},
				errors: {}
			}
		},


		created(){
			if (!User.loggedIn()) {
				this.$router.push({name: '/'})
			}
		},
		mounted() {
			let id = this.$route.params.id
			axios.get('/api/supplier/'+id)
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

			supplierUpdate() {
				let id = this.$route.params.id
				axios.patch('/api/supplier/'+id, this.form)
				.then(response => {
					this.$router.push({name: 'all-supplier'})
					Notification.success();
					console.log(response.data)
				})
				.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>