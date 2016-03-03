<?php echo $this->element('menu');?>
<!--[if !IE]><!-->
<style>
@media only screen and (max-width:800px){
	.responsive-table
	{
		display: block;
	}

	.responsive-table thead
	{
		display: none;
	}

	.responsive-table tbody
	{
		display: block;
	}

	.responsive-table tbody tr
	{
		display: block;
		margin-bottom: 1.5em;
	}

	.responsive-table tbody th,
	.responsive-table tbody td
	{
		display: list-item;
		list-style: none;
		border: none;
	}

	.responsive-table tbody th
	{
		margin-bottom: 5px;
		list-style-type: none;
		color: #fff;
		background: #000;
	}

	.responsive-table tbody td
	{
		margin-left: 10px;
		padding: 0;
	}

	.responsive-table a
	{
		font-size: 18px;
		font-weight: bold;
	}

	.responsive-table tbody td:before { width: 100px; display: inline-block;}
	.responsive-table tbody td:nth-of-type(2):before { width: 100px; display: inline-block; content: "種別 : ";}
	.responsive-table tbody td:nth-of-type(3):before { content: "学習開始日 : "; }
	.responsive-table tbody td:nth-of-type(4):before { content: "最終学習日 : "; }
	.responsive-table tbody td:nth-of-type(5):before { content: "理解度 : "; }

}
.content-label
{
	/*
	background: #999;
	color: #fff;
	*/
	font-size: 22px;
	padding-bottom: 0px;
}


</style>
<!--<![endif]-->

<div class="contents index">
	<div class="ib-breadcrumb">
	<?php
	$this->Html->addCrumb('コース一覧', array(
			'controller' => 'users_courses',
			'action' => 'index'
	));

	echo $this->Html->getCrumbs();
	//debug($contents);

	?>
	</div>

	<div class="panel panel-info">
	<div class="panel-heading"><?php echo $course_name; ?></div>
	<div class="panel-body">
	<table class="responsive-table">
		<thead>
			<tr>
				<th><?php echo __('コンテンツ名'); ?></th>
				<th><?php echo __('種別'); ?></th>
				<th><?php echo __('学習開始日'); ?></th>
				<th><?php echo __('最終学習日'); ?></th>
				<th><?php echo __('理解度'); ?></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($contents as $content): ?>
	<tr>
		<?php
		if($content['Content']['kind']=='label')
		{
			echo '<td colspan="5" class="content-label">'.h($content['Content']['title']).'</td>';
		}
		else
		{
			if ($content['Content']['kind'] == 'test')
			{
				echo "<td>" .
						$this->Html->link($content['Content']['title'],
								array(
										'controller' => 'contents_questions',
										'action' => 'index',
										$content['Content']['id']
								)) . "</td>";
				echo "<td>テスト</td>";
			}
			else if($content['Content']['kind'] == 'file')
			{
				echo "<td>" .
						$this->Html->link($content['Content']['title'], $content['Content']['url'], array('target'=>'_blank')). "</td>";
				echo "<td>配布資料</td>";
			}
			else
			{
				echo "<td>" .
						$this->Html->link($content['Content']['title'],
								array(
										'controller' => 'contents',
										'action' => 'view',
										$content['Content']['id']
								)) . "</td>";

				echo "<td>学習</td>";
			}

			//debug($content);
			?>
			<td><?php echo h($content['Record']['first_date']); ?>&nbsp;</td>
					<td><?php echo h($content['Record']['last_date']); ?>&nbsp;</td>
					<td>
			<?php
			if ($content['Content']['kind'] == 'test')
			{
				if ($content['Record']['record_id'] == null)
				{
					echo '';
				}
				else
				{
					$result = ($content['Record']['is_passed'] == 1) ? '合格' : '不合格';

					echo $this->Html->link($result,
							array(
									'controller' => 'contents_questions',
									'action' => 'record',
									$content['Content']['id'],
									$content['Record']['record_id']
							));
				}
			}
			else
			{
				echo h(Configure::read('record_understanding.'.$content[0]['understanding']));
			}
			echo '</td>';
		}
		?>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	</div>
	</div>
</div>