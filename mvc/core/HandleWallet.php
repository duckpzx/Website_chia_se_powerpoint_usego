<?php
    require_once (__DIR__  . "/Shared/General.php"); 
    require_once (__DIR__  . "/Request.php");

class HandleWallet extends General {
    private $userId;
    private $data;
    
    public $error, $response;
    private $access;

    private $dataTradeMark = ['U', 'S', 'E', 'G', 'O'];

    public function __construct()
    {
        $this->access = new General;
        $this->userId = $this->access->accessUserId();
    }
 
    public function prepareInfoDeposit() 
    {
        if( $this->access->attributeEmpty( [ 'coin' ] ) )
        {
            try {
                $Coin = $_POST['coin'];

                $randomKey = array_rand($this->dataTradeMark);
                $this->data = [
                    'full_name' => _TRADE_FULL_NAME,
                    'name_bank' => _TRADE_NAME_BANK,
                    'number_bank' => _TRADE_NUMBER_BANK,
                    'number_money' => $Coin,
                    'code_trade' => $this->access->generateCode($this->dataTradeMark[ $randomKey ])
                ];

                $this->response = $this->data;
            }
            catch( Exception $e ) {
                $this->error = _on_error;
            }
        }
    }

    public function handlePayment()
    {
        if ($this->access->attributeEmpty(['code_trade', 'coin', 'image_qr']))
        {
            $arrayData = [
                'code_trade' => $_POST['code_trade'],
                'coin' => $_POST['coin'],
                'image_qr' => $_POST['image_qr']
            ];

            $emailChecker = new EmailChecker(_IMAP_HOST_NAME, _IMAP_USER_NAME, _IMAP_PASS_WORD);
            $emailChecker->connect();
            $emailChecker->checkEmails();
            $emailChecker->closeConnection();
            $code = $emailChecker->getResult()['code'];
            if ( $code === 1 ) 
            {
                if ($this->saveDataTrade( $arrayData )) 
                
                $this->response = $emailChecker->getResult();
                // User deposit 
                $coinUser = $this->getCurrentBalance( null );
                $coinTrade = intval(str_replace('.', '', $arrayData['coin']));
                $this->updateUserBalance( 'deposit', $coinUser, $coinTrade, $this->userId);
            } 
            else {
                $this->error = $emailChecker->getResult();
            }
        }
    }

    private function saveDataTrade( $array ) 
    {
        $this->data = [
            'userId' => $this->userId,
            'id_onwser' => -1,
            'code_trade' => $array['code_trade'],
            'coin' => intval(str_replace('.', '', $array['coin'])),
            'trade_status' => 'deposit',
            'status' => 'HT',
            'image_qr' => $array['image_qr'],
            'createAt' => date('Y-m-d H:i:s')
        ];

        return $this->access->MyModelsCrud->insert('ug_trade', $this->data);
    }


