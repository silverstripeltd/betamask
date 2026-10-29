<?php

declare(strict_types=1);

namespace SilverStripe\Betamask\Tests;

use SilverStripe\Dev\FunctionalTest;
use SilverStripe\Security\Security;

/**
 * The CMS layout keeps the main column CMS 6 measures to decide whether the split preview fits, and its skip link,
 * and shows the feature banner at the top of that column.
 *
 * phpcs:disable SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
 * SapphireTest::$usesDatabase is untyped, so redeclaring it with a native type is a fatal error.
 */
class LeftAndMainLayoutTest extends FunctionalTest
{

    /**
     * @var bool
     */
    protected $usesDatabase = true;

    public function testLayoutHasTheMainColumnAndSkipLink(): void
    {
        $this->logInWithPermission('ADMIN');

        $body = (string) $this->get('admin/myprofile')->getBody();

        $this->assertMatchesRegularExpression('/<main[^>]+class="cms-container-skip-link-target/', $body);
        $this->assertStringContainsString('class="cms-container-skip-link"', $body);
    }

    public function testFeatureBannerIsInsideTheMainColumn(): void
    {
        $this->logInWithPermission('ADMIN');

        $body = (string) $this->get('admin/myprofile')->getBody();

        $this->assertMatchesRegularExpression(
            '/<main[^>]+class="cms-container-skip-link-target[^>]*>\\s*<div class="msg-banners">/',
            $body,
        );
    }

    public function testFeatureBannerIsHiddenOnceTheFeatureIsOn(): void
    {
        $this->logInWithPermission('ADMIN');
        $member = Security::getCurrentUser();
        $member->FeatureFlag_Betamask = true;
        $member->write();

        $body = (string) $this->get('admin/myprofile')->getBody();

        $this->assertStringNotContainsString('class="msg-banners"', $body);
    }

}
