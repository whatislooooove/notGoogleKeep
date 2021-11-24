// register modal component
Vue.component("modal", {
	template: "#modal-template"
});

//
Vue.component('signin', {
	template: `
    <div class="row h-100 justify-content-center align-items-center">
		<form class="signInForm" @submit.prevent="onSignIn">
			<div class="content">
				<div class="form-group">
					<label for="exampleInputEmail1">Введите почту</label>
					<input type="email" v-model="login" class="form-control" id="login" aria-describedby="emailHelp"
						   placeholder="Enter login">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
						else.</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Введите пароль</label>
					<input type="password" v-model="password" class="form-control" id="password" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-primary">Авторизоваться</button>
			</div>
		</form>
	</div>`,
	data() {
		return {
			login: null,
			password: null
		}
	},
	methods: {
		onSignIn() {
			let formInputs = {
				login: this.login,
				password: this.password
			}
			this.login = null;
			this.password = null;

			axios.post('/index.php/auth/signin', formInputs)
				.then(res => {
					console.log(res.data); // Результат ответа от сервера
			});

			console.log(formInputs);
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
