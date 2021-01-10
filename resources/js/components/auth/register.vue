<template>
	<div id="app">
		<div class="row justify-content-center">
			<div class="register-box">
			  <div class="register-logo">
			    <a href="../../index2.html"><b>Admin</b>LTE</a>
			  </div>

			  <div class="card">
			    <div class="card-body register-card-body">
			      <p class="login-box-msg">Register a new membership</p>

			      <form @submit.prevent="signup">
			        <div class="input-group">
			          <input type="text" class="form-control" placeholder="Full name" v-model="form.name">
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-user"></span>
			            </div>
			          </div>
			        </div>
			        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
			        <div class="input-group mt-3">
			          <input type="email" class="form-control" placeholder="Email" v-model="form.email">
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-envelope"></span>
			            </div>
			          </div>
			        </div>
			        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
			        <div class="input-group mt-3">
			          <input type="password" class="form-control" placeholder="Password" v-model="form.password">
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-lock"></span>
			            </div>
			          </div>
			        </div>
			        <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
			        <div class="input-group mt-3">
			          <input type="password" class="form-control" placeholder="Retype password" v-model="form.password_confirmation">
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-lock"></span>
			            </div>
			          </div>
			        </div>
			        <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>

			        <div class="row mt-3">
			          <div class="col-8">
			            <div class="icheck-primary">
			              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
			              <label for="agreeTerms">
			               I agree to the <a href="#">terms</a>
			              </label>
			            </div>
			          </div>
			          <!-- /.col -->
			          <div class="col-4">
			            <button type="submit" class="btn btn-primary btn-block">Register</button>
			          </div>
			          <!-- /.col -->
			        </div>
			      </form>
			      <router-link class="text-center" to="/">I already have a membership</router-link>
			    </div>
			    <!-- /.form-box -->
			  </div><!-- /.card -->
			</div>
			<!-- /.register-box -->
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				form: {
					name: null,
					email: null,
					password: null,
					password_confirmation: null,
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
			signup() {
				axios.post('/api/auth/signup', this.form)
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
				})
			}
		}
	}
</script>