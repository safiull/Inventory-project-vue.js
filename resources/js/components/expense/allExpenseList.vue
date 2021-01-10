<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">All expense</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-11 m-auto">
				<div class="card">
	              <div class="card-header bg-dark">
						<h3 class="display-5 float-left"><i class="fas fa-satellite"></i> All expense</h3>
						<router-link class="btn btn-info btn-sm float-right" to="store-expense"><i class="fa fa-user-plus"></i> Add expense </router-link>
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
		                    <th>Expense Amount</th>
		                    <th>Expense Details</th>
		                    <th>Action</th>
		                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr v-for="expense in filterSearch" :key="expense.id">
		                    <td>{{ expense.id }}</td>
		                    <td>{{ expense.expense_amount }}</td>
		                    <td>{{ expense.details }}</td>
		                    <td>
		                    	<div class="btn-group">
		                    		<router-link :to="{name: 'edit-expense', params:{id: expense.id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></router-link>
		                    		<button @click="deleteCategory(expense.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
		                    	</div>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  	<tr>
		                    <th>#</th>
		                    <th>Expense Amount</th>
		                    <th>Expense Details</th>
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
		computed: {
			filterSearch() {
				return this.expenses.filter(expense => {
					return expense.expense_amount.match(this.searchTerm)
				})
			}
		}, 
		methods: {
			fetchExpense() {
				axios.get('/api/expense')
				.then(response => {
					this.expenses = response.data
				})
				.catch(error => {
					console.log("Data ante pari nai")
				})
			},
			deleteCategory(id) {
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
				  	axios.delete('/api/expense/'+id)
				  	.then(()=>{
				  		this.expenses = this.expenses.filter(expense =>{
				  			return expense.id != id
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
			this.fetchExpense();
		}

	}
</script>