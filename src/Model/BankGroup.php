<?php

namespace Bankin\Model;

class BankGroup
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $logoUrl;

    /**
     * @var Bank[]|null
     */
    private $banks;

    /**
     * @var string|null
     */
    private $countryCode;

    /**
     * BankGroup constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->logoUrl = $data['logo_url'] ?? null;
        $this->countryCode = $data['country_code'] ?? null;
        $this->banks = array_map(
            function (array $data) {
                return new Bank($data);
            },
            $data['banks'] ?? []
        );
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @return Bank[]|null
     */
    public function getBanks(): ?array
    {
        return $this->banks;
    }
}