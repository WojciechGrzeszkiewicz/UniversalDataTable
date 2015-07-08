<?php

/**
 * This file is part of the WgUniversalDataTableBundle package.
 *
 * (c) stwe <https://github.com/stwe/DataTablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wg\UniversalDataTableBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class DataTableViewPass
 *
 * @package Wg\UniversalDataTableBundle\DependencyInjection\Compiler
 */
class DataTableViewPass implements CompilerPassInterface
{
    /**
     * Process.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds(
            'wg.universaldatatable.view'
        );

        foreach ($taggedServices as $id => $tagAttributes) {
            $def = $container->getDefinition($id);
            $def->addArgument(new Reference('security.authorization_checker'));
            $def->addArgument(new Reference('security.token_storage'));
            $def->addArgument(new Reference('twig'));
            $def->addArgument(new Reference('translator.default'));
            $def->addArgument(new Reference('router'));
            $def->addArgument(new Reference('doctrine.orm.entity_manager'));
            $def->addArgument('%wg_universaldatatable.default.layout.options%');
        }
    }
}
