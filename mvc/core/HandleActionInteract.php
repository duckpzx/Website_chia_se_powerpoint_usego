<?php 
    require_once (__DIR__  . "/Shared/General.php");
    require_once (__DIR__  . "/Request.php");
    require_once (__DIR__  . "/bin/ImapEmail.php");

class HandleActionInteract extends General {
    private $idPost, $userId, $idOnwser;
    private $data;

    public $response, $error;
    private $access;

    public function __construct()
    {
        $this->access = new General;
        $this->userId = $this->access->accessUserId();
    }

    public function actionAuthentication( $table ) 
    {
        if ( $this->access->attributeEmpty( [ 'idPost' ] ) ) 
        {
            $this->idOnwser = $_POST['idPost'];
            $checkExit = $this->access->MyModelsOther->getRows(" SELECT id FROM $table 
            WHERE userId = '$this->userId' AND id_onwser = '$this->idOnwser' ");
            
            if ( $checkExit > 0)
            {            
                $this->access->MyModelsCrud->remove( $table, "userId = '$this->userId' AND id_onwser = '$this->idOnwser'" );
                $this->response = ['result' => 'delete'];

            } else {
                $this->data = [
                    'userId' => $this->userId,
                    'id_onwser' => $this->idOnwser,
                    'createAt' => date('Y-m-d H:i:s')
                ];
                $this->access->MyModelsCrud->insert($table, $this->data);
                $this->response = ['result' => 'insert'];
            }
        } else {
            $this->error = _on_error;
        }
    }
 
    public function getDataProfile( $type )
    {
        if( $this->access->attributeEmpty( [ 'id' ] ) )
        { 
            if ( $type == 'favourite' ) {
                $this->userId = $_POST['id'];
                $this->response = $this->access->MyModelsCrud->getRaw("
                SELECT ug_power_point.*
                FROM ug_power_point
                INNER JOIN ug_collection_post ON ug_power_point.id = ug_collection_post.id_onwser
                WHERE ug_collection_post.userId = '$this->userId'");
                $this->response = array_reverse( $this->response );
            } else {
                $this->userId = $_POST['id'];
                $this->response = 
                $this->access->MyModelsCrud->getRaw("
                SELECT * FROM ug_power_point 
                WHERE userID = '$this->userId' 
                ORDER BY id DESC");
            }
        } else {
            $this->error = _on_error;
        }
    }

    // remove archive
    public function removeArchive() 
    {
        if ( $this->access->attributeEmpty( [ 'arrays' ] ) ) 
        {
            $arrayIds = $_POST['arrays'];
            $arrayIds = explode(',', $arrayIds);
            if( is_array( $arrayIds ) )
            {
                foreach ( $arrayIds as $id ) 
                {
                    $this->data = [
                        'userId' => NULL 
                    ];

                    $query = $this->access->MyModelsCrud->update('ug_archive', $this->data, "idPost = '$id' AND userId = '$this->userId'");
                }
            } 
            $this->response = ( $query ) ? 'Xóa nội dung khỏi danh sách' : _on_error;
        } else {
            $this->error = _on_error;
        }
    }

    public function filterData( $table )
    {
        if ( $table === 'no' ) 
        { 
            // One This means you only need to get records from one table
            return $this->access->MyModelsCrud->getRaw("
            SELECT *,
            ug_power_point.createAt as timeAt
            FROM ug_power_point as pptx
            INNER JOIN (
                SELECT 
                    idPost, 
                    MAX(createAt) AS maxCreateAt
                FROM ug_archive
                WHERE userId = '$this->userId'
                GROUP BY idPost
            ) AS latest_archive ON pptx.id = latest_archive.idPost
            ORDER BY latest_archive.maxCreateAt DESC;
            ");
        } 
        else {
            // Find the appropriate record or in a collection
            return $this->access->MyModelsCrud->getRaw("
            SELECT *,
            ug_power_point.createAt as timeAt
            FROM ug_power_point
            WHERE EXISTS (
                SELECT id_onwser
                FROM $table
                WHERE $table.id_onwser = ug_power_point.id
                AND EXISTS (
                    SELECT id
                    FROM ug_archive
                    WHERE ug_archive.idPost = $table.id_onwser
                    AND ug_archive.userId = $table.userId
                    AND ug_archive.userId = '$this->userId'
                )
            ) ");
        }
    }
    
    public function oldestdate() 
    {
        $this->response = array_reverse($this->filterData( 'no' ));
    }

    public function firstDate() 
    {
        $this->response = $this->filterData( 'no' );
    }

    public function hascollection() {
        $this->response = $this->filterData('ug_collection_post');
    }

    public function haslike() {
        $this->response = $this->filterData('ug_like_post');
    }

    private function getIdPostArchive() 
    {
        // Get data from downloaded articles
        return $this->access->MyModelsCrud->getRaw("SELECT * FROM ug_archive 
        WHERE userId = '$this->userId' ORDER BY id DESC");
    }
    
    public function searcharchive() 
    {
        if ( !empty( $_POST['keyword'] ) ) 
        {
            $keyword = $_POST['keyword'];
            $this->response = $this->access->MyModelsCrud->getRaw("
            SELECT * 
            FROM 
                ug_power_point 
            WHERE 
                id IN ( SELECT idPost FROM ug_archive 
                WHERE 
                    userId = '$this->userId' ) AND 
                    title LIKE '%$keyword%'");
        }
    }
    
    public function actionFollow() 
    {
        if ( $this->access->attributeEmpty( [ 'idonswer' ] ) )
        {
            $this->idOnwser = $_POST['idonswer'];

            $check = $this->access->MyModelsOther->getRows("
            SELECT * 
            FROM 
                ug_follow 
            WHERE 
                userId = '$this->userId' AND 
                id_onswer = '$this->idOnwser'");

            ( $check > 0 ) ? $this->removeFollow() : $this->insertFollow();
        } else 
        {
            $this->error = _on_error;
        }
    }

    private function insertFollow() 
    {
        $this->data = [
            'userId' => $this->userId,
            'id_onswer' => $this->idOnwser,
            'createAt' => date('Y-m-d H:i:s')
        ];

        $this->access->MyModelsCrud->insert("ug_follow", $this->data);
        $this->response = ['result' => 'yes'];
    }
    
    private function removeFollow() 
    {  
        $this->access->MyModelsCrud->remove("ug_follow", "userId = '$this->userId' AND id_onswer = '$this->idOnwser'");
        $this->response = ['result' => 'no'];
    }

    // On Chat Website

    public function interactWithComment( $action ) 
    {
        if ( $this->access->attributeEmpty( [ 'content', 'idpost' ] ) ) 
        {
            
            $comment = $_POST['content'];

            $this->idPost = $_POST['idpost'];
        
            switch ( $action ) {
                case 'comment':
                    $this->insertComment( $this->userId, $this->idPost, $comment );
                    $table = 'ug_comment';
                    $joinCondition = 'userId = id';
                    $orderBy = 'ug_comment.id_cmt';
                    $idRespond = '';
                    break;

                case 'respond':
                    $idComment = $_POST['id_cmt'];
                    $this->insertRespondComment( $idComment, $this->userId, $this->idPost, $comment );
                    $table = 'ug_respond_comment';
                    $joinCondition = 'userId = ug_users.id';
                    $orderBy = 'ug_respond_comment.id';
                    $idRespond = 'ug_respond_comment.id,';
                    break;

                default:
                    return;
            }

            $this->response = $this->access->MyModelsCrud->getRaw("SELECT $idRespond firstName, lastName, avatar, $table.*
                FROM ug_users, $table 
                WHERE ug_users.id = '$this->userId' AND $joinCondition ORDER BY $orderBy DESC LIMIT 1");
        } else {
            $this->error = _on_error;
        }
    }

    private function insertComment($id, $idPost, $comment)
    {
        $this->data = [
            'userId' => $id,
            'idPost' => $idPost,
            'content' => nl2br($comment),
            'createAt' => date('Y-m-d H:i:s')
        ];
        $this->access->MyModelsCrud->insert('ug_comment', $this->data);
    } 

    private function insertRespondComment( $idCmt, $id, $idPost, $comment )
    {
        $this->data = [
            'id_cmt' => $idCmt,
            'userId' => $id,
            'idPost' => $idPost,
            'content' => nl2br($comment),
            'createAt' => date('Y-m-d H:i:s')
        ];
        $checkExits = $this->access->MyModelsOther->getRows(" SELECT id_cmt FROM ug_comment WHERE id_cmt = '$idCmt' ");
        if ( $checkExits ) 
        {
            $this->access->MyModelsCrud->insert('ug_respond_comment', $this->data);
        } 
    }

    // Remove comment 
    public function removeComment() 
    {
        if ( $this->access->attributeEmpty( [ 'id_cmt' ] ) ) 
        {   // Remove comment 
            $idComment = $_POST['id_cmt'];
            
            $this->access->MyModelsCrud->remove('ug_respond_comment', " id_cmt = '$idComment' ");
            $this->access->MyModelsCrud->remove('ug_comment', " userId = '$this->userId' AND id_cmt = '$idComment' ");
            $this->response = [ 'id_cmt' => $_POST['id_cmt'] ];
        } 
        else {
            if ( $this->access->attributeEmpty( [ 'id' ] ))
            {   // Remove respond comment
                $idComment = $_POST['id'];
                $this->access->MyModelsCrud->remove('ug_respond_comment', " id = '$idComment' ");
                $this->response = [ 'id' => $_POST['id'] ];
            }
        }
    }

    public function paginationAl() 
    {
        if ( $this->access->attributeEmpty( [ 'page' ] )) 
        {
            $followCondition = ( !empty( $this->userId ) ) ? "ug_follow.userId  = '$this->userId' AND" : '';
            $idPost = $_POST['page'];
            $totalNumberPage = $this->access->MyModelsOther->getRows(" SELECT * FROM ug_power_point ");
            if ( $idPost < 0 ) $idPost = 1;
            if ( $idPost > $totalNumberPage ) $idPost = $totalNumberPage; 
            // Result data Table Comment 
            $toltalNumberOn1Page = 20;
            $offSet = ( $idPost - 1 ) * $toltalNumberOn1Page;
            $this->response = $this->access->MyModelsCrud->getRaw(" SELECT ug_users.id, 
            ug_users.firstName, ug_users.lastName, ug_users.avatar, ug_users.ug_type,
            ug_power_point.*, COUNT(ug_like_post.id) AS like_count,
            (SELECT COUNT(*) FROM ug_follow WHERE $followCondition ug_follow.id_onswer = ug_power_point.userId ) as total_follow
            FROM ug_users 
            INNER JOIN ug_power_point ON ug_users.id = ug_power_point.userId
            LEFT JOIN ug_like_post ON ug_power_point.id = ug_like_post.id_onwser
            GROUP BY ug_users.id, ug_power_point.id
            ORDER BY ug_power_point.id DESC LIMIT $offSet, $toltalNumberOn1Page ");
        } else {
            $this->error = _on_error;
        }
    }

    // Remove post on page profile 
    public function removeProfile()
    {
        if ( $this->access->attributeEmpty( [ 'id' ] ) ) 
        {
            $tab = !empty( $_POST['tab'] ) ?? null;
            $idPost = $_POST['id'];
            $typeTable = ( $tab != null ) ? 'ug_collection_post' : 'ug_power_pointt';
            $condition = "userId = '$this->userId' AND id = '$idPost'";
            $query = $this->access->MyModelsCrud->remove( $typeTable, $condition );
            if ( !$query ) 
            {
                $this->error = _on_error;
            }
        } else {
            $this->error = _on_error;
        }
    }    

    // Arrange post   
    public function arrangePost() 
    {
        if ( $this->access->attributeEmpty( [ 'id', 'class', 'type' ] ) ) 
        {
            $this->userId = $_POST['id'];
            $type = $_POST['type'];

            $stringCondition = '';

            switch ( $type ) 
            {
                case 'kinaz' :
                    $stringCondition = 'ORDER BY ug_power_point.title DESC';
                    break;

                case 'kinza' :
                    $stringCondition = 'ORDER BY ug_power_point.title ASC';
                    break;

                default : break;
            }

            $this->response = ( $type . " SELECT *
            FROM ug_power_point
            INNER JOIN ug_collection_post ON ug_power_point.id = ug_collection_post.id_onwser
            WHERE ug_collection_post.userId = '$this->userId' $stringCondition ");
        }
    }


    // Saved view 
    public function savedView() 
    {
        if ($this->access->attributeEmpty(['id', 'type'])) 
        {
            $idValue = $_POST['id'];
            $type = $_POST['type'];
            $table = ( $type == "post" ) ? "ug_new_feeds" : "ug_power_point";
            
            $viewPresent = $this->access->MyModelsCrud->getRaw("SELECT view FROM $table WHERE id = '$idValue'");
            $viewIncrease = $viewPresent[0]['view'] + 1;

            $data = [
                'view' => $viewIncrease
            ];
            
            $query = $this->access->MyModelsCrud->update($table, $data, "id = '$idValue'");
            if (!$query) 
                $this->error = 'Xảy ra lỗi, thử lại sau!';
        }
    }

    public function countService() 
    {
        $userId = $this->access->accessUserId();

        $query = $this->access->MyModelsOther->getRows("SELECT * FROM ug_service 
        WHERE userId = '$userId' AND status = 'PD'");
        if ( $query > 5 ) 
            $this->error = 'Bạn đang có quá 5 yêu cầu phê duyệt!';
    }

    public function revertService() 
    {
        if ($this->access->attributeEmpty(['id'])) 
        {
            $idValue = $_POST['id'];

            $check = $this->access->MyModelsCrud->getRaw("SELECT * FROM ug_service 
            WHERE status = 'PD' ");

            if ( !empty( $check ) ) 
            {
                $query = $this->access->MyModelsCrud->remove("ug_service", "id_trade = '$idValue'");
                if ( !$query ) 
                    $this->error = 'Lỗi xảy ra, không thể thực hiện!';
            }
        }
    }

    public function getdataAction()
    {
        if ($this->access->attributeEmpty(['id'])) 
        {
            $query = $this->access->MyModelsCrud->getRaw(" 
            SELECT ug_new_feeds.*,
                (CASE WHEN ug_new_feeds.topic = 'service' 
                        THEN (SELECT COUNT(*) 
                            FROM ug_service 
                            WHERE ug_new_feeds.id = ug_service.id_trade)
                        ELSE NULL
                    END) AS total
            FROM 
                ug_new_feeds
            LEFT JOIN 
                ug_service ON ug_new_feeds.id = ug_service.id_trade
            WHERE 
                ug_new_feeds.userId = '$this->userId'
            ORDER BY 
                ug_new_feeds.id DESC;
            ");
            $this->response = $query;
            if ( empty( $query ) ) {
                exit(0);
            }
            else if ( !$query )  
                $this->error = 'Lỗi xảy ra, không thể thực hiện!';
        }
    }

    public function removeAction() 
    {
        if ($this->access->attributeEmpty(['id'])) 
        {
            $idValue = $_POST['id'];
            // Remove request service relate to
            $query = $this->access->MyModelsCrud->remove("ug_service", " id_trade = '$idValue' ");
            
            if ( $query ) 
                $this->access->MyModelsCrud->remove("ug_new_feeds", " id = '$idValue' "); 
        }
    }

    public function confirmAction() 
    {   
        if ($this->access->attributeEmpty(['id', 'userId'])) 
        {
            $idTrade = $_POST['id'];
            $userId = $_POST['userId'];
            $data = [
                'status' => 'XN'
            ];
            // Update data service
            $querySv = $this->access->MyModelsCrud->update(" ug_service ", $data, " id_trade = '$idTrade' 
            AND userId = '$userId' ");
            // Update data new feeds
            $queryNf = $this->access->MyModelsCrud->update(" ug_new_feeds ", $data, " id = '$idTrade' ");
            
            if ( !$querySv && !$queryNf ) 
                $this->error = 'Lỗi xảy ra, không thể thực hiện!';
        }
    }

}

class definePowerpointAction extends General {
    private $handle; 
    private $method;
    private $access;

    public function __construct() 
    {
        $this->access = new General;
        $this->handle = new HandleActionInteract();
        $this->performDetermination();
    }

    public function performDetermination()
    {
        if ( $this->access->attributeEmpty( ['class'] ) )
        {
            $this->method = $_POST['class'];

            switch ( $this->method )
            {
                case 'ugcollection':
                    $this->handle->actionAuthentication('ug_collection_post');
                    $this->access->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                case 'uglike':
                    $this->handle->actionAuthentication('ug_like_post');
                    $this->access->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                // Get data Favourites 
                case 'getdatafavourite':
                    $this->handle->getDataProfile( 'favourite' );
                    break;

                case 'authorposts':
                    $this->handle->getDataProfile( 'author' );
                    break;
                
                // handle data Archive
                case 'removearchive':
                    $this->handle->removeArchive();
                    break; 

                case 'newpost':
                    $this->handle->firstDate();
                    break;
                    
                case 'firstdate':
                    $this->handle->firstDate();
                    break;

                case 'oldestdate':
                    $this->handle->oldestdate();
                    break;

                case 'hascollection':
                    $this->handle->hascollection();
                    break;

                case 'haslike':
                    $this->handle->haslike();
                    break;
   
                case 'searcharchive':
                    $this->handle->searcharchive();
                    break;

                case 'follower':
                    $this->handle->actionFollow();
                    break;
                    
                case 'comment':
                    $this->handle->interactWithComment('comment');
                    break;

                case 'respond':
                    $this->handle->interactWithComment('respond');
                    break;

                case 'removecomment':
                    $this->handle->removeComment();
                    break;

                case 'pagination':
                    $this->handle->paginationAl();
                    break;

                case 'removeprofile':
                    $this->handle->removeProfile();
                    break;

                case 'arrangepost':
                    $this->handle->arrangePost();
                    break;

                // Saved View 
                case 'savedviewpost':
                    $this->handle->savedView();
                    break;

                // Check count service 
                case 'countservice':
                    $this->handle->countService();
                    break;

                case 'revertservice':
                    $this->handle->revertService();
                    break;  
                    
                case 'GetDataAction':
                    $this->handle->getdataAction();
                    break;  

                case 'removeaction':
                    $this->handle->removeAction();
                    break;   
                    
                    
                case 'f':
                    $this->handle->confirmAction();
                    break;   

                default: break;
            }
            $this->access->sendJsonResponse( $this->handle->response, $this->handle->error );
        }
    }
}

$handle = new definePowerpointAction();
