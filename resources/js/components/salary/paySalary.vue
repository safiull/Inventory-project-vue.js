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
	                    <th>Image</th>
	                    <th>Name</th>
	                    <th>Salary</th>
	                    <th>Action</th>
	                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr v-for="employee in filterSearch" :key="employee.id">
		                    <td>{{ employee.id }}</td>
		                    <td>
		                    	<img :src="employee.image" width="40" height="40">
		                    </td>
		                    <td>{{ employee.name }}</td>
		                    <td>{{ employee.salary }}</td>
		                    <td>
		                    	<router-link :to="{name: 'give-salary', params:{id: employee.id}}" class="btn btn-primary btn-sm">Pay salary</router-link>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  <tr>
	                    <th>#</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Salary</th>
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
				employees: [],
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
				return this.employees.filter(employee => {
					return employee.name.match(this.searchTerm)
				})
			}
		}, 
		methods: {
			fetchEmployess() {
				axios.get('/api/employee')
				.then(({data}) => (this.employees = data))
				.catch(error => {
					console.log(error)
				})
			},
		},

		created() {
			this.fetchEmployess();
		}

	}
</script>