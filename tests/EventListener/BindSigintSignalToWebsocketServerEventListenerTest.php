<?php declare(strict_types=1);

namespace Gos\Bundle\WebSocketBundle\Tests\EventListener;

use Gos\Bundle\WebSocketBundle\Event\ServerLaunchedEvent;
use Gos\Bundle\WebSocketBundle\EventListener\BindSigintSignalToWebsocketServerEventListener;
use Gos\Bundle\WebSocketBundle\Server\App\Registry\PeriodicRegistry;
use PHPUnit\Framework\TestCase;
use React\EventLoop\LoopInterface;
use React\Socket\ServerInterface;

class BindSigintSignalToWebsocketServerEventListenerTest extends TestCase
{
    /**
     * @var PeriodicRegistry
     */
    private $periodicRegistry;

    /**
     * @var BindSigintSignalToWebsocketServerEventListener
     */
    private $listener;

    protected function setUp(): void
    {
        parent::setUp();

        $this->periodicRegistry = new PeriodicRegistry();

        $this->listener = new BindSigintSignalToWebsocketServerEventListener($this->periodicRegistry);
    }

    /**
     * @requires extension pcntl
     */
    public function testTheUserIsAuthenticatedWhenTheClientConnectEventIsDispatched(): void
    {
        $loop = $this->createMock(LoopInterface::class);
        $loop->expects($this->exactly(2))
            ->method('addSignal')
            ->withConsecutive(
                [SIGINT, $this->isInstanceOf(\Closure::class)],
                [SIGTERM, $this->isInstanceOf(\Closure::class)]
            );

        $event = new ServerLaunchedEvent(
            $loop,
            $this->createMock(ServerInterface::class),
            false
        );

        $listener = $this->listener;
        $listener($event);
    }
}
