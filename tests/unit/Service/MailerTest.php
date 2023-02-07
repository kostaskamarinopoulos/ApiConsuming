<?php

use PHPUnit\Framework\TestCase;
use App\Service\Mailer;
use Psr\Log\LoggerInterface;
use App\Entity\MailerData;
use Symfony\Component\Mailer\MailerInterface;

class MailerTest extends TestCase 
{
    private LoggerInterface $mockLogger;

    private MailerInterface $symfonyMailer;

    protected function setUp(): void
    {
        $this->symfonyMailer = $this->createMock(MailerInterface::class);
        $this->mockLogger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();
    }

    public function testSend() {
        $mailerData = new MailerData();
        $mailerData->setCompanyName('testName');
        $mailerData->setCompanySymbol('testSymbol');
        $mailerData->setEnddate('2020/10/10');
        $mailerData->setStartDate('2020/09/09');
        $mailerData->setEmail('test@test.com');

        $mailer = new Mailer($this->symfonyMailer, $this->mockLogger);
        $response = $mailer->send($mailerData);
        $namedAddresses = $response->getTo();

        $this->assertCount(1, $response->getTo());
        $this->assertSame('for submitted Company Symbol = testSymbol => Company’s Name = testName', $response->getSubject());
        $this->assertSame('test@test.com', $namedAddresses[0]->getAddress());
    }
}
