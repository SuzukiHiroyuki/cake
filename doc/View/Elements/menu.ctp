<?php echo $this->Html->css('home'); ?>

<!-- ***** header ***** -->
<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
	<div class="container">
		<?php echo $this->Html->link('VoSN', '/Users/home', array('class' => 'brand')); ?>
		<ul class="nav">
			
			<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown">
				つながる
				<spna class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><?php echo $this->Html->link('友人を探す', '/Users/user_list'); ?></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown">
				つながり
				<spna class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><?php echo $this->Html->link('友人リスト', '/Friends/myfriend_list'); ?></li>
					<li><?php echo $this->Html->link('ソーシャルグラフ', '/Users/social_graph'); ?></li>
				</ul>
			</li>
			
			
		</ul>
		
		<form class="navbar-search pull-left">
			<input type="text" class="search-query" placeholder="検索">
		</form>
		
		<ul class="nav pull-right">
			<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown">
				<?php echo $username ; ?>
				<spna class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><?php echo $this->Html->link('Logout', '/Users/logout'); ?></li>
				</ul>
			</li>
		</ul>
		
	</div>
	</div>
</div>

<div class="container">
<div class="row">