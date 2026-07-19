<?php declare(strict_types=1);

namespace SilverStripe\Betamask\Extension;

use SilverStripe\Admin\CMSProfileController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\Form;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;

/**
 * Applied to FormRequestHandler. Forces a full CMS reload after the current
 * member saves their profile with the Betamask admin-theme flag toggled.
 *
 * The theme assets are only loaded at LeftAndMain init, so without a reload the
 * change would not appear until the next manual refresh. This mirrors how the
 * core reloads the CMS when a member changes their Locale.
 *
 * @method \SilverStripe\Forms\FormRequestHandler getOwner()
 * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
 */
class ProfileFormReload extends Extension
{

    private const string FEATURE_FIELD = 'FeatureFlag_Betamask';

    /**
     * The flag value for the current member captured before the save runs.
     */
    private ?bool $flagBefore = null;

    public function beforeCallFormHandler(
        HTTPRequest $request,
        string $funcName,
        array $vars,
        Form $form,
        object $subject,
    ): void {
        if (!$this->isProfileSave($funcName, $subject)) {
            return;
        }

        // The profile always edits the current logged-in user.
        $member = Security::getCurrentUser();
        $this->flagBefore = $member instanceof Member && (bool) $member->{self::FEATURE_FIELD};
    }

    public function afterCallFormHandler(
        HTTPRequest $request,
        string $funcName,
        array $vars,
        Form $form,
        object $subject,
        mixed $result,
    ): void {
        // Only set by beforeCallFormHandler for the profile save action.
        if ($this->flagBefore === null || !$result instanceof HTTPResponse) {
            return;
        }

        $flagAfter = array_key_exists(self::FEATURE_FIELD, $vars)
            ? (bool) $vars[self::FEATURE_FIELD]
            : $this->flagBefore;
        $changed = $this->flagBefore !== $flagAfter;
        $this->flagBefore = null;

        if (!$changed) {
            return;
        }

        // Force the CMS to fully reload so the (de)activated theme assets apply.
        $result->addHeader('X-Reload', true);
        $result->addHeader('X-ControllerURL', $subject->Link());
    }

    private function isProfileSave(string $funcName, object $subject): bool
    {
        return strtolower($funcName) === 'save' && $subject instanceof CMSProfileController;
    }

}
