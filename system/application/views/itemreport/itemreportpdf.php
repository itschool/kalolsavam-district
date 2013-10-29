<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
-->
</style>
<page backtop="20mm" backbottom="10mm">
	<page_header>
		<table style="width: 100%;">
			<tr>
				<td style="text-align: left;width: 50%">
					<img src="<?php echo image_url().'logo.jpg'?>">
				</td>
				<td style="text-align: right;width: 50%">Kerala School Kalolsavam 2013 - 2014</td>
			</tr>
			<tr>
				<td style="width: 100%" colspan="2"><hr/></td>
			</tr>
		</table>
	</page_header>
<page_footer>
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">page [[page_cu]]/{nb} </td>
			</tr>
		</table>
</page_footer>
       <?php
	   		$prev_fest		=	'';

			for($i = 0; $i < count($item_details); $i++){

			if ($prev_fest != $item_details[$i]['fest_id'])
			{
				if ($prev_fest){
					?>
					</table>
					</page>
					<page backtop="20mm" backbottom="10mm">
	<page_header>
		<table style="width: 100%;">
			<tr>
				<td style="text-align: left;width: 50%">
					<img src="<?php echo image_url().'logo.jpg'?>">
				</td>
				<td style="text-align: right;width: 50%">Kerala School Kalolsavam 2013 - 2014</td>
			</tr>
			<tr>
				<td style="width: 100%" colspan="2"><hr/></td>
			</tr>
		</table>
	</page_header>
<page_footer>
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">page [[page_cu]]/{nb} </td>
			</tr>
		</table>
</page_footer>
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
                <th width="30" align="center" style="border: 0 1px 1px 0 #000000; padding:2px;">Sl No</th>
                <th width="80" align="left" style="border: 0 1px 1px 0 #000000; padding:2px;">Item Code</th>
                <th width="130" align="left" style="border: 0 1px 1px 0 #000000; padding:2px;">Item Name</th>
                <th width="130" align="left" style="border: 0 1px 1px 0 #000000; padding:2px;">Vibhagam</th>
                <th width="80" align="left" style="border: 0 1px 1px 0 #000000; padding:2px;">Gender</th>
                <th width="30" align="center" style="border: 0 1px 1px 0 #000000; padding:2px;">Type</th>
                <th width="70" align="center" style="border: 0 1px 1px 0 #000000; padding:2px;">Participant</th>
				<th width="50" align="center" style="border: 0 1px 1px 0 #000000; padding:2px;">Event Limit</th>
            </tr>
            <?php
				$count = 1;
				$prev_vibhagam_id		=	'';
			}
				//for($i = 0; $i < count($item_details); $i++){
			?>
            <tr>
                <td align="center" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo $count;?></td>
                <td align="left" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo $item_details[$i]['item_code'];?></td>
                <td align="left" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo $item_details[$i]['item_name'];?></td>
				<?php
				if ($prev_vibhagam_id != $item_details[$i]['vibhagam_id'])
				{
					$vibhagam_rowspan	=	get_array_val_count($item_details, 'vibhagam_id', $item_details[$i]['vibhagam_id']);
					?>
					<td align="left" rowspan="<?php echo $vibhagam_rowspan;?>" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo $item_details[$i]['vibhagam_name'];?></td>
					<?php
				}
				?>

				<td align="left" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo ($item_details[$i]['gender'] == 'B') ? 'Boy' : (($item_details[$i]['gender'] == 'G') ? 'Girl' : 'Common') ;?></td>
                <td align="center" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo $item_details[$i]['item_type'];?></td>
                <td align="center" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo $item_details[$i]['max_participants'];echo ($item_details[$i]['max_pinnani']) ? ' + '.$item_details[$i]['max_pinnani'] : ''?></td>
            	<?php
					if ($prev_vibhagam_id != $item_details[$i]['vibhagam_id'])
					{
						$vibhagam_rowspan	=	get_array_val_count($item_details, 'vibhagam_id', $item_details[$i]['vibhagam_id']);
						$prev_vibhagam_id = $item_details[$i]['vibhagam_id'];
						?>
						<td align="center" rowspan="<?php echo $vibhagam_rowspan;?>" valign="middle" style="border: 0 1px 1px 0 #000000; padding:2px;"><?php echo $item_details[$i]['max_items'];?></td>
						<?php
					}
				?>
			</tr>

            <?php
				$count++;
			}?>
        </table>


</page>
