<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
-->
</style>
       <?php
	   		$prev_fest		=	'';
			
			for($i = 0; $i < count($item_details); $i++){
			
			if ($prev_fest != $item_details[$i]['fest_id'])
			{
				if ($prev_fest){
					?>
					</table>
					
					<?php
				}
				$prev_fest = $item_details[$i]['fest_id'];
				$fest_rowspan	=	get_array_val_count($item_details, 'fest_id', $item_details[$i]['fest_id']);
	   ?>
	   <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td class="style1">Item details for <?php echo $item_details[$i]['fest_name']?></td>
        </tr>
        </table>
        
        <table width="100%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
                <th width="30" align="center">Sl No</th>
                <th width="80" align="left">Item Code</th>
                <th width="130" align="left">Item Name</th>
                <th width="130" align="left">Vibhagam</th>
                <th width="80" align="left">Gender</th>
                <th width="30" align="center">Type</th>
                <th width="70" align="center">Participant</th>
				<th width="50" align="center">Event Limit</th>
            </tr>
            <?php 
				$count = 1;
				$prev_vibhagam_id		=	'';
			}
				//for($i = 0; $i < count($item_details); $i++){
			?>
            <tr>
                <td align="center"><?php echo $count;?></td>
                <td align="left"><?php echo $item_details[$i]['item_code'];?></td>
                <td align="left"><?php echo $item_details[$i]['item_name'];?></td>
				<?php
				if ($prev_vibhagam_id != $item_details[$i]['vibhagam_id'])
				{
					$vibhagam_rowspan	=	get_array_val_count($item_details, 'vibhagam_id', $item_details[$i]['vibhagam_id']);
					?>
					<td align="left" rowspan="<?php echo $vibhagam_rowspan;?>"><?php echo $item_details[$i]['vibhagam_name'];?></td>
					<?php
				}
				?>
                
				<td align="left"><?php echo ($item_details[$i]['gender'] == 'B') ? 'Boy' : (($item_details[$i]['gender'] == 'G') ? 'Girl' : 'Common') ;?></td>
                <td align="center"><?php echo $item_details[$i]['item_type'];?></td>
                <td align="center"><?php echo $item_details[$i]['max_participants'];echo ($item_details[$i]['max_pinnani']) ? ' + '.$item_details[$i]['max_pinnani'] : ''?></td>
            	<?php
					if ($prev_vibhagam_id != $item_details[$i]['vibhagam_id'])
					{
						$vibhagam_rowspan	=	get_array_val_count($item_details, 'vibhagam_id', $item_details[$i]['vibhagam_id']);
						$prev_vibhagam_id = $item_details[$i]['vibhagam_id'];
						?>
						<td align="center" rowspan="<?php echo $vibhagam_rowspan;?>" valign="middle"><?php echo $item_details[$i]['max_items'];?></td>
						<?php
					}
				?>
			</tr>
            
            <?php 
				$count++;
			}?>
