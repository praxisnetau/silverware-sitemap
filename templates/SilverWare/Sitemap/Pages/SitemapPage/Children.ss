<ul class="sitemap-list">
  <% loop $Children %>
    <li class="sitemap-item">
      <a href="$Link" title="<% if $Up.TitleText = 'menu' %>$MenuTitle.ATT<% else %>$Title.ATT<% end_if %>">
        <% include Icon Name=$Up.LinkIcon, FixedWidth=1 %>
        <% if $Up.LinkText = 'menu' %>$MenuTitle.XML<% else %>$Title.XML<% end_if %>
      </a>
      <% if $Children %>
        <% include SilverWare\Sitemap\Pages\SitemapPage\Children LinkText=$Up.LinkText, LinkIcon=$Up.LinkIcon %>
      <% end_if %>
    </li>
  <% end_loop %>
</ul>
