<?php

declare(strict_types=1);

namespace PageManager\Handler;

use DebugBar\DebugBar;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template = null,
        private ?DebugBar $debug = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [];

        // debug message usage
        //$this->debug['messages']->addMessage(Debug::dump($request, 'testing debug messages', false, false));

        return new HtmlResponse($this->template->render('page-manager::page', $data));
    }
}
