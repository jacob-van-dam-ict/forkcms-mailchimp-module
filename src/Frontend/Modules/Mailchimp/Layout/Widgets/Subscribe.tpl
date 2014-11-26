<div id="mailchimpSubribeWidget">
    <div class="titleBar">
        {$lblNewsletter|ucfirst}
    </div>
    {form:subscribe}
    <p>{$msgFillOutToSubscribe|ucfirst}</p>
    <p>
        {$txtSubscriber}
        {$txtSubscriberError}
    </p>
    <p>
        <input id="mailchimpSubscribe" class="inputSubmit" type="submit" name="comment" value="{$lblSubscribe|ucfirst}" />
    </p>
    <p class="resultMessage">{$msgSubscribed|ucfirst}</p>
    {/form:subscribe}
</div>