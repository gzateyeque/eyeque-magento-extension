function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return '';
}

var margin = {top: 20, right: 0, bottom: 80, left: 60},
    width = 980 - margin.left - margin.right,
    height = 600 - margin.top - margin.bottom;


// Create a new JavaScript Date object based on the timestamp
// multiplied by 1000 so that the argument is in milliseconds, not seconds.

function type(d) {
    
    var timestamp = Date.parse(d.createdAt);
    var offset = new Date().getTimezoneOffset();
    var date = new Date(timestamp);
    var parseTime = d3.time.format("%b%_d,%Y %H:%M:%S");    

    d.createdAt = parseTime(date);
    return d;
}

var mouse_start_pos;
var mouse_end_pos;
var current_point_r = 99999;
var current_domain_left;
var current_domain_right;
var initial_domain_left;
var initial_domain_right;
var touches = 0;
var touches_pos = [[0,0],[0,0]];
var touch_scale = 0;
var touch_drag = 0;
var min_domain_x = -9999999999;
var max_domain_x = 9999999999;
var domain_max_padding = 0.2;
var swipe_dis = 0;
var dataset;
var max_word_length = 180;
var max_window;
var min_window;

var x = d3.scale.linear()
    .range([0, width]);

var y = d3.scale.linear()
    .range([height, 0]);

var zoom = d3.behavior.zoom()
.on("zoom", zoomed);

var drag = d3.behavior.drag()
.origin(function(d) { return d; })
.on("dragstart", dragstarted)
.on("drag", dragged)
.on("dragend", dragended);

function onLoadFile(error, data) {
  var column_names = ["testConditionID","createdAt","sphEOD","sphEOS","sphOD","sphOS","axisOD","axisOS","cylOD","cylOS"];

  if(jQuery.inArray(results_csv_column,column_names)<0 || typeof(data) == "undefined" || data.length == 0)
  {
	current_domain_left = 0;
	current_domain_right = 1;
	time_window = 1;
	svg.append("text")
 	     .attr("x", width/2)
 	     .attr("y", height/2)
 	     .attr("class", "no-data")
 	     .text("No data.");
        if (error) throw error;
        return;
  }
  if (error) throw error;
  for(var i = 0; i < data.length; i++)
  {
      data[i].index = i;
  } 
  dataset = data;
  
  

  // Compute the minimum and maximum date, and the maximum value.
    var i_end = data.length - 1;
    var i_start = Math.floor(d3.max([0.8*(data.lenth-1), data.length-6, 0]));
  if(data.length == 1)
  {
	current_domain_left = -1-0.3;
  	current_domain_right = 1-0.3;
  	time_window = 1.0*current_domain_right - 1.0*current_domain_left;
  }
  else
  {
	current_domain_left = data[i_start].index;
        current_domain_right = d3.max([data[i_end].index,1]);
        time_window = 1.0*current_domain_right - 1.0*current_domain_left;
  }
  
  
    current_domain_left = current_domain_left + 0.15 * time_window;
    current_domain_right = current_domain_right + 0.15 * time_window;
    initial_domain_left =current_domain_left;
    initial_domain_right =current_domain_right;   

    var min_data = d3.min(data, function(d) { return d[results_csv_column]*1.0; });
    var max_data = d3.max(data, function(d) { return d[results_csv_column]/1.0; });
    if(max_data - min_data <=0.1)
    {	
	min_data = min_data -1;
	max_data = max_data +1;
    }
  
    
    x.domain([current_domain_left, current_domain_right]);
    y.domain([ min_data - 0.5*(max_data-min_data), max_data + 0.5*(max_data-min_data)]).nice().clamp(true).ticks(4);
  min_domain_x = 1.0*data[0].index;
  max_domain_x = d3.max([1.0*data[data.length - 1].index,1]);


  svg
      .datum(data)
       .on("dblclick", dblclick);
  
       
  svg.append("path")
      .attr("class", "area")
      .attr("clip-path", "url(#clip)")
      .attr("d", area);
  svg.append("g")
       .attr("class", "x axis")
       .attr("transform", "translate(0," + (height+15) + ")")
       .call(xAxis)
      .selectAll(".tick text")
       .call(wrap, max_word_length);

  svg.append("path")
      .attr("class", "line")
      .attr("id", "myline")
      .attr("clip-path", "url(#clip)")
      .attr("d", line);
 
/* svg.append("text")
      .attr("x", width - 6)
      .attr("y", height - 6)
      .style("text-anchor", "end")
      .text("Last update:" + data[data.length-1].createdAt);
 */      
   var pointRadius = 12;
   var dataCirclesGroup = null;
   
   // Draw the points
   if (!dataCirclesGroup) {
   dataCirclesGroup = svg.append('svg:g');
   }
   circles = dataCirclesGroup.selectAll('.data-point').data(data);
   
   circles
   .enter()
   .append('svg:circle')
   .attr('class', 'data-point')
   .style('opacity', 1)
   .attr('cx', function(d) { return x(d.index)>0?x(d.index):-9999999999; })
   .attr('cy', function(d) { return y(d[results_csv_column]); })
   .attr('r', function() { return pointRadius; });
   circles.exit().transition()
				.style("opacity", 1e-6)
				.remove();
 

  svg.append("g")
      .attr("class", "y axis")
      .attr("transform", "translate(" + 0 + ",0)")
      .call(yAxis);

  //on double click, reset the view.
  function dblclick() {
    
    time_window = 1.0*initial_domain_right - 1.0*initial_domain_left;
    current_domain_left = 1.0*initial_domain_left;
    current_domain_right = 1.0*initial_domain_right;
    change_xAxis();
    x.domain([initial_domain_left, initial_domain_right]);
    var t = svg.transition().duration(300);
    t.select(".x.axis").call(xAxis).selectAll(".tick text")
       .call(wrap, max_word_length);
    t.select(".area").attr("d", area);
    t.select(".line").attr("d", line);
    circles.transition().duration(300).attr("cx",function(d) {
          var x_d = x(d.index); if(x_d >= 0 && x_d <= width)return x_d; else return -9999999999;});
  }
}


