<?php

/**
 * @author      Wizacha DevTeam <dev@wizacha.com>
 * @copyright   Copyright (c) Wizacha
 * @license     Proprietary
 */

declare(strict_types=1);

namespace Wizaplace\SDK\Exception;

/**
 * Class UnauthorizedModerationAction
 * @package Wizaplace\SDK\Exception
 */
final class UnauthorizedModerationAction extends \Exception
{
    /**
     * @var array
     */
    private $context;

    /**
     * @internal
     *
     * @param string          $message
     * @param array           $context
     * @param \Throwable|null $previous
     */
    public function __construct(string $message, array $context = [], ?\Throwable $previous = null)
    {
        $this->context = $context;

        parent::__construct($message, 401, $previous);
    }
}