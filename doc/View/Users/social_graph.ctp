<?php echo $this->element('menu', array('username', $username)); ?>
<?php echo $this->Html->css('d3'); ?>

<div class="span12">
	<div id="force_graph"></div>
	
</div>


</div>
</div>

<?php echo $this->Html->script('d3.v3.min'); ?>
<script type="text/javascript">


	var nodes = [

		<?php foreach($users_data as $data): ?>
		<?php echo '{name: "' . $data['User']['username'] . '", type: "' . $data['User']['affiliation'] . '"},' ; ?>
		<?php endforeach; ?>

	];

	var links = [

		<?php foreach($users_data as $data): ?>
		<?php if(is_array($data)): ?>
		<?php foreach($data['Friend'] as $data1): ?>
		<?php echo '{source:' . ($data1['user_id']-1) . ', target:' . ($data1['myfriend_id']-1) . '},' ; ?>
		<?php endforeach; ?>
		<?php endif; ?>
		<?php endforeach; ?>

	];



	var width = 940,
		 height = 600;

	var force = d3.layout.force()
		.nodes(nodes)
		.links(links)
		.gravity(1)
		.size([width, height])
		.linkDistance(200)
		.charge(-10000)
		.on("tick", tick)
		.start();

	var svg = d3.select("#force_graph").append("svg")
		.attr("width", width)
		.attr("height", height);
		

	svg.append('text')
		.attr({
			x:380,
			y:35,
			fill: "black",
			"font-size":35
		})
		.text("Social Graph");

	var link = svg.selectAll(".link")
		.data(force.links())
		.enter().append("line")
		.attr("class", "link");

	var node = svg.selectAll(".node")
		.data(force.nodes())
		.enter().append("g")
		.attr("class", "node")
		.on("mouseover", mouseover)
		.on("mouseout", mouseout)
		.call(force.drag);

	node.append("circle")
		.attr("r", 8);


	node.append("text")
		.attr("x", 12)
		.attr("dy", ".35em")
		.attr({"font-size":10})
		.text(function(d) { return d.name; });

	function tick() {
		link
		.attr("x1", function(d) { return d.source.x; })
		.attr("y1", function(d) { return d.source.y; })
      .attr("x2", function(d) { return d.target.x; })
      .attr("y2", function(d) { return d.target.y; });

	node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });}


	function mouseover() {
		d3.select(this).select("circle").transition()
			.duration(750)
			.attr("r", 16);
		d3.select(this).select("image").transition()
			.duration(750)
			.attr("x", -15)
			.attr("y", -15)
			.attr("width", 30)
			.attr("height", 30);
		d3.select(this).select("text").transition()
			.duration(750)
			.attr("x", 20)
			.attr({"font-size":20})
			.text(function(d) { return (d.name + ' (' + d.type + ')'); });
	}

	function mouseout() {
		d3.select(this).select("circle").transition()
			.duration(750)
			.attr("r", 8);
		d3.select(this).select("image").transition()
			.duration(750)
			.attr("x", -8)
			.attr("y", -8)
			.attr("width", 16)
			.attr("height", 16);
		d3.select(this).select("text").transition()
			.duration(750)
			.attr("x", 12)
			.attr({"font-size":10})
			.text(function(d) { return d.name ; });
	}
	



</script>