<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Update expense</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-11 m-auto">
					<div class="card">
						<div class="card-header bg-dark">
							<h3 class="display-5 float-left"><i class="fa fa-user-plus"></i> Edit expense</h3>
							<router-link class="btn btn-info btn-sm float-right" to="/all-expense"><i class="fa fa-users"></i> Expense list</router-link>
						</div>
						<div class="card-body">
							<form @submit.prevent="expenseUpdate">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="expense_amount">Expense amount</label>
											<input id="expense_amount" type="number" class="form-control" placeholder="Expense amount" v-model="form.expense_amount" name="expense_amount">
											<small class="text-danger" v-if="errors.expense_amount">{{ errors.expense_amount[0] }}</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="details">Expense details</label>
											<textarea id="details" class="form-control" placeholder="Expense details" v-model="form.details" name="details"></textarea>
											<small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
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
					expense_amount: null,
					details: null,
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
			axios.get('/api/expense/'+id)
			.then(({data}) => (this.form = data))
			.catch(console.log('Data pai nai'))
		},
		methods: {
			expenseUpdate() {
				let id = this.$route.params.id
				axios.patch('/api/expense/'+id, this.form)
				.then(response => {
					this.$router.push({name: 'all-expense'})
					Notification.success();
					console.log(response.data)
				})
				.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>