var insertLinebreaks = function (d) {
    var el = d3.select(this);
    var words = d.split(' ');
    el.text('');

    for (var i = 0; i < words.length; i++) {
        var tspan = el.append('tspan').text(words[i]);
        if (i > 0)
            tspan.attr('x', 0).attr('dy', '15');
    }
};



function change_xAxis()
{
   
        xAxis =	d3.svg.axis()
        .scale(x)
        .ticks(5).tickPadding(5)
        .tickFormat(function(d) {
         if(d == Math.floor(d) && d>=0 && d < dataset.length)
         {
            return dataset[d].createdAt;
         }
         else return "";
         })
        .tickSize(-height);
}


var xAxis =	d3.svg.axis()
    	.scale(x)
.ticks(5).tickPadding(5)
.tickFormat(function(d) {
     if(d == Math.floor(d) && d>=0 && d < dataset.length)
     {
        return dataset[d].createdAt;
     }
     else return "";}).tickSize(-height);
var yAxis = d3.svg.axis()
    .scale(y)
    .ticks(6)
    .orient("left");

var area = d3.svg.area()
    .interpolate("cardinal")
    .x(function(d) { return x(d.index); })
    .y0(function(d) { return y(0); })
    .y1(function(d) { return y(d[results_csv_column]); });

var line = d3.svg.line()
    .interpolate("cardinal")
    .x(function(d) { return x(d.index); })
    .y(function(d) { return y(d[results_csv_column]); });




svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")").call(zoom).call(drag);

var container = svg.append("g");

svg.append("clipPath")
    .attr("id", "clip")
  .append("rect")
    .attr("width", width)
    .attr("height", height);


document.addEventListener('touchstart', onTouchStart);
document.addEventListener('touchmove', onTouchMove);
document.addEventListener('touchend', onTouchEnd);
document.addEventListener('touchcancel', onTouchEnd);
document.addEventListener('mousewheel', onMouseWheel);




function zoomed() {
 //   svg.attr("transform","translate(" + d3.event.translate + ")");
 //   svg.attr("transform","scale(" + d3.event.scale + ")");
 //   circles.attr("transform","translate(" + d3.event.translate + ")");
 //   console.log(d3.event.scale);
 //   console.log(d3.event.translate);

}

function dragstarted() {
    var coords = d3.mouse(this);
    mouse_start_pos = coords;
    d3.event.sourceEvent.stopPropagation();
    d3.select(this).classed("dragging", true);
}

function dragged() {
    if(touch_scale == 0)
    {
        var coords = d3.mouse(this);
        mouse_current_pos = coords;
        var factor = 1.0*(mouse_current_pos[0]-mouse_start_pos[0])/width;
        mouse_start_pos = coords;
        if(factor > 0.05)factor = 0.05;
        if(factor < -0.05)factor = -0.05;
        var offset = -1* factor * (1.0*current_domain_right - 1.0*current_domain_left);
        current_domain_left = 1.0*current_domain_left + offset;
        current_domain_right = 1.0*current_domain_right + offset;
        if(current_domain_left < min_domain_x - time_window * domain_max_padding){current_domain_left = min_domain_x - time_window * domain_max_padding; current_domain_right = current_domain_left + time_window;};
        if(current_domain_right > max_domain_x + time_window * domain_max_padding){current_domain_right = max_domain_x + time_window * domain_max_padding; current_domain_left = current_domain_right - time_window;}

        x.domain([1.0*current_domain_left,1.0 * current_domain_right]);
        
        var t = svg.transition().duration(0);
        t.select(".x.axis").call(xAxis).selectAll(".tick text")
       .call(wrap, max_word_length);
        t.select(".area").attr("d", area);
        t.select(".line").attr("d", line);
        update_target_data();


    }
    else
    {
        var coords = d3.mouse(this);
        mouse_current_pos = coords;
    }
}

