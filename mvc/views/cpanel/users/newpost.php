<?php 
    $statusLogin = new showInfo();
    
    if(!empty( $dataSql['checkType'])) 
    {
        $checkUgType = $dataSql['checkType'];
    }
?>
<main>
    <div class="container">
        <div class="block"></div>
    </div>
    <div class="container-create">
        <form action="" method="POST" enctype="multipart/form-data">
            <input autofocus type="text" name="title" placeholder="Tiêu đề" required="">
            <div class="topic flex">
                <span> Thể loại: </span>
                <div class="flex wrapper-topic">
                    <label>
                        <input type="radio" name="topic" class="post" id="np-post" checked>
                        <span> Bài viết </span>
                    </label>
                    <label>
                        <input type="radio" name="topic" class="service" id="np-service">
                        <span> Dịch vụ </span>
                    </label>
                </div>
            </div>
            <textarea id="editor"></textarea>
            <div class="wrapper flex flex-alicenter">
                <?php if( $statusLogin->getStatus() ) : ?>
                    <?php if( $checkUgType[0]['ug_type'] > 0 ) : ?>
                    <div class="type flex">
                        <span> Đăng nên thông báo </span>
                        <input class="tgl tgl-ios" id="new-feed" type="checkbox"/>
                        <label class="tgl-btn" for="new-feed"></label>
                    </div>
                    <?php endif; ?>
                    <button id="btn-render"> Xuất bản </button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</main>
