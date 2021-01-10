<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">All category</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-11 m-auto">
				<div class="card">
	              <div class="card-header bg-dark">
						<h3 class="display-5 float-left"><i class="fas fa-satellite"></i> All category</h3>
						<router-link class="btn btn-info btn-sm float-right" to="store-category"><i class="fa fa-user-plus"></i> Add category </router-link>
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
	                    <th>Category name</th>
	                    <th>Action</th>
	                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr v-for="category in filterSearch" :key="category.id">
		                    <td>{{ category.id }}</td>
		                    <td>{{ category.category_name }}</td>
		                    <td>
		                    	<div class="btn-group">
		                    		<router-link :to="{name: 'edit-category', params:{id: category.id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></router-link>
		                    		<button @click="deleteCategory(category.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
		                    	</div>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  <tr>
	                    <th>#</th>
	                    <th>Category name</th>
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
				categories: [],
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
				return this.categories.filter(category => {
					return category.category_name.match(this.searchTerm)
				})
			}
		}, 
		methods: {
			fetchCategory() {
				axios.get('/api/category')
				.then(response => {
					this.categories = response.data
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
				  	axios.delete('/api/category/'+id)
				  	.then(()=>{
				  		this.categories = this.categories.filter(category =>{
				  			return category.id != id
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
			this.fetchCategory();
		}

	}
</script>