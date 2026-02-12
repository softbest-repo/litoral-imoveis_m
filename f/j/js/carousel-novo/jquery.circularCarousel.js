(function($){
	$.fn.circularCarousel = function(visible, scroll, speed, prev, next, auto, theDelay, stopAutoAfterClick){
		var element = this;
		var elemLeft = 0;
		var noOfChildren = element.children().length;
		var firstChild = element.children(":first");
		var lastChild = element.children(":last");
		var one_height = firstChild.outerHeight(true);
		var one_width = firstChild.outerWidth(true);
		var noOfAffectedItems = scroll;
		var scrollWidth = one_width * scroll;
		var last_right_margin = parseFloat(firstChild.css('marginRight'));
		var theInterval;
		theDelay = theDelay * 1000;
		var maskWidth = visible * one_width - last_right_margin;
		var maskStyle = "width: " + maskWidth + "px; " + "height: " + one_height + "px; " + "position: relative; overflow: hidden;";
		
		element.wrap('<div class="mask" style="' + maskStyle + '"></div>');
		element.css({
			"position": "absolute",
			"top": "0",
			"left": "0",
			"width": noOfChildren * one_width + "px",
			"height": one_height + "px"
		});
		
		if(noOfChildren - scroll < scroll){
			noOfAffectedItems = 2 * scroll - noOfChildren;
		}
		
		function moveItem(start, cate){
			for(i = 1; i <= cate; i++){
				element.children(':eq('+start+')').clone(true).appendTo(element);
				element.children(':eq('+start+')').detach();
			}
			firstChild = element.children(":first");
			lastChild = element.children(":last");
		}
		
		function preClickNext(){
			next.unbind().bind('click', function(){ return false; });
			clearInterval(theInterval);
			if(noOfAffectedItems > 1){
				for(i = 0; i< noOfAffectedItems; i++){
					element.children(':eq('+i+')').clone(true).appendTo(element);
				}
				element.width((noOfChildren + noOfAffectedItems) * one_width);
			}
			clickNext();
			return false;
		}
		
		function clickNext(){
			element.animate({"left": -scrollWidth + "px"}, speed, "linear", function(){
				next.unbind().bind('click', preClickNext);
				if(noOfAffectedItems != 1){
					moveItem(noOfAffectedItems, scroll-noOfAffectedItems);
					for(i = 1; i <= noOfAffectedItems; i++){
						element.children(':eq(0)').detach();
					}
				} else {
					moveItem(0, scroll);
				}
				element.css("left", "0px");
				if(auto && !stopAutoAfterClick){
					theInterval = setInterval(preClickNext, theDelay);
				}
			});
			return false;
		}
		
		function preClickPrev(){
			prev.unbind().bind('click', function(){ return false; });
			clearInterval(theInterval);
			for(i = 1; i <= scroll; i++){
				var exp = noOfChildren - 1;
				element.children(':eq('+ exp +')').clone(true).prependTo(element);
			}
			element.width((noOfChildren + scroll) * one_width).css('left', -scrollWidth + 'px');
			clickPrev();
			return false;
		}
		
		function clickPrev(){
			element.animate({"left": "0px"}, speed, "linear", function(){
				prev.unbind().bind('click', preClickPrev);
				for(i = 1; i <= scroll; i++){
					element.children(':eq('+ noOfChildren +')').detach();
				}
				element.width(noOfChildren * one_width);
				if(auto && !stopAutoAfterClick){
					theInterval = setInterval(preClickNext, theDelay);
				}
			});
			return false;
		}
		
		next.click(preClickNext);
		prev.click(preClickPrev);
		
		if(auto){
			theInterval = setInterval(preClickNext, theDelay);
		}
	};
})(jQuery);