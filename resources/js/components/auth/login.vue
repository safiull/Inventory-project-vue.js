<template>
	<div id="app">
		<div class="row justify-content-center">
			<div class="login-box">
			  <div class="login-logo">
			    <a href="../../index2.html"><b>Admin</b>LTE</a>
			  </div>
			  <!-- /.login-logo -->
			  <div class="card">
			    <div class="card-body login-card-body">
			      <p class="login-box-msg">Sign in to start your session</p>

			      <form @submit.prevent="login">
			        <div class="input-group">
			          <input 
			          	type="email" 
			          	class="form-control" 
			          	placeholder="Email" 
			          	v-model="form.email"
			          >
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-envelope"></span>
			            </div>
			          </div>
			        </div>
			        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
			        <div class="input-group mt-3">
			          <input 
			          	type="password" 
			          	class="form-control" 
			          	placeholder="Password" 
			          	v-model="form.password"
			          >
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-lock"></span>
			            </div>
			          </div>
			        </div>
			        <small class="text-danger" v-if="errors.email">{{ errors.password[0] }}</small>
			        <div class="row mt-3">
			          <div class="col-8">
			            <div class="icheck-primary">
			              <input type="checkbox" id="remember">
			              <label for="remember">
			                Remember Me
			              </label>
			            </div>
			          </div>
			          <!-- /.col -->
			          <div class="col-4">
			            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
			          </div>
			          <!-- /.col -->
			        </div>
			      </form>
			      <p class="mb-1">
			        <router-link class="text-center" to="/forget">I forgot my password</router-link>
			      </p>
			      <p class="mb-0">
			        <router-link class="text-center" to="/register">Register a new membership</router-link>
			      </p>
			    </div>
			    <!-- /.login-card-body -->
			  </div>
			</div>
			<!-- /.login-box -->
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				form: {
					email: null,
					password: null,
				},
				errors: {}
			}
		},

		created(){
			if (User.loggedIn()) {
				this.$router.push({name: 'home'})
			}
		},

		// User.responseAfterLogin(response)
		methods: {
			login() {
				axios.post('/api/auth/login', this.form)
				.then(response => {
					User.responseAfterLogin(response)
					this.$router.push({name: 'home'})
					Toast.fire({
					  title: 'Success!',
					  text: 'Logged in successfully!',
					  icon: 'success',
					})
				})
				.catch(error => {
					this.errors = error.response.data.errors

					Toast.fire({
					  title: 'Error!',
					  text: 'Invaild Email or Password!',
					  icon: 'error',
					})
				})
			}
		}
	}
</script>