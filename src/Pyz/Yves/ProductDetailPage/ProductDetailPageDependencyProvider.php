<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductDetailPage;

use Pyz\Yves\ExampleProductColorGroupWidget\Plugin\ProductDetailPage\ExampleProductColorGroupWidgetPlugin;
use Pyz\Yves\ProductSetWidget\Plugin\ProductSetIdsWidgetPlugin;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\AvailabilityWidget\Plugin\ProductDetailPage\AvailabilityWidgetPlugin;
use SprykerShop\Yves\CmsBlockWidget\Plugin\ProductDetailPage\ProductCmsBlockWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\ProductDetailPage\MultiCartWidgetPlugin;
use SprykerShop\Yves\PriceProductVolumeWidget\Plugin\ProductDetailPage\PriceProductVolumeWidgetPlugin;
use SprykerShop\Yves\PriceWidget\Plugin\ProductDetailPage\PriceWidgetPlugin;
use SprykerShop\Yves\ProductAlternativeWidget\Plugin\ProductDetailPage\ProductAlternativeWidgetPlugin;
use SprykerShop\Yves\ProductCategoryWidget\Plugin\ProductDetailPage\ProductCategoryWidgetPlugin;
use SprykerShop\Yves\ProductDetailPage\ProductDetailPageDependencyProvider as SprykerShopProductDetailPageDependencyProvider;
use SprykerShop\Yves\ProductDiscontinuedWidget\Plugin\ProductDetailPage\ProductDiscontinuedWidgetPlugin;
use SprykerShop\Yves\ProductImageWidget\Plugin\ProductDetailPage\ProductImageWidgetPlugin;
use SprykerShop\Yves\ProductLabelWidget\Plugin\ProductDetailPage\ProductAbstractLabelWidgetPlugin;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Plugin\ProductDetailPage\ProductMeasurementUnitWidgetPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\ProductDetailPage\ProductOptionWidgetPlugin;
use SprykerShop\Yves\ProductPackagingUnitWidget\Plugin\ProductDetailPage\ProductPackagingUnitWidgetPlugin;
use SprykerShop\Yves\ProductRelationWidget\Plugin\ProductDetailPage\SimilarProductsWidgetPlugin;
use SprykerShop\Yves\ProductReplacementForWidget\Plugin\ProductDetailPage\ProductReplacementForWidgetPlugin;
use SprykerShop\Yves\ProductReviewWidget\Plugin\ProductDetailPage\ProductReviewWidgetPlugin;
use SprykerShop\Yves\ShoppingListWidget\Plugin\ProductDetailPage\ShoppingListWidgetPlugin;

class ProductDetailPageDependencyProvider extends SprykerShopProductDetailPageDependencyProvider
{
    const CLIENT_PRODUCT_STORAGE_PYZ = 'CLIENT_PRODUCT_STORAGE_PYZ';

    /**
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface[]
     */
    protected function getProductDetailPageWidgetPlugins(): array
    {
        return [
            PriceWidgetPlugin::class,
            ProductCategoryWidgetPlugin::class,
            ProductImageWidgetPlugin::class,
            AvailabilityWidgetPlugin::class,
            ProductOptionWidgetPlugin::class,
            ProductAbstractLabelWidgetPlugin::class,
            SimilarProductsWidgetPlugin::class,
            ProductCmsBlockWidgetPlugin::class,
            ProductReviewWidgetPlugin::class,
            ExampleProductColorGroupWidgetPlugin::class,
            ProductMeasurementUnitWidgetPlugin::class,
            MultiCartWidgetPlugin::class, #MultiCartFeature
            ShoppingListWidgetPlugin::class, #ShoppingListFeature
            ProductDiscontinuedWidgetPlugin::class, #ProductDiscontinuedFeature
            ProductReplacementForWidgetPlugin::class, #ProductAlternativeFeature
            ProductAlternativeWidgetPlugin::class, #ProductAlternativeFeature
            PriceProductVolumeWidgetPlugin::class, #PriceProductVolumeFeature
            ProductPackagingUnitWidgetPlugin::class, #ProductPackagingUnit
            ProductSetIdsWidgetPlugin::class,
        ];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);
        $container = $this->addProductStoragePyzClient($container);
        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addProductStoragePyzClient(Container $container)
    {
        $container[self::CLIENT_PRODUCT_STORAGE_PYZ] = function (Container $container) {
            return $container->getLocator()->productStorage()->client();
        };
        return $container;
    }
}
