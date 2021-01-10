<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Give salary</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-11 m-auto">
					<div class="card">
						<div class="card-header bg-dark">
							<h3 class="display-5 float-left"><i class="fa fa-user-plus"></i> Give salary</h3>
							<router-link to="/pay-salary" class="btn btn-info btn-sm float-right"><i class="fa fa-users"></i> Pay salary</router-link>
						</div>
						<div class="card-body">
							<form @submit.prevent="giveSalary">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="name">Employee name</label>
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
											<label for="salary">Salary amount</label>
											<input id="salary" type="number" class="form-control" placeholder="Salary"v-model="form.salary">
											<small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="salary_month">Salary month</label>
											<select placeholder="Salary month" id="salary_month" class="form-control" v-model="form.salary_month" name="salary_month">
												<option value="January">January</option>
												<option value="February">February</option>
												<option value="March">March</option>
												<option value="April">April</option>
												<option value="May">May</option>
												<option value="June">June</option>
												<option value="July">July</option>
												<option value="August">August</option>
												<option value="September">September</option>
												<option value="October">October</option>
												<option value="November">November</option>
												<option value="Decebmber">Decebmber</option>
											</select>

											<small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
										</div>
									</div>
								</div>

								<button class="btn btn-info"><i class="fa fa-save"></i> Give salary</button>
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
					salary_month: null,
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
			axios.get('/api/employee/'+id)
			.then(({data}) => (this.form = data))
			.catch(console.log('Show error'))
		},
		methods: {
			giveSalary() {
				let id = this.$route.params.id
				axios.post('/api/giveSalary/'+id, this.form)
				.then(response => {
					this.$router.push({name: 'all-salary'})
					Notification.success();
					// console.log(response.data)
				})
				.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>