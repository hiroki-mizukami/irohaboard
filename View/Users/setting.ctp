<div class="users-setting">
	<div class="breadcrumb">
	<?php
	$this->Html->addCrumb('HOME', array(
		'controller' => 'users_courses',
		'action' => 'index'
	));
	echo $this->Html->getCrumbs(' / ');
	?>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('設定')?>
		</div>
		<div class="panel-body">
			<?php
				echo $this->Form->create('User', Configure::read('form_defaults'));
				echo $this->Form->input('User.new_password', array(
					'label' => __('新しいパスワード'),
					'type' => 'password',
					'autocomplete' => 'new-password'
				));
				
				echo $this->Form->input('User.new_password2', array(
					'label' => __('新しいパスワード (確認用)'),
					'type' => 'password',
					'autocomplete' => 'new-password'
				));
			?>
			<div class="form-group">
				<div class="col col-sm-9 col-sm-offset-3">
					<?php echo $this->Form->submit(__('保存'), Configure::read('form_submit_defaults')); ?>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
