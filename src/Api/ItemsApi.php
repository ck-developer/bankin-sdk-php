<?php

namespace Bankin\Api;

use Bankin\Model\Item;
use Bankin\Model\RedirectUrl;
use Bankin\Model\Synchronization;

class ItemsApi extends AbstractApi
{
    /**
     * @return RedirectUrl|array
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function connect()
    {
        $response = $this->sendRequest('GET', '/connect/items/add/url');

        return $this->hydrate($response, RedirectUrl::class);
    }

    /**
     * @param int $id
     *
     * @return RedirectUrl|array
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function edit(int $id)
    {
        $response = $this->sendRequest('GET', '/connect/items/edit/url', [
            'query' => [
                'item_id' => $id
            ]
        ]);

        return $this->hydrate($response, RedirectUrl::class);
    }

    /**
     * @param int $id
     * @return Item|array
     *
     * @throws \Http\Client\Exception
     */
    public function get(int $id)
    {
        $response = $this->sendRequest('GET', "/items/$id");

        return $this->hydrate($response, Item::class);
    }

    /**
     * @param int $id
     *
     * @return Synchronization|array|null
     *
     * @throws \Http\Client\Exception
     */
    public function sync(int $id)
    {
        $response = $this->sendRequest('POST', "/items/$id/refresh");

        if ($response->getStatusCode() !== 202) {
            return null;
        }

        $response = $this->sendRequest('GET', $response->getHeaderLine('Location'));

        return $this->hydrate($response, Synchronization::class);
    }

    /**
     * @return mixed
     *
     * @throws \Http\Client\Exception
     */
    public function status(int $id)
    {
        $response = $this->sendRequest('GET', "/items/$id/refresh/status");

        return $this->hydrate($response, Synchronization::class);
    }
}