    // Get total current balance 
    public function getCurrentBalance( $userId )
    {
        $userId = ( $userId !== null ) ? $userId : $this->userId;
        $presentCoin = $this->access->MyModelsCrud->getRaw("
            SELECT coin
            FROM ug_users
            WHERE id = '$userId'
        ");
        $getCoin = $presentCoin[0]['coin'];
        $presentCoin = intval(str_replace('.', '', $getCoin)) ?? 0;
        
        if ( $presentCoin ) 
        $this->response = $presentCoin;
        return $presentCoin;
    }

    private function updateUserBalance( $type, $presentCoin, $processCoin, $userId ) 
    {
        switch ( $type ) 
        {
            case 'deposit':
                $presentCoin += $processCoin;
                break;

            case 'withdraw':
                $presentCoin -= $processCoin;
                break;
        }

        $this->data = [
            'coin' => $presentCoin
        ];

        $query = $this->access->MyModelsCrud->update('ug_users', $this->data, "id = '$userId'");
        if ( $query ) return $presentCoin;
    }

    private function otherPayment() 
    {
        $totalPayment = $this->access->MyModelsOther->getRows("
            SELECT *
            FROM 
                ug_trade
            WHERE 
                userId = '$this->userId' AND 
                trade_status = 'withdraw' AND 
                status = 'XL'
        ");
        return ( $totalPayment === 0 ) ? 1 : 0;
    }

    private function createQrWithdraw($nameBank, $numberUser, $nameUser, $amount)
    {
        $api = "https://qr.ecaptcha.vn/api/generate/";
        $infomation = urlencode($nameBank) . '/' . urlencode($numberUser) . '/' . urlencode($nameUser) . "?amount=" . urlencode($amount);
        return $api . $infomation;
    }

    public function handleWithdraw()
    {
        if ($this->access->attributeEmpty(['coin', 'name_bank', 'number_bank', 'name_user']))
        {
            if ( $this->otherPayment() === 0 ) {
                $this->error = 'Đang có giao dịch khác, vui lòng chờ!';
            } 
            else {
                // Check payment other 
                $nameBank = $_POST['name_bank'];
                $numberUser = $_POST['number_bank'];
                $nameUser = $_POST['name_user'];
                $coin = $_POST['coin'];

                $randomKey = array_rand($this->dataTradeMark);
                $this->data = [
                    'userId' => $this->userId,
                    'id_onwser' => -1,
                    'code_trade' => $this->access->generateCode($this->dataTradeMark[ $randomKey ]),
                    'coin' => $coin,
                    'trade_status' => 'withdraw',
                    'status' => 'XL',
                    'image_qr' => $this->createQrWithdraw($nameBank, $numberUser, $nameUser, $coin),
                    'name_bank' => $nameBank,
                    'number_bank' => $numberUser,
                    'name_user' => $nameUser,
                    'createAt' => date('Y-m-d H:i:s')
                ];

                if ( $this->access->MyModelsCrud->insert( 'ug_trade', $this->data )) 
                {
                    $coinUser = $this->getCurrentBalance( null );
                    $query = $this->updateUserBalance( 'withdraw', $coinUser, $coin, $this->userId );
                    if ( $query ) $this->response = [ 'amount' => $query, 'message' => 'Yêu cầu rút tiền đã được gửi đi' ];
                }
            }
        }
    }

    public function historyPayment()
    {
        $this->response = $this->access->MyModelsCrud->getRaw("
            SELECT 
                DISTINCT TRIM(name_bank) AS name_bank, 
                TRIM(name_user) AS name_user, 
                TRIM(number_bank) AS number_bank
            FROM 
                ug_trade
            WHERE 
                userId = '$this->userId'AND 
                trade_status = 'withdraw'
                LIMIT 5;
        ");
    }

    public function acceptPayment()
    {
        if ($this->access->attributeEmpty(['money_agrees', 'id_service']))
        {
            $moneyAgrees = $_POST['money_agrees'];
            $idService = $_POST['id_service'];
    
            $coinUser = $this->getCurrentBalance( null );

            if ( $moneyAgrees > $coinUser ) {
                $this->error = 'Số dư tài khoản không đủ thực hiện';
                return false;
            }

            $query = $this->updateUserBalance( 'withdraw', $coinUser, $moneyAgrees, $this->userId );

            $randomKey = array_rand($this->dataTradeMark);
            $this->data = [
                'userId' => $this->userId,
                'id_onwser' => -1,
                'id_service' => $idService,
                'code_trade' => $this->access->generateCode($this->dataTradeMark[ $randomKey ]),
                'coin' => $moneyAgrees,
                'trade_status' => 'payment_deduct',
                'status' => 'HT',
                'createAt' => date('Y-m-d H:i:s')
            ];

            $query = $this->access->MyModelsCrud->insert('ug_trade', $this->data);
            if ($query) 
            $this->response = 'Thực hiện thành công';
        }
    }

    public function paymentService() 
    {
        if ($this->access->attributeEmpty(['money_agrees', 'id_onwser', 'id']))
        {
            $id = $_POST['id'];
            $userId = $_POST['user_id'];
            $moneyAgrees = $_POST['money_agrees'];

            $check = $this->access->MyModelsCrud->getRaw("
                SELECT * 
                FROM 
                    ug_trade
                WHERE 
                    id_service = '$id'
            ");

            if ( $check[0]['id_onwser'] !== -1 ) {
                $this->error = 'Hoạt động thường xuyên, vui lòng dừng lại!';
                return false;
            }

            $coinUser = $this->getCurrentBalance( $userId );
            $query = $this->updateUserBalance( 'deposit', $coinUser, $moneyAgrees, $userId);
            
            if ( $query ) 
            {
                $this->data = [
                    'id_onwser' => $userId
                ];

                $this->access->MyModelsCrud->update('ug_trade', $this->data, "id_service = '$id'");
            }
        }
    }
}

class definesWalletAction extends General {
    private $handle; 
    private $method;
    private $access;

    public function __construct() 
    {
        $this->access = new General;
        $this->handle = new HandleWallet();
        $this->performDetermination();
    }

    public function performDetermination()
    {
        if ( $this->access->attributeEmpty( ['class'] ) )
        { 
            $this->method = $_POST['class'];

            switch ( $this->method )
            {
                case 'PrepareDeposit':
                    $this->handle->prepareInfoDeposit();
                    break;
                    
                case 'AcceptDeposit':
                    $this->handle->handlePayment();
                    break;   

                case 'CurrentBalance':
                    $this->handle->getCurrentBalance( null );
                    break;

                case 'AcceptWithdraw':
                    $this->handle->handleWithdraw();
                    break;
                
                case 'HistoryPayment':
                    $this->handle->historyPayment();
                    break;

                case 'AcceptPayment':
                    $this->handle->acceptPayment();
                    break;

                case 'PaymentService':
                    $this->handle->paymentService();
                    break;
            }

            $this->access->sendJsonResponse($this->handle->response, $this->handle->error);
        }
    }
}

$handle = new definesWalletAction();