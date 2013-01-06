<?php defined('ALLOW_INCLUDE') or die('No direct access allowed.');
              
if (!isset($_GET['page']))
{
    $_GET['page'] = 0;
}
$page = (int) $_GET['page'];
if($page < 0 || !is_numeric($page))
    $page = 0;
      
$count_result = mysql_query("SELECT COUNT(*) FROM `itemlogger2_finds` INNER JOIN `itemlogger2_items` 
                        ON `itemlogger2_finds`.`item_index`=`itemlogger2_items`.`id` 
                        INNER JOIN `itemlogger2_servers` 
                        ON `itemlogger2_finds`.`server_id`=`itemlogger2_servers`.`id` 
                        INNER JOIN `itemlogger2_qualities` 
                        ON `itemlogger2_finds`.`quality`=`itemlogger2_qualities`.`id` 
                        LEFT JOIN `itemlogger2_players` 
                        ON `itemlogger2_finds`.`player_id`=`itemlogger2_players`.`id`
                        $mysql_where") or die(mysql_error());
$count_row = mysql_fetch_array($count_result);

$result_count = $count_row[0];
unset($count_row);
unset($count_res);

$start_at = $page*$settings['generic']['result_count'];

$mysql_result = mysql_query("SELECT `itemlogger2_finds`.`server_id`, `itemlogger2_finds`.`player_count`, 
                        `itemlogger2_finds`.`method`, `itemlogger2_finds`.`quality`, 
                        `itemlogger2_finds`.`time`, `itemlogger2_players`.`steam_id`, 
                        `itemlogger2_players`.`name`, `itemlogger2_players`.`avatar`, 
                        `itemlogger2_qualities`.`name` AS `quality_name`, 
                        `itemlogger2_qualities`.`raw_name` AS `quality_raw_name`, 
                        `itemlogger2_items`.`item_name`, `itemlogger2_items`.`proper_name`, 
                        `itemlogger2_items`.`image_url`, `itemlogger2_items`.`material_type` , 
                        `itemlogger2_servers`.`name` AS `server_name` FROM `itemlogger2_finds` 
                        INNER JOIN `itemlogger2_items` 
                        ON `itemlogger2_finds`.`item_index`=`itemlogger2_items`.`id` 
                        INNER JOIN `itemlogger2_servers` 
                        ON `itemlogger2_finds`.`server_id`=`itemlogger2_servers`.`id` 
                        INNER JOIN `itemlogger2_qualities` 
                        ON `itemlogger2_finds`.`quality`=`itemlogger2_qualities`.`id` 
                        LEFT JOIN `itemlogger2_players` 
                        ON `itemlogger2_finds`.`player_id`=`itemlogger2_players`.`id` 
                        $mysql_where
                        ORDER BY `itemlogger2_finds`.`id` DESC
                        LIMIT $start_at, {$settings['generic']['result_count']}") or die(mysql_error());
                        
$page_high =  $result_count < 50 ? $result_count : ($page+1)*$settings['generic']['result_count'];
$page_low = $start_at+1;                        
$output = <<<EOT
<h3>Drops <b>{$page_low}-{$page_high}</b> of <b>{$result_count}</b>:</h3>  
<table id="dropsTable">
    <thead>
        <tr>
            <th colspan="1">Name</th>
            <th>Steam ID</th>
            <th>Time</th>
            <th colspan="2">Item</th>
        </tr>
    </thead>
    <tbody>
EOT;
$oldtz = new DateTimeZone($settings['time']['tz_in']);
$newtz = new DateTimeZone($settings['time']['tz_out']);
while($mysql_row = mysql_fetch_assoc($mysql_result))
{
    foreach($mysql_row as $key=>$info)
    {
        $mysql_row[$key] = htmlspecialchars($mysql_row[$key], ENT_QUOTES, 'UTF-8');    
    }
    
    if($mysql_row['quality_raw_name'] === 'unique')
    {
        $mysql_row['quality_name'] = '';    
    }
    
    if(strlen($mysql_row['avatar']) == 0)
    {
        $mysql_row['avatar'] = 'assets/images/steamqm.jpg';    
    }
    
    if(isset($item_methods[$mysql_row['method']]))
    {
        $item_method = $item_methods[$mysql_row['method']];
    }
    
    $newtime = new DateTime("@{$mysql_row['time']}", $oldtz);
    $newtime->setTimeZone($newtz);
    $corrected_time = $newtime->format($settings['time']['tzformat']);
    
    $item_name = $mysql_row['quality_name'] . ' ' . ($mysql_row['proper_name'] == 1 ? 'The ' : '') . $mysql_row['item_name'];
    $friend_id = steamToFriend($mysql_row['steam_id']);
    $output .= <<<EOT
        <tr class="{$mysql_row['material_type']}">
            <!--
            <td class="player_avatar"><a href="http://steamcommunity.com/profiles/{$friend_id}"><img src="{$mysql_row['avatar']}" alt="Steam Avatar for {$mysql_row['name']}" /></a></td>
            -->
            <td class="player_name"><a title="TF2 Items Profile" href="http://www.tf2items.com/profiles/{$friend_id}">{$mysql_row['name']}</a></td>
            <td class="player_count"><a title="Search by SteamID" href="/?searchCriteria=SID&SearchText={$mysql_row['steam_id']}">{$mysql_row['steam_id']}</a></td>
            <td class="time_found">{$corrected_time}</td>
            <td class="item_name">{$item_method}<a title="Search by Item" href="/?searchCriteria=SItem&SearchText={$mysql_row['item_name']}"><span class="quality_{$mysql_row['quality_raw_name']}">{$item_name}</span></a></td>
            <td class="item_image"><a target="_blank" title="View on TF2 Wiki" href="http://wiki.teamfortress.com/w/index.php?search={$mysql_row['item_name']}"><img src="{$mysql_row['image_url']}" alt="Image of {$item_name}" /></a></td>
        </tr>
EOT;
}

$output .= <<<EOT
    </tbody>
</table>
EOT;

$params = $_GET;

if($page > 0)
{ 
    $params['page'] = $_GET['page'] - 1;
    $param_string = http_build_query($params);
    $output .= "<a href='?{$param_string}' class='pagebutton' style='float:left; margin-left:5px;margin-top:25px;'>&lt;&lt; Back</a>"; 
}
if($page < floor($result_count/$settings['generic']['result_count']))
{ 
    $params['page'] = $_GET['page'] + 1;
    $param_string = http_build_query($params);
    $output .= "<a href='?{$param_string}' class='pagebutton' style='float:right; margin-right:5px;margin-top:25px;'>Next &gt;&gt;</a>";
}
?>
