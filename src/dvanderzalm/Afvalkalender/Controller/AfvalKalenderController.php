<?php
namespace dvanderzalm\Afvalkalender\Controller;

use GuzzleHttp\Client;

class AfvalKalenderController
{
    /* @var string */
    private $baseUri = 'http://json.mijnafvalwijzer.nl';

    /* @var string */
    private $postalcode = '';

    /* @var int */
    private $houseNumber = 0;

    /* @var string */
    private $suffix = '';

    /* @var string */
    private $country;

    /* @var object */
    private $client;

    /**
     * AfvalKalenderController constructor.
     * @param $postalcode
     * @param $houseNumber
     * @param string $suffix
     * @param string $country
     */
    public function __construct($postalcode, $houseNumber, $suffix = '', $country = 'nl')
    {
        $this->suffix = $suffix;
        $this->houseNumber = $houseNumber;
        $this->postalcode = $postalcode;
        $this->country = $country;
        $this->client = new Client();
    }

    /**
     * Determine the CSS class wich is being used on the elements
     *
     * @param $type
     * @return string
     */
    private function determineCssClass($type) : string
    {
        switch ($type) {
            case 'gft':
                $cssClass = 'green';
                break;
            case 'restafval':
                $cssClass = 'blue';
                break;
            case 'papier':
                $cssClass = 'red';
                break;
            case 'plastic':
                $cssClass = 'orange';
                break;
        }

        return $cssClass;
    }

    /**
     * Parse the data into a HTML element
     *
     * @param $garbageCollectionDay
     * @return string
     */
    private function parseFutureGarbageCollectionDays($garbageCollectionDay) : string
    {
        $cssClass = $this->determineCssClass($garbageCollectionDay->type);

        $collectionDate = date('d-m-Y', strtotime($garbageCollectionDay->date));

        $html = '<div class="' . $cssClass . '">
            <h3>' . $garbageCollectionDay->nameType . '</h3>
            <span>' . $collectionDate . '</span>
        </div>';

        return $html;
    }

    /**
     * Get the future collection days. We don't need to have dates in the past.
     *
     * @param $json
     * @param $futureDays
     * @return array
     */
    private function getGarbageCollectionDaysInFuture($json, $futureDays) : array
    {
        $collectionElements = [];
        if (is_array($json->data->ophaaldagen->data)) {
            $i = 1;
            foreach ($json->data->ophaaldagen->data as $collectionDay) {
                if ($collectionDay->date >= date('Y-m-d') && $futureDays >= $i) {
                    $collectionElements[] = $this->parseFutureGarbageCollectionDays($collectionDay);

                    $i++;
                }
            }
        }

        return $collectionElements;
    }

    /**
     * @return array
     */
    private function parseQueryParameters(): array
    {
        $queryParameters = [
            'method' => 'postcodecheck',
            'postcode' => $this->postalcode,
            'street' => '',
            'huisnummer' => $this->houseNumber,
            'toevoeging' => $this->suffix,
            'platform' => 'phone',
            'langs' => 'nl'
        ];

        return $queryParameters;
    }

    /**
     * Get response after request
     *
     * @return object
     */
    private function getJsonResponseAfterRequest()
    {
        $queryParameters = $this->parseQueryParameters();

        $response = $this->client->get($this->baseUri,
            [
                'query'=> $queryParameters
            ]
        );

        $jsonResponse = json_decode($response->getBody());

        return $jsonResponse;
    }

    /**
     * Request the items
     *
     * @param $maxDays
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestGarbageMoments($maxDays)
    {
        $elements = $this->getGarbageCollectionDaysInFuture($this->getJsonResponseAfterRequest(), $maxDays);

        if (!empty($elements)) {
            foreach ($elements as $item) {
                echo $item;
            }
        } else {
            echo 'Er zijn geen ophaaldagen bekend.';
        }
    }
}