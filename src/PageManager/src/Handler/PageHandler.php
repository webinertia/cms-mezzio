<?php

declare(strict_types=1);

namespace PageManager\Handler;

use DebugBar\DebugBar;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Tactician\CommandBus;
use Mezzio\Template\TemplateRendererInterface;
use PageManager\Storage;
use PageManager\Storage\PageEntity;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PageHandler implements RequestHandlerInterface
{
    public function __construct(
        private CommandBus $commandBus,
        private ?TemplateRendererInterface $template = null,
        private ?DebugBar $debug = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $page = new PageEntity(null, 'command created');
        $this->commandBus->handle(new Storage\SavePageCommand($page));

        // debug message usage
        //$this->debug['messages']->addMessage(Debug::dump($request, 'testing debug messages', false, false));

        return new HtmlResponse($this->template->render('page-manager::page', $page));
    }
}
