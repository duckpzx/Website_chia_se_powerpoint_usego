<?php
    require_once (__DIR__  . "/Shared/General.php"); 
    require_once (__DIR__  . "/Request.php");

class HandleProposals extends General {
    private $idPost, $userId, $keyWords, $valueSearch;
    private $data;
    
    public $error, $response;
    private $access;

    public function __construct()
    {
        $this->access = new General;
        $this->userId = $this->access->accessUserId();
    }
 
    public function suggestDetail() 
    {
        if( $this->access->attributeEmpty( [ 'keywords', 'id' ] ) )
        {
            $this->idPost = $_POST ['id'];
            $this->keyWords = $_POST ['keywords'];
            $arrayKeyWords = explode( '|', $this->keyWords );
            // Transmit separated data
            $this->getDetailSuggestionData( $arrayKeyWords );
        }
    }

    private function getDetailSuggestionData( $arrayKey )
    {
        $stringConcatenation = "";
        $count = count( $arrayKey );
        foreach ( $arrayKey as $index => $key ) 
        {
            $stringConcatenation .= " title LIKE '%$key%' OR tags LIKE '%$key%' ";
            if ( $index < $count - 1 ) {
                $stringConcatenation .= " OR ";
            }
        }
        // Get all records that contain the keyword and have an id different from the current id
        $this->response = $this->access->MyModelsCrud->getRaw(" SELECT 
            ug_power_point.id, 
            ug_power_point.title, 
            ug_power_point.images, 
            COUNT(ug_like_post.id) AS total_like
        FROM    
            ug_power_point 
        LEFT JOIN 
            ug_like_post ON ug_power_point.id = ug_like_post.id_onwser
        WHERE 
            ug_power_point.id != '$this->idPost' AND ( $stringConcatenation )
        GROUP BY 
            ug_power_point.id
        ORDER BY 
            total_like DESC
        LIMIT 3 ");
    }

    // Get information from search keywords
    public function getDataSearchTips( $tableName ) 
    {
        if( !empty( $_POST ))
        {
            $this->valueSearch = $_POST ['valuesearch'];

            if ( $tableName === 'ug_power_point' ) 
            {
                $query = $this->access->MyModelsCrud->getRaw(" SELECT 
                ug_power_point.*, 
                (SELECT COUNT(*) FROM ug_like_post WHERE ug_like_post.id_onwser = ug_power_point.id) AS like_count,
                (SELECT COUNT(*) FROM ug_comment WHERE ug_comment.idPost = ug_power_point.id) AS comment_count,
                (SELECT COUNT(*) FROM ug_respond_comment WHERE ug_respond_comment.idPost = ug_power_point.id) AS respond_count
                FROM ug_users 
                INNER JOIN ug_power_point ON ug_users.id = ug_power_point.userId
                WHERE ug_power_point.title LIKE '%$this->valueSearch%' OR ug_power_point.tags LIKE '%$this->valueSearch%'
                GROUP BY ug_power_point.id
                ORDER BY ug_power_point.id ");
            } else {
                $query = $this->access->MyModelsCrud->getRaw(" SELECT * FROM $tableName 
                WHERE title LIKE '%$this->valueSearch%' OR content LIKE '%$this->valueSearch%' 
                ORDER BY id ");
            }
            $this->response = ( $query ) ? $query : null;
        }
    }
}

class definesProposetAction extends General {
    private $handle; 
    private $method;
    private $access;

    public function __construct() 
    {
        $this->access = new General;
        $this->handle = new HandleProposals();
        $this->performDetermination();
    }

    public function performDetermination()
    {
        if ( $this->access->attributeEmpty( ['class'] ) )
        { 
            $this->method = $_POST['class'];

            switch ( $this->method )
            {
                // sheck email existence
                case 'suggestposts':
                    $this->handle->suggestDetail();
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                case 'searchtips':
                    $this->handle->getDataSearchTips('ug_power_point');
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                case 'searchkeyword':
                    $this->handle->getDataSearchTips('ug_new_feeds');
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;
            }
        }
    }
}

$handle = new definesProposetAction();
