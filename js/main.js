var graph = new joint.dia.Graph;

// Create a custom element.
// ------------------------
joint.shapes.html = {};
joint.shapes.html.Element = joint.shapes.basic.Rect.extend({
    defaults: joint.util.deepSupplement({
        type: 'html.Element',
        attrs: {
            rect: { stroke: 'none', 'fill-opacity': 0 }
        }
    }, joint.shapes.basic.Rect.prototype.defaults)
});

// Create a custom view for that element that displays an HTML div above it.
// -------------------------------------------------------------------------
joint.shapes.html.ElementView = joint.dia.ElementView.extend({
    template: [
        '<div class="html-element">',
        '<button class="delete">x</button>',
        '<label></label>',
        '<span></span>', '<br/>',
        '<select><option>--</option><option>one</option><option>two</option></select>',
        '<input type="text" value="I\'m HTML input" />',
        '</div>'
    ].join(''),

    initialize: function() {
        _.bindAll(this, 'updateBox');
        joint.dia.ElementView.prototype.initialize.apply(this, arguments);

        this.$box = $(_.template(this.template)());
        // Prevent paper from handling pointerdown.
        this.$box.find('input,select').on('mousedown click', function(evt) {
            evt.stopPropagation();
        });
        // This is an example of reacting on the input change and storing the input data in the cell model.
        this.$box.find('input').on('change', _.bind(function(evt) {
            this.model.set('input', $(evt.target).val());
        }, this));
        this.$box.find('select').on('change', _.bind(function(evt) {
            this.model.set('select', $(evt.target).val());
        }, this));
        this.$box.find('select').val(this.model.get('select'));
        this.$box.find('.delete').on('click', _.bind(this.model.remove, this.model));
        // Update the box position whenever the underlying model changes.
        this.model.on('change', this.updateBox, this);
        // Remove the box when the model gets removed from the graph.
        this.model.on('remove', this.removeBox, this);

        this.updateBox();
    },
    render: function() {
        joint.dia.ElementView.prototype.render.apply(this, arguments);
        this.paper.$el.prepend(this.$box);
        this.updateBox();
        return this;
    },
    updateBox: function() {
        // Set the position and dimension of the box so that it covers the JointJS element.
        var bbox = this.model.getBBox();
        // Example of updating the HTML with a data stored in the cell model.
        this.$box.find('label').text(this.model.get('label'));
        this.$box.find('span').text(this.model.get('select'));
        this.$box.css({
            width: bbox.width,
            height: bbox.height,
            left: bbox.x,
            top: bbox.y,
            transform: 'rotate(' + (this.model.get('angle') || 0) + 'deg)'
        });
    },
    removeBox: function(evt) {
        this.$box.remove();
    }
});

var paper = new joint.dia.Paper({
    el: $('#mygraph'),
    width: 900,
    height: 1000,
    model: graph,
    gridSize: 1,
    interactive: function(cellView, method){
        return { elementMove: false }
    },
});

var redRect = new joint.shapes.basic.Rect({
    position: { x: -120, y: 150 },
    size: { width: 300, height: 30 },
    attrs: { rect: { fill: '#AF0A0A'}, text: { text: 'ORGANIZACIONES INTERNACIONALES', fill: 'white'} }
});

var ylwRect = new joint.shapes.basic.Rect({
    position: { x: 50, y: 15 },
    size: { width: 30, height: 30 },
    attrs: { rect: { fill: '#F0EF19'}}
});

var tilRect = new joint.shapes.basic.Rect({
    position: { x: 85, y: 15 },
    size: { width: 200, height: 30 },
    attrs: { rect: { 'stroke-width': 0 }, text: { text: 'NACIONES UNIDAS', fill: 'black', 'font-weight': 'bold', 'text-align': 'left' } }
});


redRect.rotate(-90, ['absolute'],);

/*
var rect3 = new joint.shapes.basic.Rect({
    position: { x: 300, y: 80 },
    size: { width: 300, height: 30 },
}); 

rect3.attr({
    rect: { fill: '#2C3E50', rx: 5, ry: 5, 'stroke-width': 2, stroke: 'black' },
    text: {
        text: 'my label', fill: '#3498DB',
            'font-size': 18, 'font-weight': 'bold', 'font-variant': 'small-caps', 'text-transform': 'capitalize'
    }
});

var link = new joint.dia.Link({
    source: { id: rect.id },
    target: { id: rect2.id },
});

link.attr({
    '.link-tools': { display: 'none' } 
});
*/


graph.addCells([redRect, ylwRect, tilRect]);

/*
graph.on('all', function(eventName, cell){
    console.log(arguments);
});

rect.on('change:position', function(el){
    console.log(el.id, ':', el.get('position'));
});
*/
