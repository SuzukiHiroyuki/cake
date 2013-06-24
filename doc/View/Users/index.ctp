<?php echo $this->Html->css('index'); ?>

<div class="container" style="padding-top: 50px;">
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
	<fieldset>
		<legend><?php echo __('Please enter your username and password'); ?></legend>
				  <?php echo $this->Form->input('username', array('placeholder' => '4～12文字の半角英数字'));
						  echo $this->Form->input('password', array('placeholder' => '6～10文字の半角英数字'));
				  ?>
	</fieldset>
<button type="submit" class="btn">Login</button></form>



<?php echo $this->Form->create('User', array('action' => 'add')); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
				  <?php echo $this->Form->input('username', array('placeholder' => '4～12文字の半角英数字'));
						  echo $this->Form->input('password', array('placeholder' => '6～10文字の半角英数字'));
						  echo $this->Form->input('affiliation', array('placeholder' => '所属組織を入力'));
				  ?>
	</fieldset>
<button type="submit" class="btn">登録</button></form>
</div>