<?php 
require_once(dirname(__DIR__)) . "/core/shared/General.php";

class Wallet extends General {
    private $access;
    private $userId;

    public function __construct() {
        $this->access = new General();
        $this->userId = $this->access->accessUserId();
    }

    public function index() {
        if ($this->userId === -1) { 
            $this->access->loadError404();
        }

        $this->view('masterlayout', [
            'page' => 'users/wallet',
            'resources' => $this->getResources(),
            'dataSql' => [
                'dataTrade' => $this->getDataTrade(),
                'totalTrade' => $this->totalTrade(),
                'totalAmount' => $this->totalAmount(),
            ], 
        ]);
    }

    private function getResources() {
        return [
            'title' => 'Usego - Tài sản của tôi',
            'css' => 'wallet',
            'js' => 'wallet',
        ];
    }

    private function getDataTrade() { 
        return $this->access->MyModelsCrud->getRaw("
            SELECT *,
                CASE 
                    WHEN trade_status = 'deposit' THEN 'Nạp tiền' 
                    WHEN trade_status = 'withdraw' THEN 'Rút tiền'
                    WHEN trade_status = 'payment_add' THEN 'Cộng tiền'
                    WHEN trade_status = 'payment_deduct' THEN 'Trừ tiền'
                    ELSE NULL 
                END AS trade_message,
                CASE 
                    WHEN status = 'HT' THEN 'Hoàn thành' 
                    WHEN status = 'TB' THEN 'Thất bại'
                    WHEN status = 'XL' THEN 'Đang xử lý' 
                    ELSE NULL 
                END AS status_message
            FROM 
                ug_trade 
            WHERE 
                userId = '$this->userId'
            ORDER BY 
                id DESC;
        ");
    }

    private function totalTrade() {
        return $this->access->MyModelsOther->getRows("
            SELECT * 
            FROM 
                ug_trade
            WHERE 
                userId = '$this->userId';
        ");
    }

    private function totalAmount() {
        return $this->access->MyModelsCrud->getRaw("
            SELECT 
                SUM(coin) as total
            FROM 
                ug_trade
            WHERE 
                userId = '$this->userId'
        ");
    }
}
