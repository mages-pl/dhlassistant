<div class="row">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-heading">
				<i class="icon-truck"></i>Wysyłka DHL
			</div>
			{if $dhlassistant_configuration_link}
				<div class="alert alert-warning">
					Moduł nie został skonfigurowany. Można to zrobić <a href="{$dhlassistant_configuration_link}">tutaj</a>.	
				</div>
			{else}
				{if $dhlassistant_sended}
					Przesyłka wysłana.
					<br>
					Link śledzenia przesyłki: <a href="{$dhlassistant_tracking_link}" class="blank" target="_blank" rel=”noopener”>{$dhlassistant_tracking_link}</a>
					<br>
					<a class="btn btn-default" href="{$dhlassistant_edit_link}"><i class="icon-search-plus"></i> Zobacz szczegóły przesyłki</a>
					<br>
					<span class="btn-group">
						{foreach from=$dhlassistant_label_links key='name' item='label_link'}
							<a class="btn btn-default _blank" href="{$label_link}" target="_blank" rel=”noopener”><i class="icon-file-text"></i> Etykieta {$name}</a>
						{/foreach}
					</span>
				{else}
					{if $dhlassistant_country_not_supported}
						Kraj docelowy nie jest dostępny.
					{else}
						<a class="btn btn-default" href="{$dhlassistant_edit_link}"><i class="icon-pencil"></i> Edytuj zlecenie przesyłki</a>
					{/if}
				{/if}
			{/if}
		</div>
	</div>
</div>