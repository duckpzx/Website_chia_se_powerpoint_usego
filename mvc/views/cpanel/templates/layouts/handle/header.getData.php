<?php 
class showInfo extends General {
    private $userId;
    private $status;
    private $MyModels;
    private $access;

    public function __construct() 
    {
        $this->access = new General;
        $this->userId = $this->access->accessUserId();
        $this->checkStatusLogin();
    }

    public function checkStatusLogin()
    {
        $this->status = new isLogin();
        if ( $this->status->checkLogin() ) 
        {
            $userId = $this->status->checkLogin();
            $Id = $userId['userId'];
            $queryUser = $this->getUserId( $Id );
            $dataInfoUser = (!empty( $queryUser )) ? $queryUser : [];
            return $dataInfoUser;
        } 
        else {
            $this->status = false;
        }
    }

    // Set Infomation User
    public function getStatus() 
    {
        return $this->status;
    }

    public static function setFullName($data, $key)
    {
        if ($key === 'no_key') 
        {
            return $data['firstName'] . ' ' . $data['lastName'];
            
        } else if(!empty($data[$key]['firstName']) && !empty($data[$key]['lastName']))
        {
            return $data[$key]['firstName'] . ' ' . $data[$key]['lastName'];
        } 
        else {
            return (!empty($data[$key]['firstName'])) ? $data[$key]['firstName'] : $data[$key]['lastName'];
        }
    }

    public static function setEmail($data)
    {
        if(!empty($data[0]['email']))
        {
            return $data[0]['email'];
        }
    }

    public static function setAvatar($data, $key)
    {
        if(!empty($data[$key]['avatar'])) 
        {
            return $data[$key]['avatar'];
        }
    }

    public static function setInfomation($data, $key) 
    {
        if(!empty($data[0][$key])) 
        {
            return $data[0][$key];
        }
    } 

