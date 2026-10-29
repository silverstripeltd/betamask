<%-- CMS layout: silverstripe/admin's own template plus the Betamask top bar and feature
     flag messages. CMS 6 measures the <main> column to decide whether the split preview
     fits, so it and the skip link must stay in sync with admin. The messages sit at the
     top of that column, outside the PJAX-swapped content, so a dismissed banner stays
     gone while the user moves between sections. --%>
<!DOCTYPE html>
<html lang="$Locale.RFC1766">
    <head>
    <% base_tag %>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>$Title</title>
</head>
<body class="loading cms" data-frameworkpath="$ModulePath(silverstripe/framework)"
    data-member-tempid="$CurrentMember.TempIDHash.ATT"
>
    <% include SilverStripe\\Admin\\CMSLoadingScreen %>

    <% if $FeatureFlag('Betamask') %>
        <% include SilverStripe\\Admin\\TopBar %>
    <% end_if %>

    <a class="cms-container-skip-link"
       href="#cms-container-skip-link-target"
       tabindex="0"
    ><%t SilverStripe\\Admin\\LeftAndMain.SkipLink "Skip main navigation" %></a>

    <div class="cms-container" data-layout-type="custom">
        $Menu
        <main id="cms-container-skip-link-target"
             class="cms-container-skip-link-target flexbox-area-grow fill-height fill-width"
             tabindex="-1"
        >
            <% if not $FeatureFlag('Betamask') %>
                <% include SilverStripe\\Admin\\FeatureFlag\\Messages %>
            <% end_if %>
            $Content
        </main>
        $PreviewPanel
    </div>
</body>
</html>
