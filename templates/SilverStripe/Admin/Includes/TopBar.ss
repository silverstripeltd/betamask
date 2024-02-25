<div class="cms-top-bar">
    <div class="cms-top-bar__brand">
        <div class="cms-top-bar__mobile-toggle">
            <div class="cms-mobile-menu-toggle-wrapper"></div>
        </div>
        <div class="cms-top-bar__brand-logo">
            <a href="$AdminURL('pages')">
                <img class="cms-image" src="$resourceURL('themes/betamask/dist/images/silverstripe-logo.svg')" alt="Silverstripe CMS" />
            </a>
        </div>

        <div class="cms-top-bar__brand-divider"></div>
        <a class="cms-top-bar__brand-name" target="_blank" href="$BaseHref">
            <% if $SiteConfig %>
                $SiteConfig.Title
            <% else %>
                $ApplicationName
            <% end_if %>
        </a>
        <span class="cms-top-bar__env cms-top-bar__env--{$EnvironmentCss}">{$EnvironmentLabel}</span>
    </div>

    <div class="cms-top-bar__actions">
        <div class="cms-top-bar__actions-item actions__help">
            <% include SilverStripe\Admin\TopBarHelpMenu %>
        </div>

        <div class="cms-top-bar__actions-item actions__username">
            <% include SilverStripe\Admin\TopBarLogonMenu %>
        </div>
    </div>
</div>
