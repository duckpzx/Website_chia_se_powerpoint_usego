<?php

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
        $tokenTrade = $_POST['token_trade'];
        $moneyAgrees = floatval(str_replace(',', '', $_POST['money_agrees'])) . "000";
    
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
                        if ($recipient_name === 'PHAM XUAN DUC' 
                        && $recipient_account === '0396605617')
                    
                        if (preg_match('/Số\s+tiền\s+giao\s+dịch\s+.*?\(VND\)\s+([0-9,.]+)/', $clean_body, $matches)) {
                            $transaction_amount = floatval(str_replace(',', '', $matches[1])); 
        
                            if ($transaction_amount >= $moneyAgrees) {
                                $this->result = [
                                    'status' => 'success',
                                    'message' => 'Số tiền giao dịch hợp lệ',
                                    'transaction_amount' => $transaction_amount
                                ];

                            } else {
                                $this->result = [
                                    'status' => 'failed',
                                    'message' => 'Số tiền giao dịch không đủ',
                                    'transaction_amount' => $transaction_amount
                                ];
                            }
                        } else {
                            $this->result = ['status' => 'failed', 'message' => 'Không tìm thấy thông tin số tiền trong email'];
                        }
                    }
                    imap_setflag_full($this->inbox, $email_number, '\\Seen');

                    return; 
                }
            }
            $this->result = ['status' => 'failed', 'message' => 'Không có email khớp với token giao dịch'];
        } else {
            $this->result = ['message' => 'Không có email nào từ mbebanking@mbbank.com.vn kể từ ngày hôm nay'];
        }
    }

    public function checkTransaction()
    {
        
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
