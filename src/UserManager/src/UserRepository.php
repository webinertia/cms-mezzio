<?php

declare(strict_types=1);

namespace UserManager;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Where;
use Laminas\Stdlib\ArrayObject;
use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;
use Webinertia\Db\TableGateway;
use Webmozart\Assert\Assert;

use function array_flip;
use function array_intersect_key;
use function password_verify;

final class UserRepository implements UserRepositoryInterface
{
    /**
     *
     * @param TableGateway $gateway
     * @param array<string, string|[]> $config
     * @return void
     */
    public function __construct(
        protected TableGateway $gateway,
        protected array $config
    ) {
    }

    public function authenticate(string $credential, ?string $password = null): ?UserInterface
    {
        /**
         * class aliased as UserRepositoryInterface so that it will be called to authenticate a user
         * Provide a factory to supply the db table instance via constructor
         * this class should query the database and populate as DefaultUser class and return it
         */
        $where = new Where();
        /** @var string */
        $identifier = $this->config['username'];
        $where->equalTo($identifier, $credential);
        /** @var Resultset */
        $result = $this->gateway->select($where);
        /** @var ArrayObject|null */
        $user   = $result->current();
        Assert::string($password);
        if ($user === null) {
            return $user;
        } elseif (! password_verify($password, (string) $user->password)) {
            return null;
        }
        /**
         * @psalm-suppress all
         */
        return new Auth\CurrentUser(
            $user->userName,
            (array) $user->role,
            array_intersect_key($user->getArrayCopy(), array_flip($this->config['details']))
        );
    }
}