    private function getUserId($userId)
    {
        $query = $this->access->MyModelsCrud->getRaw("
        SELECT 
            id, firstName, lastName, email, coin, firstLogin,
            avatar, describes, ug_type, createAt
        FROM 
            ug_users
        WHERE 
            id = '$userId'");
        return $query;
    }

    public static function setIdUser($data) 
    {
        if(!empty($data[0])) return $data[0]['id'];
    }

    public static function analysis2Character($data) 
    {
        $paths = explode( '||', $data );
        $paths = array_map( 'trim' , $paths );
        $paths = array_filter( $paths );

        return $paths;
    } 

    public static function handleKeyWord($data, $title)
    {
        foreach ($data as $item) {
            if (strpos($title, $item) !== false) {
                // If there is, return that element
                return $item;
            }
        }
        // If none of the keywords is found, return the first keyword in the array
        return $data[0];
    }

    public static function dateDiffInMinutes($dateTimeTwo, $dateTimeOne = null) {
        $dateTimeOne = $dateTimeOne ?? date('Y-m-d H:i:s');
        $minutes = round(abs(strtotime($dateTimeTwo) - strtotime($dateTimeOne)) / 60);

        if ($minutes < 60) {
            return "$minutes phút trước";
        } elseif ($minutes < 1440) {
            return round($minutes / 60) . " giờ trước";
        } elseif ($minutes < 43200) {
            return floor($minutes / 1440) . " ngày trước";
        } elseif ($minutes < 518400) {
            return floor($minutes / 43200) . " tháng trước";
        } else {
            return floor($minutes / 518400) . " năm trước";
        }
    }

    // Get top keywords
    public function getTopKeywords() {
        $data = $this->access->MyModelsCrud->getRaw("
        SELECT 
            ug_power_point.tags, 
            COUNT(ug_like_post.id) AS like_count 
        FROM 
            ug_users 
        INNER JOIN 
            ug_power_point ON ug_users.id = ug_power_point.userId 
        LEFT JOIN 
            ug_like_post ON ug_power_point.id = ug_like_post.id_onwser 
        GROUP BY 
            ug_users.id, ug_power_point.id 
        ORDER BY 
            like_count DESC LIMIT 4");

        $arrayTopKeywords = [];
        foreach ( $data as $tags )
        {
            $arrayTags = showInfo::analysis2Character( $tags ['tags'] );
            $arrayTopKeywords = array_merge( $arrayTopKeywords, $arrayTags );
        }
        $uniqueArray = array_map('strtolower', array_unique( array_map( 'trim', $arrayTopKeywords )));
        $arrayResults = array_slice( $uniqueArray, 0, 10 );
        return $arrayResults;
    }

    public static function formatCoin($num) {
        if ($num >= 1e9) return number_format($num / 1e9, 1) . 'T';
        if ($num >= 1e6) return number_format($num / 1e6, 1) . 'Tr';
        if ($num >= 1e3) return number_format($num / 1e3, 1) . 'K';
        return $num;
    }
}

class showInfoYourSelf extends Controller {
    // Set Infomation yourself 
    public static function checkYourSelf( $idUrl ) 
    {
        $check = new showInfo();
        $myId = $check->setIdUser($check->checkStatusLogin());
        if( $myId == $idUrl )
        {
            return true;
        }
        return false;
    }

    public static function setDateYourSelf($method, $params)
    {
        if(Request::isGet())
        {
            if(!empty($method[$params]))
            {
                $idUrl = $method[$params];
                if(showInfoYourSelf::checkYourSelf($idUrl))
                {
                    return true;
                }
            }
        }
    }

    public static function showDataLists($dataLists, $interface, $value)
    {   
        if (!empty($dataLists)) 
        {
            foreach ($dataLists as $item) 
            {
                $output = str_replace('{{' . $value . '}}', $item[$value], $interface);
                echo $output;
            }
        }
    }
}


// Define ________________________________________________________________

    // Tat ca
    define('tat_ca_text', 'Tất cả bài viết');
    define('tat_ca_image', 'poster-01');
    // Xa hoi
    define('xa_hoi_text', 'Xã hội');
    define('xa_hoi_image', 'poster-02');
    // Sang trong
    define('sang_trong_text', 'Sang trọng');
    define('sang_trong_image', 'poster-03');
    // Tinh yeu
    define('tinh_yeu_text', 'Tình yêu');
    define('tinh_yeu_image', 'poster-04');
    // Thuong mai
    define('thuong_mai_text', 'Thương mại');
    define('thuong_mai_image', 'poster-05');
    // Kinh doanh
    define('kinh_doanh_text', 'Kinh doanh');
    define('kinh_doanh_image', 'poster-06');
    // Robot
    define('robot_text', 'Robot');
    define('robot_image', 'poster-07');
    // Cong nghe
    define('cong_nghe_text', 'Công nghệ');
    define('cong_nghe_image', 'poster-08');
    // Nghe thuat
    define('nghe_thuat_text', 'Nghệ thuật');
    define('nghe_thuat_image', 'poster-09');
    // The gioi
    define('the_gioi_text', 'Thế giới');
    define('the_gioi_image', 'poster-10');
    // Hoat hinh
    define('hoat_hinh_text', 'Hoạt hình');
    define('hoat_hinh_image', 'poster-11');
    // Du lich
    define('du_lich_text', 'Du lịch');
    define('du_lich_image', 'poster-12');

class Compact extends Controller {

    public static function compactData($data, $key) 
    {
        if(!empty($data[$key]))
        {
            return $data[$key];
        }
    }

    public static function handleTypeTime() 
    {
        $timeToday = date("Y-m-d");
        // Get 'Thứ' to time 
        $editTimeToday = date("N", strtotime($timeToday));
        // Convert from things to words
        $textTimeToday = "";
        switch($editTimeToday) 
        {
            case 1:
                $textTimeToday = "Thứ 2";
                break;
            case 2:
                $textTimeToday = "Thứ 3";
                break;
            case 3:
                $textTimeToday = "Thứ 4";
                break;
            case 4:
                $textTimeToday = "Thứ 5";
                break;
            case 5:
                $textTimeToday = "Thứ 6";
                break;
            case 6:
                $textTimeToday = "Thứ 7";
                break;
            case 7:
                $textTimeToday = "Chủ nhật";
                break;
            default: 
                $textTimeToday = _no_data;
        }
        return $textTimeToday;
    }

    public static function getParam() 
    {
        $redirect = $_SERVER['REDIRECT_URL'];
        return explode('/', $redirect);
    }

    public static function identifyTopic($type) 
    {
        $pathRedirect = Compact::getParam();
        if (!empty( $pathRedirect[3] )) 
        {
            $paramTopic = $pathRedirect[3];
            switch ($paramTopic) 
            {
                case 'xa-hoi':
                    echo ( $type == 'text' ) ? xa_hoi_text : xa_hoi_image;
                    break;

                case 'sang-trong':
                    echo ( $type == 'text' ) ? sang_trong_text : sang_trong_image;
                    break;

                case 'tinh-yeu':
                    echo ( $type == 'text' ) ? tinh_yeu_text : tinh_yeu_image;
                    break;

                case 'thuong-mai':
                    echo ( $type == 'text' ) ? thuong_mai_text : thuong_mai_image;
                    break;

                case 'kinh-doanh':
                    echo ( $type == 'text' ) ? kinh_doanh_text : kinh_doanh_image;
                    break;

                case 'robot':
                    echo ( $type == 'text' ) ? robot_text : robot_image;
                    break;

                case 'cong-nghe':
                    echo ( $type == 'text' ) ? cong_nghe_text : cong_nghe_image;
                    break;

                case 'nghe-thuat':
                    echo ( $type == 'text' ) ? nghe_thuat_text : nghe_thuat_image;
                    break;

                case 'the-gioi':
                    echo ( $type == 'text' ) ? the_gioi_text : the_gioi_image;
                    break;

                case 'hoat-hinh':
                    echo ( $type == 'text' ) ? hoat_hinh_text : hoat_hinh_image;
                    break;
                    
                case 'du-lich':
                    echo ( $type == 'text' ) ? du_lich_text : du_lich_image;
                    break;

                default:
                    echo ( $type == 'text' ) ? tat_ca_text : tat_ca_image;
                    break;
            }
        } else {
            echo ( $type == 'text' ) ? tat_ca_text : tat_ca_image;
        }
    }
}

$statusLogin = new showInfo();
