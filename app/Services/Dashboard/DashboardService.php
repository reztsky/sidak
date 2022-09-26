<?php
namespace App\Services\Dashboard;

class DashboardService{
    
    public static function dashboard($levelUser){
        switch ($levelUser) {
            case '1':
                    return UserLevelOneService::dashboard();
                break;
        
            case '2':
                    return UserLevelTwoService::dashboard();
                break;

            case '3':
                    return UserLevelThreeService::dashboard();
                break;

            default:
                # code...
                break;
        }
    }
}