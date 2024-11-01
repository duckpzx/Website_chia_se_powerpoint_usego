<?php 
    class Comment extends General {
        private $access;

        public function __construct()
        {
            $this->access = new General;
        }

        public function accessGetId()
        {
            return $this->access->accessGetUserId( 'page' );
        }

        public function dataComment() 
        {
            return $this->access->getDataComment( 'top' );
        }

        public function respondComment() 
        {
            return $this->access->getDataRespond();
        }

        public function dataMyUser() {
            $userId = $this->access->accessUserId();
            if ( $userId > 0 ) 
            {
                return $this->access->MyModelsCrud->getRaw(" SELECT ug_users.id, 
                ug_users.firstName, ug_users.lastName, ug_users.avatar, ug_users.ug_type
                FROM ug_users WHERE id = '$userId' ");
            }
        }
    }

    $handle = new Comment();

    // Data user 
    $dataInfoUser = $handle->dataMyUser();

    // Data comment 
    $dataComments = $handle->dataComment();

    // Data feedback 
    $dataRespondComment = $handle->respondComment();

    $statusLogin = new showInfo();
?>

<div class="comment-block">
<?php if( $statusLogin->getStatus() ) : ?>
    <div class="item-wrap">
        <div class="talk-ask">
            <div class="form-item">
                <i class="avata">
                    <img class="avt-zoom" 
                    src="<?= _TEMPLATE . 'images/uploads/avatar/' . showInfo::setAvatar( $dataInfoUser, 0 ); ?>" 
                    width="40">
                </i>
            </div>
            <section class="wrapper-comment">
                <form method="POST" class="form-actions">
                    <textarea 
                    name="box-comment"
                    class="comment-text"
                    placeholder="Viết bình luận..."
                    placeholder="" 
                    required=""
                    rows="1"></textarea>
                    <div class="form-send">
                        <button class="b-send btn-send-talk" id="btn-send-detail" disabled>
                            <span>Bình luận</span>
                        </button>
                    </div>
                </form>
            </section>
        </div>
            <!-- Loading -->
            <div class="loading-wrapper">
                <img 
                src="<?= _TEMPLATE . 'images/icons/circle-Loading.gif' ?>" width="70">
            </div>
        </div>
        <?php endif;  ?>
    <div class="show-comments"
    data-id="<?= $dataInfoUser[0]['id'] ?>"
    data-template="<?= _TEMPLATE . '/images/uploads/avatar/' ?>">
    <?php if ( !empty( $dataComments ) ) : ?>
        <?php foreach ( $dataComments as $comment ) : ?>
            <div class="item-wrap talk-feedback" data-id_cmt="<?php if (!empty( $comment['id_cmt'] )) echo $comment['id_cmt']; ?>">
                <div class="talk-ask">
                    <div class="form-item">
                        <a href="/usego/profile/?id=<?php if (!empty( $comment['userId'] )) echo $comment['userId']; ?>">
                            <i class="avata">
                                <img src="<?= _TEMPLATE . 'images/uploads/avatar/' ?><?php if (!empty( $comment['avatar'] )) echo $comment['avatar']; ?>">
                            </i>
                        </a>
                    </div>
                    <section class="general-settings">
                        <div class="item-main">
                            <div class="item-title-wrap">
                                <h3>
                                    <span><?= showInfo::setFullName( $comment, 'no_key' ); ?></span>
                                    <?php if ( !empty($comment['ug_type']) && $comment['ug_type'] === 1 ) : ?>
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="item-entry">
                                <span><?php if (!empty( $comment['content'] )) echo $comment['content']; ?></span>
                            </div>
                        </div>
                        <div class="meta">
                            <div class="time">
                                <span></span>
                            </div>        
                            <div class="feedback">
                            <?php
                            $hasComment = 0; 
                            if (!empty( $dataRespondComment )) {
                                foreach ( $dataRespondComment as $feedback ) {
                                    if ( $feedback['id_cmt'] === $comment['id_cmt'] ) {
                                        $hasComment++;
                                    }
                                }
                            }
                            ?>
                            <?php echo ( $hasComment > 0 ) ? '<span>Xem ' . $hasComment . ' bình luận khác</span>' : '<span>Phản hồi</span>'  ?>
                            </div>
                            <?php if (!empty( $dataInfoUser )) : ?>
                                <?php if ( $dataInfoUser[0]['id'] === $comment['id'] ) : ?>
                                <div class="options">
                                    <i class="fa-solid fa-ellipsis"></i>
                                    <ul class="module-comment module-buttons">
                                        <li class="remove" data-id_cmt="<?php if (!empty( $comment['id_cmt'] )) echo $comment['id_cmt']; ?>">
                                            <span>
                                                ❌ Xóa bình luận
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <section class="container-feedbacks" 
                        data-id_cmt="<?php if (!empty( $comment['id_cmt'] )) echo $comment['id_cmt']; ?>">
                            <?php if( $statusLogin->getStatus() ) : ?>
                                <form method="POST" class="form-actions form-feedback">
                                    <textarea 
                                    name="feedback-comment" 
                                    class="comment-text" 
                                    placeholder="Phản hồi..." 
                                    required=""
                                    rows="1"></textarea>
                                    <div class="form-send">
                                        <button class="b-send b-send-feedback" disabled="" 
                                        data-id_cmt="<?php if (!empty( $comment['id_cmt'] )) echo $comment['id_cmt']; ?>">
                                            <span>Phản hồi</span>
                                        </button>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if (!empty( $dataRespondComment )) : ?>
                                <?php foreach ( $dataRespondComment as $feedback ) : ?>
                                    <?php if ( $comment['id_cmt'] === $feedback['id_cmt'] ) : ?>
                                    <div class="talk-ask">
                                        <div class="form-item">
                                            <a href="/usego/profile/?id=<?php if (!empty( $feedback['id'] )) ?>">
                                                <i class="avata">
                                                    <img src="<?= _TEMPLATE . 'images/uploads/avatar/' ?><?php if (!empty( $feedback['avatar'] )) echo $feedback['avatar']; ?>">
                                                </i>
                                            </a>
                                        </div>
                                        <section class="general-settings general-comments">
                                            <div class="item-main">
                                                <div class="item-title-wrap">
                                                    <h3>
                                                        <span><?= showInfo::setFullName($feedback, 'no_key'); ?></span>
                                                        <?php if ( !empty($feedback['ug_type']) && $feedback['ug_type'] === 1 ) : ?>
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                                        <?php endif; ?>
                                                    </h3>
                                                </div>
                                                <div class="item-entry">
                                                    <span><?php if (!empty( $feedback['content'] )) echo $feedback['content']; ?></span>
                                                </div>
                                            </div>
                                            <div class="meta">
                                                <div class="time">
                                                    <span></span>
                                                </div>           
                                                <?php if (!empty( $dataInfoUser )) : ?>
                                                <?php if ( $dataInfoUser[0]['id'] === $feedback['userId'] ) : ?>
                                                    <div class="options">
                                                        <i class="fa-solid fa-ellipsis"></i>
                                                        <ul class="module-comment module-buttons">
                                                            <li class="remove" data-id="<?php if (!empty( $feedback['id'] )) echo $feedback['id']; ?>">
                                                            <span>
                                                                ❌ Xóa bình luận
                                                            </span>
                                                            </li>
                                                        </ul>
                                                    </div>  
                                                <?php endif; ?>
                                                <?php endif; ?>          
                                            </div>
                                        </section>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </section>
                    </section>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>