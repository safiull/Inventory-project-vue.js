<template>
	
</template>
<script>
	export default {
		created(){
			localStorage.removeItem('token')
			localStorage.removeItem('user')
			this.$router.push({name: '/'})
			Toast.fire({
					  title: 'Success!',
					  text: 'Logout successfully!',
					  icon: 'success',
					});
		}
	}
</script>