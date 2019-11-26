<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/11/26
 * Time: 15:56
 */

namespace App\Controller;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Nats\Driver\DriverInterface;


/**
 * @AutoController(prefix="nats")
 */
class NatsController extends AbstractController
{
    /**
    * @Inject
    * @var DriverInterface
    */
    protected $nats;

    public function publish()
    {
        $res = $this->nats->publish('hyperf.demo', [
            'id' => 'Hyperf',
        ]);

        return $this->response->success($res);
    }
}