<?php
include('../core/init.php');
include(ROOT.'/templates/header.php');
$user_class  = new User();
$total_users = $user_class->count_users();
$page  = isset($_GET['page'])? $_GET['page'] : 1;
$users 	  	 = $user_class->user_list();
?>
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<?php if($users){ ?>
				<table class="table table-striped users-table">
					<thead>
						<tr>
							<th>SNo.</th>
							<th>Customer name</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i = (($page-1)*10)+1;
							foreach($users as $user){
								$user_id 	= escape($user->id);
								$first_name = escape($user->first_name);
								$last_name  = escape($user->last_name);
								$tr  = '<tr onclick="window.location=\''.REL.'/admin/single-user.php?u='.$user_id.'\'">';
								$tr .= '<td>'.$i.'</td>';
								$tr .= '<td>'.$first_name.' '.$last_name.'</td>';
								$tr .= '</tr>';
								$i++;
								echo $tr;
							}
						?>
					</tbody>
				</table>
				<?php
				pagination::get_pagination(10,$total_users);
				?>
			<?php 
			}
			else{
				echo "Users list is empty.";
			}
			?>
		</div>
	</div>
</div>