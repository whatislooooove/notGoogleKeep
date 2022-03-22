<?php
/** @var string $user_name */
?>
<?php
if (array_key_exists('is_authorized', $_SESSION)):
?>
<div id="app">
	<div class="userBlock row mx-4">
		<div class="col-1 userName">
			<?=$user_name?>
		</div>
		<div class="col-1 logout">
			<a href="/index.php/auth/logout">Выйти</a>
		</div>
		<theme></theme>
	</div>
	<div id="addNoteBtn" class="row addNote m-4 justify-content-center addNote m-4">
		<button id="show-modal" @click="showModalAdd = true" type="button" class="btn btn-primary col-sm-4 col-6" data-toggle="modal" data-target=".bd-example-modal-lg">Добавить заметку?</button>
		<!-- use the modal component, pass in the prop -->
		<modal-add v-if="showModalAdd" @close="showModalAdd = false">
			<!--
		  you can use custom content here to overwrite
		  default content
		-->
			<h3 slot="header">Add note</h3>
		</modal-add>
		<modal-edit v-if="showModalEdit" @close="showModalEdit = false">
			<!--
		  you can use custom content here to overwrite
		  default content
		-->
			<h3 slot="header">Edit note</h3>
		</modal-edit>
	</div>
	<div class="card-deck notes m-4 mx-5">
	<?php
		foreach ($notes as $note):
	?>
		<keep upd="<?=date('Y.m.d', $note['date_update'])?>"
			  end="<?=date('Y.m.d', $note['date_end'])?>"
			  title="<?=$note['title']?>"
			  text="<?=$note['text']?>"
			  data-id="<?=$note['id_note']?>"
			  del="<?=$note['id_note']?>">
		</keep>
	<?php
		endforeach;
	?>
	</div>
</div>
<?php
else:
	header('/index.php/auth');
endif;?>
