<?php echo $this->element('menu', array('username', $username)); ?>
<?php echo $this->Html->css('d3'); ?>

<div class="span12">

<div id="force_graph"></div>

<table class="table">
	<tr>
		<th>User Name</th>
		<th>Affiliation</th>
	</tr>
	<?php foreach($myfriends_data as $data): ?>
	<tr>
		<td><?php echo $data['Friend']['myfriend_name']; ?></td>
		<td><?php echo $data['Friend']['myfriend_affiliation']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>


</div>


</div>
</div>


<?php echo $this->Html->script('d3.v3.min'); ?>
<script>

	var links = [

		<?php foreach($myfriends_data as $data): ?>
		<?php echo '{source: "' . $username . '", target: "' . $data['Friend']['myfriend_name'] . '"},' ; ?>
		<?php endforeach; ?>

	];

	var nodes = {};

	// Compute the distinct nodes from the links.
	links.forEach(function(link) {
		link.source = nodes[link.source] || (nodes[link.source] = {name: link.source});
		link.target = nodes[link.target] || (nodes[link.target] = {name: link.target});
	});


	var width = 940,
		 height = 600;

	var force = d3.layout.force()
		.nodes(d3.values(nodes))
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
		.text("My Friends");

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

	node.append("image")
		.attr("xlink:href", "/social/img/person.png")
		.attr("x", -8)
		.attr("y", -8)
		.attr("width", 16)
		.attr("height", 16);

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
			.attr({"font-size":20});
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
			.attr({"font-size":10});
	}

</script>