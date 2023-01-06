<?php

namespace App\Repositories\Bot;

use App\Models\Bot\Webhook;
use App\Repositories\Repository;

class WebhookRepository extends Repository
{
    /**
     * @var Webhook
     */
    private $webhook;

    /**
     * @param Webhook $webhook
     */
    public function __construct(Webhook $webhook)
    {
        $this->model = $this->webhook = $webhook;
    }

    /**
     * @param array $attributes
     * @return Webhook
     */
    public function store(array $attributes): Webhook
    {
        /** @var Webhook $webhook */
        $webhook = new $this->webhook;
        $webhook->fill($attributes);

        $webhook->save();

        return $webhook;
    }

    /**
     * @param Webhook $webhook
     * @param array $attributes
     * @return Webhook
     */
    public function update(Webhook $webhook, array $attributes): Webhook
    {
        $webhook->update($attributes);

        return $webhook;
    }

    /**
     * @param Webhook $webhook
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Webhook $webhook): ?bool
    {
        $webhook->delete();
        return true;
    }
}
