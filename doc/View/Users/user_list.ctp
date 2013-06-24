<?php echo $this->element('menu', array('username', $username)); ?>

<div class="span12">
<table class="table">
	<tr>
		<th>User Name</th>
		<th>Affiliation</th>
		<th>Relation</th>
	</tr>
	
	<?php foreach($users_data as $data): ?>
	
		<tr>
			<td><?php echo $data['User']['username']; ?></td>
			<td><?php echo $data['User']['affiliation']; ?></td>
			<td>
				<?php
					if($data['User']['relation'] == "交際する") { echo $this->Form->create('Friend', array('action' => 'register')); }
					if($data['User']['relation'] == "解除する") { echo $this->Form->create('Friend', array('action' => 'delete')); }
					echo $this->Form->hidden('myfriend_name', array('value' => $data['User']['username']));
					echo $this->Form->hidden('myfriend_id', array('value' => $data['User']['user_id']));
					echo $this->Form->hidden('myfriend_affiliation', array('value' => $data['User']['affiliation']));
				?>
				<?php if($data['User']['relation'] == "交際する"): ?>
					<button type="submit" class="btn btn-info"><?php echo $data['User']['relation']; ?></form>
				<?php endif; ?>
				<?php if($data['User']['relation'] == "解除する"): ?>
					<button type="submit" class="btn btn-danger"><?php echo $data['User']['relation']; ?></form>
				<?php endif; ?>
			</td>
		</tr>
	
	<?php endforeach; ?>
</table>


</div>

</div>
</div>