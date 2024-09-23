<?php 
    class General extends Controller {
        public $MyModelsCrud, $MyModelsOther = null;

        public function __construct() 
        {
            $this->MyModelsCrud = $this->models('MyModelsCrud');
            $this->MyModelsOther = $this->models('MyModelsOther');
        }

        public function accessUserId() 
        {
            $status = new isLogin();
            if($status->checkLogin())
            {
                $userId = $status->checkLogin();
                return $userId['userId'];
            }
            return -1;
        }

        public function accessGetUserId( $param )
        {
            if(Request::isGet()) 
            {
                $body = Request::getBody();
                return (!empty( $body[ $param ] )) ? $body[ $param ] : null;
            }
        }

        public function getValueParams()
        {
            $redirect = $_SERVER['REDIRECT_URL'];
            $pathRedirect = explode('/', $redirect);
            if (!empty($pathRedirect[3])) 
            {
                $topicSerarch = $pathRedirect[3];
                return str_replace('-', ' ', $topicSerarch);
            }
        }


        // Pagination Functions 
        public function calculateaPagination() 
        {
            $totalNumberPage = $this->totalMaxPage();
            // Check exits
            if (!empty( $totalNumberPage ) || $totalNumberPage > 0) 
            {   
                $idPost = $this->handlePage( $totalNumberPage );

                return ( $idPost - 1 ) * _MAXIMUM_PAGE;
            } else {
                return 0;
            }
        }

        public function totalMaxPage()
        {
            $topicSerarch = $this->getValueParams();
            $totalNumberRecord = $this->MyModelsOther->getRows(" SELECT * FROM 
            ug_power_point WHERE title LIKE '%$topicSerarch%' OR tags LIKE '%$topicSerarch%' ");
            $toltalNumberOn1Page = _MAXIMUM_PAGE;
            return ceil( $totalNumberRecord / $toltalNumberOn1Page );
        }

        public function handlePage( $totalNumberPage ) 
        {
            $idPost = ( !empty($this->accessGetUserId( 'page' )) ) ? $this->accessGetUserId( 'page' ) : 1;
            if ( $idPost < 0 ) $idPost = 1;
            if ( $idPost > $totalNumberPage ) $idPost = $totalNumberPage; 

            return $idPost;
        }


        // Comment Functions 
        public function getDataComment( $type ) 
        {
            if (!empty( $this->accessGetUserId( 'id' ) ))
            {
                // Get id account owner
                $userId = $this->accessUserId();
                $condition = (!empty( $userId )) ?  "ug_comment.userId = '$userId'" : 'total_responds';
                if ( $type === 'top' ) 
                {
                    $idPost = $this->accessGetUserId( 'id' );
                    return $this->MyModelsCrud->getRaw
                    (" SELECT ug_users.id, ug_users.firstName, ug_users.lastName, ug_users.avatar,
                    ug_comment.*, COUNT( ug_respond_comment.id ) AS total_responds
                    FROM ug_users 
                    JOIN ug_comment ON ug_users.id = ug_comment.userId
                    LEFT JOIN ug_respond_comment ON ug_comment.id_cmt = ug_respond_comment.id_cmt
                    WHERE ug_comment.idPost = '$idPost'
                    GROUP BY ug_users.id, ug_comment.id_cmt
                    ORDER BY 
                    CASE 
                        WHEN $condition THEN 0 
                        ELSE 1 
                    END,
                    total_responds DESC,
                    createAt DESC ");

                } 
                else {
                    $idPost = $this->accessGetUserId( 'id' );
                    return $this->MyModelsCrud->getRaw(" SELECT * FROM ug_users, ug_comment 
                    WHERE idPost = '$idPost' AND ug_users.id = ug_comment.userId 
                    ORDER BY 
                    CASE 
                        WHEN ug_comment.userId = $userId THEN 0 
                        ELSE 1 
                    END,
                    ug_comment.createAt DESC ");
                }
            }
        }

        public function getDataRespond() 
        {
            if (!empty( $this->accessGetUserId( 'id' ) ))
            {
                $idPost = $this->accessGetUserId( 'id' );
                // Get id account owner

                return $this->MyModelsCrud->getRaw(" SELECT * FROM ug_users, ug_respond_comment 
                WHERE idPost = '$idPost' AND ug_users.id = ug_respond_comment.userId 
                ORDER BY ug_respond_comment.createAt ASC ");
            }
        }


        // Request handle Calljax check exitst properties
        public function attributeEmpty( $array )
        {
            foreach( $array as $key ) 
            {
                if ( !empty( $_POST[ $key ] ) ) 
                {
                    return true;
                }
            }
        }

        // Response send 
        public function sendJsonResponse( $response, $error )
        {
            if (!empty( $response ) || !empty( $error )) 
            {
                header('Content-Type: application/json');
                $properties = ( !empty( $error ) ) ? 'error' : 'data';
                $response = ( !empty( $error ) ) ? $error : $response;
                // Action response client 
                echo json_encode( [ $properties => $response ], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
    }
