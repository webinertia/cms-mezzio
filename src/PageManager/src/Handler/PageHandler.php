<?php

declare(strict_types=1);

namespace PageManager\Handler;

use DebugBar\DebugBar;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
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
        private ?TemplateRendererInterface $template = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        //$page = new PageEntity(null, 'command created');
        //$this->test = $page;
       // $this->commandBus->handle(new Storage\SavePageCommand($page));

        // debug message usage
        // $debug = $request->getAttribute(DebugBar::class);
        // $debug['messages']->addMessage('test message');

        if ($this->template === null) {
            return new JsonResponse([]);
        }

        return new HtmlResponse($this->template->render('page-manager::page'));
    }
}
