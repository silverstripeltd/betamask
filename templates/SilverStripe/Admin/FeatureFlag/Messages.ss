<% if $FeatureMessages %>
    <div class="msg-banners">
    <% loop $FeatureMessages %>
      <div id="site-banner-{$Name}" data-id="{$Name}" class="message-box message-box--success alert alert-success alert-dismissible fade show msg-banners__item" role="alert">
        <button data-id="{$Name}" type="button" class="close msg-banners__close" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="msg-banners__content">{$Message}</div>
      </div>
    <% end_loop %>
    </div>
<% end_if %>
