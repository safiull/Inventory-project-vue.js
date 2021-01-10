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
		                  <th>#</th>
		                  <th>Employee name</th>
		                  <th>Amount</th>
		                  <th>Salary date</th>
		                  <th>Action</th>
		                </tr>
	                  </thead>
	                  <tbody>
		                  <tr v-for="salary in salaries" :key="salary.id">
		                    <td>{{ salary.id }}</td>
		                    <td>{{ salary.name }}</td>
		                    <td>{{ salary.amount }}</td>
		                    <td>{{ salary.salary_date }}</td>
		                    <td>
		                    	<router-link :to="{name: 'view-salary', params:{id: salary.salary_month}}" class="btn btn-primary btn-sm">Edit salary</router-link>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  <tr>
	                      <th>#</th>
		                  <th>Employee name</th>
		                  <th>Amount</th>
		                  <th>Salary date</th>
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
					return salary.name.match(this.searchTerm)
				})
			}
		}, 
		methods: {
			fetchSalary() {
				let id = this.$route.params.id
				axios.get('/api/salary/view/'+id)
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