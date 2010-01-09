<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h1 class="news">Новости:</h1>
<?foreach($news as $new):?>
<div class="news_short">
		<div class="news_short_header">
			<?=html::anchor('news/view/'.$new->url, $new->title);?>
		</div>
		<div class="news_short_info">
			Создана: <?=date('d-m-Y H:i', $new->created);?>
		</div>
	<div class="news_short_body">
		<?text::limit_words($new->text, 50, '...');?>
		<?=$new->text?>
	</div>
	<div class="news_short_footer">
		<?html::anchor('news/view/'.$new->url, 'Подробнее')?>
	</div>
</div>
<?endforeach;?>
<div class="pagination">
	<?=$this->pagination->render();?>
</div>