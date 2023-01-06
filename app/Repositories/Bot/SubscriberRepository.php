<?php

namespace App\Repositories\Bot;

use App\Models\Bot\Subscriber;
use App\Repositories\Repository;

class SubscriberRepository extends Repository
{
    /**
     * @var Subscriber
     */
    private $subscriber;

    /**
     * @param Subscriber $subscriber
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->model = $this->subscriber = $subscriber;
    }

    /**
     * @param array $attributes
     * @return Subscriber
     */
    public function store(array $attributes): Subscriber
    {
        $enabled = false;
        if(array_key_exists('receive_message', $attributes)){
            if($attributes['receive_message'] === 'on'){
                $enabled = true;
            }
        }
        $attributes['receive_message'] = $enabled;

        /** @var Subscriber $subscriber */
        $subscriber = new $this->subscriber;
        $subscriber->fill($attributes);

        $subscriber->save();

        return $subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @param array $attributes
     * @return Subscriber
     */
    public function update(Subscriber $subscriber, array $attributes): Subscriber
    {
        $enabled = false;
        if(array_key_exists('receive_message', $attributes)){
            if($attributes['receive_message'] === 'on'){
                $enabled = true;
            }
        }
        $attributes['receive_message'] = $enabled;

        $subscriber->update($attributes);
        $subscriber->save();

        return $subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Subscriber $subscriber): ?bool
    {
        $subscriber->delete();
        return true;
    }
}
