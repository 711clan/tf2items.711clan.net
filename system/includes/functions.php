<?php defined('ALLOW_INCLUDE') or die('No direct access allowed.');

function steamToFriend($steam_id)
{
    $steam_id=strtolower($steam_id);
    if(substr($steam_id,0,7)=='steam_0')
    {
        $tmp=explode(':',$steam_id);
        if((count($tmp)==3) && is_numeric($tmp[1]) && is_numeric($tmp[2]))
        {
            return bcadd((($tmp[2]*2)+$tmp[1]),'76561197960265728');
        } 
        else 
        {
            return false;
        }
    }
     else 
     {
        return false;
     }
}

function doRender($page_name, $extra_tags="", $extra_description="", $body_content="")
{
    global $page, $settings;
    
    $header['meta_description'] = 'A log of TF2 Items obtained on a variety of servers by people over a historical period of time.' . $extra_description;
    $header['meta_tags'] = 'TF2, team, fortress, 2, two, valve, software, corporation, steam, powered, source, HL2, half, life, L4D, left, 4, four, dead, zombie, scout, spy, soldier, medic, pyro, demoman, enginieer, sniper, heavy, weapons, explosions, awesomeness' . $extra_tags;
    $header['page_name'] = $page_name;
    
    include 'system/templates/head.php';
    include 'system/templates/body.php';
    include 'system/templates/footer.php';  
}

function doDrops($mysql_where="")
{                       
    global $item_methods, $settings;

    include 'system/templates/drops.php';
    return $output; 
}