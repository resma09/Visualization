<?php include 'nav.html';?>
<html>
	<style>

		.axis path,
		.axis line {
			fill: none;
			stroke: black;
			shape-rendering: crispEdges;
		}

		.axis text {
			font-family: sans-serif;
			font-size: 11px;
		}
        p{
            padding-left: 150px;
            font-style: normal;
            font-size: 20px;
            text-align: left;
        }

	</style>
	<script src="d3.min.js" charset="utf-8">
	</script>

<body>
<p><strong>Districts Vs. Population for Mid-Western Development Region</strong></p>
<script>

var margin = {top:10, right: 10, bottom:100, left:150};
	var w = 1000-margin.left - margin.right;
	var h = 400-margin.top - margin.bottom;



    var svg = d3.select("body")
		.append("svg")
		.attr("width", w + margin.left + margin.right)
		.attr("height", h + margin.top + margin.bottom)
		.append("g")
		.attr("transform","translate(" + margin.left + "," + margin.bottom + ")");

	var y = d3.scale.ordinal()
        .rangeRoundBands([0,h], .1);

  	var x = d3.scale.linear()
        .range([0,w]);

	var xAxis = d3.svg.axis()
        .scale(x)
        .orient("top")
        .tickFormat(d3.format('s'));

  	var yAxis = d3.svg.axis()
          .scale(y)
          .orient("left");


d3.json("json/midwestern_pop1.json", function(error, data){
    x.domain([0,d3.max(data, function(d){return d.population;})]);
    y.domain(data.map(function(d){return d.district;}));

    	
    
    

    svg.selectAll("rect")
    	.data(data)
    	.enter()
    	.append("rect")
        .attr("class", "bar")
    	.attr("y", function(d){
    		return y(d.district)
    	})
    	.attr("height", y.rangeBand())
    	.attr("width", function(d){return x(d.population); })
    	.attr("fill", "MediumAquaMarine")
    	
        .on("mouseover", function() {
        	d3.select(this)
          	 .attr("fill", "DarkSlateGray");
					})
        .on("mouseout", function(d) {
        	d3.select(this)
        		.transition()
        		.duration(150)
        		.attr("fill", "MediumAquaMarine");
						})
             .append("title")
        .text(function(d) {
            return (d.district) + ": " +(d.population) ;
        });
        
       

    svg.append("g")
    	.attr("class","x axis")
    	.call(xAxis)
        .append("text")
        .attr("y",-30)
        .attr("x", (w/2))
        .style("text-anchor","end")
        .text("Population");


    svg.append("g")
    	.attr("class","y axis")
    	.call(yAxis)
        .append("text")
        .attr("transform","rotate(-90)")
        .attr("x",-100)
        .attr("y", -100)
        .style("text-anchor","end")
        .text("Districts");


  
});
</script>
</body>


</html>