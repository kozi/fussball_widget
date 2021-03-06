/*
 * fussball_widget
 * http://kozianka.de/
 * Copyright (c) 2011-2015 Martin Kozianka
 *
 */
if (!String.prototype.fulltrim) {
    String.prototype.fulltrim=function(){return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,'').replace(/\s+/g,' ');};
}

var FussballWidget = function() {
    var rendered   = false;
    var id         = null;
    var div_id     = null;
    var team       = null;
    var wettbewerb = null;

    return {
        ergebnisse: function() {
            this.wettbewerb.zeigeBegegnungen(this.div_id);
            return false;
        },
        tabelle: function() {
            this.wettbewerb.zeigeTabelle(this.div_id);
            return false;
        },
        init: function(id, wettbewerbs_id, team) {
            // id setzen
            this.id = id;
            this.rendered = false;
            this.div_id = 'id' + this.id;

            this.wettbewerb = new fussballdeAPI();

            this.wettbewerb.setzeWettbewerb(wettbewerbs_id);

            if (team.length > 0) {
                this.team = team.toLowerCase().fulltrim();
                this.postRender();
            }
        },

        postRender: function() {
            window.setTimeout(this.id + '.postRender()', 2000);

            if (this.rendered) {
                return false;
            }
            var iframe = jQuery('#'+this.div_id+' iframe');

            if (iframe.length == 0) {
                return false;
            }
            iframe.attr('width', '100%');
            // iframe.attr('height', '600px');

            console.log('postRender', iframe.length, this.rendered, this.id, iframe);

            /*
             divEl = document.getElementById('fussballdeAPI');
             if (divEl == null) { return false; }

             table = document.getElementById(this.div_id).getElementsByClassName('egmSnippetContent')[0];
             if (table == null) { return false; }

             a_nodes = table.getElementsByTagName('a');

             for (i = 0;i < a_nodes.length; i++) {
             node = a_nodes[i].firstChild;
             if (node.nodeType == 3) {
             value = node.nodeValue.toLowerCase().fulltrim();
             if (value == this.team) {
             row = node.parentNode.parentNode.parentNode;
             row.id = "fussball_widget_highlighted_row";
             }
             }
             }
             */

        }

    };

};

