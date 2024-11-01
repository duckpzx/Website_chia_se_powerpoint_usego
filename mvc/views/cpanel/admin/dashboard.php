<?php 
    $getActionParams = new App();
    $arrayCrumbs = $getActionParams->urlProcess();

    $arrayData = [
        [
            'title' => 'home',
            'param' => 'statistics',
            'name' => 'Tổng hợp số liệu',
            'icon' => '',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-app-window" width="1.3rem" height="1.3rem" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="M6 8h.01"></path><path d="M9 8h.01"></path></svg>'
        ],
        [
            'param' => 'requesttrade',
            'name' => 'Yêu cầu giao dịch',
            'icon' => '',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="1.3rem" height="1.3rem" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline><line x1="12" y1="12" x2="20" y2="7.5"></line><line x1="12" y1="12" x2="12" y2="21"></line><line x1="12" y1="12" x2="4" y2="7.5"></line><line x1="16" y1="5.25" x2="8" y2="9.75"></line></svg>'
        ],

        [
            'title' => 'app',
            'param' => 'powerpoint',
            'name' => 'File thuyết trình',
            'icon' => '',
            'select' => [
                'managefile' => 'Quản lý File',
                'managephoto' => 'Quản lý ảnh File',
            ],
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout" width="1.3rem" height="1.3rem" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="4" width="6" height="5" rx="2"></rect><rect x="4" y="13" width="6" height="7" rx="2"></rect><rect x="14" y="4" width="6" height="16" rx="2"></rect></svg>'
        ],
        [
            'param' => 'requestpost',
            'name' => 'Yêu cầu dịch vụ',
            'icon' => '',
            'select' => [
                'fileservice' => 'File dịch vụ',
                'photoservice' => 'Ảnh File dịch vụ'
            ],
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box-multiple" width="1.3rem" height="1.3rem" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="7" y="3" width="14" height="14" rx="2"></rect><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2"></path></svg>'
        ],
        [
            'param' => 'postservice',
            'name' => 'Bài viết dịch vụ',
            'icon' => '',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-donut-3" width="1.3rem" height="1.3rem" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3v5m4 4h5"></path><path d="M8.929 14.582l-3.429 2.918"></path><circle cx="12" cy="12" r="4"></circle><circle cx="12" cy="12" r="9"></circle></svg>'
        ],
        [
            'param' => 'usermanage',
            'name' => 'Quản trị thành viên',
            'icon' => '',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="1.3rem" height="1.3rem" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><circle cx="12" cy="10" r="3"></circle><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path></svg>'
        ],
    ];

    $param = 'statistics';
    if (!empty( $arrayCrumbs[1] ) )
    {
        $param = $arrayCrumbs[1];
    } 
?>

<div class="dashboard-lists">
    <ul class="lists-dashboard">
        <?php if (!empty( $arrayData )) : ?>
        <?php foreach( $arrayData as $item ) : ?>
        <?php if (!empty( $item['title'] )) : ?>
        <div class="title">
            <span> <?= $item['title'] ?> </span>
        </div>
        <?php endif; ?>
        <li class="item-dashboard"> 
        <?php if (!empty($item['select'])): ?>
            <button class="btn-dashboard <?php if ($param == $item['param']) echo 'active'; ?>">
                <div class="des-main">
                    <?php if (!empty($item['svg'])): ?>
                        <?= $item['svg'] ?>
                    <?php endif; ?>  
                    <span> <?= $item['name'] ?> </span>
                </div>
                <i class="fa-solid fa-angle-down"></i>
            </button>
        <?php else: ?>
            <a href="/usego/admin/<?php if (!empty($item['param'])) echo $item['param']; ?>" 
                class="btn-dashboard <?php if ($param == $item['param']) echo 'active'; ?>">
                <div class="des-main">
                    <?php if (!empty($item['svg'])): ?>
                        <?= $item['svg'] ?>
                    <?php endif; ?>  
                    <span> <?= $item['name'] ?> </span>
                </div>
            </a>
        <?php endif; ?>
            <ul>
                <?php if (!empty( $item['select'] )) : ?>
                <?php foreach( $item['select'] as $key => $value ) : ?>
                <li>
                    <a href="/usego/admin/<?php if (!empty($item['param'])) echo $item['param']; ?>/<?php if (!empty($key)) echo $key; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="4"></circle></svg>
                        <span> <?= $value ?> </span>
                    </a>
                </li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>