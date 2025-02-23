<?php
/**
 * Copyright © 2018 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\RomCity\Api\Data;

interface RomCityInterface
{
    public const ENTITY_ID = 'entity_id';
    public const REGION_ID = 'region_id';
    public const CITY_NAME = 'city';
    public const LOCALE    = 'locale';

    public function getEntityId();

    public function getRegionId();

    public function getCityName();

    public function getLocale();

    public function setEntityId($entityId);

    public function setRegionId($regionId);

    public function setCityName($cityName);

    public function setLocale($locale);

}
