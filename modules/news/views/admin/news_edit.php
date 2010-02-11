<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<?=html::script(array(
	'templates/template/js/jwysiwyg/jquery.wysiwyg'
));?>
<?=form::open();?>
<ul>
	<li>
		<?=form::label(array('class' => 'desc', 'for' => 'title'), 'Заголовок');?>
		<div>
			<?=form::input(array('name' => 'title', 'class' => 'text medium field'), $form['title']);?>
		</div>
	</li>
	<li>
		<label class="desc" for="text">
			Текст новости
		</label>
		<div>
			<?=form::textarea(array('id' => 'text', 'name' => 'text', 'class' => 'textarea max field', 'id' => 'wysiwyg'), $form['text']);?>
		</div>
	</li>
	<li>
		<?=form::submit('', 'Сохранить');?>
	</li>
</ul>
<?=form::close();?>

<script language="JavaScript" type="text/javascript">
$(function(){
	$('#wysiwyg').wysiwyg({
		controls : {
			html : { visible : true }
		},
		css : '/templates/template/css/wysiwyg.css'
	});
});
</script>