<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Library</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-11 m-auto">
					<div class="card">
						<div class="card-header bg-dark">
							<h3 class="display-5 float-left"><i class="fa fa-user-plus"></i> Add Employee</h3>
							<router-link class="btn btn-info btn-sm float-right" to="all-employee"><i class="fa fa-users"></i> Employee list</router-link>
						</div>
						<div class="card-body">
							<form @submit.prevent="employeeInsert" enctype="multipart/form-data">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="name">Name</label>
											<input id="name" type="text" class="form-control" placeholder="Employee name" v-model="form.name">
											<small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="email">Email</label>
											<input id="email" type="email" class="form-control" placeholder="Employee email"v-model="form.email">
											<small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="salary">Salary</label>
											<input id="salary" type="number" class="form-control" placeholder="Salary"v-model="form.salary">
											<small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
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
									<div class="col-6">
										<div class="form-group">
											<label for="nid">Nid</label>
											<input id="nid" type="text" class="form-control" placeholder="Nid"v-model="form.nid">
											<small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="date">Joining date</label>
											<input id="date" type="date" class="form-control" v-model="form.joining_date">
											<small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="description">Description</label>
											<textarea rows="2" placeholder="Description" id="description" class="form-control" v-model="form.description"></textarea>
											<small class="text-danger" v-if="errors.description">{{ errors.description[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="file">Employee image</label>
											<input id="file" type="file" class="form-control" @change="onFileSelected">
										</div>
									</div>
									<div class="col-6 text-center">
										<div class="form-group">
											<img v-if="this.form.image" :src="this.form.image" width="100" height="100">
										</div>
									</div>
								</div>
								<button class="btn btn-info"><i class="fa fa-save"></i> Seve</button>
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
					salary: null,
					address: null,
					nid: null,
					joining_date: null,
					image: null,
					description: null,
				},
				errors: {}
			}
		},

		created(){
			if (!User.loggedIn()) {
				this.$router.push({name: '/'})
			}
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
						this.form.image = event.target.result
					};
					reader.readAsDataURL(file)
				}
			},

			employeeInsert() {
				axios.post('/api/employee', this.form)
				.then(response => {
					this.$router.push({name: 'all-employee'})
					Notification.success();
					console.log(response.data)
				})
				.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>