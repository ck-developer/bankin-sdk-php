<?php


namespace Bankin\Model;

class Stock
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $currentPrice;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var float
     */
    private $totalValue;

    /**
     * @var float
     */
    private $averagePurchasePrice;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $ticker;

    /**
     * @var string
     */
    private $stockKey;

    /**
     * @var string
     */
    private $isin;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var string
     */
    private $marketplace;

    /**
     * @var string
     */
    private $label;

    /**
     * @var \DateTimeImmutable
     */
    private $valueDate;
}