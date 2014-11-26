{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblModuleSettings|ucfirst}: {$lblMailchimp}</h2>
</div>

{form:settings}

<div class="box">
	<div class="heading">
		<h3>{$lblGeneral|ucfirst}</h3>
	</div>
    <div class="options">
        {$msgSelectList|ucfirst}
    </div>
	<div class="options">
        {$ddmList}
	</div>
</div>
<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="{$lblSave|ucfirst}" />
		</div>
	</div>
{/form:settings}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}