<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">Pay salary</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-11 m-auto">
				<div class="card">
	              <div class="card-header bg-dark">
						<h3 class="display-5 float-left"><i class="fas fa-satellite"></i> Pay salary</h3>
						<router-link class="btn btn-info btn-sm float-right" to="/all-salary"><i class="fa fa-user-plus"></i> All salary </router-link>
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
		                  <th>Salary month</th>
		                  <th>Action</th>
		                </tr>
	                  </thead>
	                  <tbody>
		                  <tr v-for="salary in filterSearch" :key="salary.id">
		                    <td>{{ salary.salary_month }}</td>
		                    <td>
		                    	<router-link :to="{name: 'view-salary', params:{id: salary.salary_month}}" class="btn btn-primary btn-sm">View salary</router-link>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  <tr>
	                    <th>Salary month</th>
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
				salaries: [],
				searchTerm: '',
			}
		},
		created(){
			if (!User.loggedIn()) {
				this.$router.push({name: '/'})
			}
		},
		computed: {
			filterSearch() {
				return this.salaries.filter(salary => {
					return salary.salary_month.match(this.searchTerm)
				})
			}
		}, 
		methods: {
			fetchSalary() {
				axios.get('/api/salary')
				.then(({data}) => (this.salaries = data))
				.catch(error => {
					console.log(error)
				})
			},
		},

		created() {
			this.fetchSalary();
		}

	}
</script>