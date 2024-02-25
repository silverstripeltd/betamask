<div class="cms-popup">
    <button class="cms-popup-action" aria-expanded="false" aria-controls="help-content">
        <i class="font-icon-white-question"></i>
        <span class="cms-popup-action__text">
            Help
        </span>
        <i class="font-icon-caret-down-two arrow"></i>
    </button>
    <div class="cms-popup-content" id="help-content">
        <%-- This should live its own include for extensibility --%>
       <ul class="cms-popup-menu">
            <li class="cms-popup-menu__item">
                 <div class="cms-top-bar__brand-version">
                    <img src="$resourceURL('themes/betamask/dist/images/silverstripe-logo-full.svg')" alt="Silverstripe CMS" />
                    <span class="cms-top-bar__version">
                        <% if $CMSVersionNumber %>
                            v{$CMSVersionNumber}
                        <% end_if %>
                    </span>
                </div>
            </li>

            <% if $HelpLinks %>
                <li class="cms-popup-menu__item cms-popup-menu__item--divider"></li>
                <% loop $HelpLinks %>
                    <% if $URL %>
                        <li class="cms-popup-menu__item cms-popup-menu__item--black">
                            <a class="cms-popup-menu__link" href="$URL" target="_blank" rel="noopener noreferrer">$Title</a>
                        </li>
                    <% end_if %>
                <% end_loop %>
            </ul>
        <% end_if %>
    </div>
</div>
