<?php 
    // Getdata Action Params 
    $getActionParams = new App();

    $arrayCrumbs = $getActionParams->urlProcess();

    $param = 'statistics';
    if (!empty( $arrayCrumbs[1] ) )
    {
        $param = $arrayCrumbs[1];
    } 
?>
<main>
    <div class="container">
    <div class="block"></div>
        <div class="dashboard-wrapper">
            <div class="dashboard-left">
                <?php require_once 'dashboard.php'; ?>
            </div>
            <div class="dashboard-right">
                <?php 
                    switch( $param ) 
                    {
                        case 'statistics':
                            require_once(__DIR__ . '/statistics.php');
                        break;

                        case 'managefile':
                            require_once 'dashboard.php';
                        break;

                        case 'managephoto':
                            require_once 'dashboard.php';
                        break;

                        case 'requesttrade':
                            require_once 'dashboard.php';
                        break;

                        case 'fileservice':
                            require_once 'dashboard.php';
                        break;

                        case 'photoservice':
                            require_once 'dashboard.php';
                        break;
                    }
                ?>
            </div>
        </div>
    </div>
</main>