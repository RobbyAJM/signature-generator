<?php
    header('Content-type: image/jpeg');
    $ini = parse_ini_file('db.ini');

    $jpg_image = imagecreatefromjpeg(dirname(__FILE__).'\templates\sig_template.jpg');
    $white = imagecolorallocate($jpg_image, 255, 255, 255);
    $font_path = dirname(__FILE__). '\fonts\bebas_neue.ttf';

    function playerStuffs($ini, $type)
    {
        if($type == 'xp'){
            return number_format($ini['pXP'],0,',','.')." XPs";
        }elseif($type == 'coins'){
            return number_format($ini['pCoins'],0,',','.')." Coins";
        }elseif($type == 'cookies'){
            return number_format($ini['pCookies'],0,',','.')." Cookies";
        }
    }

    function playerRanks($ini, $type)
    {
        if($type == 'staff'){
            if($ini['pAdminLevel'] > 0){
                if($ini['pAdminLevel'] == 1){
                    return "Trial Moderator (1)";
                }elseif($ini['pAdminLevel'] == 2){
                    return "Moderator (2)";
                }elseif($ini['pAdminLevel'] == 3){
                    return "Admin (3)";
                }elseif($ini['pAdminLevel'] == 4){
                    return "Senior Administrator (4)";
                }elseif($ini['pAdminLevel'] == 5){
                    return "Head Administrator (5)";
                }elseif($ini['pAdminLevel'] == 6){
                    return "Manager (6)";
                }elseif($ini['pAdminLevel'] == 7){
                    return "Server Co-Ordinator (7)";
                }elseif($ini['pAdminLevel'] == 8){
                    return "Honored Staff (8)";
                }elseif($ini['pAdminLevel'] == 9){
                    return "Server Director (9)";
                }elseif($ini['pAdminLevel'] == 10){
                    return "Server Head (10)";
                }elseif($ini['pAdminLevel'] > 10){
                    return "RCON Admin";
                }
            }elseif($ini['pHelperLevel'] > 0){
                if($ini['pHelperLevel'] == 1){
                    return "Helper (1)";
                }elseif($ini['pHelperLevel'] == 2){
                    return "Helper (2)";
                }elseif($ini['pHelperLevel'] == 3){
                    return "Helper (3)";
                }elseif($ini['pHelperLevel'] == 4){
                    return "Helper (4)";
                }elseif($ini['pHelperLevel'] == 5){
                    return "Helper (5)";
                }
            }
        }elseif($type == 'vip'){
            if($ini['pVipLevel'] == 4){
                return "VIP Platinum (4)";
            }elseif($ini['pVipLevel'] == 3){
                return "VIP Gold (3)";
            }elseif($ini['pVipLevel'] == 2){
                return "VIP Silver (2)";
            }elseif($ini['pVipLevel'] == 1){
                return "VIP Bronze (1)";
            }
        }elseif($type == 'clan'){
            if($ini['bTMember'] > 0){
                return "bT Member (Rank: {$ini['bTmember']})";
            }elseif($ini['KissMember'] > 0){
                return "Kiss Member (Rank: {$ini['KissMember']})";
            }elseif($ini['wmmember'] > 0){
                return "wM Member (Rank: {$ini['wmmember']})";
            }elseif($ini['realsmmember'] > 0){
                return "sm Member (Rank: {$ini['realsmmember']})";
            }elseif($ini['RealbTMember'] > 0){
                return "bT Member (Rank: {$ini['RealbTMember']})";
            }elseif($ini['HHmember'] > 0){
                return "HH Member (Rank: {$ini['HHmember']})";
            }elseif($ini['smMember'] > 0){
                return "sm Member (Rank: {$ini['smMember']})";
            }elseif($ini['teaMember'] > 0){
                return "TEA Member (Rank: {$ini['teaMember']})";
            }elseif($ini['wrMember'] > 0){
                return "wR Member (Rank: {$ini['wrMember']})";
            }else{
                return "UC Member";
            }
        }
    }

    function playerInformations($ini, $type)
    {
        if($type == 'event'){
            return number_format($ini['Eventswon'],0,',','.')." Event Wons";
        }elseif($type == 'trucking'){
            return number_format($ini['trucking'],0,',','.')." Trucking Points";
        }elseif($type == 'pizza'){
            return number_format($ini['pizza'],0,',','.')." Pizza Points";
        }
    }

    $dimensions = [
        'xp' => imagettfbbox(22.35, 0, $font_path, playerStuffs($ini,'xp')),
        'coins' => imagettfbbox(22.35, 0, $font_path, playerStuffs($ini,'coins')),
        'cookies' => imagettfbbox(22.35, 0, $font_path, playerStuffs($ini,'cookies')),
        'staff' => imagettfbbox(22.35, 0, $font_path, playerRanks($ini,'staff')),
        'vip' => imagettfbbox(22.35, 0, $font_path, playerRanks($ini,'vip')),
        'clan' => imagettfbbox(22.35, 0, $font_path, playerRanks($ini,'clan')),
        'event' => imagettfbbox(22.35, 0, $font_path, playerInformations($ini,'event')),
        'trucking' => imagettfbbox(22.35, 0, $font_path, playerInformations($ini,'trucking')),
        'pizza' => imagettfbbox(22.35, 0, $font_path, playerInformations($ini,'pizza'))
    ];

    $textWidth = [
        'xp' => abs($dimensions['xp'][4] - $dimensions['xp'][0]),
        'coins' => abs($dimensions['coins'][4] - $dimensions['coins'][0]),
        'cookies' => abs($dimensions['cookies'][4] - $dimensions['cookies'][0]),
        'staff' => abs($dimensions['staff'][4] - $dimensions['staff'][0]),
        'vip' => abs($dimensions['vip'][4] - $dimensions['vip'][0]),
        'clan' => abs($dimensions['clan'][4] - $dimensions['clan'][0]),
        'event' => abs($dimensions['event'][4] - $dimensions['event'][0]),
        'trucking' => abs($dimensions['trucking'][4] - $dimensions['trucking'][0]),
        'pizza' => abs($dimensions['pizza'][4] - $dimensions['pizza'][0]),
    ];

    $xToRight = [
        'xp' => (imagesx($jpg_image) - $textWidth['xp']) - 33.5,
        'coins' => (imagesx($jpg_image) - $textWidth['coins']) - 33.5,
        'cookies' => (imagesx($jpg_image) - $textWidth['cookies']) - 33.5,
        'staff' => (imagesx($jpg_image) - $textWidth['staff']) - 33.5,
        'vip' => (imagesx($jpg_image) - $textWidth['vip']) - 33.5,
        'clan' => (imagesx($jpg_image) - $textWidth['clan']) - 33.5,
        'event' => (imagesx($jpg_image) - $textWidth['event']) - 33.5,
        'trucking' => (imagesx($jpg_image) - $textWidth['trucking']) - 33.5,
        'pizza' => (imagesx($jpg_image) - $textWidth['pizza']) - 33.5,
    ];
    
    imagettftext($jpg_image, 22.35, 0, 35, 193, $white, $font_path, "{$ini['username']} - ".number_format($ini['pKills'],0,',','.')." Score");
    imagettftext($jpg_image, 22.35, 0, 35, 275, $white, $font_path, "{$ini['pHour']} Hours, {$ini['pMin']} Minutes");
    imagettftext($jpg_image, 22.35, 0, 35, 358, $white, $font_path, "{$ini['pMapsPlayed']} Map Played");
    imagettftext($jpg_image, 22.35, 0, 35, 445, $white, $font_path, "{$ini['pEvac']} Evac ({$ini['First']} First Evac)");
    imagettftext($jpg_image, 22.35, 0, 35, 520, $white, $font_path, "{$ini['MaxKS']} Kill");
    imagettftext($jpg_image, 22.35, 0, $xToRight['xp'], 195, $white, $font_path, playerStuffs($ini,'xp'));
    imagettftext($jpg_image, 22.35, 0, $xToRight['coins'], 225, $white, $font_path, playerStuffs($ini,'coins'));
    imagettftext($jpg_image, 22.35, 0, $xToRight['cookies'], 255, $white, $font_path, playerStuffs($ini,'cookies'));
    imagettftext($jpg_image, 22.35, 0, $xToRight['staff'], 335, $white, $font_path, playerRanks($ini,'staff'));
    imagettftext($jpg_image, 22.35, 0, $xToRight['vip'], 370, $white, $font_path, playerRanks($ini,'vip'));
    // imagettftext($jpg_image, 22.35, 0, $xToRight['clan'], 455, $white, $font_path, playerRanks($ini,'clan'));
    imagettftext($jpg_image, 22.35, 0, $xToRight['event'], 455, $white, $font_path, playerInformations($ini,'event'));
    imagettftext($jpg_image, 22.35, 0, $xToRight['trucking'], 485, $white, $font_path, playerInformations($ini,'trucking'));
    imagettftext($jpg_image, 22.35, 0, $xToRight['pizza'], 515, $white, $font_path, playerInformations($ini,'pizza'));

    // Return image to Browser
    imagejpeg($jpg_image); // Pass 2nd parameters to save file

    // Clear Memory
    imagedestroy($jpg_image);
?>