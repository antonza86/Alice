<nav class="restaurant-navigation">
	<ul class="restaurant-navigation__list">
		<li class="restaurant-navigation__list-item active see_menu_box" style="width: 50%;">
			<a href="javascript:void(0);" class="restaurant-navigation__link"><?php echo $this->lang->line('tab_menu'); ?></a>
		</li>
		<li class="restaurant-navigation__list-item hide" style="display: none;">
			<a href="javascript:void(0);" class="restaurant-navigation__link"><?php echo $this->lang->line('tab_feedback'); ?> (<span>3200</span>)</a>
		</li>
		<li class="restaurant-navigation__list-item" id="see_more_info_box" data-type="true" style="width: 50%;">
			<a href="javascript:void(0);" class="restaurant-navigation__link"><?php echo $this->lang->line('tab_more_info'); ?></a>
		</li>
	</ul>
</nav>