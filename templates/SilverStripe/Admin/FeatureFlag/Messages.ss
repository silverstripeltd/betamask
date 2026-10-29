<% if $FeatureMessages %>
    <div class="msg-banners">
    <% loop $FeatureMessages %>
        <div id="site-banner-{$Name}" data-id="{$Name}" class="msg-banners__item" role="status">
            <div class="msg-banners__content">{$Message}</div>
            <button data-id="{$Name}" type="button" class="msg-banners__close" aria-label="<%t SilverStripe\\Betamask\\FeatureFlag.DISMISS 'Dismiss' %>">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <% end_loop %>
    </div>
<% end_if %>
