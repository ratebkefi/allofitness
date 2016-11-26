<?php

/*
 * This file is part of the Admin package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CommunBundle\Manager;

use Symfony\Component\Templating\EngineInterface;
use Swift_Mailer;

/**
 * Manager for frontend users.
 *
 * @author Ivan Proskuryakov <volgodark@gmail.com>
 */
class MailingManager
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var Swift_Mailer
     */
    protected $mailer;

    /**
     * @var string
     */
    protected $websiteEmail;

    /**
     * Constructor
     *
     * @param Swift_Mailer $mailer
     * @param EngineInterface $templating
     * @param string $websiteEmail
     */

    public function __construct(
        Swift_Mailer $mailer,
        EngineInterface $templating,
        $websiteEmail
    )
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->websiteEmail = $websiteEmail;
    }

    public function SendMail($title,$website,$template,$data)
    {

        try {
            $message = \Swift_Message::newInstance()
                ->setSubject($title)
                ->setFrom(array($this->websiteEmail => $website))
                ->setTo($data['email'])
                ->setBody($this->templating->render($template, $data));
            $message->setContentType("text/html");
            $response = $this->mailer->send($message);

        } catch (\Swift_TransportException $e) {
            $response = $e->getMessage();
        }
        return $response;

    }

}
