<?php

/**
 * This file is part of the EightMarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EightMarq\UserBundle\DependencyInjection;

use EightMarq\CoreBundle\DependencyInjection\AbstractExtension;
use EightMarq\UserBundle\Entity\User;
use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Security\Core\User\UserInterface;

class UserExtension extends AbstractExtension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yaml');
    }

    /**
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container): void
    {
        $this->targetEntities[UserInterface::class] = User::class;

        parent::prepend($container);
    }

}