/*
 * fussball_widget
 * http://kozianka.de/
 * Copyright (c) 2011-2013 Martin Kozianka
 *
 */

var FussballWidget = function() {
	var id = null;
	var div_id = null;
	var team = null;
	var wettbewerb = null;
	
return {

	ergebnisse: function() {
		this.wettbewerb.zeigeWettbewerb(this.div_id);
		return false;
	},
	tabelle: function() {
		this.wettbewerb.zeigeTabelle(this.div_id);
		return false;

	},
	init: function(id, mandant, wettbewerbs_id, team) {
		// id setzen
		this.id = id;
		this.div_id = 'id' + this.id;
		
		this.wettbewerb = new fussballdeAPI();

        // mandant
        this.wettbewerb.setzeMandant(mandant);

        // wettbewerbs_id
        this.wettbewerb.setzeWettbewerb(wettbewerbs_id);



		
		if (team.length > 0) {
			this.team = team;
			this.highlight_team();
		}
	},

	highlight_team: function() {
		window.setTimeout(this.id + '.highlight_team()', 2000);

		divEl = document.getElementById('fussballdeAPI');
		if (divEl == null || document.getElementById('highlighted_row') != null) { 
            return false;
		}

		a_nodes = divEl.getElementsByTagName('a');

		for (i = 0;i < a_nodes.length; i++) {
			node = a_nodes[i].firstChild;
			if (node.nodeType == 3 && node.nodeValue.indexOf(this.team) != -1) {
				row = node.parentNode.parentNode.parentNode;
				row.id = "fussball_widget_highlighted_row";
				
				return true;
			}
		}
		
	}

};

};