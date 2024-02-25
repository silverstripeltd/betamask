<?php

namespace SilverStripe\Betamask;

use SilverStripe\FeatureFlag\FeatureFlagInterface;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Security\Member;

/**
 * Feature flag to manage enable/disable Betamask theme
 */
class FeatureFlag implements FeatureFlagInterface
{

    public function getName(): string
    {
        return 'Betamask';
    }

    /**
     * Feature enabled at member level. Each member can enable/disable it
     */
    public function checkFeature(?Member $member = null): bool
    {
        return $member instanceof Member && $member->FeatureFlag_Betamask;
    }

    /**
     * If feature not enabled, then we show a message banner
     */
    public function showMessage(?Member $member = null): bool
    {
        return !$this->checkFeature($member);
    }

    public function getMessage(): DBField
    {
        return DBField::create_field(
            'HTMLText',
            '<strong>New CMS design interface is now available!</strong> Turn this feature on in the your ' .
            '<a href="/admin/myprofile/#Root_Features">profile area</a>.',
        );
    }

}
