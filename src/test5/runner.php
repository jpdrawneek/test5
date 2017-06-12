<?php
/**
 * Created by PhpStorm.
 * User: jpd
 * Date: 12/06/17
 * Time: 22:44
 */

namespace test5;

use GuzzleHttp\Psr7;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class runner
{
    /** @var ClientInterface */
    protected $client;
    /** @var application */
    protected $application;

    /**
     * runner constructor.
     * @param ClientInterface $client
     * @param application $app
     */
    public function __construct(ClientInterface $client, application $app)
    {
        $this->client = $client;
        $this->application = $app;
    }

    /**
     * @param int $count
     * @return array
     */
    public function run(int $count)
    {
        /** @var ResponseInterface $data */
        $data = $this->client->request('GET', 'https://s3-eu-west-1.amazonaws.com/secretsales-dev-test/interview/flatland.txt');
        // @todo Move Url to configuration file.

        $stream = $data->getBody();
        while(!$stream->eof()) {
            $this->application->countWords(Psr7\readline($stream));
        }
        $topList = $this->application->getTopWords($count);
        return $topList;
    }
}