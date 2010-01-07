<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<div class="player_select_away">
	<?=form::dropdown(array('name' => 'goals_a[0][0]', 'class' => 'select mini field'), $team_players);?>
	<?=form::input(array('name' => 'goals_a[0][1]', 'class' => 'text mini field'));?>
</div>
<div class="player_select_away" style="display:none">
	<?=form::dropdown(array('name' => 'goals_a[1][0]', 'class' => 'select mini field'), $team_players);?>
	<?=form::input(array('name' => 'goals_a[1][1]', 'class' => 'text mini field'));?>
</div>
<div class="player_select_away" style="display:none">
	<?=form::dropdown(array('name' => 'goals_a[2][0]', 'class' => 'select mini field'), $team_players);?>
	<?=form::input(array('name' => 'goals_a[2][1]', 'class' => 'text mini field'));?>
</div>
<div class="player_select_away" style="display:none">
	<?=form::dropdown(array('name' => 'goals_a[3][0]', 'class' => 'select mini field'), $team_players);?>
	<?=form::input(array('name' => 'goals_a[3][1]', 'class' => 'text mini field'));?>
</div>
<div class="player_select_away" style="display:none">
	<?=form::dropdown(array('name' => 'goals_a[4][0]', 'class' => 'select mini field'), $team_players);?>
	<?=form::input(array('name' => 'goals_a[4][1]', 'class' => 'text mini field'));?>
</div>
<div class="player_select_away" style="display:none">
	<?=form::dropdown(array('name' => 'goals_a[5][0]', 'class' => 'select mini field'), $team_players);?>
	<?=form::input(array('name' => 'goals_a[5][1]', 'class' => 'text mini field'));?>
</div>
<div class="player_select_away" style="display:none">
	<?=form::dropdown(array('name' => 'goals_a[6][0]', 'class' => 'select mini field'), $team_players);?>
	<?=form::input(array('name' => 'goals_a[6][1]', 'class' => 'text mini field'));?>
</div>
<a class="add_goal_select_away">Добавить</a>