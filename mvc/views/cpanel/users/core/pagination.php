<?php
    class Pagination extends General {
        private $access;
        public function __construct()
        {
            $this->access = new General;
        }

        public function accessGetId()
        {
            return $this->access->accessGetUserId( 'page' );
        }

        public function getPagePowerpoints() 
        {
            return $this->handlePage( $this->totalNumberPagePowerpoints());
        }

        public function totalNumberPagePowerpoints()
        {
            return $this->access->totalMaxPage();
        }
    }

    $handle = new Pagination();
    // Settings

    switch ( $typePagination ) {
        case 'powerpoints': 
            // All file powerpoints on website 
            $totalMaxPage = $handle->totalNumberPagePowerpoints();
            $page = $handle->getPagePowerpoints();
        break;

        default: echo _on_error ; break;
    }
?>
<?php if ( $totalMaxPage > 0 ) : ?>
<div class="pagination-wrapper" data-page="<?= $page ?>">
    <div class="pagination_page" data-max="<?= $totalMaxPage ?>">
        <button data-page="<?= $page - 1 ?>" href="#" class="item-page-site pageItem-prev <?= ( $page == 1 ) ? 'blur' : '' ?>" <?= ( $page == 1 ) ? 'disabled' : '' ?>>
            <i class="fa-solid fa-angles-left"></i>
        </button>

        <div class="list-paginations">
            <?php 
            $pageStart = max( 1, $page - 3 );
            $pageEnd = min( $page + 8, $totalMaxPage );

            $diff = _NUMBER_PAGINATION - ( $pageEnd - $pageStart + 1 );
            $pageStart = max( 1, $pageStart - $diff );

            if ($pageStart <= 1) {
                $pageStart = 1;
                $pageEnd = min(_NUMBER_PAGINATION , $totalMaxPage);
            }

            if ($pageEnd > $totalMaxPage) {
                $pageStart -= ($pageEnd - $totalMaxPage);
                $pageEnd = $totalMaxPage;
            }

            for ( $index = $pageStart; $index <= $pageEnd; ++$index ):
            ?>
                <a data-page="<?= $index ?>" href="#" class="item-page-site pageItem-number <?= ( $index == $page ) ? 'pageAt' : '' ?>">
                    <span><?= $index ?></span>
                </a>
            <?php endfor; ?>
        </div>

        <button data-page="<?= $page + 1 ?>" href="#" class="item-page-site pageItem-next <?= ( $page == $totalMaxPage ) ? 'blur' : '' ?>" <?= ( $page == $totalMaxPage ) ? 'disabled' : '' ?>>
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>
</div>
<?php else : ?>
    <div class="product-lists">
        <div class="no-posts-yet">
            <div class="poster">
            <img 
            src="<?= _TEMPLATE . 'images/icons/no-value.png' ?>" width="90">
        </div>
            <span>Không có kết quả nào phù hợp</span>
        </div>
    </div>
<?php endif; ?>