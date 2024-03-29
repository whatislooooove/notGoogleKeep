// register modal component
Vue.component("modal-add", {
	template: "#modal-template",
	methods: {
		addNote() {

			let noteData = {
				title: this.title,
				text: this.description,
			}
			axios.post('/index.php/notelist/add', noteData)
				.then(res => {
					if (res.data.errors) {
						this.errors = res.data.errors;
					} else {
						vm.keeps.push({
							title: res.data.title,
							text: res.data.text,
							dateupd: timeConverter(res.data.date_update),
							dateend: timeConverter(res.data.date_end),
							id: res.data.id_note
						});
					}
				});
			this.$emit('close');
		}
	}
});

Vue.component("modal-edit", {
	template: "#modal-template",
	methods: {
		editNote() {
			console.log(this.title);
			console.log(this.description);

			let noteData = {
				title: this.title,
				text: this.description,
			}
			axios.post('/index.php/notelist/add', noteData)
				.then(res => {
					if (res.data.errors) {
						this.errors = res.data.errors;
					} else {
						// window.location.reload();
						console.log('good!')
					}
				});
		},
		loadData() {
			this.title = 'kek';
			this.description = 'kek kek';
			console.log('test');
		}
	},
	data: {
		value: 'kek'
	},
	mounted() {
		this.loadData();
	}
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
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Введите пароль</label>
					<input type="password" v-model="password" class="form-control" id="password" placeholder="Password" required>
				</div>
				<button type="submit" class="btn btn-primary my-3">Авторизоваться</button>
				<div>Нет аккаунта? <a href="/index.php/auth/register" class="">Зарегистрируйтесь</a></div>
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
						} else {
							window.location.href = '/';
						}
					});
			}
		}
	}
})

Vue.component('signup', {
	template: `
	<div class="row h-100 justify-content-center align-items-center">
  		<form class="signInForm" @submit.prevent="onSignUp">
   			<p v-if="errors.length">
      			<b>Пожалуйста исправьте указанные ошибки:</b>
       			<ul>
          			<li v-for="error in errors">{{ error }}</li>
       			</ul>
     		</p>
     		<p v-if="msg !== null" class="msg">
      			{{msg}}
     		</p>
			<div class="content">
				<div class="form-group">
					<label for="name">Введите ваше имя</label>
						<input type="text" v-model="name" class="form-control" id="name" aria-describedby="emailHelp"
							placeholder="Enter name" required>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Введите логин</label>
						<input type="text" v-model="login" class="form-control" id="login" aria-describedby="emailHelp"
							placeholder="Enter login" required>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Введите пароль</label>
					<input type="password" v-model="password" class="form-control" id="password" placeholder="Password" required>
				</div>
				<div class="form-group">
					<label for="repeatInputPassword1">Повторите пароль</label>
					<input type="password" v-model="repeatpassword" class="form-control" id="repeatpassword" placeholder="Repeat password" required>
				</div>
				<button type="submit" class="btn btn-primary my-3">Зарегистрироваться</button>
				<div>Есть аккаунт? <a href="/index.php/auth" class="">Войти</a></div>
			</div>
  		</form>
 	</div>`,
	data() {
		return {
			name: null,
			login: null,
			password: null,
			repeatpassword: null,
			errors: [],
			msg: null
		}
	},
	methods: {
		onSignUp() {
			let formInputs = {
				name: this.name,
				login: this.login,
				password: this.password,
				repeatpassword: this.repeatpassword
			}
			// this.login = null;
			// this.password = null;
			this.errors = [];
			this.msg = null;

			if (formInputs.login.length < 4) {
				this.errors.push('Логин слишком короткий (4 символа минимум)')
			}
			if (formInputs.password.length < 4) {
				this.errors.push('Пароль слишком короткий (4 символа минимум)')
			}
			if (formInputs.password !== formInputs.repeatpassword) {
				this.errors.push('Пароли не совпадают')
			}

			if (this.errors.length == 0) {
				axios.post('/index.php/auth/signup', formInputs)
					.then(res => {
						this.name = null;
						this.login = null;
						this.password = null;
						this.repeatpassword = null;

						if (res.data.errors) {
							this.errors = res.data.errors;
						} else {
							this.msg = 'Вы успешно зарегистрировались';
						}
					});
			}
		}
	}
})

Vue.component('theme', {
	template: `
    <div class="col-10 theme">
   		<div class="changeTheme">
   			<label>
    			<input type="checkbox" value="Активна" v-model="darkTheme">
    			Темная тема: {{darkTheme.length != 0 ? 'Активна' : 'Неактивна'}}<br>
    		</label>
    	</div>
	</div>`,
	data() {
		return {
			darkTheme: []
		}
	}
})

Vue.component('keep', {
	props: ['upd', 'end', 'title', 'text', 'del'],
	template: `<div class="card noteBlock my-3" @click="showModalEdit = true;">
		<div class="card-body">
			<div class="row">
				<h5 class="card-title col-11">{{title}}</h5>
				<a href="#" class="deleteNote col-1 justify-content-end row" @click="deleteNote">Удалить</a>
			</div>
    		<p class="card-text">{{text}}</p>
    		<p class="card-text"><small class="text-muted">Last updated: {{upd}}</small></p>
    		<p class="card-text"><small class="text-muted">End date: {{end}}</small></p>
   		</div>
  	</div>`,

	methods: {
		deleteNote(e) {
			let neededBlock = e.currentTarget.closest(`[id]`);
			let blockId = neededBlock.getAttribute('id');
			neededBlock.remove();
			axios.post('/index.php/notelist/delete', blockId)
				.then(res => {
					if (res.data.errors) {
						this.errors = res.data.errors;
					}
				});
		}
	}
})

// start app
let vm = new Vue({
	el: "#app",
	data: {
		showModalAdd: false,
		showModalEdit: false,
		keeps: []
	}
});

function timeConverter(UNIX_timestamp){
	var a = new Date(UNIX_timestamp * 1000);
	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var year = a.getFullYear();
	var month = ((a.getMonth() + 1) < 10) ? '0' + (Number(a.getMonth()) + 1) : a.getMonth();
	var date = a.getDate();
	var hour = a.getHours();
	var min = a.getMinutes();
	var sec = a.getSeconds();
	var time = year + '.' + month  + '.' + date + ' ';
	return time;
}
