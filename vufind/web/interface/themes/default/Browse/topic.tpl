<script type="text/javascript" src="{$path}/services/Browse/ajax.js"></script>

<div id="page-content" class="content">
            <div class="browseNav" style="margin: 0px;">
            {include file="Browse/top_list.tpl" currentAction="Topic"}
            </div>
            <div class="browseNav" style="margin: 0px;">
            <ul class="browse" id="list2">
              <li><a href="{$path}/Browse/Topic" onclick="highlightBrowseLink('list2', this); LoadAlphabet('topic_facet', 'list3', 'topic_facet'); return false">{translate text="By Alphabetical"}</a></li>
              <li><a href="{$path}/Browse/Topic" onclick="highlightBrowseLink('list2', this); LoadSubject('genre_facet', 'list3', 'topic_facet'); return false">{translate text="By Genre"}</a></li>
              <li><a href="{$path}/Browse/Topic" onclick="highlightBrowseLink('list2', this); LoadSubject('geographic_facet', 'list3', 'topic_facet'); return false">{translate text="By Region"}</a></li>
              <li><a href="{$path}/Browse/Topic" onclick="highlightBrowseLink('list2', this); LoadSubject('era', 'list3', 'topic_facet'); return false">{translate text="By Era"}</a></li>
            </ul>
            </div>
            <div class="browseNav" style="margin: 0px;">
            <ul class="browse" id="list3">
            </ul>
            </div>
            <div class="browseNav" style="margin: 0px;">
            <ul class="browse" id="list4">
            </ul>
            </div>
</div>