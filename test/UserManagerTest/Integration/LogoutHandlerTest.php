<?php

declare(strict_types=1);

namespace UserManagerTest\Integration;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Uri;
use Mezzio\Authentication\UserInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Test\Integration\AbstractTestCase;

/**
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
final class LogoutHandlerTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->initApp();
        $this->initPipeline();
    }

    public function testUserIsLoggedOut(): void
    {
        $sessionData = [
            'username' => 'jsmith',
            'roles' => [
                'Administrator',
            ],
        ];
        $_SESSION[UserInterface::class] = $sessionData;
        $uri = new Uri('/logout');
        $request = new ServerRequest([], [], $uri);
        $request->withAttribute(UserInterface::class, $sessionData);
        /** @var Response */
        $response = $this->app->handle($request);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/user/login', $response->getHeaderLine('Location'));
    }
}
