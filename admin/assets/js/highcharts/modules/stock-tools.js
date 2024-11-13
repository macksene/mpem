/*
 Highstock JS v7.1.3 (2019-08-14)

 Advanced Highstock tools

 (c) 2010-2019 Highsoft AS
 Author: Torstein Honsi

 License: www.highcharts.com/license
*/
(function(f){"object"===typeof module&&module.exports?(f["default"]=f,module.exports=f):"function"===typeof define&&define.amd?define("highcharts/modules/stock-tools",["highcharts","highcharts/modules/stock"],function(p){f(p);f.Highcharts=p;return f}):f("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(f){function p(h,f,p,n){h.hasOwnProperty(f)||(h[f]=n.apply(null,p))}f=f?f._modules:{};p(f,"modules/stock-tools-bindings.js",[f["parts/Globals.js"],f["parts/Utilities.js"]],function(h,f){var p=
f.defined,n=f.isNumber,l=h.fireEvent,t=h.pick;f=h.extend;var k=h.merge,q=h.correctFloat,d=h.NavigationBindings.prototype.utils;d.addFlagFromForm=function(a){return function(b){var c=this,g=c.chart,e=g.stockTools,m=d.getFieldType;b=d.attractToPoint(b,g);var w={type:"flags",onSeries:b.series.id,shape:a,data:[{x:b.x,y:b.y}],point:{events:{click:function(){var a=this,b=a.options;l(c,"showPopup",{point:a,formType:"annotation-toolbar",options:{langKey:"flags",type:"flags",title:[b.title,m(b.title)],name:[b.name,
m(b.name)]},onSubmit:function(b){"remove"===b.actionType?a.remove():a.update(c.fieldsToOptions(b.fields,{}))}})}}}};e&&e.guiEnabled||g.addSeries(w);l(c,"showPopup",{formType:"flag",options:{langKey:"flags",type:"flags",title:["A",m("A")],name:["Flag A",m("Flag A")]},onSubmit:function(a){c.fieldsToOptions(a.fields,w.data[0]);g.addSeries(w)}})}};d.manageIndicators=function(a){var b=this.chart,c={linkedTo:a.linkedTo,type:a.type},g=["ad","cmf","mfi","vbp","vwap"],e="ad atr cci cmf macd mfi roc rsi vwap ao aroon aroonoscillator trix apo dpo ppo natr williamsr stochastic linearRegression linearRegressionSlope linearRegressionIntercept linearRegressionAngle".split(" ");
if("edit"===a.actionType)this.fieldsToOptions(a.fields,c),(a=b.get(a.seriesId))&&a.update(c,!1);else if("remove"===a.actionType){if(a=b.get(a.seriesId)){var m=a.yAxis;a.linkedSeries&&a.linkedSeries.forEach(function(a){a.remove(!1)});a.remove(!1);0<=e.indexOf(a.type)&&(m.remove(!1),this.resizeYAxes())}}else c.id=h.uniqueKey(),this.fieldsToOptions(a.fields,c),0<=e.indexOf(a.type)?(m=b.addAxis({id:h.uniqueKey(),offset:0,opposite:!0,title:{text:""},tickPixelInterval:40,showLastLabel:!1,labels:{align:"left",
y:-2}},!1,!1),c.yAxis=m.options.id,this.resizeYAxes()):c.yAxis=b.get(a.linkedTo).options.yAxis,0<=g.indexOf(a.type)&&(c.params.volumeSeriesID=b.series.filter(function(a){return"column"===a.options.type})[0].options.id),b.addSeries(c,!1);l(this,"deselectButton",{button:this.selectedButtonElement});b.redraw()};d.updateHeight=function(a,b){b.update({typeOptions:{height:this.chart.pointer.getCoordinates(a).yAxis[0].value-b.options.typeOptions.points[1].y}})};d.attractToPoint=function(a,b){a=b.pointer.getCoordinates(a);
var c=a.xAxis[0].value;a=a.yAxis[0].value;var g=Number.MAX_VALUE,e;b.series.forEach(function(a){a.points.forEach(function(a){a&&g>Math.abs(a.x-c)&&(g=Math.abs(a.x-c),e=a)})});return{x:e.x,y:e.y,below:a<e.y,series:e.series,xAxis:e.series.xAxis.index||0,yAxis:e.series.yAxis.index||0}};d.isNotNavigatorYAxis=function(a){return"highcharts-navigator-yaxis"!==a.userOptions.className};d.updateNthPoint=function(a){return function(b,c){var g=c.options.typeOptions;b=this.chart.pointer.getCoordinates(b);var e=
b.xAxis[0].value,m=b.yAxis[0].value;g.points.forEach(function(b,c){c>=a&&(b.x=e,b.y=m)});c.update({typeOptions:{points:g.points}})}};f(h.NavigationBindings.prototype,{getYAxisPositions:function(a,b,c){function g(a){return p(a)&&!n(a)&&a.match("%")}var e=0;a=a.map(function(a){var m=g(a.options.height)?parseFloat(a.options.height)/100:a.height/b;a=g(a.options.top)?parseFloat(a.options.top)/100:q(a.top-a.chart.plotTop)/b;n(m)||(m=c/100);e=q(e+m);return{height:100*m,top:100*a}});a.allAxesHeight=e;return a},
getYAxisResizers:function(a){var b=[];a.forEach(function(c,g){c=a[g+1];b[g]=c?{enabled:!0,controlledAxis:{next:[t(c.options.id,c.options.index)]}}:{enabled:!1}});return b},resizeYAxes:function(a){a=a||20;var b=this.chart,c=b.yAxis.filter(this.utils.isNotNavigatorYAxis),g=c.length;b=this.getYAxisPositions(c,b.plotHeight,a);var e=this.getYAxisResizers(c),m=b.allAxesHeight,d=a;1<m?(6>g?(b[0].height=q(b[0].height-d),b=this.recalculateYAxisPositions(b,d)):(a=100/g,b=this.recalculateYAxisPositions(b,a/
(g-1),!0,-1)),b[g-1]={top:q(100-a),height:a}):(d=100*q(1-m),5>g?(b[0].height=q(b[0].height+d),b=this.recalculateYAxisPositions(b,d)):b=this.recalculateYAxisPositions(b,d/g,!0,1));b.forEach(function(a,b){c[b].update({height:a.height+"%",top:a.top+"%",resize:e[b]},!1)})},recalculateYAxisPositions:function(a,b,c,g){a.forEach(function(e,m){m=a[m-1];e.top=m?q(m.height+m.top):0;c&&(e.height=q(e.height+g*b))});return a}});f={segment:{className:"highcharts-segment",start:function(a){a=this.chart.pointer.getCoordinates(a);
var b=this.chart.options.navigation;a=k({langKey:"segment",type:"crookedLine",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.segment.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1)]},arrowSegment:{className:"highcharts-arrow-segment",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"arrowSegment",type:"crookedLine",typeOptions:{line:{markerEnd:"arrow"},
points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.arrowSegment.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1)]},ray:{className:"highcharts-ray",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"ray",type:"crookedLine",typeOptions:{type:"ray",points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,
b.bindings.ray.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1)]},arrowRay:{className:"highcharts-arrow-ray",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"arrowRay",type:"infinityLine",typeOptions:{type:"ray",line:{markerEnd:"arrow"},points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.arrowRay.annotationsOptions);return this.chart.addAnnotation(a)},
steps:[d.updateNthPoint(1)]},infinityLine:{className:"highcharts-infinity-line",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"infinityLine",type:"infinityLine",typeOptions:{type:"line",points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.infinityLine.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1)]},arrowInfinityLine:{className:"highcharts-arrow-infinity-line",
start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"arrowInfinityLine",type:"infinityLine",typeOptions:{type:"line",line:{markerEnd:"arrow"},points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.arrowInfinityLine.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1)]},horizontalLine:{className:"highcharts-horizontal-line",start:function(a){a=this.chart.pointer.getCoordinates(a);
var b=this.chart.options.navigation;a=k({langKey:"horizontalLine",type:"infinityLine",draggable:"y",typeOptions:{type:"horizontalLine",points:[{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.horizontalLine.annotationsOptions);this.chart.addAnnotation(a)}},verticalLine:{className:"highcharts-vertical-line",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"verticalLine",type:"infinityLine",draggable:"x",typeOptions:{type:"verticalLine",
points:[{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.verticalLine.annotationsOptions);this.chart.addAnnotation(a)}},crooked3:{className:"highcharts-crooked3",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"crooked3",type:"crookedLine",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.crooked3.annotationsOptions);
return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1),d.updateNthPoint(2)]},crooked5:{className:"highcharts-crooked5",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"crookedLine",type:"crookedLine",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,
b.bindings.crooked5.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1),d.updateNthPoint(2),d.updateNthPoint(3),d.updateNthPoint(4)]},elliott3:{className:"highcharts-elliott3",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"elliott3",type:"elliottWave",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,
y:a.yAxis[0].value}]},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.elliott3.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1),d.updateNthPoint(2),d.updateNthPoint(3)]},elliott5:{className:"highcharts-elliott5",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"elliott5",type:"elliottWave",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},
{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.elliott5.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1),d.updateNthPoint(2),d.updateNthPoint(3),d.updateNthPoint(4),d.updateNthPoint(5)]},measureX:{className:"highcharts-measure-x",start:function(a){a=this.chart.pointer.getCoordinates(a);
var b=this.chart.options.navigation;a=k({langKey:"measure",type:"measure",typeOptions:{selectType:"x",point:{x:a.xAxis[0].value,y:a.yAxis[0].value,xAxis:0,yAxis:0},crosshairX:{strokeWidth:1,stroke:"#000000"},crosshairY:{enabled:!1,strokeWidth:0,stroke:"#000000"},background:{width:0,height:0,strokeWidth:0,stroke:"#ffffff"}},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.measureX.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateRectSize]},measureY:{className:"highcharts-measure-y",
start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"measure",type:"measure",typeOptions:{selectType:"y",point:{x:a.xAxis[0].value,y:a.yAxis[0].value,xAxis:0,yAxis:0},crosshairX:{enabled:!1,strokeWidth:0,stroke:"#000000"},crosshairY:{strokeWidth:1,stroke:"#000000"},background:{width:0,height:0,strokeWidth:0,stroke:"#ffffff"}},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.measureY.annotationsOptions);return this.chart.addAnnotation(a)},
steps:[d.updateRectSize]},measureXY:{className:"highcharts-measure-xy",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"measure",type:"measure",typeOptions:{selectType:"xy",point:{x:a.xAxis[0].value,y:a.yAxis[0].value,xAxis:0,yAxis:0},background:{width:0,height:0,strokeWidth:10},crosshairX:{strokeWidth:1,stroke:"#000000"},crosshairY:{strokeWidth:1,stroke:"#000000"}},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.measureXY.annotationsOptions);
return this.chart.addAnnotation(a)},steps:[d.updateRectSize]},fibonacci:{className:"highcharts-fibonacci",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"fibonacci",type:"fibonacci",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.fibonacci.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1),
d.updateHeight]},parallelChannel:{className:"highcharts-parallel-channel",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"parallelChannel",type:"tunnel",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.parallelChannel.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1),d.updateHeight]},pitchfork:{className:"highcharts-pitchfork",
start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=k({langKey:"pitchfork",type:"pitchfork",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value,controlPoint:{style:{fill:"red"}}},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}],innerBackground:{fill:"rgba(100, 170, 255, 0.8)"}},shapeOptions:{strokeWidth:2}},b.annotationsOptions,b.bindings.pitchfork.annotationsOptions);return this.chart.addAnnotation(a)},steps:[d.updateNthPoint(1),
d.updateNthPoint(2)]},verticalCounter:{className:"highcharts-vertical-counter",start:function(a){a=d.attractToPoint(a,this.chart);var b=this.chart.options.navigation,c=p(this.verticalCounter)?this.verticalCounter:0;a=k({langKey:"verticalCounter",type:"verticalLine",typeOptions:{point:{x:a.x,y:a.y,xAxis:a.xAxis,yAxis:a.yAxis},label:{offset:a.below?40:-40,text:c.toString()}},labelOptions:{style:{color:"#666666",fontSize:"11px"}},shapeOptions:{stroke:"rgba(0, 0, 0, 0.75)",strokeWidth:1}},b.annotationsOptions,
b.bindings.verticalCounter.annotationsOptions);a=this.chart.addAnnotation(a);a.options.events.click.call(a,{})}},verticalLabel:{className:"highcharts-vertical-label",start:function(a){a=d.attractToPoint(a,this.chart);var b=this.chart.options.navigation;a=k({langKey:"verticalLabel",type:"verticalLine",typeOptions:{point:{x:a.x,y:a.y,xAxis:a.xAxis,yAxis:a.yAxis},label:{offset:a.below?40:-40}},labelOptions:{style:{color:"#666666",fontSize:"11px"}},shapeOptions:{stroke:"rgba(0, 0, 0, 0.75)",strokeWidth:1}},
b.annotationsOptions,b.bindings.verticalLabel.annotationsOptions);a=this.chart.addAnnotation(a);a.options.events.click.call(a,{})}},verticalArrow:{className:"highcharts-vertical-arrow",start:function(a){a=d.attractToPoint(a,this.chart);var b=this.chart.options.navigation;a=k({langKey:"verticalArrow",type:"verticalLine",typeOptions:{point:{x:a.x,y:a.y,xAxis:a.xAxis,yAxis:a.yAxis},label:{offset:a.below?40:-40,format:" "},connector:{fill:"none",stroke:a.below?"red":"green"}},shapeOptions:{stroke:"rgba(0, 0, 0, 0.75)",
strokeWidth:1}},b.annotationsOptions,b.bindings.verticalArrow.annotationsOptions);a=this.chart.addAnnotation(a);a.options.events.click.call(a,{})}},flagCirclepin:{className:"highcharts-flag-circlepin",start:d.addFlagFromForm("circlepin")},flagDiamondpin:{className:"highcharts-flag-diamondpin",start:d.addFlagFromForm("flag")},flagSquarepin:{className:"highcharts-flag-squarepin",start:d.addFlagFromForm("squarepin")},flagSimplepin:{className:"highcharts-flag-simplepin",start:d.addFlagFromForm("nopin")},
zoomX:{className:"highcharts-zoom-x",init:function(a){this.chart.update({chart:{zoomType:"x"}});l(this,"deselectButton",{button:a})}},zoomY:{className:"highcharts-zoom-y",init:function(a){this.chart.update({chart:{zoomType:"y"}});l(this,"deselectButton",{button:a})}},zoomXY:{className:"highcharts-zoom-xy",init:function(a){this.chart.update({chart:{zoomType:"xy"}});l(this,"deselectButton",{button:a})}},seriesTypeLine:{className:"highcharts-series-type-line",init:function(a){this.chart.series[0].update({type:"line",
useOhlcData:!0});l(this,"deselectButton",{button:a})}},seriesTypeOhlc:{className:"highcharts-series-type-ohlc",init:function(a){this.chart.series[0].update({type:"ohlc"});l(this,"deselectButton",{button:a})}},seriesTypeCandlestick:{className:"highcharts-series-type-candlestick",init:function(a){this.chart.series[0].update({type:"candlestick"});l(this,"deselectButton",{button:a})}},fullScreen:{className:"highcharts-full-screen",init:function(a){var b=this.chart;b.fullScreen=new h.FullScreen(b.container);
l(this,"deselectButton",{button:a})}},currentPriceIndicator:{className:"highcharts-current-price-indicator",init:function(a){var b=this.chart,c=b.series[0],g=c.options,e=g.lastVisiblePrice&&g.lastVisiblePrice.enabled;g=g.lastPrice&&g.lastPrice.enabled;b=b.stockTools;var m=b.getIconsURL();b&&b.guiEnabled&&(a.firstChild.style["background-image"]=g?'url("'+m+'current-price-show.svg")':'url("'+m+'current-price-hide.svg")');c.update({lastPrice:{enabled:!g,color:"red"},lastVisiblePrice:{enabled:!e,label:{enabled:!0}}});
l(this,"deselectButton",{button:a})}},indicators:{className:"highcharts-indicators",init:function(){var a=this;l(a,"showPopup",{formType:"indicators",options:{},onSubmit:function(b){a.utils.manageIndicators.call(a,b)}})}},toggleAnnotations:{className:"highcharts-toggle-annotations",init:function(a){var b=this.chart,c=b.stockTools,g=c.getIconsURL();this.toggledAnnotations=!this.toggledAnnotations;(b.annotations||[]).forEach(function(a){a.setVisibility(!this.toggledAnnotations)},this);c&&c.guiEnabled&&
(a.firstChild.style["background-image"]=this.toggledAnnotations?'url("'+g+'annotations-hidden.svg")':'url("'+g+'annotations-visible.svg")');l(this,"deselectButton",{button:a})}},saveChart:{className:"highcharts-save-chart",init:function(a){var b=this,c=b.chart,g=[],e=[],m=[],d=[];c.annotations.forEach(function(a,b){g[b]=a.userOptions});c.series.forEach(function(a){a instanceof h.seriesTypes.sma?e.push(a.userOptions):"flags"===a.type&&m.push(a.userOptions)});c.yAxis.forEach(function(a){b.utils.isNotNavigatorYAxis(a)&&
d.push(a.options)});h.win.localStorage.setItem("highcharts-chart",JSON.stringify({annotations:g,indicators:e,flags:m,yAxes:d}));l(this,"deselectButton",{button:a})}}};h.setOptions({navigation:{bindings:f}})});p(f,"modules/stock-tools-gui.js",[f["parts/Globals.js"],f["parts/Utilities.js"]],function(h,f){var p=f.isArray,n=h.addEvent,l=h.createElement,t=h.pick,k=h.fireEvent,q=h.getStyle,d=h.merge,a=h.css,b=h.win;h.setOptions({lang:{stockTools:{gui:{simpleShapes:"Simple shapes",lines:"Lines",crookedLines:"Crooked lines",
measure:"Measure",advanced:"Advanced",toggleAnnotations:"Toggle annotations",verticalLabels:"Vertical labels",flags:"Flags",zoomChange:"Zoom change",typeChange:"Type change",saveChart:"Save chart",indicators:"Indicators",currentPriceIndicator:"Current Price Indicators",zoomX:"Zoom X",zoomY:"Zoom Y",zoomXY:"Zooom XY",fullScreen:"Fullscreen",typeOHLC:"OHLC",typeLine:"Line",typeCandlestick:"Candlestick",circle:"Circle",label:"Label",rectangle:"Rectangle",flagCirclepin:"Flag circle",flagDiamondpin:"Flag diamond",
flagSquarepin:"Flag square",flagSimplepin:"Flag simple",measureXY:"Measure XY",measureX:"Measure X",measureY:"Measure Y",segment:"Segment",arrowSegment:"Arrow segment",ray:"Ray",arrowRay:"Arrow ray",line:"Line",arrowLine:"Arrow line",horizontalLine:"Horizontal line",verticalLine:"Vertical line",infinityLine:"Infinity line",crooked3:"Crooked 3 line",crooked5:"Crooked 5 line",elliott3:"Elliott 3 line",elliott5:"Elliott 5 line",verticalCounter:"Vertical counter",verticalLabel:"Vertical label",verticalArrow:"Vertical arrow",
fibonacci:"Fibonacci",pitchfork:"Pitchfork",parallelChannel:"Parallel channel"}},navigation:{popup:{circle:"Circle",rectangle:"Rectangle",label:"Label",segment:"Segment",arrowSegment:"Arrow segment",ray:"Ray",arrowRay:"Arrow ray",line:"Line",arrowLine:"Arrow line",horizontalLine:"Horizontal line",verticalLine:"Vertical line",crooked3:"Crooked 3 line",crooked5:"Crooked 5 line",elliott3:"Elliott 3 line",elliott5:"Elliott 5 line",verticalCounter:"Vertical counter",verticalLabel:"Vertical label",verticalArrow:"Vertical arrow",
fibonacci:"Fibonacci",pitchfork:"Pitchfork",parallelChannel:"Parallel channel",infinityLine:"Infinity line",measure:"Measure",measureXY:"Measure XY",measureX:"Measure X",measureY:"Measure Y",flags:"Flags",addButton:"add",saveButton:"save",editButton:"edit",removeButton:"remove",series:"Series",volume:"Volume",connector:"Connector",innerBackground:"Inner background",outerBackground:"Outer background",crosshairX:"Crosshair X",crosshairY:"Crosshair Y",tunnel:"Tunnel",background:"Background"}}},stockTools:{gui:{enabled:!0,
className:"highcharts-bindings-wrapper",toolbarClassName:"stocktools-toolbar",buttons:"indicators separator simpleShapes lines crookedLines measure advanced toggleAnnotations separator verticalLabels flags separator zoomChange fullScreen typeChange separator currentPriceIndicator saveChart".split(" "),definitions:{separator:{symbol:"separator.svg"},simpleShapes:{items:["label","circle","rectangle"],circle:{symbol:"circle.svg"},rectangle:{symbol:"rectangle.svg"},label:{symbol:"label.svg"}},flags:{items:["flagCirclepin",
"flagDiamondpin","flagSquarepin","flagSimplepin"],flagSimplepin:{symbol:"flag-basic.svg"},flagDiamondpin:{symbol:"flag-diamond.svg"},flagSquarepin:{symbol:"flag-trapeze.svg"},flagCirclepin:{symbol:"flag-elipse.svg"}},lines:{items:"segment arrowSegment ray arrowRay line arrowLine horizontalLine verticalLine".split(" "),segment:{symbol:"segment.svg"},arrowSegment:{symbol:"arrow-segment.svg"},ray:{symbol:"ray.svg"},arrowRay:{symbol:"arrow-ray.svg"},line:{symbol:"line.svg"},arrowLine:{symbol:"arrow-line.svg"},
verticalLine:{symbol:"vertical-line.svg"},horizontalLine:{symbol:"horizontal-line.svg"}},crookedLines:{items:["elliott3","elliott5","crooked3","crooked5"],crooked3:{symbol:"crooked-3.svg"},crooked5:{symbol:"crooked-5.svg"},elliott3:{symbol:"elliott-3.svg"},elliott5:{symbol:"elliott-5.svg"}},verticalLabels:{items:["verticalCounter","verticalLabel","verticalArrow"],verticalCounter:{symbol:"vertical-counter.svg"},verticalLabel:{symbol:"vertical-label.svg"},verticalArrow:{symbol:"vertical-arrow.svg"}},
advanced:{items:["fibonacci","pitchfork","parallelChannel"],pitchfork:{symbol:"pitchfork.svg"},fibonacci:{symbol:"fibonacci.svg"},parallelChannel:{symbol:"parallel-channel.svg"}},measure:{items:["measureXY","measureX","measureY"],measureX:{symbol:"measure-x.svg"},measureY:{symbol:"measure-y.svg"},measureXY:{symbol:"measure-xy.svg"}},toggleAnnotations:{symbol:"annotations-visible.svg"},currentPriceIndicator:{symbol:"current-price-show.svg"},indicators:{symbol:"indicators.svg"},zoomChange:{items:["zoomX",
"zoomY","zoomXY"],zoomX:{symbol:"zoom-x.svg"},zoomY:{symbol:"zoom-y.svg"},zoomXY:{symbol:"zoom-xy.svg"}},typeChange:{items:["typeOHLC","typeLine","typeCandlestick"],typeOHLC:{symbol:"series-ohlc.svg"},typeLine:{symbol:"series-line.svg"},typeCandlestick:{symbol:"series-candlestick.svg"}},fullScreen:{symbol:"fullscreen.svg"},saveChart:{symbol:"save-chart.svg"}}}}});n(h.Chart,"afterGetContainer",function(){this.setStockTools()});n(h.Chart,"getMargins",function(){var a=this.stockTools&&this.stockTools.listWrapper;
(a=a&&(a.startWidth+h.getStyle(a,"padding-left")+h.getStyle(a,"padding-right")||a.offsetWidth))&&a<this.plotWidth&&(this.plotLeft+=a)});n(h.Chart,"destroy",function(){this.stockTools&&this.stockTools.destroy()});n(h.Chart,"redraw",function(){this.stockTools&&this.stockTools.guiEnabled&&this.stockTools.redraw()});h.Toolbar=function(a,b,e){this.chart=e;this.options=a;this.lang=b;this.iconsURL=this.getIconsURL();this.guiEnabled=a.enabled;this.visible=t(a.visible,!0);this.placed=t(a.placed,!1);this.eventsToUnbind=
[];this.guiEnabled&&(this.createHTML(),this.init(),this.showHideNavigatorion());k(this,"afterInit")};h.extend(h.Chart.prototype,{setStockTools:function(a){var b=this.options,c=b.lang;a=d(b.stockTools&&b.stockTools.gui,a&&a.gui);this.stockTools=new h.Toolbar(a,c.stockTools&&c.stockTools.gui,this);this.stockTools.guiEnabled&&(this.isDirtyBox=!0)}});h.Toolbar.prototype={init:function(){var a=this,b=this.lang,e=this.options,d=this.toolbar,h=a.addSubmenu,f=e.buttons,l=e.definitions,k=d.childNodes,q=this.inIframe(),
r;f.forEach(function(c){r=a.addButton(d,l,c,b);q&&"fullScreen"===c&&(r.buttonWrapper.className+=" highcharts-disabled-btn");["click","touchstart"].forEach(function(b){n(r.buttonWrapper,b,function(){a.eraseActiveButtons(k,r.buttonWrapper)})});p(l[c].items)&&h.call(a,r,l[c])})},addSubmenu:function(b,g){var c=this,d=b.submenuArrow,f=b.buttonWrapper,k=q(f,"width"),p=this.wrapper,v=this.listWrapper,t=this.toolbar.childNodes,r=0,u;this.submenu=u=l("ul",{className:"highcharts-submenu-wrapper"},null,f);this.addSubmenuItems(f,
g);["click","touchstart"].forEach(function(b){n(d,b,function(b){b.stopPropagation();c.eraseActiveButtons(t,f);0<=f.className.indexOf("highcharts-current")?(v.style.width=v.startWidth+"px",f.classList.remove("highcharts-current"),u.style.display="none"):(u.style.display="block",r=u.offsetHeight-f.offsetHeight-3,u.offsetHeight+f.offsetTop>p.offsetHeight&&f.offsetTop>r||(r=0),a(u,{top:-r+"px",left:k+3+"px"}),f.className+=" highcharts-current",v.startWidth=p.offsetWidth,v.style.width=v.startWidth+h.getStyle(v,
"padding-left")+u.offsetWidth+3+"px")})})},addSubmenuItems:function(a,b){var c=this,g=this.submenu,d=this.lang,h=this.listWrapper,f;b.items.forEach(function(e){f=c.addButton(g,b,e,d);["click","touchstart"].forEach(function(b){n(f.mainButton,b,function(){c.switchSymbol(this,a,!0);h.style.width=h.startWidth+"px";g.style.display="none"})})});var l=g.querySelectorAll("li > .highcharts-menu-item-btn")[0];c.switchSymbol(l,!1)},eraseActiveButtons:function(a,b,e){[].forEach.call(a,function(a){a!==b&&(a.classList.remove("highcharts-current"),
a.classList.remove("highcharts-active"),e=a.querySelectorAll(".highcharts-submenu-wrapper"),0<e.length&&(e[0].style.display="none"))})},addButton:function(a,b,e,d){b=b[e];var c=b.items,g=b.className||"";e=l("li",{className:t(h.Toolbar.prototype.classMapping[e],"")+" "+g,title:d[e]||e},null,a);a=l("span",{className:"highcharts-menu-item-btn"},null,e);if(c&&c.length){var f=l("span",{className:"highcharts-submenu-item-arrow highcharts-arrow-right"},null,e);f.style["background-image"]="url("+this.iconsURL+
"arrow-bottom.svg)"}else a.style["background-image"]="url("+this.iconsURL+b.symbol+")";return{buttonWrapper:e,mainButton:a,submenuArrow:f}},addNavigation:function(){var a=this.wrapper;this.arrowWrapper=l("div",{className:"highcharts-arrow-wrapper"});this.arrowUp=l("div",{className:"highcharts-arrow-up"},null,this.arrowWrapper);this.arrowUp.style["background-image"]="url("+this.iconsURL+"arrow-right.svg)";this.arrowDown=l("div",{className:"highcharts-arrow-down"},null,this.arrowWrapper);this.arrowDown.style["background-image"]=
"url("+this.iconsURL+"arrow-right.svg)";a.insertBefore(this.arrowWrapper,a.childNodes[0]);this.scrollButtons()},scrollButtons:function(){var a=0,b=this,e=b.wrapper,d=b.toolbar,f=.1*e.offsetHeight;["click","touchstart"].forEach(function(c){n(b.arrowUp,c,function(){0<a&&(a-=f,d.style["margin-top"]=-a+"px")});n(b.arrowDown,c,function(){e.offsetHeight+a<=d.offsetHeight+f&&(a+=f,d.style["margin-top"]=-a+"px")})})},createHTML:function(){var a=this.chart,b=this.options,e=a.container;a=a.options.navigation;
this.wrapper=a=l("div",{className:"highcharts-stocktools-wrapper "+b.className+" "+(a&&a.bindingsClassName)});e.parentNode.insertBefore(a,e);this.toolbar=e=l("ul",{className:"highcharts-stocktools-toolbar "+b.toolbarClassName});this.listWrapper=b=l("div",{className:"highcharts-menu-wrapper"});a.insertBefore(b,a.childNodes[0]);b.insertBefore(e,b.childNodes[0]);this.showHideToolbar();this.addNavigation()},showHideNavigatorion:function(){this.visible&&this.toolbar.offsetHeight>this.wrapper.offsetHeight-
50?this.arrowWrapper.style.display="block":(this.toolbar.style.marginTop="0px",this.arrowWrapper.style.display="none")},showHideToolbar:function(){var a=this.chart,b=this.wrapper,e=this.listWrapper,d=this.submenu,f=this.visible,k;this.showhideBtn=k=l("div",{className:"highcharts-toggle-toolbar highcharts-arrow-left"},null,b);k.style["background-image"]="url("+this.iconsURL+"arrow-right.svg)";f?(b.style.height="100%",k.style.top=h.getStyle(e,"padding-top")+"px",k.style.left=b.offsetWidth+h.getStyle(e,
"padding-left")+"px"):(d&&(d.style.display="none"),k.style.left="0px",this.visible=f=!1,e.classList.add("highcharts-hide"),k.classList.toggle("highcharts-arrow-right"),b.style.height=k.offsetHeight+"px");["click","touchstart"].forEach(function(b){n(k,b,function(){a.update({stockTools:{gui:{visible:!f,placed:!0}}})})})},switchSymbol:function(a,b){var c=a.parentNode,d=c.classList.value;c=c.parentNode.parentNode;c.className="";d&&c.classList.add(d.trim());c.querySelectorAll(".highcharts-menu-item-btn")[0].style["background-image"]=
a.style["background-image"];b&&this.selectButton(c)},selectButton:function(a){0<=a.className.indexOf("highcharts-active")?a.classList.remove("highcharts-active"):a.classList.add("highcharts-active")},unselectAllButtons:function(a){var b=a.parentNode.querySelectorAll(".highcharts-active");[].forEach.call(b,function(b){b!==a&&b.classList.remove("highcharts-active")})},inIframe:function(){try{return b.self!==b.top}catch(c){return!0}},update:function(a){d(!0,this.chart.options.stockTools,a);this.destroy();
this.chart.setStockTools(a);this.chart.navigationBindings&&this.chart.navigationBindings.update()},destroy:function(){var a=this.wrapper,b=a&&a.parentNode;this.eventsToUnbind.forEach(function(a){a()});b&&b.removeChild(a);this.chart.isDirtyBox=!0;this.chart.redraw()},redraw:function(){this.showHideNavigatorion()},getIconsURL:function(){return this.chart.options.navigation.iconsURL||this.options.iconsURL||"https://code.highcharts.com/7.1.3/gfx/stock-icons/"},classMapping:{circle:"highcharts-circle-annotation",
rectangle:"highcharts-rectangle-annotation",label:"highcharts-label-annotation",segment:"highcharts-segment",arrowSegment:"highcharts-arrow-segment",ray:"highcharts-ray",arrowRay:"highcharts-arrow-ray",line:"highcharts-infinity-line",arrowLine:"highcharts-arrow-infinity-line",verticalLine:"highcharts-vertical-line",horizontalLine:"highcharts-horizontal-line",crooked3:"highcharts-crooked3",crooked5:"highcharts-crooked5",elliott3:"highcharts-elliott3",elliott5:"highcharts-elliott5",pitchfork:"highcharts-pitchfork",
fibonacci:"highcharts-fibonacci",parallelChannel:"highcharts-parallel-channel",measureX:"highcharts-measure-x",measureY:"highcharts-measure-y",measureXY:"highcharts-measure-xy",verticalCounter:"highcharts-vertical-counter",verticalLabel:"highcharts-vertical-label",verticalArrow:"highcharts-vertical-arrow",currentPriceIndicator:"highcharts-current-price-indicator",indicators:"highcharts-indicators",flagCirclepin:"highcharts-flag-circlepin",flagDiamondpin:"highcharts-flag-diamondpin",flagSquarepin:"highcharts-flag-squarepin",
flagSimplepin:"highcharts-flag-simplepin",zoomX:"highcharts-zoom-x",zoomY:"highcharts-zoom-y",zoomXY:"highcharts-zoom-xy",typeLine:"highcharts-series-type-line",typeOHLC:"highcharts-series-type-ohlc",typeCandlestick:"highcharts-series-type-candlestick",fullScreen:"highcharts-full-screen",toggleAnnotations:"highcharts-toggle-annotations",saveChart:"highcharts-save-chart",separator:"highcharts-separator"}};n(h.NavigationBindings,"selectButton",function(a){var b=a.button,c=this.chart.stockTools;c&&c.guiEnabled&&
(c.unselectAllButtons(a.button),0<=b.parentNode.className.indexOf("highcharts-submenu-wrapper")&&(b=b.parentNode.parentNode),c.selectButton(b))});n(h.NavigationBindings,"deselectButton",function(a){a=a.button;var b=this.chart.stockTools;b&&b.guiEnabled&&(0<=a.parentNode.className.indexOf("highcharts-submenu-wrapper")&&(a=a.parentNode.parentNode),b.selectButton(a))})});p(f,"masters/modules/stock-tools.src.js",[],function(){})});
//# sourceMappingURL=stock-tools.js.map