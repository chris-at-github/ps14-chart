// import Chart from 'chart.js/auto';
// import Filter from "../modules/filter";
//

(function () {
	'use strict';

	xna.on('documentLoaded', function() {

		document.querySelectorAll('.chart--line-chart').forEach(function(node) {
			const identifier = node.getAttribute('data-identifier');
			const settings = xna.settings.charts[identifier];

			const animationDelay = 45;
			const animations = {
				x: {
					type: 'number',
					easing: 'easeOutElastic',
					duration: animationDelay,
					from: NaN, // the point is initially skipped
					delay(ctx) {
						if (ctx.type !== 'data' || ctx.xStarted) {
							return 0;
						}
						ctx.xStarted = true;
						return ctx.index * animationDelay;
					}
				},
				y: {
					type: 'number',
					easing: 'easeOutElastic',
					duration: animationDelay,
					from: function(ctx) {
						return ctx.chart.scales.y.getPixelForValue(100);
					},
					delay(ctx) {
						if (ctx.type !== 'data' || ctx.yStarted) {
							return 0;
						}
						ctx.yStarted = true;
						return ctx.index * animationDelay;
					}
				}
			};

			const ctx = node.querySelector('.chart--canvas');
			const chart = new Chart(node.querySelector('.chart--canvas'), {
				type: 'line',
				data: {
					labels: settings.labels,
					datasets: settings.datasets
				},
				options: {
					animations: animations,
					interaction: {
						intersect: false
					},
					maintainAspectRatio: false,
					plugins : {
						legend: false
					},
					scales: {
						x: {
							display: true,
							title: {
								display: true,
								text: settings.axis.x.label
							}
						},
						y: {
							beginAtZero: true,
							display: true,
							title: {
								display: true,
								text: settings.axis.y.label
							}
						}
					}
				}
			});
		});
	});
})();



