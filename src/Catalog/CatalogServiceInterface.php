<?php

/**
 * @copyright Copyright (c) Wizacha
 * @license Proprietary
 */

declare(strict_types=1);

namespace Wizaplace\SDK\Catalog;

use Psr\Http\Message\ResponseInterface;
use Wizaplace\SDK\Exception\NotFound;
use Wizaplace\SDK\Exception\SomeParametersAreInvalid;
use Wizaplace\SDK\SortDirection;

/**
 * Interface CatalogServiceInterface
 * @package Wizaplace\SDK\Catalog
 */
interface CatalogServiceInterface
{
    /**
     * @param string|null $language
     *
     * @return \Generator|Product[] a Generator of Product
     */
    public function getAllProducts(string $language = null): \Generator;

    /**
     * @param string $id
     *
     * @return Product
     */
    public function getProductById(string $id): Product;

    /**
     * @param string $id
     *
     * @return Declination
     */
    public function getDeclinationById(string $id): Declination;

    /**
     * @param string $code
     *
     * @return Product[]
     */
    public function getProductsByCode(string $code): array;

    /**
     * @param string $supplierReference
     *
     * @return Product[]
     */
    public function getProductsBySupplierReference(string $supplierReference): array;

    /**
     * @param string $mvpId
     *
     * @return Product[]
     */
    public function getProductsByMvpId(string $mvpId): array;

    /**
     * @param  ProductFilter $productFilter
     * @param  bool $allowMvp
     *
     * @return Product[]
     */
    public function getProductsByFilters(ProductFilter $productFilter, bool $allowMvp = true): array;

    /**
     * @return CategoryTree[]
     */
    public function getCategoryTree(string $criteria = CategorySortCriteria::POSITION, string $direction = SortDirection::ASC): array;

    /**
     * @param int $id
     *
     * @return Category
     */
    public function getCategory(int $id): Category;

    /**
     * @param int|int[] $ids
     * @return Category[]
     */
    public function getCategories($ids = []): array;

    /**
     * @param string         $query
     * @param array          $filters
     * @param array          $sorting
     * @param int            $resultsPerPage
     * @param int            $page
     * @param GeoFilter|null $geoFilter
     *
     * @return SearchResult
     */
    public function search(
        string $query = '',
        array $filters = [],
        array $sorting = [],
        int $resultsPerPage = 12,
        int $page = 1,
        ?GeoFilter $geoFilter = null
    ): SearchResult;

    /**
     * @param int $id
     *
     * @return CompanyDetail
     */
    public function getCompanyById(int $id): CompanyDetail;

    /**
     * @return CompanyDetail[]
     */
    public function getCompanies(): array;

    /**
     * @param null|AttributeFilter $attributeFilter
     *
     * @return Attribute[]
     */
    public function getAttributes(AttributeFilter $attributeFilter = null): array;

    /**
     * @param int $attributeId
     *
     * @return Attribute
     */
    public function getAttribute(int $attributeId): Attribute;

    /**
     * @param int $variantId
     *
     * @return AttributeVariant
     */
    public function getAttributeVariant(int $variantId): AttributeVariant;

    /**
     * @return AttributeVariant[]
     */
    public function getAttributeVariants(int $attributeId): array;

    /**
     * Report a suspicious product to the marketplace administrator.
     *
     * @throws NotFound
     * @throws SomeParametersAreInvalid
     */
    public function reportProduct(ProductReport $report): void;

    /**
     * Convenience method to extract a brand from a product
     *
     * @param ProductSummary|Product $product
     * @return null|ProductAttributeValue
     * @throws \TypeError
     */
    public function getBrand($product): ?ProductAttributeValue;

    /**
     * @param ProductSummary $product
     *
     * @return ProductAttributeValue|null
     */
    public function getBrandFromProductSummary(ProductSummary $product): ?ProductAttributeValue;

    /**
     * @param Product $product
     *
     * @return ProductAttributeValue|null
     */
    public function getBrandFromProduct(Product $product): ?ProductAttributeValue;

    /**
     * @param string $attachmentId
     *
     * @return ResponseInterface
     */
    public function getProductAttachment(string $attachmentId): ResponseInterface;
}
