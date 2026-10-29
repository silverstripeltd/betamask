<?php

declare(strict_types=1);

namespace SilverStripe\Betamask\Tests;

use SilverStripe\Dev\FunctionalTest;

/**
 * The CMS layout keeps the main column CMS 6 measures to decide whether the split preview fits, and its skip link.
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

}
