// register modal component
Vue.component("modal", {
	template: "#modal-template"
});

//
Vue.component('signin', {
	template: `
    <div class="row h-100 justify-content-center align-items-center">
		<form class="signInForm" @submit.prevent="onSignIn">
			<p v-if="errors.length">
    			<b>Пожалуйста исправьте указанные ошибки:</b>
    			<ul>
      				<li v-for="error in errors">{{ error }}</li>
    			</ul>
  			</p>
			<div class="content">
				<div class="form-group">
					<label for="exampleInputEmail1">Введите логин</label>
					<input type="text" v-model="login" class="form-control" id="login" aria-describedby="emailHelp"
						   placeholder="Enter login" required>
					<small id="emailHelp" class="form-text text-muted">We'll never share your login with anyone
						else =).</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Введите пароль</label>
					<input type="password" v-model="password" class="form-control" id="password" placeholder="Password" required>
				</div>
				<button type="submit" class="btn btn-primary">Авторизоваться</button>
			</div>
		</form>
	</div>`,
	data() {
		return {
			login: null,
			password: null,
			errors: []
		}
	},
	methods: {
		onSignIn() {
			let formInputs = {
				login: this.login,
				password: this.password
			}
			// this.login = null;
			// this.password = null;
			this.errors = [];

			if (formInputs.login.length < 4) {
				this.errors.push('Логин слишком короткий (4 символа минимум)')
			}
			if (formInputs.password.length < 4) {
				this.errors.push('Пароль слишком короткий (4 символа минимум)')
			}

			if (this.errors.length == 0) {
				axios.post('/index.php/auth/signin', formInputs)
					.then(res => {
						if (res.data.errors) {
							this.errors = res.data.errors;
							this.login = null;
							this.password = null;
						}
						else {
							window.location.reload();
						}
					});
			}
		}
	}
})
// start app
new Vue({
	el: "#app",
	data: {
		showModal: false
	}
});
