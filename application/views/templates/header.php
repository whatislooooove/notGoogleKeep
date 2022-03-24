<html>
<head>
	<title>Not Google keep, этим все сказано</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<link rel="stylesheet" href="/assets/styles/styles.css" type="text/css" />
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script type="text/x-template" id="modal-template">
		<transition name="modal">
			<div class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-container">
						<div class="modal-header">
							<slot name="header">
								default header
							</slot>
						</div>

						<div class="modal-body">
							<slot name="body">
								<label>Введите заголовок</label>
								<input type="text" class="form-control" id="title" v-model="title" aria-describedby="emailHelp"
									   placeholder="Enter title" required>
								<label>Введите описание</label>
								<textarea type="text" class="form-control" id="description" v-model="description" aria-describedby="emailHelp"
									   placeholder="Enter description" required></textarea>
							</slot>
						</div>

						<div class="modal-footer">
							<slot name="footer">
								<button class="btn btn-primary" @click="addNote">
									Добавить
								</button>
								<button class="btn btn-secondary" @click="$emit('close')">
									Закрыть
								</button>
							</slot>
						</div>
					</div>
				</div>
			</div>
		</transition>
	</script>
</head>
<body>

