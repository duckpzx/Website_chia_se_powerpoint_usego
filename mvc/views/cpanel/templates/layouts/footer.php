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
        <div class="modal-newfeed-pad" data-template="<?= _TEMPLATE ?>">
            <header>
                <div class="title">
                    <h4></h4>
                </div>
                <button class="close-new-feed">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </header>
            <div class="newfeed-new-item">
                
            </div>
        </div>
    </div>
    <div class="modal-overlay"></div>
<script src="<?= _TEMPLATE . 'js/root.js?v=' . time(); ?>"></script>
<script src="<?= _TEMPLATE . 'js/layouts/header.js?v=' . time(); ?>"></script>
<script src="<?= _TEMPLATE . 'js/layouts/footer.js?v=' . time(); ?>"></script>
<?php if (!empty($dataUsego['editor'])): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.6/js/froala_editor.pkgd.min.js" integrity="sha512-BxHHbAsRj+g+qXQHsHQr+4PCppQuM1bt9MPLVRBrkILyIesbKD48O+vX8dt6r5R9x0roCnJzU/LFmqS4q/Tqgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php endif; ?>
<?php if (!empty($dataUsego['comment'])): ?>
<script src="<?= _TEMPLATE ?>"></script>
<?php endif; ?>
<?php if (!empty($dataUsego['swiper'])): ?>
<script src="<?= _TEMPLATE . 'libary/swiper/node_modules/swiper/swiper-bundle.min.js' ?>"></script>
<?php endif; ?>
<?php 
function loadJs($dataUsego, $template) {
    $jsFiles = [
        'js' => !empty($dataUsego['js']) ? $dataUsego['js'] : null,
        '_lite' => !empty($dataUsego['_lite']['_js']) ? $dataUsego['_lite']['_js'] : null,
        'jszip' => !empty($dataUsego['jszip']) ? true : false
    ];

    foreach ($jsFiles as $key => $file) {
        if ($key === 'js' && is_array($file)) {
            foreach ($file as $item) {
                echo '<script src="' . $template . 'js/' . $item . '.js?v=' . time() . '"></script>';
            }
        } elseif ($key === 'js' && !is_array($file)) {
            echo '<script src="' . $template . 'js/views/' . $file . '.js?v=' . time() . '"></script>';
        } elseif ($key === '_lite' && $file) {
            echo '<script src="' . $template . 'js/views/' . $file . '.js?v=' . time() . '"></script>';
        } elseif ($key === 'jszip' && $file) {
            echo '<script src="' . $template . 'libary/zip/node_modules/jszip/dist/jszip.min.js"></script>';
        }
    }
}

loadJs($dataUsego, _TEMPLATE); 
?>
<script src="<?= _TEMPLATE . 'libary/node_modules/lazysizes/lazysizes.min.js' ?>"></script>
<script src="<?= _TEMPLATE ?>libary/cute-alert/cute-alert.js"></script>
<script src="<?= _TEMPLATE . 'libary/xdialog/xdialog.js' ?>"></script>
</footer>
</body>
</html>
