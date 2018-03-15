<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 16:50
 */

namespace App\Model\EventListener;

use Kdyby\Events\Subscriber;
use Nette;

class UserListener extends Nette\Object implements Subscriber
{
    public $onSuccess = array();

    private $orders;

    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    public function process($values)
    {
        if ($order = $this->orders->create($values)) {
            $this->onSuccess($this, $order);
        }
    }

    function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
    }
}