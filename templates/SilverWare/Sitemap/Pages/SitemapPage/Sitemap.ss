<% if $Sitemap %>
  <div class="sitemap">
    <% include SilverWare\Sitemap\Pages\SitemapPage\Children Children=$Sitemap, LinkText=$LinkText, LinkIcon=$LinkIcon %>
  </div>
<% else %>
  <% include Alert Type='warning', Text=$NoDataMessage %>
<% end_if %>
