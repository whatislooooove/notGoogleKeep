<div id="app">
	<div id="addNoteBtn" class="row addNote m-4 justify-content-center addNote m-4">
		<button id="show-modal" @click="showModal = true" type="button" class="btn btn-primary col-sm-4 col-6" data-toggle="modal" data-target=".bd-example-modal-lg">Добавить заметку?</button>
		<!-- use the modal component, pass in the prop -->
		<modal v-if="showModal" @close="showModal = false">
			<!--
		  you can use custom content here to overwrite
		  default content
		-->
			<h3 slot="header">custom header</h3>
		</modal>
	</div>
	<div class="card-deck row m-4 justify-content-center">
		<div class="card card col-md-3 col-sm-4 col-6">
			<img class="card-img-top" src="data:image/jpeg;base64,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" alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title">Название карточки</h5>
				<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
				<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
			</div>
		</div>
	</div>
</div>
