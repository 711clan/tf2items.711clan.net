<?php defined('ALLOW_INCLUDE') or die('No direct access allowed.');              

$search_value = "";
if(isset($_GET['SearchText']))
{
    $search_value = htmlspecialchars($_GET['SearchText'], ENT_QUOTES, 'UTF-8');
}

$mysql_where = "WHERE `itemlogger2_finds`.`player_id` > 0";

$selected['SName'] = ""; 
$selected['SID'] = ""; 
$selected['SItem'] = "";

if(isset($_GET['searchCriteria']) && strlen($search_value) > 0)
{
    switch ($_GET['searchCriteria'])
    {
        case 'SName':
        {
            $selected['SName'] = "selected";  
            $mysql_where .= " AND `itemlogger2_players`.`name` LIKE '%".mysql_real_escape_string($search_value)."%'";
            break;
        }
        case 'SID':
        {
            $selected['SID'] = "selected";
            $mysql_where .= " AND `itemlogger2_players`.`steam_id` LIKE '%".mysql_real_escape_string($search_value)."%'";
            break;
        }
        case 'SItem':
        {
            $selected['SItem'] = "selected"; 
            $mysql_where .= " AND `itemlogger2_items`.`item_name` LIKE '%".mysql_real_escape_string($search_value)."%'";
            break;
        }      
    }   
}

$body_content = <<<EOT
    <div id="dropSearch">
        <form id="highlightForm" method="post" action="{$_SERVER['REQUEST_URI']}"> 
         <div class="searchRow">                     
               <span class="rowTitle">Highlight:</span>  
               <input type="checkbox" name="CHWeapon" id="CHWeapon" /> <label for="CHWeapon">Weapons</label>
               <input type="checkbox" name="CHHat" id="CHHat" />    <label for="CHHat">Hats</label>
               <input type="checkbox" name="CHTool" id="CHTool" />   <label for="CHTool">Tools</label>
               <input type="checkbox" name="CHCrate" id="CHCrate" />  <label for="CHCrate">Crates</label>
               <input type="checkbox" name="CHCraft" id="CHCraft" />  <label for="CHCraft">Crafting</label>   
           </div>
        </form> 
        <form method="get" action="{$_SERVER['REQUEST_URI']}">
           <div class="searchRow">
               <span class="rowTitle">Search by:</span> 
               <select name="searchCriteria" class="tx">
                    <option value="SName" {$selected['SName']}>Player Name</option>
                    <option value="SID" {$selected['SID']}>Player STEAM ID</option> 
                    <option value="SItem" {$selected['SItem']}>Item Name</option> 
               </select>
               <span class="rowTitle" style="width:auto;"> For </span>
               <input type="text" name="SearchText" class="tx" value="$search_value" />
           </div>
           <div class="searchRow">
            <input type="submit" class="pagebutton" style="float:right;margin-right:10px;margin-top:5px;" value="Filter" />
           </div>                                                         
        </form>
    </div>
    <div id="dropSearchDropDownButton">Filtering Options</div>

EOT;
$body_content .= doDrops($mysql_where);

doRender('Recent Drops', ', drops, recent, time, items, players', ' Items that have recently dropped.', $body_content);
