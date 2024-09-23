<?php require_once ("handle/footer.getData.php") ?>
<?php 
    // Get Data Top Keywords
    $showInfo = new showDataFooter(); 
    if(!empty( $showInfo->getAlertHot() )) :
    $dataAlertHot = $showInfo->getAlertHot();
    endif;
?>
<footer>
    <div class="container-footer">
            <div class="footer">
                <div class="footer-head">
                    <div class="content flex flex-alicenter flex-between">
                        <div class="text">
                        <h4>USEGO.COM TỐT NHẤT</h4>
                        <p>Được thành lập vào 09/2023 đến nay, là một nền tảng trao đổi 
                        tài liệu file thiết kế PowerPoint, Tất cả đều miễn phí  
                        </p>
                        </div>
                        <div class="img-frame">
                            <img class="ji-frame" src="<?= _TEMPLATE . 'images/icons/usego-ji.png' ?>" width="120">
                            <img class="hi-frame" src="<?= _TEMPLATE . 'images/icons/usego-hi.png' ?>" width="40">
                        </div>
                        <div class="fl_fanpage">
                            <a href="#"> Theo dõi</a>
                            <a href="#">Truy cập</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <ul class="lists-footer">
                    <li class="item-footer item-footer-1">
                        <span>Về chúng tôi</span>
                        <small>
                            Usego là một nền tảng thiết kế và chia sẽ các mẫu 
                            thiết kế, sáng tạo liên quan tới powerpoint các bài 
                            được chia sẻ công khai và hoàn toàn miễn phí, hãy
                            trải nghiệm hoặc đăng tải các bài viết của bạn! 
                        </small>
                    </li>
                    <li class="item-footer item-footer-2">
                        <ul>
                            <li>
                                <span>Phổ biến</span>
                                <a href="#">
                                    <small>Đặc biệt</small>
                                </a>
                                <a href="#">
                                    <small>Câu hỏi</small>
                                </a>
                                <a href="#">
                                    <small>Thiết kế</small>
                                </a>
                                <a href="#">
                                    <small>Hướng dẫn</small>
                                </a>
                                <a href="#">
                                    <small>Khoa học</small>
                                </a>
                            </li>
                            <li>
                                <span>Cảm hứng</span>
                                <a href="#">
                                    <small>Đề xuất</small>
                                </a>
                                <a href="#">
                                    <small>Mẫu công nghệ</small>
                                </a>
                                <a href="#">
                                    <small>Mẫu môi trường</small>
                                </a>
                                <a href="#">
                                    <small>Mẫu học đường</small>
                                </a>
                            </li>
                            <li>
                                <span>Hỗ trợ</span>
                                <a href="#">
                                    <small>Liên hệ</small>
                                </a>
                                <a href="#">
                                    <small>Tuyên bố</small>
                                </a>
                                <a href="#">
                                    <small>Ứng dụng</small>
                                </a>
                                <a href="#">
                                    <small>Nhận xét</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-footer item-footer-3">
                        <ul>
                            <li>
                                <a href="#"><i class="fa-brands fa-facebook"></i>
                                <small>Facebook</small>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-github"></i>
                                <small>Github</small>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-youtube"></i>
                                <small>Youtube</small>
                                </a>
                            </li>
                        </ul>
                        <div class="s-text">
                            <h1>USEGO</h1>
                            <small>Truyền thông mới của trang đang chờ bạn chú ý</small>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="footer-color"></div>
            <div class="footer-part-dropdown">
            <div class="footer-color-before">
            </div>
            <p class="condition">
                Tất cả dữ liệu, tài liệu trên trang web này đều được bảo vệ bởi Luật Bản quyền 
                và các quy định pháp luật có liên quan. Không tổ chức, cá nhân nào được xâm 
                phạm các quyền này. Người vi phạm sẽ phải chịu trách nhiệm về hành vi vi 
                phạm của công ty chúng tôi theo quy định của pháp luật. Chúng tôi xin tuyên bố. 
                Cố vấn pháp lý | © 2023 - <?php echo date('Y') ?>
            </p>
            <div class="footer-color-after"></div>
            </div>
    </div>
    <!-- Newfeed -->
    <div class="modal-content">
        <div class="modal-newfeed-pad">
            <header>
                <div class="title">
                    <h4>Usego - Tin mới</h4>
                </div>
                <button class="close-new-feed">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </header>
            <?php if (!empty( $dataAlertHot )) : ?>
                <?php foreach( $dataAlertHot as $item ) : ?>
                <div class="newfeed-new-item">
                    <div class="newfeed-content">
                        <div class="hastag-newfeed">
                            <span><span style="color: var(--main)">#</span> <?php if (!empty( $item['title'] )) echo $item['title']; ?></span>
                        </div>
                        <div class="describe-newfeed">
                            <span>
                            <?php if (!empty( $item['content'] )) echo $item['content']; ?>
                            </span>
                        </div>
                        <div class="poster-newfeed">
                            <a href="#">
                                <?php if (!empty( $item['image'] )) : ?>
                                    <img class="poster" src="" width="400">
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <footer>
                        <div class="auth-infomation">
                            <span>Đăng bởi</span>
                            <a href="#">
                                <strong>
                                    <p><?= showInfo::setFullName($item, 'no_key'); ?></p> 
                                    <i class="fa-solid fa-check"></i>
                                </strong>
                            </a>
                            <i class="dot">·</i>
                            <span>
                                <?php if (!empty( $item['createAt'] )) : ?>
                                    <?php showInfo::dateDiffInMinutes( $item['createAt'] ) ?>
                                <?php endif; ?>
                            </span>
                        </div>
                    </footer>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-overlay"></div>
    <div class="dialog-box">
        <div class="content-box">
            <div class="title-box"></div>
            <div class="des-box"></div>
        </div>
        <div class="button-box">
            <button id="btn-accpect-box">Đồng ý</button>
            <button id="btn-cancel-box">Hủy bỏ</button>
        </div>
    </div>
    <!-- File Javascript -->
    <script src="<?= _TEMPLATE . 'js/root.js' ?>"></script>
    <script src="<?= _TEMPLATE . 'js/layouts/header.js' ?>"></script>
    <script src="<?= _TEMPLATE . 'js/layouts/footer.js' ?>"></script>
    <?php if( !empty( $dataUsego['editor'] ) ) : ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.6/js/froala_editor.pkgd.min.js" integrity="sha512-BxHHbAsRj+g+qXQHsHQr+4PCppQuM1bt9MPLVRBrkILyIesbKD48O+vX8dt6r5R9x0roCnJzU/LFmqS4q/Tqgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php endif; ?>
    <?php if( !empty( $dataUsego['comment'] ) ) : ?>
    <script src="<?= _TEMPLATE ?>"></script>
    <?php endif; ?>
    <?php if( !empty( $dataUsego['swiper'] ) ) : ?>
    <script src="<?= _TEMPLATE . 'libary/swiper/node_modules/swiper/swiper-bundle.min.js' ?>"></script>
    <?php endif; ?>
    <?php if (!empty( $dataUsego['js'] )): ?>
        <?php if (is_array( $dataUsego['js'] )): ?>
            <?php foreach ( $dataUsego['js'] as $item ): ?>
                <script src="<?= _TEMPLATE . 'js/' . $item . '.js' ?>"></script>
            <?php endforeach; ?>
        <?php else: ?>
            <script src="<?= _TEMPLATE . 'js/views/' . $dataUsego['js'] . '.js' ?>"></script>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!empty( $dataUsego['_lite']['_js'] )): ?>
        <script src="<?= _TEMPLATE . 'js/views/' . $dataUsego['_lite']['_js'] . '.js' ?>"></script>
    <?php endif; ?>
    <script src="<?= _TEMPLATE . 'libary/node_modules/lazysizes/lazysizes.min.js' ?>"></script>
    <script src="<?= _TEMPLATE ?>libary/cute-alert/cute-alert.js"></script>
    <script src="<?= _TEMPLATE . 'libary/xdialog/xdialog.js' ?>"></script>
    <?php if( !empty( $dataUsego['jszip'] ) ) : ?>
    <script src="<?= _TEMPLATE ?>libary/zip/node_modules/jszip/dist/jszip.min.js"></script>
    <?php endif; ?>
</footer>
</body>
</html>