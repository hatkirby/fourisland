window.onload = function() {
	      settings = {
	          tl: { radius: 10 },
	          tr: { radius: 10 },
	          bl: { radius: 10 },
	          br: { radius: 10 },
	          antiAlias: true,
	          autoPad: true
	      }
	      var myBoxObject = new curvyCorners(settings, "rounded");
	      myBoxObject.applyCornersToAll();
	  }

