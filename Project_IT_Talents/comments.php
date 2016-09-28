<?php 

$data = filterComments();

?>

<section id="comments">
<table cellspacing="0">
<tr id="titleStore">
<th colspan="2"><?php echo $data['store'] ?></th>
						<th id="com123"><?php echo "Comments: " . count($data['rows'])?></th>
						<th id="rate123"><?php echo "Rate: " . sprintf('%03.1f', $data['rate'])?>/5</th>
					</tr>
					
					<?php foreach ($data['rows'] as $row):?>
						<tr>			
							<td><?= $row['data']?></td>
							<td><?= $row['user_name'] ?></td>
							<td><?= $row['comment']?></td>
							<td><?= $row['rate']; ?></td>
						</tr>
					<?php endforeach;?>
					
				</table>	
				
				<p style="color:rgb(250, 200, 200); padding: 10px;"><?= $msgStore ?></p>
			</section>