<?php

/*
 * This file is part of ChekovModelBundle package.
 *
 * (c) Chekov Bundles <https://github.com/pavel-chekov>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chekov\Bundle\ModelBundle\Admin\Routing;

use Sulu\Bundle\AdminBundle\Admin\Routing\Route;

trait RouteTrait
{
    abstract public function getJsBundleName();

    /**
     * @return Route[]
     */
    private function createBasicRoutes(array $locales, string $resourceKey, string $route, bool $addRoute = true): array
    {
        $bundleName = $this->getJsBundleName();

        $routes = [
            (new Route(sprintf('%s_%s.datagrid', $bundleName, $resourceKey), $route . '/:locale', 'sulu_admin.datagrid'))
                ->addOption('title', sprintf('%s.%s', $bundleName, $resourceKey))
                ->addOption('adapters', ['table'])
                ->addOption('resourceKey', $resourceKey)
                ->addOption('locales', $locales)
                ->addAttributeDefault('locale', $locales[0])
                ->addOption('addRoute', $addRoute ? sprintf('%s_%s.add_form.detail', $bundleName, $resourceKey) : null)
                ->addOption('editRoute', sprintf('%s_%s.edit_form.detail', $bundleName, $resourceKey)),
        ];

        if ($addRoute) {
            $routes = array_merge(
                $routes,
                [
                    (new Route(sprintf('%s_%s.add_form', $bundleName, $resourceKey), $route . '/:locale/add', 'sulu_admin.resource_tabs'))
                        ->addOption('resourceKey', $resourceKey)
                        ->addOption('locales', $locales),
                    (new Route(sprintf('%s_%s.add_form.detail', $bundleName, $resourceKey), '/details', 'sulu_admin.form'))
                        ->addOption('tabTitle', sprintf('%s.details', $bundleName))
                        ->addOption('backRoute', sprintf('%s_%s.datagrid', $bundleName, $resourceKey))
                        ->addOption('editRoute', sprintf('%s_%s.edit_form.detail', $bundleName, $resourceKey))
                        ->setParent(sprintf('%s_%s.add_form', $bundleName, $resourceKey))
                        ->addOption('locales', $locales),
                ]
            );
        }

        $routes = array_merge(
            $routes,
            [
                (new Route(sprintf('%s_%s.edit_form', $bundleName, $resourceKey), $route . '/:locale/:id', 'sulu_admin.resource_tabs'))
                    ->addOption('resourceKey', $resourceKey)
                    ->addOption('locales', $locales),
                (new Route(sprintf('%s_%s.edit_form.detail', $bundleName, $resourceKey), '/details', 'sulu_admin.form'))
                    ->addOption('tabTitle', sprintf('%s.details', $bundleName))
                    ->addOption('backRoute', sprintf('%s_%s.datagrid', $bundleName, $resourceKey))
                    ->setParent(sprintf('%s_%s.edit_form', $bundleName, $resourceKey))
                    ->addOption('locales', $locales),
            ]
        );

        return $routes;
    }
}
