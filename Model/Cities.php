<?php

declare(strict_types=1);

namespace Eadesigndev\RomCity\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\Locale\Resolver;


class Cities implements ConfigProviderInterface
{
    /** @var RomCityRepository  */
    private $romCityRepository;

    /** @var SearchCriteriaBuilder  */
    private $searchCriteria;

    /** @var SerializerInterface  */
    private $serializer;

    /*** @var Resolver*/
    protected $localeResolver;


    public function __construct(
        RomCityRepository $romCityRepository,
        SearchCriteriaBuilder $searchCriteria,
        SerializerInterface $serializer,
        Resolver $localeResolver
    ) {
        $this->romCityRepository = $romCityRepository;
        $this->searchCriteria = $searchCriteria;
        $this->serializer = $serializer;
        $this->localeResolver = $localeResolver;        

    }

    public function getConfig(): array
    {
        return [
            'cities' => $this->getCities()
        ];
    }
 
    private function getCities(): string
    {
        $localeCode = $this->localeResolver->getLocale();

        $searchCriteriaBuilder = $this->searchCriteria;
        $searchCriteria = $searchCriteriaBuilder->create();

        $citiesList = $this->romCityRepository->getList($searchCriteria);
        $items = $citiesList->getItems();

        $return = [];

        /** @var RomCity $item */

            foreach ($items as $item) {
                 if($item->getLocale()==$localeCode){
                    $return[$item->getRegionId()][] = $item->getCityName();
                 }
            }
        
    return $this->serializer->serialize($return);
    }

        
}
