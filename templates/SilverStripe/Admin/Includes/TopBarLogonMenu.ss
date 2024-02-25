<div class="cms-popup">
    <button class="cms-popup-action" aria-expanded="false" aria-controls="login-content">
        <i class="font-icon-torso"></i>

        <span class="cms-popup-action__text">
            <% with $CurrentMember %>
                <% if $FirstName && $Surname %>
                $FirstName $Surname
                <% else_if $FirstName %>
                    $FirstName
                <% else %>
                    $Email
                <% end_if %>
            <% end_with %>
        </span>

        <i class="font-icon-caret-down-two arrow"></i>
    </button>
    <div class="cms-popup-content" id="login-content">
        <%-- This should live its own include for extensibility --%>
        <ul class="cms-popup-menu">
            <li class="cms-popup-menu__item cms-popup-menu__item--black">
                <a class="cms-popup-menu__link" href="$AdminURL('myprofile')">My profile</a>
            </li>
            <li class="cms-popup-menu__item cms-popup-menu__item--black">
                <a class="cms-popup-menu__link" href="$LogoutURL">Logout</a>
            </li>
        </ul>
    </div>
</div>
