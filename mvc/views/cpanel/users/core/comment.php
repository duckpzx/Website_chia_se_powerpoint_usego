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
                                            <svg class="module-svg" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                                                <path d="m22.242,5.272l-3.515-3.515c-1.133-1.133-2.64-1.757-4.242-1.757h-4.971c-1.602,0-3.109.624-4.243,1.757l-3.515,3.515c-1.133,1.134-1.757,2.641-1.757,4.243v4.971c0,1.602.624,3.109,1.757,4.243l3.515,3.515c1.134,1.133,2.641,1.757,4.243,1.757h4.971c1.603,0,3.109-.624,4.242-1.757l3.515-3.514c1.134-1.133,1.758-2.64,1.758-4.243v-4.971c0-1.603-.624-3.11-1.758-4.243Zm-.242,9.213c0,1.069-.416,2.073-1.172,2.829l-3.515,3.515c-.756.755-1.76,1.171-2.828,1.171h-4.971c-1.068,0-2.073-.416-2.829-1.171l-3.514-3.515c-.756-.756-1.172-1.76-1.172-2.829v-4.971c0-1.068.416-2.073,1.171-2.829l3.515-3.514c.756-.756,1.76-1.172,2.829-1.172h4.971c1.068,0,2.072.416,2.828,1.171l3.515,3.515c.756.755,1.172,1.759,1.172,2.828v4.971Zm-5.561-5.511l-3.043,3.043,3.043,3.043c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-3.043-3.043-3.043,3.043c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l3.043-3.043-3.043-3.043c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l3.043,3.043,3.043-3.043c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414Z"/>
                                            </svg>
                                            <span>
                                                Xóa bình luận
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
                                                            <svg class="module-svg" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                                                                <path d="m22.242,5.272l-3.515-3.515c-1.133-1.133-2.64-1.757-4.242-1.757h-4.971c-1.602,0-3.109.624-4.243,1.757l-3.515,3.515c-1.133,1.134-1.757,2.641-1.757,4.243v4.971c0,1.602.624,3.109,1.757,4.243l3.515,3.515c1.134,1.133,2.641,1.757,4.243,1.757h4.971c1.603,0,3.109-.624,4.242-1.757l3.515-3.514c1.134-1.133,1.758-2.64,1.758-4.243v-4.971c0-1.603-.624-3.11-1.758-4.243Zm-.242,9.213c0,1.069-.416,2.073-1.172,2.829l-3.515,3.515c-.756.755-1.76,1.171-2.828,1.171h-4.971c-1.068,0-2.073-.416-2.829-1.171l-3.514-3.515c-.756-.756-1.172-1.76-1.172-2.829v-4.971c0-1.068.416-2.073,1.171-2.829l3.515-3.514c.756-.756,1.76-1.172,2.829-1.172h4.971c1.068,0,2.072.416,2.828,1.171l3.515,3.515c.756.755,1.172,1.759,1.172,2.828v4.971Zm-5.561-5.511l-3.043,3.043,3.043,3.043c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-3.043-3.043-3.043,3.043c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l3.043-3.043-3.043-3.043c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l3.043,3.043,3.043-3.043c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414Z"/>
                                                            </svg>
                                                            <span>
                                                                Xóa bình luận
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