function dragended(d) {
    d3.select(this).classed("dragging", false);
}

// use jqury double tap detection to handle smartphone double tap
$("svg").on('doubletap',function(event){
       if(touch_scale == 0 || touch_scale == -1 || touch_scale == 1)
       {
       		if(touch_scale == 1 && swipe_dis > 100)
       		{
				//do nothing because it is a swipe, not a double tap
       		}
       		else{
                time_window = initial_domain_right - initial_domain_left;
                current_domain_left = 1.0*initial_domain_left;
                current_domain_right = 1.0*initial_domain_right;
                change_xAxis();
                
                x.domain([initial_domain_left, initial_domain_right]);
                var t = svg.transition().duration(300);
                t.select(".x.axis").call(xAxis).selectAll(".tick text")
       .call(wrap, max_word_length);
                t.select(".area").attr("d", area);
                t.select(".line").attr("d", line);
                circles.transition().duration(300).attr("cx",function(d) {
          var x_d = x(d.index); if(x_d >= 0 && x_d <= width)return x_d; else return -9999999999;});

       		}
       } 
       else
       {
       }
    
});


function onTouchStart(event) {
    event.preventDefault();
    if(touch_scale != 2)touch_scale = 0;
    if (event.touches.length === 1) {
        if(touch_scale != 2)touch_scale = 1;
        touches_pos[0][0] = event.touches[0].clientX;
        touches_pos[0][1] = event.touches[0].clientY;
    } else if (event.touches.length === 2) {
        touches_pos[0][0] = event.touches[0].clientX;
        touches_pos[0][1] = event.touches[0].clientY;
        touches_pos[1][0] = event.touches[1].clientX;
        touches_pos[1][1] = event.touches[1].clientY;
        touch_scale = 2;
    }
}




function onTouchMove(event) {
    event.preventDefault();
    if (event.touches.length === 1) {
        

        if(touch_scale == 0)
        {
            touch_scale = 1;
            touches_pos[0][0] = event.touches[0].clientX;
            touches_pos[0][1] = event.touches[0].clientY;
        }
        else if(touch_scale === 1 )
        {
            var factor = 1.0 * (event.touches[0].clientX - touches_pos[0][0])/width;
            if(factor > 0.05)factor = 0.05;
            if(factor < -0.05)factor = -0.05
            
            swipe_dis = norm(touches_pos[0][0],touches_pos[0][1],event.touches[0].clientX,event.touches[0].clientY);
            touches_pos[0][0] = event.touches[0].clientX;
            touches_pos[0][1] = event.touches[0].clientY;
            var offset = -1* factor * (1.0*current_domain_right - 1.0*current_domain_left);
            current_domain_left = 1.0*current_domain_left + offset;
            current_domain_right = 1.0*current_domain_right + offset;
            if(current_domain_left < min_domain_x - time_window * domain_max_padding){current_domain_left = min_domain_x - time_window * domain_max_padding; current_domain_right = current_domain_left + time_window;};
            if(current_domain_right > max_domain_x + time_window * domain_max_padding){current_domain_right = max_domain_x + time_window * domain_max_padding; current_domain_left = current_domain_right - time_window;};
            x.domain([1.0*current_domain_left,1.0 * current_domain_right]);

            
            var t = svg.transition().duration(0);
            t.select(".x.axis").call(xAxis).selectAll(".tick text")
       .call(wrap, max_word_length);
            t.select(".area").attr("d", area);
            t.select(".line").attr("d", line);
            update_target_data();

        }
       
        
        
    } else if (event.touches.length === 2) {
        
        if(touch_scale === 0)
        {
        	    touch_scale = 2;
        	    touches_pos[0][0] = event.touches[0].clientX;
            touches_pos[0][1] = event.touches[0].clientY;
            touches_pos[1][0] = event.touches[1].clientX;
            touches_pos[1][1] = event.touches[1].clientY;
        	    
        	}
		else if(touch_scale === 2)
        {
            var old_dis = norm(touches_pos[0][0],touches_pos[0][1],touches_pos[1][0],touches_pos[1][1]);
        		var new_dis = norm(event.touches[0].clientX,event.touches[0].clientY,event.touches[1].clientX,event.touches[1].clientY);
        		var factor = 0.5;
        		var scale_size;
        		if(old_dis <= 0.001)scale_size = 1;
        		else scale_size = new_dis / old_dis;
        		scale_size = scale_size * scale_size;
        		if(scale_size > 1.3)scale_size = 1.3;
        		if(scale_size < 0.7)scale_size = 0.7;
        		
        		time_window = 1.0*current_domain_right - 1.0*current_domain_left;
        		var new_domain_left = 1.0*current_domain_left + factor * time_window - 0.5/scale_size * time_window;
        		var new_domain_right = new_domain_left + 1.0/scale_size * time_window;
        		touches_pos[0][0] = event.touches[0].clientX;
        		touches_pos[0][1] = event.touches[0].clientY;
        		touches_pos[1][0] = event.touches[1].clientX;
        		touches_pos[1][1] = event.touches[1].clientY;
        		time_window = 1.0*new_domain_right - 1.0*new_domain_left;
        		if(time_window <= (max_domain_x-min_domain_x))
        		{
            		current_domain_left = 1.0*new_domain_left;
            		current_domain_right = 1.0*new_domain_right;
            		if(current_domain_left < min_domain_x - time_window * domain_max_padding){current_domain_left = min_domain_x - time_window * domain_max_padding; current_domain_right = current_domain_left + time_window;};
            		if(current_domain_right > max_domain_x + time_window * domain_max_padding){current_domain_right = max_domain_x + time_window * domain_max_padding; current_domain_left = current_domain_right - time_window;};
            		change_xAxis();
            		x.domain([current_domain_left, current_domain_right]);
            		var t = svg.transition().duration(0);
            		t.select(".x.axis").call(xAxis).selectAll(".tick text")
       		.call(wrap, max_word_length);
            		t.select(".area").attr("d", area);
            		t.select(".line").attr("d", line);
            		update_target_data();
					
        		}
        		   		
        }

    }
    
}

