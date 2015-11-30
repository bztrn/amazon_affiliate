<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Sascha Egerer <info@sascha-egerer.de>
 *  (c) 2015 Alexander Schnitzler <aschnitzler@marketing-factory.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
namespace Mfc\AmazonAffiliate\Hook;

use Mfc\AmazonAffiliate\Domain\Model\Product;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class AsinEvaluator
 * @package Mfc\AmazonAffiliate\Hooks
 */
class AsinEvaluatorHook
{

    /**
     * Validate a single or a list of ASIN's
     *
     * @param $value
     * @param $is_in
     * @param $set
     * @return string
     */
    public function evaluateFieldValue($value, $is_in, &$set)
    {
        $value = trim($value);
        if ($value != '') {
            $asinArray = GeneralUtility::trimExplode(LF, $value, true);
            foreach ($asinArray as $asin) {
                // create a product instance wich checks if the product is valid
                /**
                 * Hint: The object acts like an active record,
                 * so the destructor takes care of properly
                 * updating the cached db record.
                 *
                 * Therefore, only an instance has to be created,
                 * but not assigned to a variable.
                 */
                GeneralUtility::makeInstance(Product::class, $asin);
            }

        }

        return $value;
    }

}
