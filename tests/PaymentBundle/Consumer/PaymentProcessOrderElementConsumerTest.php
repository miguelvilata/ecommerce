<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\PaymentBundle\Tests\Consumer;

use Sonata\Component\Order\OrderInterface;
use Sonata\Component\Payment\TransactionInterface;
use Sonata\Component\Product\Pool;
use Sonata\OrderBundle\Entity\OrderElementManager;
use Sonata\PaymentBundle\Consumer\PaymentProcessOrderElementConsumer;
use Sonata\Tests\Helpers\PHPUnit_Framework_TestCase;

class PaymentProcessOrderElementConsumerTest extends PHPUnit_Framework_TestCase
{
    public function testGenerateDiffValue()
    {
        $consumer = $this->getConsumer();

        $this->assertEquals(-1, $consumer->generateDiffValue(TransactionInterface::STATUS_VALIDATED, OrderInterface::STATUS_VALIDATED, 1));
        $this->assertEquals(-10, $consumer->generateDiffValue(TransactionInterface::STATUS_VALIDATED, OrderInterface::STATUS_VALIDATED, 10));
    }

    /**
     * @return PaymentProcessOrderElementConsumer
     */
    protected function getConsumer()
    {
        $registry = $this->createMock('Doctrine\Common\Persistence\ManagerRegistry');

        $orderElementManager = new OrderElementManager('Sonata\OrderBundle\Tests\Entity\OrderElement', $registry);

        $pool = new Pool();

        $consumer = new PaymentProcessOrderElementConsumer($orderElementManager, $pool);

        return $consumer;
    }
}
