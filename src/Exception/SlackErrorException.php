<?php

namespace Nexy\Slack\Exception;

use Psr\Http\Message\ResponseInterface;

class SlackErrorException extends \RuntimeException
{
    /** @var ResponseInterface */
    protected $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        parent::__construct($this->getMessageFromResponse(), $response->getStatusCode());
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    protected function getMessageFromResponse()
    {
        $data = json_decode($this->response->getBody()->getContents(), true);
        $message = 'Slack error: ';

        foreach($data['response_metadata']['messages']??[] as $item) {
            $message .= $item.'.';
        }
        return $message;
    }
}