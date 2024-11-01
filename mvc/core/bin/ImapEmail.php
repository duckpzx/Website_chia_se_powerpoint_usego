<?php

    define('_IMAP_HOST_NAME', '{imap.gmail.com:993/imap/ssl}INBOX');
    define('_IMAP_USER_NAME', 'ducpham2004nha@gmail.com');
    define('_IMAP_PASS_WORD', 'oclezgkegttyuits');

    define('_TRADE_FULL_NAME', 'PHAM XUAN DUC');
    define('_TRADE_NAME_BANK', 'Mb');
    define('_TRADE_NUMBER_BANK', '0396605617');

class EmailChecker {
    private $hostname;
    private $username;
    private $password;
    private $inbox;
    private $date;
    private $searchCriteria;
    private $result = [];

    public function __construct($hostname, $username, $password)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->date = date('d-M-Y');
        $this->searchCriteria = 'FROM "mbebanking@mbbank.com.vn" SINCE "' . $this->date . '" UNSEEN';
    }

    public function connect()
    {
        $this->inbox = imap_open($this->hostname, $this->username, $this->password) or die(json_encode(['error' => 'Cannot connect to IMAP: ' . imap_last_error()]));
    }

    public function searchEmails()
    {
        return imap_search($this->inbox, $this->searchCriteria);
    }

    public function checkEmails()
    {
        $emails = $this->searchEmails();
        $tokenTrade = $_POST['code_trade'];
        $moneyAgrees = floatval(str_replace(',', '', $_POST['code_trade'])) . "000";
    
        if ($emails) {
            foreach ($emails as $email_number) {
                $header = imap_headerinfo($this->inbox, $email_number);
                $subject = $header->subject;
                $from = $header->from[0]->mailbox . '@' . $header->from[0]->host;
    
                $body = imap_fetchbody($this->inbox, $email_number, 1);
                
                $clean_body = quoted_printable_decode($body);
                $clean_body = html_entity_decode($clean_body, ENT_QUOTES, 'UTF-8');

                $clean_body = strip_tags($clean_body);
    
                if (strpos($clean_body, $tokenTrade) !== false) {
                    if (preg_match('/Người\s+thụ\s+hưởng\s+([\w\s]+?)\s*-\s*([\d\s\-]+)/', $clean_body, $recipient_matches)) 
                    {
                        $recipient_name = trim($recipient_matches[1]);
                        $recipient_account = trim($recipient_matches[2]);
                        if ($recipient_name === _TRADE_FULL_NAME 
                        && $recipient_account === _TRADE_NUMBER_BANK)
                    
                        if (preg_match('/Số\s+tiền\s+giao\s+dịch\s+.*?\(VND\)\s+([0-9,.]+)/', $clean_body, $matches)) {
                            $transaction_amount = floatval(str_replace(',', '.', $matches[1])); 
        
                            if ($transaction_amount >= $moneyAgrees) {
                                $this->result = [
                                    'code' => 1,
                                    'message' => 'Thực hiện giao dịch thành công',
                                ];

                            } else {
                                $this->result = [
                                    'code' => 0,
                                    'message' => 'Số tiền giao dịch không đủ',
                                ];
                            }
                        } else {
                            $this->result = ['code' => 0, 'message' => 'Không có thông tin khớp với giao dịch'];
                        }
                    }
                    imap_setflag_full($this->inbox, $email_number, '\\Seen');

                    return;  
                }
            }
            $this->result = ['code' => 0, 'message' => 'Không có thông tin khớp với giao dịch'];
        } else {
            $this->result = ['code' => 0, 'message' => 'Không có thông tin khớp với giao dịch'];
        }
    }


    public function closeConnection()
    {
        imap_close($this->inbox);
    }

    public function getResult()
    {
        return $this->result;
    }
}
