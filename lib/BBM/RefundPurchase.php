<?php

namespace BBM;

use BBM\Server\Connect;
use BBM\Server\Exception;

class RefundPurchase extends Connect
{
    /**
     * Data that the API send to the Bibliomundi Server.
     * @var Mixed
     */
    private $data;

    /**
     * Validate the data and get the OAuth2 access_token for this request.
     * @param array $data
     *
     * @return bool
     * @throws Exception
     */
    public function validate(array $data)
    {
        $this->data = $data;

        try {
            $this->validateData();
            $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI[$this->environment] . 'token.php', $this->verbose);
            $request->authenticate(true, $this->clientId, $this->clientSecret);
            $request->create();
            $request->setPost(['grant_type' => Server\Config\SysConfig::$GRANT_TYPE, 'environment' => $this->environment]);
            $response = json_decode($request->execute());

            // SET THE ACCESS TOKEN TO THE NEXT REQUEST DATA.
            $this->data['access_token'] = $response->access_token;
            $this->data['environment'] = $this->environment;
        } catch (Exception $e) {
            throw $e;
        }

        return true;
    }

    /**
     * Validate everything inside the $data Array to check if all the information
     * that we need will be sent.
     * @throws Exception
     */
    private function validateData()
    {
        // REQUIRED DATA

        if (!isset($this->data['ebook_ids']) || !(is_array($this->data['ebook_ids']) && count($this->data['ebook_ids']))) {
            throw new Exception("ebook_ids precisa de ser uma array com id de ebooks referente à compra", 422);
        }

        if (!isset($this->data['transaction_key']))
            throw new Exception('transaction_key está faltando na requisição', 422);

        if (!isset($this->data['refund_reason']) && !empty($this->data['refund_reason']))
            throw new Exception('refund_reason é obrigatório para o envio do estorno', 422);

        // SET THE CLIENT_ID TO THE REQUEST
        $this->data['client_id'] = $this->clientId;
        $this->data['refund_reason'] = urlencode($this->data['refund_reason']);
    }

    /**
     * @throws Exception
     */
    public function requestRefund()
    {
        $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI[$this->environment] . Server\Config\SysConfig::$BASE_SALE . 'refund.php', $this->verbose);
        $request->authenticate(false);
        $request->create();
        $request->setPost($this->data);

        try {
            $request->execute();
            return $request->getResponse();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
