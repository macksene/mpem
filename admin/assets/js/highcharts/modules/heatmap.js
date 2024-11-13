/*
 Highmaps JS v7.1.3 (2019-08-14)

 (c) 2009-2019 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(b){"object"===typeof module&&module.exports?(b["default"]=b,module.exports=b):"function"===typeof define&&define.amd?define("highcharts/modules/heatmap",["highcharts"],function(h){b(h);b.Highcharts=h;return b}):b("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(b){function h(e,b,h,r){e.hasOwnProperty(b)||(e[b]=r.apply(null,h))}b=b?b._modules:{};h(b,"parts-map/ColorAxis.js",[b["parts/Globals.js"],b["parts/Utilities.js"]],function(e,b){var h=b.erase,r=b.isNumber;b=e.addEvent;
var k=e.Axis,l=e.Chart,n=e.color,q=e.extend,g=e.Legend,d=e.LegendSymbolMixin,v=e.noop,p=e.merge,t=e.pick;var u=e.ColorAxis=function(){this.init.apply(this,arguments)};q(u.prototype,k.prototype);q(u.prototype,{defaultColorAxisOptions:{lineWidth:0,minPadding:0,maxPadding:0,gridLineWidth:1,tickPixelInterval:72,startOnTick:!0,endOnTick:!0,offset:0,marker:{animation:{duration:50},width:.01,color:"#999999"},labels:{overflow:"justify",rotation:0},minColor:"#e6ebf5",maxColor:"#003399",tickLength:5,showInLegend:!0},
keepProps:["legendGroup","legendItemHeight","legendItemWidth","legendItem","legendSymbol"].concat(k.prototype.keepProps),init:function(a,c){var f="vertical"!==a.options.legend.layout;this.coll="colorAxis";var m=this.buildOptions.call(a,this.defaultColorAxisOptions,c);k.prototype.init.call(this,a,m);c.dataClasses&&this.initDataClasses(c);this.initStops();this.horiz=f;this.zoomEnabled=!1;this.defaultLegendLength=200},initDataClasses:function(a){var c=this.chart,f,m=0,w=c.options.chart.colorCount,e=
this.options,g=a.dataClasses.length;this.dataClasses=f=[];this.legendItems=[];a.dataClasses.forEach(function(a,d){a=p(a);f.push(a);if(c.styledMode||!a.color)"category"===e.dataClassColor?(c.styledMode||(d=c.options.colors,w=d.length,a.color=d[m]),a.colorIndex=m,m++,m===w&&(m=0)):a.color=n(e.minColor).tweenTo(n(e.maxColor),2>g?.5:d/(g-1))})},hasData:function(){return!(!this.tickPositions||!this.tickPositions.length)},setTickPositions:function(){if(!this.dataClasses)return k.prototype.setTickPositions.call(this)},
initStops:function(){this.stops=this.options.stops||[[0,this.options.minColor],[1,this.options.maxColor]];this.stops.forEach(function(a){a.color=n(a[1])})},buildOptions:function(a,c){var f=this.options.legend,m="vertical"!==f.layout;return p(a,{side:m?2:1,reversed:!m},c,{opposite:!m,showEmpty:!1,title:null,visible:f.enabled})},setOptions:function(a){k.prototype.setOptions.call(this,a);this.options.crosshair=this.options.marker},setAxisSize:function(){var a=this.legendSymbol,c=this.chart,f=c.options.legend||
{},m,e;a?(this.left=f=a.attr("x"),this.top=m=a.attr("y"),this.width=e=a.attr("width"),this.height=a=a.attr("height"),this.right=c.chartWidth-f-e,this.bottom=c.chartHeight-m-a,this.len=this.horiz?e:a,this.pos=this.horiz?f:m):this.len=(this.horiz?f.symbolWidth:f.symbolHeight)||this.defaultLegendLength},normalizedValue:function(a){this.isLog&&(a=this.val2lin(a));return 1-(this.max-a)/(this.max-this.min||1)},toColor:function(a,c){var f=this.stops,e=this.dataClasses,d;if(e)for(d=e.length;d--;){var g=e[d];
var b=g.from;f=g.to;if((void 0===b||a>=b)&&(void 0===f||a<=f)){var k=g.color;c&&(c.dataClass=d,c.colorIndex=g.colorIndex);break}}else{a=this.normalizedValue(a);for(d=f.length;d--&&!(a>f[d][0]););b=f[d]||f[d+1];f=f[d+1]||b;a=1-(f[0]-a)/(f[0]-b[0]||1);k=b.color.tweenTo(f.color,a)}return k},getOffset:function(){var a=this.legendGroup,c=this.chart.axisOffset[this.side];a&&(this.axisParent=a,k.prototype.getOffset.call(this),this.added||(this.added=!0,this.labelLeft=0,this.labelRight=this.width),this.chart.axisOffset[this.side]=
c)},setLegendColor:function(){var a=this.reversed;var c=a?1:0;a=a?0:1;c=this.horiz?[c,0,a,0]:[0,a,0,c];this.legendColor={linearGradient:{x1:c[0],y1:c[1],x2:c[2],y2:c[3]},stops:this.stops}},drawLegendSymbol:function(a,c){var f=a.padding,d=a.options,e=this.horiz,g=t(d.symbolWidth,e?this.defaultLegendLength:12),b=t(d.symbolHeight,e?12:this.defaultLegendLength),k=t(d.labelPadding,e?16:30);d=t(d.itemDistance,10);this.setLegendColor();c.legendSymbol=this.chart.renderer.rect(0,a.baseline-11,g,b).attr({zIndex:1}).add(c.legendGroup);
this.legendItemWidth=g+f+(e?d:k);this.legendItemHeight=b+f+(e?k:0)},setState:function(a){this.series.forEach(function(c){c.setState(a)})},visible:!0,setVisible:v,getSeriesExtremes:function(){var a=this.series,c=a.length;this.dataMin=Infinity;for(this.dataMax=-Infinity;c--;)a[c].getExtremes(),void 0!==a[c].valueMin&&(this.dataMin=Math.min(this.dataMin,a[c].valueMin),this.dataMax=Math.max(this.dataMax,a[c].valueMax))},drawCrosshair:function(a,c){var f=c&&c.plotX,d=c&&c.plotY,e=this.pos,g=this.len;if(c){var b=
this.toPixels(c[c.series.colorKey]);b<e?b=e-2:b>e+g&&(b=e+g+2);c.plotX=b;c.plotY=this.len-b;k.prototype.drawCrosshair.call(this,a,c);c.plotX=f;c.plotY=d;this.cross&&!this.cross.addedToColorAxis&&this.legendGroup&&(this.cross.addClass("highcharts-coloraxis-marker").add(this.legendGroup),this.cross.addedToColorAxis=!0,this.chart.styledMode||this.cross.attr({fill:this.crosshair.color}))}},getPlotLinePath:function(a){var c=a.translatedValue;return r(c)?this.horiz?["M",c-4,this.top-6,"L",c+4,this.top-
6,c,this.top,"Z"]:["M",this.left,c,"L",this.left-6,c+6,this.left-6,c-6,"Z"]:k.prototype.getPlotLinePath.apply(this,arguments)},update:function(a,c){var f=this.chart,d=f.legend,e=this.buildOptions.call(f,{},a);this.series.forEach(function(a){a.isDirtyData=!0});a.dataClasses&&d.allItems&&(d.allItems.forEach(function(a){a.isDataClass&&a.legendGroup&&a.legendGroup.destroy()}),f.isDirtyLegend=!0);f.options[this.coll]=p(this.userOptions,e);k.prototype.update.call(this,e,c);this.legendItem&&(this.setLegendColor(),
d.colorizeItem(this,!0))},remove:function(){this.legendItem&&this.chart.legend.destroyItem(this);k.prototype.remove.call(this)},getDataClassLegendSymbols:function(){var a=this,c=this.chart,f=this.legendItems,b=c.options.legend,g=b.valueDecimals,k=b.valueSuffix||"",l;f.length||this.dataClasses.forEach(function(b,m){var n=!0,h=b.from,p=b.to;l="";void 0===h?l="< ":void 0===p&&(l="> ");void 0!==h&&(l+=e.numberFormat(h,g)+k);void 0!==h&&void 0!==p&&(l+=" - ");void 0!==p&&(l+=e.numberFormat(p,g)+k);f.push(q({chart:c,
name:l,options:{},drawLegendSymbol:d.drawRectangle,visible:!0,setState:v,isDataClass:!0,setVisible:function(){n=this.visible=!n;a.series.forEach(function(a){a.points.forEach(function(a){a.dataClass===m&&a.setVisible(n)})});c.legend.colorizeItem(this,n)}},b))});return f},name:""});["fill","stroke"].forEach(function(a){e.Fx.prototype[a+"Setter"]=function(){this.elem.attr(a,n(this.start).tweenTo(n(this.end),this.pos),null,!0)}});b(l,"afterGetAxes",function(){var a=this.options.colorAxis;this.colorAxis=
[];a&&new u(this,a)});b(g,"afterGetAllItems",function(a){var c=[],d=this.chart.colorAxis[0];d&&d.options&&d.options.showInLegend&&(d.options.dataClasses?c=d.getDataClassLegendSymbols():c.push(d),d.series.forEach(function(c){h(a.allItems,c)}));for(d=c.length;d--;)a.allItems.unshift(c[d])});b(g,"afterColorizeItem",function(a){a.visible&&a.item.legendColor&&a.item.legendSymbol.attr({fill:a.item.legendColor})});b(g,"afterUpdate",function(a,c,d){this.chart.colorAxis[0]&&this.chart.colorAxis[0].update({},
d)})});h(b,"parts-map/ColorSeriesMixin.js",[b["parts/Globals.js"],b["parts/Utilities.js"]],function(e,b){var h=b.defined;b=e.noop;var p=e.seriesTypes;e.colorPointMixin={dataLabelOnNull:!0,isValid:function(){return null!==this.value&&Infinity!==this.value&&-Infinity!==this.value},setVisible:function(e){var b=this,k=e?"show":"hide";b.visible=!!e;["graphic","dataLabel"].forEach(function(e){if(b[e])b[e][k]()})},setState:function(b){e.Point.prototype.setState.call(this,b);this.graphic&&this.graphic.attr({zIndex:"hover"===
b?1:0})}};e.colorSeriesMixin={pointArrayMap:["value"],axisTypes:["xAxis","yAxis","colorAxis"],optionalAxis:"colorAxis",trackerGroups:["group","markerGroup","dataLabelsGroup"],getSymbol:b,parallelArrays:["x","y","value"],colorKey:"value",pointAttribs:p.column.prototype.pointAttribs,translateColors:function(){var b=this,e=this.options.nullColor,h=this.colorAxis,p=this.colorKey;this.data.forEach(function(g){var d=g[p];if(d=g.options.color||(g.isNull?e:h&&void 0!==d?h.toColor(d,g):g.color||b.color))g.color=
d})},colorAttribs:function(b){var e={};h(b.color)&&(e[this.colorProp||"fill"]=b.color);return e}}});h(b,"parts-map/HeatmapSeries.js",[b["parts/Globals.js"]],function(b){var e=b.colorPointMixin,h=b.merge,r=b.noop,k=b.pick,l=b.Series,n=b.seriesType,q=b.seriesTypes;n("heatmap","scatter",{animation:!1,borderWidth:0,nullColor:"#f7f7f7",dataLabels:{formatter:function(){return this.point.value},inside:!0,verticalAlign:"middle",crop:!1,overflow:!1,padding:0},marker:null,pointRange:null,tooltip:{pointFormat:"{point.x}, {point.y}: {point.value}<br/>"},
states:{hover:{halo:!1,brightness:.2}}},h(b.colorSeriesMixin,{pointArrayMap:["y","value"],hasPointSpecificOptions:!0,getExtremesFromAll:!0,directTouch:!0,init:function(){q.scatter.prototype.init.apply(this,arguments);var b=this.options;b.pointRange=k(b.pointRange,b.colsize||1);this.yAxis.axisPointRange=b.rowsize||1},translate:function(){var b=this.options,d=this.xAxis,e=this.yAxis,h=b.pointPadding||0,l=function(a,b,d){return Math.min(Math.max(b,a),d)},p=this.pointPlacementToXValue();this.generatePoints();
this.points.forEach(function(a){var c=(b.colsize||1)/2,f=(b.rowsize||1)/2,g=l(Math.round(d.len-d.translate(a.x-c,0,1,0,1,-p)),-d.len,2*d.len);c=l(Math.round(d.len-d.translate(a.x+c,0,1,0,1,-p)),-d.len,2*d.len);var n=l(Math.round(e.translate(a.y-f,0,1,0,1)),-e.len,2*e.len);f=l(Math.round(e.translate(a.y+f,0,1,0,1)),-e.len,2*e.len);var q=k(a.pointPadding,h);a.plotX=a.clientX=(g+c)/2;a.plotY=(n+f)/2;a.shapeType="rect";a.shapeArgs={x:Math.min(g,c)+q,y:Math.min(n,f)+q,width:Math.max(Math.abs(c-g)-2*q,
0),height:Math.max(Math.abs(f-n)-2*q,0)}});this.translateColors()},drawPoints:function(){var b=this.chart.styledMode?"css":"animate";q.column.prototype.drawPoints.call(this);this.points.forEach(function(d){d.graphic[b](this.colorAttribs(d))},this)},hasData:function(){return!!this.processedXData.length},getValidPoints:function(b,d){return l.prototype.getValidPoints.call(this,b,d,!0)},animate:r,getBox:r,drawLegendSymbol:b.LegendSymbolMixin.drawRectangle,alignDataLabel:q.column.prototype.alignDataLabel,
getExtremes:function(){l.prototype.getExtremes.call(this,this.valueData);this.valueMin=this.dataMin;this.valueMax=this.dataMax;l.prototype.getExtremes.call(this)}}),b.extend({haloPath:function(b){if(!b)return[];var d=this.shapeArgs;return["M",d.x-b,d.y-b,"L",d.x-b,d.y+d.height+b,d.x+d.width+b,d.y+d.height+b,d.x+d.width+b,d.y-b,"Z"]}},e));""});h(b,"masters/modules/heatmap.src.js",[],function(){})});
//# sourceMappingURL=heatmap.js.map