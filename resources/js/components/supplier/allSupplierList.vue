<template>
	<div>
		<div class="card">
			<div class="card-header">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
				    <li class="breadcrumb-item active" aria-current="page">All supplier</li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-11 m-auto">
				<div class="card">
	              <div class="card-header bg-dark">
						<h3 class="display-5 float-left"><i class="fas fa-satellite"></i> All Supplier</h3>
						<router-link class="btn btn-info btn-sm float-right" to="store-supplier"><i class="fa fa-user-plus"></i> All Supplier </router-link>
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
	                    <th>Phone</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Shop name</th>
	                    <th>Action</th>
	                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr v-for="supplier in filterSearch" :key="supplier.id">
		                    <td>{{ supplier.id }}</td>
		                    <td>
		                    	<img :src="supplier.image" width="40" height="40">
		                    </td>
		                    <td>{{ supplier.phone }}</td>
		                    <td>{{ supplier.name }}</td>
		                    <td>{{ supplier.email }}</td>
		                    <td>{{ supplier.shop_name }}</td>
		                    <td>
		                    	<div class="btn-group">
		                    		<router-link :to="{name: 'edit-supplier', params:{id: supplier.id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></router-link>
		                    		<button @click="deleteSupplier(supplier.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
		                    	</div>
		                    </td>
		                  </tr>
	                  </tbody>
	                  <tfoot>
	                  <tr>
	                    <th>#</th>
	                    <th>Image</th>
	                    <th>Phone</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Shop name</th>
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
				suppliers: [],
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
				return this.suppliers.filter(supplier => {
					return supplier.name.match(this.searchTerm)
				})
			}
		}, 
		methods: {
			fetchSupplier() {
				axios.get('/api/supplier')
				.then(response => {
					this.suppliers = response.data
				})
				.catch(error => {
					console.log(error)
				})
			},
			deleteSupplier(id) {
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
				  	axios.delete('/api/supplier/'+id)
				  	.then(()=>{
				  		this.suppliers = this.suppliers.filter(supplier =>{
				  			return supplier.id != id
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
			this.fetchSupplier();
		}

	}
</script>