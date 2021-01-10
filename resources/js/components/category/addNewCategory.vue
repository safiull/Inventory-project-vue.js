<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Add category</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-11 m-auto">
					<div class="card">
						<div class="card-header bg-dark">
							<h3 class="display-5 float-left"><i class="fa fa-user-plus"></i> Add category</h3>
							<router-link class="btn btn-info btn-sm float-right" to="/all-category"><i class="fa fa-users"></i> Category list</router-link>
						</div>
						<div class="card-body">
							<form @submit.prevent="categoryInsert">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="name">Category name</label>
											<input id="name" type="text" class="form-control" placeholder="Category name" v-model="form.category_name" name="category_name">
											<small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
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
					category_name: null,
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
			categoryInsert() {
				axios.post('/api/category', this.form)
				.then(response => {
					this.$router.push({name: 'all-category'})
					Notification.success();
					console.log(response.data)
				})
				.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>