function onTouchEnd(event) {
    event.preventDefault();
    if(touch_scale >= 0 ){touch_scale = -1 * touch_scale;setTimeout(function(){ touch_scale = 0; }, 500);}
    else touch_scale = 0;
}

function norm(x0,y0,x1,y1)
{
     return Math.sqrt(1.0*(x1-x0)*(x1-x0) + 1.0*(y1-y0)*(y1-y0));
}
function onMouseWheel(event)
{
    var wheel_scale = 1;
    if(event.deltaY>=1)
    {
        wheel_scale = 0.9;
    }
    else if(event.deltaY<=-1)
    {
        wheel_scale = 1.05;
    }
    if(wheel_scale != 1)
    {
        time_window = 1.0*current_domain_right - 1.0*current_domain_left;
        var factor = 0.5;
        var new_domain_left = 1.0*current_domain_left + factor * time_window - 0.5/wheel_scale * time_window;
        var new_domain_right = new_domain_left + 1.0/wheel_scale * time_window;


        time_window = 1.0*new_domain_right - 1.0*new_domain_left;
        if(time_window <= (max_domain_x-min_domain_x))
        {
            current_domain_left = 1.0*new_domain_left;
            current_domain_right = 1.0*new_domain_right;
            if(current_domain_left < min_domain_x - time_window * domain_max_padding){current_domain_left = min_domain_x - time_window * domain_max_padding; current_domain_right = current_domain_left + time_window;};
            if(current_domain_right > max_domain_x + time_window * domain_max_padding){current_domain_right = max_domain_x + time_window * domain_max_padding; current_domain_left = current_domain_right - time_window;};
            change_xAxis();
            x.domain([current_domain_left, current_domain_right]);
            var t = svg.transition().duration(0);
            t.select(".x.axis").call(xAxis).selectAll(".tick text")
       .call(wrap, max_word_length);
            t.select(".area").attr("d", area);
            t.select(".line").attr("d", line);
            update_target_data();
			
        }
               
    }
}

// Get the coordinates

function update_target_data()
{
    circles.transition().duration(0).attr("cx",function(d) {
          var x_d = x(d.index); if(x_d >= 0 && x_d <= width)return x_d; else return -9999999999;});
}


function wrap(text, width) {
  text.each(function() {
    var text = d3.select(this),
        words = text.text().split(/\s+/).reverse(),
        word,
        line = [],
        lineNumber = 0,
        lineHeight = 1.1, // ems
        y = text.attr("y"),
        dy = parseFloat(text.attr("dy")),
        tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");
    while (word = words.pop()) {
      line.push(word);
      tspan.text(line.join(" "));
      if (tspan.node().getComputedTextLength() > width) {
        line.pop();
        tspan.text(line.join(" "));
        line = [word];
        tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
      }
    }
  });
}



