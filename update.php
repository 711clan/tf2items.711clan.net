<?php  

define('ALLOW_INCLUDE', 1);
require 'system/includes/config.php';

$TFItems_440 = json_decode(file_get_contents('http://api.steampowered.com/ITFItems_440/GetSchema/v0001/?key='.$settings['steam']['api_key'].'&format=json&language='.$settings['generic']['language']));

header("Content-type: plain text");
echo json_encode($TFItems_440);

//Update the items table.
mysql_query('TRUNCATE `itemlogger2_items`') or die(mysql_error());
$items_query = 'INSERT IGNORE INTO itemlogger2_items (`id`, `item_name`, `proper_name`, `item_slot`, `image_url`, `material_type`)';
$i = 0;

foreach($TFItems_440->result->items->item as $item_info)
{
    if($i == 0)
    {
        $items_query .= " VALUES ($item_info->defindex, '$item_info->item_name', " . (int)$item_info->proper_name . ", '$item_info->item_slot', '$item_info->image_url', '$item_info->craft_material_type')";    
        $i++;
    }
    else
    {
        $items_query .= ", ($item_info->defindex, '" . mysql_real_escape_string($item_info->item_name) . "', " . (int)$item_info->proper_name . ", '" . mysql_real_escape_string($item_info->item_slot) . "', '" . mysql_real_escape_string($item_info->image_url) . "', '" . mysql_real_escape_string($item_info->craft_material_type) . "')";
    }
}

mysql_query($items_query) or die(mysql_error());
unset($items_query);


//Update the qualities table.
mysql_query('TRUNCATE `itemlogger2_qualities`') or die(mysql_error());
$qualities_query = 'INSERT IGNORE INTO itemlogger2_qualities (`id`, `name`, `raw_name`)';
$i = 0;

foreach($TFItems_440->result->qualities as $quality_key=>$quality_info)
{
    if($i == 0)
    {
        $qualities_query .= " VALUES ('". mysql_real_escape_string($quality_info) ."', '". mysql_real_escape_string($TFItems_440->result->qualityNames->{$quality_key}) ."', '". mysql_real_escape_string($quality_key) ."')";    
        $i++;                            
    }
    else
    {
        $qualities_query .= ", ('". mysql_real_escape_string($quality_info) ."', '". mysql_real_escape_string($TFItems_440->result->qualityNames->{$quality_key}) ."', '". mysql_real_escape_string($quality_key) ."')";        
    }
}

mysql_query($qualities_query) or die(mysql_error());
unset($qualities_query);


