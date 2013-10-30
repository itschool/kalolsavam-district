 
Cluster Report  

Festival : <?php echo $retdata[0]['fest_name']; ?>

<?php $prev_cluster="";$clustarray=""; $item_code="";$prev_array="";
for($j=0;$j<count($retdata); $j++){ if(($prev_cluster!=$retdata[$j]['clustno'])||($item_code!=$retdata[$j]['item_code'])){ $prev_cluster=$retdata[$j]['clustno'];$prev_array=$clustarray;$clustarray="";$clustarray=$retdata[$j]['participant_id']; if($j!=0){?>

Cluster    <?php echo $retdata[$j-1]['clustno']; ?>:  <?php echo $prev_array; ?><?php }}else {$clustarray=$clustarray.',  '.$retdata[$j]['participant_id'];?> <?php }if($item_code!=$retdata[$j]['item_code']){$item_code=$retdata[$j]['item_code'];?>



Item Code  :  <?php echo $retdata[$j]['item_code']; ?>   Item Name   : <?php echo $retdata[$j]['item_name']; ?>

Stage: <?php echo $retdata[$j]['stage_name'].' - '.$retdata[$j]['stage_desc'].' '.datetophpmodel($retdata[$j]['stime']).' at '.timephpmodel($retdata[$j]['ttime']); ?> Maximum Time for item :<?php echo $retdata[$j]['max_time']; ?> <?php }}$prev_array=$clustarray;?>

Cluster  <?php echo $retdata[$j-1]['clustno']; ?>:  <?php echo $prev_array; ?>

 
 
 