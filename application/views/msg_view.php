<?php $cur_user = $prev_user = ""; ?>

<table class="table table-striped" style="table-layout: fixed; word-wrap: break-word;">
	<tbody>
		<?php if($all_msg) : foreach($all_msg as $post):?>
		<?php $cur_user = html_escape($post->user_name); ?>
		<tr class="msg_row <?=$cur_user?>">

			<td class="col-sm-3">
				<?php if($cur_user != $prev_user): ?>
					<img id="avatars" class="img-circle" src="<?=site_url(('assets/images/avatars/avatar_'.$post->avatar_num.'.png'))?>" style="max-width:25px;"> 				
					<strong>  <span class="span_username <?=$cur_user?>"><?php echo html_escape($post->user_name);  ?></span></strong> 
					<u> <span class="span_email <?=$cur_user?>"><?php echo '('.html_escape($post->user_email).')';  ?> </span></u>
				<?php endif;?>
			</td>

			<!-- display msg -->
			<td class="col-sm-7"><?=parse_smileys(html_escape($post->msg),site_url('assets/images/smileys'));?> </td>
			<td class="col-sm-2"> <em class="small text-muted"><?=$post->time;?></em> </td>

		</tr>

		<?php $prev_user = $cur_user; ?>
		<?php endforeach; else:?>
			<h4>No message yet! Be the first one to leave a message</h4>
		<?php endif;?>
	</tbody>

</table>
