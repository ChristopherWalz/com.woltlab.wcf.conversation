<article class="message messageReduced">
	<div>
		<section class="messageContent">
			<div>
				<header class="messageHeader">
					<div class="box32">
						{if $message->userID}
							<a href="{link controller='User' object=$message->getUserProfile()->getDecoratedObject()}{/link}" class="framed">{@$message->getUserProfile()->getAvatar()->getImageTag(32)}</a>
						{else}
							<span class="framed">{@$message->getUserProfile()->getAvatar()->getImageTag(32)}</span>
						{/if}
						
						<div class="messageHeadline">
							<h1>{if $message->getConversation()->canRead()}<a href="{@$message->getLink()}">{$message->getTitle()}</a>{else}{$message->getTitle()}{/if}</h1>
							<p>
								<span class="username">{if $message->userID}<a href="{link controller='User' object=$message->getUserProfile()->getDecoratedObject()}{/link}">{$message->getUsername()}</a>{else}{$message->getUsername()}{/if}</span>
								{@$message->getTime()|time}
							</p>
						</div>
					</div>
				</header>
				
				<div class="messageBody">
					<div>
						<div class="messageText">
							{@$message->getFormattedMessage()}
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</article>