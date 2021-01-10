<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">All employee</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-11 m-auto">
				<div class="card">
	              <div class="card-header bg-dark">
						<h3 class="display-5 float-left"><i class="fas fa-satellite"></i> Add Employee</h3>
						<router-link class="btn btn-info btn-sm float-right" to="store-employee"><i class="fa fa-user-plus"></i> Add employee </router-link>
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
	                    <th>Email</th>
	                    <th>Address</th>
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
		                    <td>{{ employee.email }}</td>
		                    <td>{{ employee.address }}</td>
		                    <td>{{ employee.salary }}</td>
		                    <td>
		                    	<div class="btn-group">
		                    		<router-link :to="{name: 'edit-employee', params:{id: employee.id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></router-link>
		                    		<button @click="deleteEmployee(employee.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
		                    	</div>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  <tr>
	                    <th>#</th>
	                    <th>Image</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Address</th>
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
			deleteEmployee(id) {
				Swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.isConfirmed) {
				  	axios.delete('/api/employee/'+id)
				  	.then(()=>{
				  		this.employees = this.employees.filter(employee =>{
				  			return employee.id != id
				  		})
				  	})
				  	.catch(console.log("error"))
				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				})
			}
		},

		created() {
			this.fetchEmployess();
		}

	}
</script>