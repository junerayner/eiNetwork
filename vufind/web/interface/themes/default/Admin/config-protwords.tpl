<div id="page-content" class="content">
  <div id="sidebar">
    {include file="MyResearch/menu.tpl"}
    
    {include file="Admin/menu.tpl"}
  </div>
  
  <div id="main-content">
          <h1>Protected Words Configuration</h1>
          {include file="Admin/savestatus.tpl"}

          <p>
            The Protected Words are a list of words that will prevent VuFind from using word stemming on.
          </p>

          <form method="post">
            <textarea name="protwords" rows="20" cols="20">{$protwords|escape}</textarea><br />
            <input type="submit" name="submit" value="Save">
          </form>
  </div>
</div>