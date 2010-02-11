<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<div class="user_profile">
	<h4><?=$user->username." (".$user->first_name." ".$user->last_name.")";?></h4>
	<table class="user">
		<tbody>
			<tr>
				<td>Любимый клуб</td>
				<td><?=$user->like_club;?></td>
			</tr>
			<tr>
				<td>Кправляет/управлял командами</td>
				<td>
					<?if(count($lines)):?>
					<ul>
						<?foreach($lines as $line):?>
						<li>
							<?=html::anchor('tournament/team/'.$line->id, $line->team->name);?> (<?=html::anchor('tournament/view/'.$line->table->id, $line->table->name);?>)
						</li>
						<?endforeach;?>
					</ul>
					<?endif;?>
				</td>
			</tr>
		</tbody>
	</table>
</div>